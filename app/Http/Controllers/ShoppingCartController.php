<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingCart;
use App\PayPal;

class ShoppingCartController extends Controller
{
    //
    public function index(){
        $shopping_cart_id = \Session::get('shopping_cart_id');
        
        $shopping_cart = ShoppingCart::findOrCreateBySession($shopping_cart_id);
        
        $paypal = new PayPal($shopping_cart);
        
        $payment = $paypal->generate();
        
        return redirect($payment->getApprovalLink());
        
        /*$products = $shopping_cart->products()->get();
        
        $total = $shopping_cart->total();
        
        return view('shopping_carts.index', ["products" => $products, "total" => $total]);*/
    }
    
    public function show($id){
        $shopping_cart = ShoppingCart::where('custom_id', $id)->first();
        
        $order = $shopping_cart->order();
        
        return view('shopping_carts.completed', ['shopping_cart' => $shopping_cart, 'order' => $order]);
    }
}
