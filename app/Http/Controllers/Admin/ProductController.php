<?php
 
namespace App\Http\Controllers\Admin;
 
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
 
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', ['products' => $products]);
    }
 
    public function create()
    {
        return view('admin.products.create');
    }
 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'sale_price'  => 'nullable|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category'    => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
 
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }
 
        // ✅ FIX: Checkbox agar nahi aaya toh 0 set karo
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $validated['slug'] = Str::slug($validated['name']) . '-' . time();
 
        Product::create($validated);
 
        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }
 
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }
 
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'sale_price'  => 'nullable|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category'    => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
 
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }
 
        // ✅ FIX: Checkbox agar tick nahi toh 0 save hoga
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $validated['slug'] = Str::slug($validated['name']) . '-' . $product->id;
 
        $product->update($validated);
 
        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }
 
    public function destroy(Product $product)
    {
        $product->delete();
 
        return back()->with('success', 'Product deleted successfully!');
    }
}
 