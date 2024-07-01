<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function leaf(){
        return $this->belongsTo(Leaf::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplierId','id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
}
