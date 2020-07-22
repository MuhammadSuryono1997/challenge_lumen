<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use App\AuthorModel;

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
        $data = AuthorModel::All();
        
        Log::info("Showng All Data Author");
        return response()->json(["messages"=>"Get Data Author", "last_update"=> date("d F Y H:i:s"),"results"=> $data], 200);
    }

    public function getById($id)
    {
        $author = AuthorModel::find($id);
        if($author == Null)
        {
            Log::info("Id $id Not Found in Table Author");
            return response()->json(["messages"=> "Id not found", "find_at" => date("d F Y H:is"), "data"=> "Id $id Not Found in Table Author"], 404);
        }

        Log::info("Showng Data Author By Id");
        return response()->json(["messages"=>"Get Data Author", "last_update"=> date("d F Y H:i:s"),"data_id"=>$id,"results"=> $author], 200);
    }

    public function insert(Request $request)
    {
        $author = new AuthorModel();
        $author->username = $request->input('username');
        $author->password = hash('md5', $request->input('password'));
        $author->email = $request->input('email');
        $author->salt = $request->input('salt');
        $author->profile = $request->input('profile');
        $author->save();

        Log::info("Insert Data");
        return response()->json(["messages"=> "Success", "created_at" => date("d F Y H:is"), "data"=> $author], 201);
    }

    public function update(Request $request,$id)
    {
        $author = AuthorModel::find($id);
        if($author == Null)
        {
            Log::info("Id $id Not Found in Table Author");
            return response()->json(["messages"=> "Id update not found", "find_at" => date("d F Y H:is"), "data"=> "Id $id Not Found in Table Author"], 404);
        }
        $author->username = $request->input('username');
        $author->password = hash('md5', $request->input('password'));
        $author->email = $request->input('email');
        $author->salt = $request->input('salt');
        $author->profile = $request->input('profile');
        $author->save();
        Log::info("Update Data $id");
        return response()->json(["messages"=> "Success", "updated_at" => date("d F Y H:is"), "data"=> $author], 201);
    }

    public function delete($id)
    {
        $author = AuthorModel::find($id);
        if($author == Null)
        {
            Log::info("Id $id Not Found in Table Author");
            return response()->json(["messages"=> "Id delete not found", "find_at" => date("d F Y H:is"), "data"=> "Id $id Not Found in Table Author"], 404);
        }
        $author->delete();
        Log::info("Delete data $id");
        return response()->json(["message" => "Success","deleted_at" => date("d F Y H:is"),"results" => ["id" => $id]], 200);    
    }


}