<?php

namespace App\Http\Controllers\Web\Payment;

use App\Events\Payment\File\UploadEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\StoreFileRequest;
use App\Models\Glossary\Bank;
use App\Models\Glossary\FileStatus;
use App\Models\Payment\File;
use App\Models\Payment\Package;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class FileController extends Controller
{
    public function index(Package $package)
    {
        return Inertia::render('payment/files/Index', [
            'package' => $package->toResource(),
            'files' => fn() => $package->files()->api(),
        ]);
    }

    public function create(Package $package)
    {
        return Inertia::render('payment/files/Create', [
            'package' => $package->toResource(),
            'banks' => fn() => Bank::api(),
        ]);
    }

    public function store(StoreFileRequest $request, Package $package)
    {
        $upload = $request->file('file');
        $disk = 'uploads';
        $file_name = Str::random(40) . '.' . $upload ->getClientOriginalExtension();
        $file_origin_name = $upload ->getClientOriginalName();
        $file_path = 'uploads';

        Storage::disk($disk)->putFileAs($file_path, $upload, $file_name);

        $file = File::create([
            'disk' => $disk,
            'name' => $file_name,
            'path' => $file_path,
            'origin_name' => $file_origin_name,
            'errors' => [],
            'package_id' => $package->id,
            'bank_id' => $request->bank,
            'status_id' => FileStatus::byCode('loading')->id
        ]);

        UploadEvent::dispatch($file);

        return redirect()->route('payments.files.index', compact('package'));
    }

    public function show(Package $package, File $file)
    {
        return redirect()->route('payments.recipients.index', compact('file'));
    }

    public function destroy(Package $package, File $file)
    {
        $file->delete();

        return redirect()->route('payments.files.index', ['package' => $file->package])->with('message', 'Запись удалена');
    }
}
