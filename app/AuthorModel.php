<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorModel extends Model
{
    // use Authenticatable, Authorizable;
    protected $table = 'authors';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'profile', 'salt', 'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    // ];
    public function post(){
        return $this->hasMany('App\PostModel');
    }

    public function comment(){
        return $this->hasMany('App\CommentModel');
    }
}
