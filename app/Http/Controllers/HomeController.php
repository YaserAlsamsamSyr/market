<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Http\Requests\ProductFormRequest;
class HomeController extends Controller
{
    public function index(Request $req){
        $products=Product::latest()->where('amount','>',0)->paginate(10);
        return view('home',["products"=>$products,"page"=>$req->query('page')]);
    }

    public function addToCard(Request $req){
        $items=$req->session()->get('items');
        if(!$items){
            $items=[];
            $req->session()->put('items',[]);
        }
        $pro=Product::find($req->id);
        $pro->amount=$req->amount-1;
        $pro->save();
        $newItem=[
            "id"=>$req->id,
            "img"=>$req->img,
            "rate"=>$req->rate,
            "name"=>$req->name,
            "category"=>$req->category,
            "price"=>$req->price,
            "amount"=>$req->amount-1
        ];
        $index='';
        if(sizeof($items)>0)
            foreach($items as $key=>$i)
                if($i["id"]==$newItem["id"])
                    $index=$key;
        if($index!=='')
            $items[$index]["amount"]=$newItem["amount"];
        array_push($items,$newItem);
        $req->session()->put('items',$items);
        return  redirect('/?page='.$req->page);
    }

    public function myCard(Request $req){
        $items=$req->session()->get('items');
        if($items){
            $itemNum=sizeOf($items);
            $totalPrice=0;
            foreach($items as $i){
                $totalPrice+=$i['price'];
            }
            return view('product.myCard',["num"=>$itemNum,"price"=>$totalPrice]);
        }
        return view('product.myCard',["num"=>0,"price"=>0]);
    }

    public function removeFromCard(Request $req){
           $items=$req->session()->get('items');
           $itemId=$req->itemId;
           $pro=Product::find($items[$itemId]["id"]);
           $pro->amount=$items[$itemId]["amount"]+1;
           $pro->save();
           $id=$items[$itemId]["id"];
           unset($items[$itemId]);
           if(sizeof($items)>0)
               foreach($items as $key=>$i)
                    if($i["id"]==$id)
                        $items[$key]["amount"]++;
           if(sizeof($items)==0) {
               $req->session()->pull('items'); 
            } else {
                $newItem=[];
                $newItem=array_values($items);
                $req->session()->put('items',$newItem);
            }
            return redirect()->route('myCard');
    }
    
    public function rateProduct(Request $req,String $id){
        $rate=$req->rate;
        $pro=Product::find($id);
        $pro->rate=$rate;
        $pro->save();
        return redirect('/bill/'.$req->billId);
    }
}