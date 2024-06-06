<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $myProducts=User::find(auth()->id())->products(["id","img","category","name","rate","price","rate","amount"])->get();
        return view('product.myProducts',["products"=>$myProducts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.addProduct',["isAdded"=>"no"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $req)
    {
        $req->validated();
        $imgName=time().'_'.$req->name.'_'.$req->img->extension();
        $req->img->move(public_path('images'),$imgName);
        $newProduct=new Product([
            "img"=>"images/".$imgName,
            "rate"=>$req->rate,
            "category"=>$req->category,
            "name"=>$req->name,
            "price"=>$req->price,
            "amount"=>$req->amount
        ]);
        $user=User::find(auth()->id());
        $user->products()->save($newProduct);
        return view('product.addProduct',["isAdded"=>"yes"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product=Product::find($id);
        return view('product.edit',["product"=>$product,"updated"=>false]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $req, string $id)
    {
        $pro=Product::find($id);
        $imgName='';
        $req->validated();
        $img_path=public_path($req->oldImg);
        if(file_exists($img_path))
            unlink($img_path);
        $imgName="images/".time().'_'.$req->name.'_'.$req->img->extension();
        $req->img->move(public_path('images'),$imgName);
        $pro->img=$imgName;
        $pro->name=$req->name;
        $pro->category=$req->category;
        $pro->price=$req->price;
        $pro->rate=$req->rate;
        $pro->amount=$req->amount;
        $pro->save();
        return view('product.edit',["product"=>$pro,"updated"=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $pro=Product::find($id);
            $img_path=public_path($pro->img);
            if(file_exists($img_path)){
                unlink($img_path);
            }
            $pro->delete();
            return redirect('/product');
    }
}
