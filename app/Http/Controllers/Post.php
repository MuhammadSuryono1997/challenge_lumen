<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use App\PostModel;
use App\AuthorModel;


class Post extends Controller
{
    public function __construct()
    {
        
    }

    public function GetAll()
    {
        $data = PostModel::All();
        Log::info("Get All Data Post");
        return response()->json(["messages"=>"Get Data Post", "last_update"=> date("d F Y H:i:s"),"results"=> $data]);
    }

    public function getPostAuthor()
    {
        $data = PostModel::with(array('author'=>function($query)
        {
            $query->select();
        }))->get();

        Log::info("Get All Data Post Using Author");
        return response()->json(["messages"=>"Get Data Post Author", "last_update"=> date("d F Y H:i:s"),"results"=> $data]);
    }

    public function getPostAuthorId(Request $request)
    {
        $id = $request->route('id');
        if(!PostModel::where('author_id', $id)->first())
        {
            Log::error("Error Get All Data Post Using Author Id");
            return response()->json(["messages"=>"Id Not Found", "find_at"=> date("d F Y H:i:s"),"results"=> "Id Not found"]);
        }
        
        $data = PostModel::where('author_id', $id)->with(array('author'=>function($query)
        {
            $query->select();
        }))->get();

        Log::info("Get All Data Post Using Author Id");
        return response()->json(["messages"=>"Get Data Post Author Id", "last_update"=> date("d F Y H:i:s"),"results"=> $data]);
    }

    public function getById($id)
    { 
        $post = PostModel::find($id);
        if(!$post)
        {
            Log::info("Get Data By Id $id Not Found");
            return response()->json(["messages"=>"Get Data Post By Id Not Found", "last_update"=> date("d F Y H:i:s"),"data_id"=>$id,"results"=> "Not Found"], 200);
        }
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
        if(!AuthorModel::find($request->input('author_id')))
        {
            Log::info("Insert Not Created");
            return response()->json(["messages"=> "Author Id Not Found"], 404);
        }
        $post->save();

        Log::info("Insert Data Post");
        return response()->json(["messages"=> "Success", "created_at" => date("d F Y H:is"), "data"=> $post], 201);
    }

    public function update(Request $request,$id)
    {
        $post = PostModel::find($id);
        // $post->title = $request->input('title');
        // $post->content = $request->input('content');
        // $post->tags = $request->input('tags');
        // $post->author_id = $request->input('author_id');
        if(!AuthorModel::find($request->input('author_id')))
        {
            Log::info("Update Not Created");
            return response()->json(["messages"=> "Author Id Not Found"], 404);
        }
        $post->save();

        Log::info("Update data $id");
        return response()->json(["messages"=> "Success", "updated_at" => date("d F Y H:is"), "data"=> $post], 206);
    }

    public function delete($id)
    {
        $post = PostModel::find($id);
        if(!PostModel::find($id))
        {
            Log::info("Deleted Not Action");
            return response()->json(["messages"=> "Post Id Not Found"], 404);
        }
        $post->delete();

        Log::info("Delete data $id");
        return response()->json(["message" => "Success","deleted_at" => date("d F Y H:is"),"results" => ["id" => $id]], 200);    
    }


}