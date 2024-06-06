<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use App\Models\Product;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // return $request->expectsJson() ? null : route('login');
        if($request->expectsJson()){
            return null;
        }else{
            $items=$request->session()->get('items');
            if($items){
                foreach($items as $i){
                    $pro=Product::find($i["id"]);
                    $pro->amount=$i["amount"]+1;
                    $pro->save();
                }
            }
            return route('login');
        }
    }
}
