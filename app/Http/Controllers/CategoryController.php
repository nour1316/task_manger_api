<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{


public function getTasksFromCategory($cat_id){
        $tasks=Category::findorFail($cat_id)->tasks;
       return response()->json( $tasks,200);
       
        
}





}


