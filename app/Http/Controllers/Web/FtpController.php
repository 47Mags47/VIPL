<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FtpController extends Controller
{
    public function modal(Request $request){
        $path = $request->path ?? '001';

        $folders = Storage::disk('ftp')->directories($path);
        $files = Storage::disk('ftp')->files($path);

        return view('pages.file.modal', compact('path', 'folders', 'files'));
    }

    public function table(Request $request)
    {
        if (!$request->ajax())
            return abort(403);

        $path = $request->path ?? '001';

        $folders = Storage::disk('ftp')->directories($path);
        $files = Storage::disk('ftp')->files($path);

        return view('pages.file.table', compact('path', 'folders', 'files'))->render();
    }
}
