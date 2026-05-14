<?php
 
namespace App\Http\Controllers;
 
use App\Models\Product;
use Illuminate\Http\Request;
 
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
 
        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->whereIn('category', (array)$request->category);
        }
 
        // Filter by price range
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }
 
        // Sort
        $sort = $request->sort ?? 'newest';
        if ($sort === 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_high') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'featured') {
            $query->where('is_featured', true)->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }
 
        $products = $query->paginate(12);
        $categories = Product::distinct()->pluck('category');
 
        return view('products.index', compact('products', 'categories'));
    }
 

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
 
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
 
        return view('products.show', compact('product', 'relatedProducts'));
    }
}