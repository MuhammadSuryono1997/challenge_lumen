<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use App\PostModel;
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
        $data = PostModel::with(array('author'=>function($query)
        {
            $query->select();
        }))->get();

        Log::info("Get All Data Post");
        return response()->json(["messages"=>"Get Data Post", "last_update"=> date("d F Y H:i:s"),"results"=> $data]);
    }

    public function getById($id)
    { 
        $post = PostModel::find($id);
        Log::info("Get Data By Id $id");
        return response()->json(["messages"=>"Get Data Post", "last_update"=> date("d F Y H:i:s"),"data_id"=>$id,"results"=> $post], 200);
    }

    public function insert(Request $request)
    {
        $post = new PostModel();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->tags = $request->input('tags');
        $post->author_id = $request->input('author_id');
        $post->save();

        Log::info("Insert Data Post");
        return response()->json(["messages"=> "Success", "created_at" => date("d F Y H:is"), "data"=> $post], 201);
    }

    public function update(Request $request,$id)
    {
        $post = PostModel::find($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->tags = $request->input('tags');
        $post->author_id = $request->input('author_id');
        $post->save();

        Log::info("Update data $id");
        return response()->json(["messages"=> "Success", "updated_at" => date("d F Y H:is"), "data"=> $post], 206);
    }

    public function delete($id)
    {
        $post = PostModel::find($id);
        $post->delete();

        Log::info("Delete data $id");
        return response()->json(["message" => "Success","deleted_at" => date("d F Y H:is"),"results" => ["id" => $id]], 200);    
    }


}