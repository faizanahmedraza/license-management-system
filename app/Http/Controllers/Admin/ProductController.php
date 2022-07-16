<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
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
            'name' => 'required|string|max:150',
            'short_code' => 'required|string|max:255',
            'version_number' => 'required|max:20',
            'description' => 'sometimes|nullable|string|max:1000'
        ]);

        $validated['slug'] = Str::slug($request->name);
        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', __('Successfully created!'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
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
        $product = Product::findOrFail($id);
        // save user name
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'short_code' => 'required|string|max:255',
            'version_number' => 'required|max:20',
            'description' => 'sometimes|nullable|string|max:1000',
        ]);

        $validated['slug'] = Str::slug($request->name);
        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', __('Successfully updated!'));
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
        $product = Product::with('licenses')->find($id);

        if (!empty($product)) {
            if ($product->licenses->isEmpty()) {
                $product->delete();
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
        return (new ProductExport($from,$to))->download('products.' . $filenameExt, $writerType);
    }
}
