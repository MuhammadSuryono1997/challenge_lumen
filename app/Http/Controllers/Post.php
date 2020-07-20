<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Post extends Controller
{
    public function __construct()
    {
        
    }

    public function GetAll()
    {
        $data = [
            [
                "id" => 1,
                "title"=> "ea molestias quasi exercitationem repellat qui ipsa sit aut",
                "content"=> "ut aspernatur corporis harum nihil quis provident sequi\nmollitia nobis aliquid molestiae\nperspiciatis et ea nemo ab reprehenderit accusantium quas\nvoluptate dolores velit et doloremque molestiae",
                "tags"=> "berita,ekonomi",
                "status"=> "publish",
                "created_time"=> date("d F Y H:i:s"),
                "updated_time"=> "-",
                "author_id"=>1
            ],
            [
                "id" => 2,
                "title"=> "nesciunt quas odio",
                "content"=> "repudiandae veniam quaerat sunt sed\nalias aut fugiat sit autem sed est\nvoluptatem omnis possimus esse voluptatibus quis\nest aut tenetur dolor neque",
                "tags"=> "berita,ekonomi,sejarah",
                "status"=> "publish",
                "created_time"=> date("d F Y H:i:s"),
                "updated_time"=> "-",
                "author_id"=>10
            ]

        ];

        return response()->json(["messages"=>"Get Data Post", "last_update"=> date("d F Y H:i:s"),"results"=> $data]);
    }

    public function getById($id)
    { 
        $post = [
            "id" => $id,
            "title"=> "nesciunt quas odio",
            "content"=> "repudiandae veniam quaerat sunt sed\nalias aut fugiat sit autem sed est\nvoluptatem omnis possimus esse voluptatibus quis\nest aut tenetur dolor neque",
            "tags"=> "berita,ekonomi,sejarah",
            "status"=> "publish",
            "created_time"=> date("d F Y H:i:s"),
            "updated_time"=> "-",
            "author_id"=>10
        ];

        return response()->json(["messages"=>"Get Data Post", "last_update"=> date("d F Y H:i:s"),"data_id"=>$id,"results"=> $post]);
    }

    public function insert(Request $request)
    {
        $post = [
            "id" => rand(1,100),
            "title"=> $request->input('title'),
            "content"=> $request->input('content'),
            "tags"=> $request->input('tags'),
            "status"=> $request->input('publish'),
            "created_time"=> $request->input('created'),
            "updated_time"=> $request->input('update'),
            "author_id"=>$request->input('author_id')
        ];

        return response()->json(["messages"=> "Success", "created_at" => date("d F Y H:is"), "data"=> $post]);
    }

    public function update(Request $request,$id)
    {
        $post = [
            "id" => $id,
            "title"=> $request->input('title'),
            "content"=> $request->input('content'),
            "tags"=> $request->input('tags'),
            "status"=> $request->input('publish'),
            "created_time"=> $request->input('created'),
            "updated_time"=> $request->input('update'),
            "author_id"=>$request->input('author_id')
        ];

        return response()->json(["messages"=> "Success", "updated_at" => date("d F Y H:is"), "data"=> $post]);
    }

    public function delete($id)
    {
        return response()->json(["message" => "Success","deleted_at" => date("d F Y H:is"),"results" => ["id" => $id]]);    
    }


}