<?php

namespace App\Http\Controllers\Web\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PackageIndexRequest;
use App\Models\Glossary\PackageStatus;
use App\Models\Payment\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(){
        $packages = Package::orderBy('created_at', 'desc')->get();

        return view('pages.payment.package.index', compact('packages'));
    }

    public function edit(PackageIndexRequest $request)
    {
        $package = Package::firstOrCreate([
            'division_id' => user()->division_id,
            'event_id' => $request->event,

        ], [
            'status_id' => PackageStatus::byCode('created')->id
        ]);

        if($package->status_id === PackageStatus::byCode('ready')->id)
            $package->update(['status_id' => PackageStatus::byCode('updated')->id]);

        if($request->ajax()){
            return view('pages.payment.package.file.table', compact('package'));
        }

        return view('pages.payment.package.edit', compact('package'));
    }

    public function mark(Package $package){
        $package->update(['status_id' => PackageStatus::byCode('ready')->id]);

        return redirect()->route('payment.package.show', compact('package'));
    }

    public function show(Package $package){
        return view('pages.payment.package.show', compact('package'));
    }
}
