<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Role;

class GeneralsController extends Controller
{


    
    public function RoleName($id)
    {
        $name = Role::query()
              ->selectRaw('name')
              ->where('id', $id)->first()->name;
        return $name;
    }
    

}