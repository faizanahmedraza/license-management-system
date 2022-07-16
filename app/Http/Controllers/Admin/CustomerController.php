<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CustomerExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCustomerRequest;
use App\Models\User;
use App\Models\UserInfo;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel;

class CustomerController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::where('user_type', User::USER_TYPE['customer'])->latest()->get();
        return view('admin.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CreateCustomerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCustomerRequest $request)
    {
        // save user name
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:users',
        ]);

        $validated['password'] = Str::random(8);
        $validated['user_type'] = User::USER_TYPE['customer'];
        $validated['status'] = User::STATUS['pending'];
        $customer = User::create($validated);

        // save on user info
        $info = UserInfo::where('user_id', $customer->id)->first();

        if ($info === null) {
            // create new model
            $info = new UserInfo();
        }

        // attach this info to the customer
        $info->user()->associate($customer);

        foreach ($request->only(array_keys($request->rules())) as $key => $value) {
            if (is_array($value)) {
                $value = serialize($value);
            }
            $info->$key = $value;
        }

        // include to save avatar
        if ($avatar = ImageService::upload()) {
            $info->avatar = $avatar;
        }

        if ($request->boolean('avatar_remove')) {
            ImageService::delete($info->avatar);
            $info->avatar = null;
        }

        $info->save();

        return redirect()->route('admin.customers.index')->with('success', __('Successfully created!'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = User::with('info')->findOrFail($id);
        $statuses = User::STATUS;
        return view('admin.customer.show', compact('customer', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = User::with('info')->findOrFail($id);
        $statuses = User::STATUS;
        return view('admin.customer.edit', compact('customer', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\CreateCustomerRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCustomerRequest $request, $id)
    {
        $customer = User::with('info')->findOrFail($id);
        // save user name
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:users,email,' . $id,
        ]);

        $validated['status'] = !empty($request->status) ? User::STATUS[$request->status] : $customer->status;
        $customer->update($validated);

        // save on user info
        $info = UserInfo::where('user_id', $customer->id)->first();

        if ($info === null) {
            // create new model
            $info = new UserInfo();
        }

        // attach this info to the customer
        $info->user()->associate($customer);

        foreach ($request->only(array_keys($request->rules())) as $key => $value) {
            if (is_array($value)) {
                $value = serialize($value);
            }
            $info->$key = $value;
        }

        // include to save avatar
        if ($avatar = ImageService::upload()) {
            $info->avatar = $avatar;
        }

        if ($request->boolean('avatar_remove')) {
            ImageService::delete($info->avatar);
            $info->avatar = null;
        }
        $info->save();

        return redirect()->route('admin.customers.index')->with('success', __('Successfully updated!'));
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
        $customer = User::with('licenses')->find($id);

        if (!empty($customer)) {
            if ($customer->licenses->isEmpty()) {
                $customer->info()->delete();
                $customer->delete();
                $msg = __("Successfully deleted!");
                $code = 200;
            } else {
                $msg = __("Kindly delete relational data first!");
            }
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
        return (new CustomerExport($from,$to))->download('customers.' . $filenameExt, $writerType);
    }
}
