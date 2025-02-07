<?php

namespace App\Http\Controllers;

use App\Http\Requests\requestStoreProfile;
use App\Http\Requests\requestUpdateProfile;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id=Auth::user()->id;
        $pro= User::findorfail($user_id)->profile;
        return response()->json($pro,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( requestStoreProfile $request)
    {
       $user_id=Auth::user()->id;
       $validatData=$request->validated();
       $validatData['user_id']=$user_id;
      $pro=Profile::create($validatData);
      return response()->json($pro,201);
    }

 

    /**
     * Update the specified resource in storage.
     */
    public function update(requestUpdateProfile $request, string $id)
    {

        $user_id= Auth::user()->id;
        $profile=Profile::findorFail($id);
        if( !($profile->user_id == $user_id))
        return response()->json('you  cant  update this profile' , 404);
         $pro=$profile->update($request->all());
         return response()->json($pro,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user_id= Auth::user()->id;
        $profile=Profile::findorFail($id);
        if( !($profile->user_id == $user_id))
        return response()->json('you  cant  delete this profile' , 404);
         $pro=$profile->delete();
         return response()->json($pro,204);

 
    }
}
