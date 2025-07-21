<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment\Raport;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class BankFileController extends Controller
{
    public function download(Raport $raport)
    {
        $archive_name = $raport->id . '.zip';
        $archive_path = Storage::disk('bank-files')->path($archive_name);

        $zip = new ZipArchive();
        $zip->open($archive_path, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($raport->bankFiles as $file) {
            $zip->addFile($file->getFullPath(), $file->bank->number_code . '/' . $file->original_name);
        }

        $zip->close();

        $name = 'Файлы в банки по ' . $raport->event->code . 'выплате на ' . $raport->event->date->format('d.m.Y') . '.zip';

        return Storage::disk('bank-files')->download($archive_name, $name);
    }
}
