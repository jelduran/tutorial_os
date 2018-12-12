<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    //
    
    protected $fillable = ['status'];
    
    public function in_shopping_carts(){
        return $this->hasMany('App\InShoppingCart');
    }
    
    public function products(){
        return $this->belongsToMany('App\Product','in_shopping_carts');
    }
    
    public function productsSize(){
        return $this->products()->count();
    }
    
    public function total(){
        return $this->products()->sum('pricing');
    }
    
    public function totalUSD(){
        return $this->products()->sum('pricing') / 100;
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
