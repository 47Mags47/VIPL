<?php

namespace App\Classes;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class Dumper
{
    private string $path;
    private string $name;
    private array $ignored;

    private string $database;
    private string $db_user;
    private string $db_password;

    private bool $only_data = false;
    private bool $tablespaces = false;
    private bool $insert = true;


    public function __construct()
    {
        $this->ignored = [];
        $this->database = env('DB_DATABASE', 'Laravel');
        $this->db_user = env('DB_USERNAME', 'root');
        $this->db_password = env('DB_PASSWORD', null);
    }

    public function setPath(string $path)
    {
        $this->path = $path;
        return $this;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function ignore(Collection|array $tables)
    {
        foreach ($tables as $table) {
            $this->ignored[] = $table;
        }

        return $this;
    }

    public function onlyData(bool $bool){
        $this->only_data = $bool;
        return $this;
    }

    private function getIgnoredString()
    {
        foreach ($this->ignored as $key => $table) {
            $database = $this->database;
            $this->ignored[$key] = " --ignore-table=$database.$table";
        }

        return implode(' ', $this->ignored);
    }

    private function getUserString()
    {
        return "--user=" . $this->db_user . " --password=" . $this->db_password;
    }

    private function attrs()
    {
        $attrs = [
            "$this->database"                       => true,
            "--no-tablespaces"                      => !$this->tablespaces,
            "--complete-insert"                     => $this->insert,
            "--order-by-primary"                    => true,
            "--skip-comments"                       => true,
            "--replace"                             => true,
            $this->getUserString()                  => true,
            "--no-create-info"                      => $this->only_data,
            $this->getIgnoredString()               => true,
            "--result-file=$this->path/$this->name" => true,
        ];

        return collect($attrs)
            ->map(function ($insert, $attr) {
                if ($insert) return $attr;
            })
            ->implode(' ');
    }

    public function start()
    {
        Log::info('Создание дампа БД', ['call' => __CLASS__, 'attrs' => get_object_vars($this)]);

        if (!file_exists($this->path)) {
            Log::error("Дирректория $this->path не существует");
            throw new Exception("Дирректория $this->path не существует");
        }

        exec("mysqldump " . $this->attrs() . " 2>&1", $output, $code);

        if ($code !== 0) {
            Log::error('Операция завершилась ошибкой:\n ' . implode('\r\n', $output));
            throw new Exception(implode('\n', $output));
        }

        Log::info('Создание дампа прошло успешно', ['path' => "$this->path/$this->name"]);

        return "$this->path/$this->name";
    }

    public function restore(string $path)
    {
        self::staticRestore($path, $this->database, $this->getUserString());
    }

    private static function staticRestore(string $path, string $database, string $user_string)
    {
        Log::info('Восстановление дампа БД', ['call' => __CLASS__, 'dump path' => $path, 'database' => $database]);

        if (!file_exists($path)) {
            Log::error("Файл $path не существует");
            throw new Exception("Файл $path не существует");
        }

        $restore_command = "mysql $user_string $database < $path 2>&1";
        exec($restore_command, $output, $code);
        if ($code !== 0) {
            Log::error('Операция завершилась ошибкой:\n ' . implode('\r\n', $output));
            throw new Exception(implode('\r\n', $output));
        }

        Log::info('Восстановление дампа завершено');
    }
}
