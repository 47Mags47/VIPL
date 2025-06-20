<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CheckFileRequest;
use App\Http\Requests\Payment\StoreFileRequest;
use App\Jobs\File\ReadToDB;
use App\Models\Glossary\Bank;
use App\Models\Glossary\FileStatus;
use App\Models\Payment\File;
use App\Models\Payment\Package;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\ResumableJSUploadHandler;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class FileController extends Controller
{
    public function index(Package $package)
    {
        $files = $package->files()->orderBy('created_at', 'desc')->paginate(50)->toResourceCollection();
        $banks = Bank::orderBy('number_code')->get()->toResourceCollection();

        return Inertia::render('payment/files/index', [
            'package' => $package->toResource(),
            'files' => $files,
            'banks' => $banks
        ]);
    }

    public function check(CheckFileRequest $request, Package $package)
    {
        return back()->with('message', 'Началась загрузка файла');
    }

    public function store(StoreFileRequest $request, Package $package)
    {
        $receiver = new FileReceiver("file", $request, ResumableJSUploadHandler::class);

        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        $save = $receiver->receive();

        if ($save->isFinished()) {
            $disk = 'uploads';
            $file_name = Str::random(40) . '.' . $save->getFile()->getClientOriginalExtension();
            $file_origin_name = $save->getFile()->getClientOriginalName();
            $file_path = '';
            $full_path = Storage::disk($disk)->path($file_path);

            $save->getFile()->move($full_path, $file_name);

            $file = File::create([
                'disk' => $disk,
                'name' => $file_name,
                'path' => $file_path,
                'origin_name' => $file_origin_name,
                'errors' => [],
                'package_id' => $package->id,
                'bank_id' => $request->bank,
                'status_id' => FileStatus::byCode('uploaded')->id
            ]);

            ReadToDB::dispatch($file);
        }
    }

    public function show(Package $package, File $file)
    {
        return redirect()->route('payments.file.recipients.index', compact('file'));
    }

    public function destroy(Package $package, File $file)
    {
        $file->delete();
        return response('Файл удален');
    }
}
