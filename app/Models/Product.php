<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bill;
use App\Models\User;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'img',
        'rate',
        'category',
        'name',
        'price',
        'amount'
    ];
    public function bills(){
        return $this->belongsToMany(Bill::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}