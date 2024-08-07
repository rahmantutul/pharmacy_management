<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function details(){
        return $this->hasMany(PurchaseDetails::class,'purchaseId','id');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplierId','id');
    }
}
