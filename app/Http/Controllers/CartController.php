<?php

namespace App\Http\Controllers;
use App\Cart;

use Illuminate\Http\Request;


class CartController extends Controller
{
    public function addToCart(Request $request,$product_id){

            $check = Cart::where('product_id',$product_id)->where('user_ip',request()->ip())->first();
            if ($check) {
                Cart::where('product_id',$product_id)->where('user_ip',request()->ip())->increment('qty');
                return Redirect()->back()->with('cart','Product added On Cart');
            }else{

                Cart::insert([
                    'product_id' => $product_id,
                    'qty' => 1,
                   'purchase_price' => $request->purchase_price,
                    'user_ip' => request()->ip(),
                ]);
                return Redirect()->back()->with('cart','Product added On Cart');
            }
    }

    // -------------- cart page --------------------
    public function cartPage(){

        $carts = Cart::where('user_ip',request()->ip())->latest()->get();
        $subtotal = Cart::all()->where('user_ip',request()->ip())->sum(function($t){
            return $t->purchase_price * $t->qty;
         });
        return view('pages.cart',compact('carts','subtotal'));
    }

    // --------- cart destroy ------
    public function destroy($cart_id){
        Cart::where('id',$cart_id)->where('user_ip',request()->ip())->delete();
        return Redirect()->back()->with('cart_delete','Cart Product Removed');
    }

     // ------------- cart quantity update -----------
     public function quantityUpdate(Request $request,$cart_id){
        Cart::where('id',$cart_id)->where('user_ip',request()->ip())->update([
            'qty' => $request->qty,
        ]);
        return Redirect()->back()->with('cart_update','Quantity Updated');
    }
}
