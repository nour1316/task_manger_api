<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//login/logout/register
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::post('logout',[UserController::class,'logout'])->middleware('auth:sanctum');




Route::middleware('auth:sanctum')->group(function(){



 Route::apiResource('tasks',TaskController::class); 
 Route::get('task/{id}/user',[TaskController::class,'getuserFromTask']); 
 Route::post('task/{taskId}/categories', [TaskController::class, 'addCategoriesToTask']);   
 Route::get('task/{taskId}/categories', [TaskController::class, 'getTaskCategories']);
 Route::get('task/orderd', [TaskController::class, 'orderdTask']); 
 Route::get('task/favorite', [TaskController::class, 'showFavorite']); 
 Route::post('task/{taskId}/favorite', [TaskController::class, 'addFavorite']); 
 Route::delete('task/{taskId}/favorite', [TaskController::class, 'deleteFavorite']); 

  
             


 Route::apiResource('profile',ProfileController::class)  ;

Route::get('user/tasks',[UserController::class,'getUserTasks']);



Route::get('category/{cat_id}/tasks', [CategoryController::class,'getTasksFromCategory']);

Route::get('alltasks', [TaskController::class,'getAllTasks'])->middleware('CheakUser');



}); // end group