<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\StorePackageFileRequest;
use App\Jobs\File\ReadToDB;
use App\Models\Glossary\FileStatus;
use App\Models\Payment\File;
use App\Models\Payment\Package;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class FileController extends Controller
{
    public function index(Package $package){
        $files = $package->files()->paginate(50)->toResourceCollection();

        return Inertia::render('payment/files/index', compact('files'));
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

    public function show(File $file)
    {
        return redirect()->route('payments.package.recipients.index', compact('file'));
    }

    public function delete(Package $package, File $file){
        $file->delete();
        return response('Файл удален');
    }
}
