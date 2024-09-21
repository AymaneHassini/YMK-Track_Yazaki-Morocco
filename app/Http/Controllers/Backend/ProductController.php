<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function AllProduct()
    {

        $product = Product::latest()->get();
        return view('backend.product.all_product', compact('product'));

    } // End Method

    public function AddProduct()
    {

        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();
        return view('backend.product.add_product', compact('category', 'supplier'));
    }// End Method
    public function StoreProduct(Request $request)
    {

        $pcode = IdGenerator::generate(['table' => 'products','field' => 'product_code','length' => 4, 'prefix' => 'PC' ]);
     
        $image = $request->file('product_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/product/'.$name_gen);
        $save_url = 'upload/product/'.$name_gen;
    
        Product::insert([
    
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $pcode,
            'product_garage' => $request->product_garage,
            'product_store' => $request->product_store,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'product_image' => $save_url,
            'created_at' => Carbon::now(),
    
        ]);
    
        $notification = array(
           'message' => 'Product Inserted Successfully',
           'alert-type' => 'success'
            );
    
        return redirect()->route('all.product')->with($notification);
    }
    public function EditProduct($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();
        return view('backend.product.edit_product', compact('product', 'category', 'supplier'));

    }
    public function UpdateProduct(Request $request)
    {
        $product_id = $request->id;

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
            'category_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'product_code' => 'required|string|max:255',
            'product_garage' => 'required|string|max:255',
            'product_store' => 'required|string|max:255',
            'buying_date' => 'required|date',
            'expire_date' => 'required|date|after:buying_date',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->file('product_image')) {
            $image = $request->file('product_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/product/'.$name_gen);
            $save_url = 'upload/product/'.$name_gen;

            Product::findOrFail($product_id)->update([
                'product_name' => $request->product_name,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'product_code' => $request->product_code,
                'product_garage' => $request->product_garage,
                'product_store' => $request->product_store,
                'buying_date' => $request->buying_date,
                'expire_date' => $request->expire_date,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'product_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
               'message' => 'Product Updated Successfully',
               'alert-type' => 'success'
            );

            return redirect()->route('all.product')->with($notification);
         
        } else {
            Product::findOrFail($product_id)->update([
                'product_name' => $request->product_name,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'product_code' => $request->product_code,
                'product_garage' => $request->product_garage,
                'product_store' => $request->product_store,
                'buying_date' => $request->buying_date,
                'expire_date' => $request->expire_date,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
               'message' => 'Product Updated Successfully',
               'alert-type' => 'success'
            );

            return redirect()->route('all.product')->with($notification);
        }
    }


    public function DeleteProduct($id)
    {

        $product_img = Product::findOrFail($id);
        $img = $product_img->product_image;
        unlink($img);

        Product::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function BarcodeProduct($id)
    {

        $product = Product::findOrFail($id);
        return view('backend.product.barcode_product', compact('product'));

    }// End Method
}
