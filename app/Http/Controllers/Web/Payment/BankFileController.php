<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment\Raport;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use ZipArchive;

class BankFileController extends Controller
{
    public function download(Raport $raport)
    {
        $archive_name = $raport->id . '.zip';
        $archive_dir = 'archives';
        $archive_path = Storage::disk('bank-files')->path($archive_dir . '/' . $archive_name);

        $zip = new ZipArchive();
        $zip->open($archive_path, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($raport->bankFiles as $file) {
            $path = Storage::disk($file->disk)->path($file->localPath());

            $zip->addFile($path, $file->bank->number_code . '/' . $file->name);
        }

        $zip->close();

        $name = 'Файлы в банки по ' . $raport->event->code . 'выплате на ' . $raport->event->date->format('d.m.Y') . '.zip';

        return Storage::disk('bank-files')->download($archive_dir . '/' . $archive_name, $name);
    }
}
