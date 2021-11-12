<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobPostController;

Route::get('/job_posts',[JobPostController::class,'getposts']);
Route::get('/single job post/show/{id}',[JobPostController::class,'showpost']);
Route::post('/single job post/update/{id}',[JobPostController::class,'updatepost']);

Route::post('job_posts/add',[JobPostController::class,'job_post_store']);
Route::patch('/update/job_post/{id}',[JobPostController::class,'patchjobposts']);
Route::delete('job_post/delete/{id}',[JobPostController::class,'job_post_delete']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
