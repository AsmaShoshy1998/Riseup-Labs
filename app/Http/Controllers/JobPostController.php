<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPost;

class JobPostController extends Controller
{
    public function getposts()
    {
        try{
            $job_posts=JobPost::all();
return response()->json([
    'success'=>'true',
    'message'=>'All Jobs information are given to you',
    'data'=> $job_posts,
       ]); 
        }
        catch (\Throwable $s)
        {
           
            return response()->json([
                'success'=>'false',
                'message'=>$s->getMessage(),
                'data'=>'',
            ]); 
        }
        
    }
    public function job_post_store(Request $request)
    {
        try{
        $request->validate([
            'job_title' => 'required|max:255',
            'descript' => 'required|max:255',
            'userid' => 'required',
            'status' => 'required',
            'thumbnail' => 'required',
            
        ]);
        $fileName='';
        if($request->hasFile('thumbnail'))
        {
           $file=$request->file('thumbnail');
           $fileName=date('Ymdms').'.'.$file->getClientOriginalExtension();
           $file->storeAs('/uploads',$fileName);

        }
        $job_posts=JobPost::create([
            'title'=>$request->job_title,
            'description'=>$request->descript,
            'user_id'=>$request->userid,
            'status'=>$request->status,
           'thumbnail'=>$fileName,
           ]);
           if($job_posts)
        {
            return response()->json([
                'success'=>'true',
                'message'=>'Job Post Added Succeessfully',
                'data'=>$job_posts,
            ],200);
           
        }
        else{
            return response()->json(["result"=>"House is not found"],404);
        }
    }
    catch (\Throwable $s)
    {
        return response()->json([
            'success'=>'false',
            'message'=>$s->getMessage(),
            'data'=>'',
        ]); 
    }
}

public function showpost(Request $request,$id)
    {
        try{
       
            $job_posts=JobPost::find($request->id);
            
            if ($job_posts)
            {
                $job_posts=JobPost::find($request->id);
            
            return response()->json(['message'=>'Job Post has been updated'],200);
            }
            else{
                return response()->json(['message'=>'No Data Found'],404);
            }
        }
    catch (\Throwable $s)
    {
        return response()->json([
            'success'=>'false',
            'message'=>$s->getMessage(),
            'data'=>'',
        ]); 
    }
    }

    public function updatepost(Request $request,$id)
    { 
        try{
            $request->validate([
                'job_title' => 'required|max:255',
                'descript' => 'required|max:255',
                'userid' => 'required',
                'status' => 'required',
                'thumbnail' => 'required',
                
            ]);
            $fileName='';
            if($request->hasFile('thumbnail'))
            {
               $file=$request->file('thumbnail');
               $fileName=date('Ymdms').'.'.$file->getClientOriginalExtension();
               $file->storeAs('/uploads',$fileName);
    
            }
            $job_posts = JobPost::where("id", $id)->update([
                'title'=>$request->job_title,
                'description'=>$request->descript,
                'user_id'=>$request->userid,
                'status'=>$request->status,
               'thumbnail'=>$fileName,
               ]);
            $job_posts=JobPost::find($request->id);
            if ($job_posts)
            {
                $job_posts = JobPost::where("id", $id)->update([
                    "description"=>$request->descript,
            ]);
            return response()->json(['message'=>'Job Post has been updated'],200);
            }
            else{
                return response()->json(['message'=>'No Data Found'],404);
            }
        }
    catch (\Throwable $s)
    {
        return response()->json([
            'success'=>'false',
            'message'=>$s->getMessage(),
            'data'=>'',
        ]); 
    }
    }
           

    public function patchjobposts(Request $request,$id)
    { 
        try{
       
            $job_posts=JobPost::find($request->id);
            if ($job_posts)
            {
                $job_posts = JobPost::where("id", $id)->update([
                    "description"=>$request->descript,
            ]);
            return response()->json(['message'=>'Job Post has been updated'],200);
            }
            else{
                return response()->json(['message'=>'No Data Found'],404);
            }
        }
    catch (\Throwable $s)
    {
        return response()->json([
            'success'=>'false',
            'message'=>$s->getMessage(),
            'data'=>'',
        ]); 
    }
    }
    public function job_post_delete(Request $request,$id)
    {
        try{
       
            $job_posts=JobPost::where('id',$id)->delete();
            
            if ($job_posts)
            {
                $job_posts=JobPost::find($request->id);
            
            return response()->json(['message'=>'Job Post has been deleted'],200);
            }
            else{
                return response()->json(['message'=>'No Data Found'],404);
            }
        }
    catch (\Throwable $s)
    {
        return response()->json([
            'success'=>'false',
            'message'=>$s->getMessage(),
            'data'=>'',
        ]); 
    }
    }
}
