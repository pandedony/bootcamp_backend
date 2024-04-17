<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'color' => 'nullable|string|max:255',
                'category' => 'required|exists:categories,id',
                'description' => 'nullable|string',
                'productImg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($request->hasFile('productImg')) {
                $image = $request->file('productImg');
                $imageName = time() . '.' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('images/products', $imageName, 'public');
            } else {
                $imageName = 'preview.jpg';
            }

            Product::create([
                'title' => $request->input('name'),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'colors' => $request->input('color'),
                'user_id' => Auth::user()->id,
                'category_id' => $request->input('category'),
                'imageUrl' => $imageName,
            ]);

            DB::commit();

            return redirect()->route('product.index')->with('success', 'Product saved successfully.');
        } catch (\Exception $th) {
            DB::rollBack();

            if (isset($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return redirect()->back()->withInput()->with('error', 'An error occurred while saving the product.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail(Crypt::decrypt($id));
        $encryptedId = Crypt::encrypt($product->id);
        return view('admin.product.show', compact('product', 'encryptedId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail(Crypt::decrypt($id));
        $encryptedId = Crypt::encrypt($product->id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories', 'encryptedId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $product = Product::findOrFail(Crypt::decrypt($id));

            $product->update([
                'title' => $request->input('name'),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'colors' => $request->input('color'),
            ]);

            DB::commit();

            return redirect()->route('product.index')->with('success', 'Product updated successfully');
        } catch (\Exception $th) {
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product)
    {
        try {
            DB::beginTransaction();

            $product = Product::findOrFail(Crypt::decrypt($product));
            $product->delete();
            if ($product->imageUrl !== 'preview.jpg') {
                Storage::disk('public')->delete('images/products' . $product->imageUrl);
            }

            DB::commit();
            return redirect()->route('product.index')->with('success', 'Product record deleted sucessfully');
        } catch (\Exception $th) {
            DB::rollback();
            return redirect()->route('product.index')->withErrors(['error' => 'Error, Please try again.']);
        }
    }

    public function getProducts(Request $request)
    {

        if ($request->ajax()) {
            $model = Product::query()->with('category');

            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('customPrice', function ($product) {
                    return 'Rp ' . number_format($product->price,  0, ',', '.');
                })
                ->addColumn('action', function ($product) {
                    $encryptedId = Crypt::encrypt($product->id);
                    return view('admin.product.action', compact('encryptedId'))->render();
                })
                ->addColumn('avatar', function ($product) {
                    $imageUrl = asset("storage/images/products/{$product->imageUrl}");

                    return '
                <div>
                    <div class="avatar-container" style="width: 50px; height 50px; overflow: hidden; border-radius:50%;">
                        <img src="' . $imageUrl . '" alt="Avatar" style="width:100% height: auto;">
                    </div>
                </div>';
                })
                ->escapeColumns([])
                ->toJson();
        } else {
            return "404 Not Found";
        }
    }
}
