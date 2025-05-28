<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\StorePackageFileRequest;
use App\Jobs\File\ReadToDB;
use App\Models\Glossary\FileStatus;
use App\Models\Payment\File;
use App\Models\Payment\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function table(Package $package){
        return view('pages.payment.package.file.table', compact('package'));
    }

    public function create(Package $package){
        return view('pages.payment.package.file.create', compact('package'));
    }

    public function store(StorePackageFileRequest $request, Package $package){
        if(!Storage::disk('ftp')->has($request->path))
            return abort(404);

        $data = array_merge($request->only([
            'path', 'bank_id', 'package_id'
        ]), [
            'hash' => Storage::disk('ftp')->checksum($request->path),
            'size' => Storage::disk('ftp')->size($request->path),
            'errors' => [],

            'package_id' => $package->id,
            'status_id' => FileStatus::byCode('reading')->id,
        ]);

        $file = File::create($data);

        ReadToDB::dispatch($file);

        return redirect()->route('payment.package.edit', ['event' => $package->event_id]);
    }

    public function delete(Package $package, File $file){
        $file->delete();
        return response('Файл удален');
    }
}
