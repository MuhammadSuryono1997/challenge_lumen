<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\CommentModel;
use App\PostModel;
use App\AuthorModel;

class Comment extends Controller
{
    public function __construct()
    {
        
    }

    public function GetAll()
    {
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
        $comments = new CommentModel();
        $comments->content = $request->input('content');
        $comments->status = $request->input('status');
        $comments->author_id = $request->input('author_id');
        $comments->email = $request->input('email');
        $comments->url = $request->input('url');
        $comments->post_id = $request->input('post_id');
        if(!AuthorModel::find($request->input('author_id')))
        {
            Log::info("Author Id Not Found");
            return response()->json(["messages"=> "Author Id Not Found"], 404);
        }

        if(!PostModel::find($request->input('post_id')))
        {
            Log::info("Post Id Not Found");
            return response()->json(["messages"=> "Post Id Not Found"], 404);
        }

        $comments->save();
        Log::info("Insert data Comments");
        return response()->json(["messages"=> "Success", "created_at" => date("d F Y H:is"), "data"=> $comments], 201);
    }

    public function update(Request $request,$id)
    {
        $comments = CommentModel::find($id);
        $comments->content = $request->input('content');
        $comments->status = $request->input('status');
        $comments->author_id = $request->input('author_id');
        $comments->email = $request->input('email');
        $comments->url = $request->input('url');
        $comments->post_id = $request->input('post_id');
        if(CommentModel::find($id))
        {
            Log::info("Comment Id Not Found");
            return response()->json(["messages"=> "Comment Id Not Found"], 404);
        }
        if(!AuthorModel::find($request->input('author_id')))
        {
            Log::info("Author Id Not Found");
            return response()->json(["messages"=> "Author Id Not Found"], 404);
        }

        if(!PostModel::find($request->input('post_id')))
        {
            Log::info("Post Id Not Found");
            return response()->json(["messages"=> "Post Id Not Found"], 404);
        }

        $comments->save();
        Log::info("Update data $id");
        return response()->json(["messages"=> "Success", "updated_at" => date("d F Y H:is"), "data"=> $comments], 201);
    }

    public function delete($id)
    {
        $comments = CommentModel::find($id);
        if(!$comments)
        {
            Log::info("Comment Id Not Found");
            return response()->json(["messages"=> "Comment Id Not Found"], 404);
        }
        Log::info("Delete data $id");
        return response()->json(["message" => "Success","deleted_at" => date("d F Y H:is"),"results" => ["id" => $id]], 200);    
    }


}