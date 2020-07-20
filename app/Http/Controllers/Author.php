<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Author extends Controller
{
    public function __construct()
    {
        
    }

    public function GetAll()
    {
        $data = [
            [
                "id" => 1,
                "username"=> "Clementina DuBuque",
                "password"=> "IIondhy9jdnd7ndnf09",
                "salt"=> "TTyU896AAByuuI9",
                "email"=> "Nathan@yesenia.net",
                "profile"=> "synergize scalable supply-chains"
            ],
            [
                "id" => 2,
                "username"=> "Patricia Lebsack",
                "password"=> "IIondhy9jdnd7nsabsu7",
                "salt"=> "TTyU8978dHHHuuI9",
                "email"=> "Julianne.OConner@kory.org",
                "profile"=> "transition cutting-edge web services"
            ]

        ];

        return response()->json(["messages"=>"Get Data Author", "last_update"=> date("d F Y H:i:s"),"results"=> $data]);
    }

    public function getById($id)
    {
        $author = [
            "id" => $id,
            "username"=> "Clementina DuBuque",
            "password"=> "IIondhy9jdnd7ndnf09",
            "salt"=> "TTyU896AAByuuI9",
            "email"=> "Nathan@yesenia.net",
            "profile"=> "synergize scalable supply-chains"
        ];

        return response()->json(["messages"=>"Get Data Author", "last_update"=> date("d F Y H:i:s"),"data_id"=>$id,"results"=> $author]);
    }

    public function insert(Request $request)
    {
        $author = [
            "id"=> rand(1,100),
            "username"=> $request->input('username'),
            "password"=> hash('md5', $request->input('password')),
            "salt"=> hash('md5', $request->input('salt')),
            "email"=> $request->input('email'),
            "profile"=> $request->input('profile')
        ];

        return response()->json(["messages"=> "Success", "created_at" => date("d F Y H:is"), "data"=> $author]);
    }

    public function update(Request $request,$id)
    {
        $author = [
            "id"=> $id,
            "username"=> $request->input('username'),
            "password"=> hash('md5', $request->input('password')),
            "salt"=> hash('md5', $request->input('salt')),
            "email"=> $request->input('email'),
            "profile"=> $request->input('profile')
        ];

        return response()->json(["messages"=> "Success", "updated_at" => date("d F Y H:is"), "data"=> $author]);
    }

    public function delete($id)
    {
        return response()->json(["message" => "Success","deleted_at" => date("d F Y H:is"),"results" => ["id" => $id]]);    
    }


}