<?php

namespace App\Http\Controllers;

use App\Http\Requests\requestStore;
use App\Http\Requests\requestUpdate;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     //  $task= Task::all();
      //  return response()->json($task,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(requestStore  $request)
    {
       $user_id=Auth::user()->id;
      $validData=$request->validated();
      $validData['user_id']=$user_id;
        $task=Task::create($validData);
        return response()->json($task,201);

    }

    /**
     * Display the specified resource.
     * // show all task for  all users
     * p    */

    public function show()
    {  
    //  $tasks=Auth::user()->tasks;
      //  return response()->json($tasks,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(requestUpdate $request , string $id)
    {
        $user_id= Auth::user()->id;
        $task=Task::findorFail($id);
        if( !($task->user_id == $user_id))
        return response()->json('you  cant  update this task' , 404);
         $task=$task->update($request->only('title','description','prority'));
         return response()->json($task,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user_id= Auth::user()->id;
        $task=Task::findorFail($id);
        if( !($task->user_id == $user_id))
        return response()->json('you  cant  delete this task' , 404);
         $task=$task->delete();
         return response()->json($task,200);

    }







    public function getuserFromTask($id){

         $user_id= Task::findorfail($id)->user->id; 
        if(!(Auth::user()->id==$user_id))
        return response()->json('sorry  you can not access to  user data',404);
        $user_data= Task::findorfail($id)->user; 
        return response()->json($user_data,200);

    }




    
      public function addCategoriesToTask(Request $request,$id){
        $task=Task::findorfail($id);
        $task->categories()->attach($request->category_id);
         return response()->json('you are add category success',201);

    }
     

 

    public function getTaskCategories($id){

      $user_id=Task::findorFail($id)->user_id;
      if(!Auth::user()->id == $user_id)
      return response()->json('it is fail',404);

      $categories=Task::findorFail($id)->categories;
       return response()->json($categories,200);
 
     }






      public function getAllTasks(){
     $task= Task::all();
     return response()->json($task,200);
      }



      public function orderdTask(){
     $tasks= Auth::user()->tasks->orderByRaw("FILED('high','medum','low')")->get();
     return response()->json($tasks,200);
      }





      public function addFavorite($taskId){
//Auth::user()->favoritesTasks->syncwithoutDetaching($taskId);
  Auth::user()->favoritesTasks()->syncWithoutDetaching([$taskId]);
  return response()->json('you add ',201);        
      }



      public function deleteFavorite($taskId){
        Task::findorfail($taskId);
      
        Auth::user()->favoritesTasks()->detach($taskId);
        return response()->json('it is deleted ',201);        
              }


              
      public function showFavorite(){
        
        $task=Auth::user()->favoritesTasks;
        return response()->json( $task,201);        
              }



}
