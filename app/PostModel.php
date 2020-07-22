<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    // use Authenticatable, Authorizable;
    protected $table = 'posts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
        
    // ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    // ];
    public function author(){
        return $this->belongsTo("App\AuthorModel");
    }
}
