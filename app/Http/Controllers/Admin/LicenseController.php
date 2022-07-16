<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LicenseExport;
use App\Http\Controllers\Controller;
use App\Models\License;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $licenses = License::with(['product','user'])->latest()->get();
        return view('admin.license.index', compact('licenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = User::where('user_type',User::USER_TYPE['customer'])->get();
        $products = Product::get();
        $statuses = User::STATUS;
        $licenseTypes = License::LICENSE_TYPE;
        return view('admin.license.create',compact('customers','products','statuses','licenseTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // save
        $validated = $request->validate([
            'product_id' => 'required',
            'user_id' => 'required',
            'license_code' => 'required|string|max:150',
            'license_type' => 'required|string|max:150',
            'status' => 'required',
            'expiry' => 'sometimes|nullable|date|after:' . date('Y-m-d'),
        ]);

        $validated['status'] = License::STATUS[$request->status];
        License::create($validated);

        return redirect()->route('admin.licenses.index')->with('success', __('Successfully created!'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customers = User::where('user_type',User::USER_TYPE['customer'])->get();
        $products = Product::get();
        $license = License::with(['product','user'])->findOrFail($id);
        $statuses = User::STATUS;
        $licenseTypes = License::LICENSE_TYPE;
        return view('admin.license.show', compact('license','products','customers','statuses','licenseTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = User::where('user_type',User::USER_TYPE['customer'])->get();
        $products = Product::get();
        $license = License::with(['product','user'])->findOrFail($id);
        $statuses = User::STATUS;
        $licenseTypes = License::LICENSE_TYPE;
        return view('admin.license.edit', compact('license','products','customers','statuses','licenseTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $license = License::with(['product','user'])->findOrFail($id);
        // save user name
        $validated = $request->validate([
            'product_id' => 'required',
            'user_id' => 'required',
            'license_code' => 'required|string|max:150',
            'license_type' => 'required|string|max:150',
            'status' => 'required',
            'expiry' => 'sometimes|nullable|date|after:' . date('Y-m-d'),
        ]);

        $validated['status'] = License::STATUS[$request->status];
        $license->update($validated);

        return redirect()->route('admin.licenses.index')->with('success', __('Successfully updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $msg = 'Something went wrong.';
        $code = 400;
        $license = License::find($id);

        if (!empty($license)) {
            $license->delete();
            $msg = __("Successfully deleted!");
            $code = 200;
        }
        return response()->json(['msg' => $msg], $code);
    }

    public function export(Request $request)
    {
        $date = explode("do",$request->date_range);
        $from = date('Y-m-d H:i:s', strtotime(trim($date[0])));
        $to = date('Y-m-d H:i:s', strtotime(trim($date[1])));
        $ext = $request->ext;
        $filenameExt = "xlsx";
        $writerType = Excel::XLSX;
        if ($ext == "csv") {
            $filenameExt = "csv";
            $writerType = Excel::CSV;
        }
        return (new LicenseExport($from,$to))->download('licenses.' . $filenameExt, $writerType);
    }
}
