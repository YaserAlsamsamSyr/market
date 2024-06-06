<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bill;
use App\Models\Product;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $myBills=User::find(auth()->id())->bills()->get();
        return view('product.myBills',[
            "bills"=>$myBills
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $pro=$req->session()->get('items');
        if(!$pro)
            abort(403);
        $bill=User::find(auth()->id())->bills()->create([]);
        $proId=collect($pro)->map(function ($item){
            return $item['id'];
            });
        $bill->products()->attach($proId);
        $req->session()->forget('items');
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $billPro=Bill::find($id)->products()->get();
        return view('product.productsInBill',[
            'billId'=>$id,
            'productsInBill'=>$billPro
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Bill::find($id)->delete();
        return redirect('/bill');
    }
}
