<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;

class PosController extends Controller
{
    public function Pos()
    {
        $todaydate=Carbon::now();
        $product = Product::where('expire_date', '>', $todaydate)->latest()->get();
        $customer = Customer::latest()->get();
        return view('backend.pos.pos_page', compact('product', 'customer'));

    }
    public function AddCart(Request $request)
    {

        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => 20,
            'options' => ['size' => 'large']]);


        $notification = array(
           'message' => 'Product Added Successfully',
           'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    } // End Method


    public function AllItem()
    {

        $product_item = Cart::content();

        return view('backend.pos.text_item', compact('product_item'));

    } // End Method


    public function CartUpdate(Request $request, $rowId)
    {

        $qty = $request->qty;
        $update = Cart::update($rowId, $qty);
         
        $notification = array(
           'message' => 'Cart Updated Successfully',
           'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method


    public function CartRemove($rowId)
    {

        Cart::remove($rowId);

        $notification = array(
            'message' => 'Cart Removed Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method

    public function CreateInvoice(Request $request)
    {
        $contents = Cart::content(); // Retrieve all cart contents
        $cust_id = $request->customer_id; // Get the customer ID from the request
        $customer = Customer::where('id', $cust_id)->first(); // Find the customer
    
        // Loop through each cart item and check if the quantity exceeds the stock
        foreach ($contents as $cartItem) {
            $product = Product::find($cartItem->id); // Fetch the product by its ID
    
            // If the cart quantity exceeds the available stock, return an error message
            if ($cartItem->qty > $product->product_store) {
                return back()->withErrors(['error' => 'The quantity for ' . $cartItem->name . ' exceeds the available stock of ' . $product->product_store . '.']);
            }
        }
    
        // If all quantities are valid, proceed to the invoice view
        return view('backend.invoice.product_invoice', compact('contents', 'customer'));
    }
}
