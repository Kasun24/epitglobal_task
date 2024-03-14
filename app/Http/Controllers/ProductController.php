<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

/**
 * ProductController class
 *
 * @author <NAME>
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = 10; // default value
        $product = Product::orderBy('name', 'asc')->paginate($perPage);
    
        return view('product.index', compact('product', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:products',
            'category' => 'required',
            'supplier' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'note' => 'max:1000',
        ]);

        $product = Product::create($request->all());

        Alert::success('Success', 'Product has been saved!');
        return redirect('/product');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return void
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $product_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($product_id)
    {
        $product = product::findOrFail($product_id);

        return view('product.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $product_id)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:products,name,'. $product_id. ',product_id',
            'category' => 'required',
            'supplier' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'note' => 'max:1000',
        ]);

        $product = Product::findOrFail($product_id);
        $product->update($validated);

        Alert::info('Success', 'Product has been updated!');
        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($product_id)
    {
        try {
            $deletedproduct = Product::findOrFail($product_id);

            $deletedproduct->delete();

            Alert::error('Success', 'Product has been deleted!');
            return redirect('/product');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Cant deleted, Product already used!');
            return redirect('/product');
        }
    }
}