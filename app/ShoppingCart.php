<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    //
    
    protected $fillable = ['status'];
    
    public function productsSize(){
        return $this->id;
    }
    
    public static function findOrCreateBySession($shopping_cart_id){
        if ($shopping_cart_id)
            return ShoppingCart::findBySession($shopping_cart_id);
        else
            return ShoppingCart::createWithoutSession();
    }
    
    public static function findBySession($shopping_cart_id){
        return ShoppingCart::find($shopping_cart_id);
    }
    
    public static function createWithoutSession(){
        return ShoppingCart::create([
            'status' => 'incompleted'
        ]);
    }
}
