<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addCategory(){
        return view('admin.addcategory');
    }
    public function postaddcategory(Request $request){
        $category = new Category();
        $category->category = $request->category;
        $category->save();
        return to_route('admin.viewcategory')->with('success','Category added successfully');
    }
    public function viewCategory(Category $category){
        $categories = Category::paginate(6);
        return view('admin.categories',compact('categories'));
    }
    public function deleteCategory(Category $category){
        $category->delete();
        return to_route('admin.viewcategory')->with('success','the category has been successfully deleted');
    }
    public function updateCategory(Request $request, Category $category)
    {
        $category->category = $request->category;
        $category->save();
        return to_route('admin.viewcategory')->with('success', 'Category updated successfully');
    }
    public function addProduct(){
        $categories = Category::all();
        return view('admin.addproduct',compact('categories'));
    }
    public function postAddProduct(ProductRequest $request){
        $formFields = $request->validated();
        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('products', 'public');
        }
        Product::create($formFields);
        return to_route('admin.viewproduct')->with('success', 'Product created successfully');

    }
    public function viewProduct(){
        $products = Product::paginate(5);
        return view('admin.products',compact('products'));
    }
    public function deleteProduct(Product $product){
        $product->delete();
        return to_route('admin.viewproduct')->with('success', 'Product deleted successfully');
    }
    public function editProduct(Product $product){
        $categories = Category::all(); // toutes les catégories
        return view('admin.editproduct', compact('product','categories'));
    }

    public function updateProduct(ProductRequest $request , Product $product){
        $formFields = $request->validated();
        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('products', 'public');
        }
        $product->fill($formFields)->save();
        return to_route('admin.viewproduct')->with('success','Product successfully updated');

    }
    public function searchProduct(Request $request){
        $products = Product::where('name','LIKE','%'.$request->search.'%')
        ->orWhere('category','LIKE','%'.$request->search.'%')
        ->orWhere('id','LIKE','%'.$request->search.'%')
        ->paginate(5);
        return view('admin.products',compact('products'));
    }
    public function viewOrders(){
        $orders = Order::with('product')->latest()->get();
        return view('admin.vieworders', compact('orders'));
    }
    public function searchOrder(Request $request){
        $orders = Order::with('product')
            ->where('name','LIKE','%'.$request->search.'%')
            ->orWhere('telephone','LIKE','%'.$request->search.'%')
            ->latest()
            ->get();
        return view('admin.vieworders', compact('orders'));
    }
    public function changeStatus(Request $request,Order $order){
        $order->status = $request->status;
        $order->save();
        return to_route('admin.vieworders')->with('success', 'Status updated successfully');
    }
    public function downloadPdf(Order $order){
        $pdf = PDF::loadView('admin.facture',compact('order'));
        return $pdf->download('facture.pdf');
    }



}
