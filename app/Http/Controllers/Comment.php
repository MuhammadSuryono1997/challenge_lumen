<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\CommentModel;

class Comment extends Controller
{
    public function __construct()
    {
        
    }

    public function GetAll()
    {
        // $data = [
        //     [
        //         "id" => 1,
        //         "content"=> "ut aspernatur corporis harum nihil quis provident sequi\nmollitia nobis aliquid molestiae\nperspiciatis et ea nemo ab reprehenderit accusantium quas\nvoluptate dolores velit et doloremque molestiae",
        //         "status"=> "publish",
        //         "created_time"=> date("d F Y H:i:s"),
        //         "author_id"=>1,
        //         "email"=> "msuryono0@gmail.com",
        //         "url"=>"http://loca/post",
        //         "post_id"=> 1
        //     ],
        //     [
        //         "id" => 2,
        //         "content"=> "dignissimos aperiam dolorem qui eum\nfacilis quibusdam animi sint suscipit qui sint possimus cum\nquaerat magni maiores excepturi\nipsam ut commodi dolor voluptatum modi aut vitae",
        //         "status"=> "publish",
        //         "created_time"=> date("d F Y H:i:s"),
        //         "author_id"=>1,
        //         "email"=> "msuryono0@gmail.com",
        //         "url"=>"http://loca/post",
        //         "post_id"=> 1
        //     ]

        // ];
        $data = CommentModel::All();
        Log::info("Get All Data Comment");
        return response()->json(["messages"=>"Get Data Comments", "last_update"=> date("d F Y H:i:s"),"results"=> $data], 200);
    }

    public function getById($id)
    { 
        $comments = CommentModel::find($id);
        if(!$comments)
        {
            Log::notice("Get Data Comment $id Not Found");
            return response()->json(["messages"=>"Get Data Comments NotFound", "last_update"=> date("d F Y H:i:s"),"data_id"=>$id,"results"=> $comments]);
        }
        
        Log::info("Get Data Comment $id");
        return response()->json(["messages"=>"Get Data Comments", "last_update"=> date("d F Y H:i:s"),"data_id"=>$id,"results"=> $comments]);
    }

    public function insert(Request $request)
    {
        $comments = [
            "id" => rand(1,100),
            "content"=> $request->input('content'),
            "status"=> $request->input('status'),
            "created_time"=> $request->input('created'),
            "author_id"=>$request->input('author_id'),
            "email"=>$request->input('email'),
            "url"=>$request->input('url'),
            "post_id"=>$request->input('post_id')
        ];
        Log::info("Insert data Comments");
        return response()->json(["messages"=> "Success", "created_at" => date("d F Y H:is"), "data"=> $comments], 201);
    }

    public function update(Request $request,$id)
    {
        $comments = [
            "id" => $id,
            "content"=> $request->input('content'),
            "status"=> $request->input('status'),
            "created_time"=> $request->input('created'),
            "author_id"=>$request->input('author_id'),
            "email"=>$request->input('email'),
            "url"=>$request->input('url'),
            "post_id"=>$request->input('post_id')
        ];
        Log::info("Update data $id");
        return response()->json(["messages"=> "Success", "updated_at" => date("d F Y H:is"), "data"=> $comments], 201);
    }

    public function delete($id)
    {
        Log::info("Delete data $id");
        return response()->json(["message" => "Success","deleted_at" => date("d F Y H:is"),"results" => ["id" => $id]], 200);    
    }


}