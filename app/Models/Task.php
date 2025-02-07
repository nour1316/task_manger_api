<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
 protected $fillable= ['title','description','prority','user_id'];



 public function user(){
return $this->belongsTo(User::class);
 }




 public function categories(){
    
    return $this->belongsToMany(Category::class,'category_task');

 }


 public function favoritesUsers(){
   return $this->belongsToMany(User::class,'favorites');
}


}
