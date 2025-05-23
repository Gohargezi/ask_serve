<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;


Route::get('/', [OrganizationController::class , "TopOrganizations"])->name("main");

Route::get("/logout" , [UserController::class , "logout"])->name("logout");
Route::get("/login" , [UserController::class , "login"])->name("login");
Route::get("/register" , [UserController::class , "register"])->name("register");
Route::get("/passwordRecovery" , [UserController::class , "passwordRecovery"])->name("password_recovery"); 

Route::get("/search" , [OrganizationController::class , "GetOrganizations"])->name("search"); 

Route::get("/organization/{id}" , [OrganizationController::class , "GetOrganization"])->name("organization");
Route::get("/createorganization" , [OrganizationController::class , "CreateOrganization"])->name("createorganization"); 
Route::post("/createorganization" , [OrganizationController::class , "CreateOrganization"])->name("createorganization"); 

Route::post("/createcomment" , [CommentController::class , "CreateComment"])->name("createcomment"); 
Route::get("/feedbackcomment" , [CommentController::class , "FeedbackComment"])->name("feedbackcomment"); 

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name("admin/dashboard");

Route::get("/admin/publishOrganization" , [AdminController::class , "PublishOrganization"])->name("publishOrganization"); 
Route::get("/admin/publishComment" , [AdminController::class , "PublishComment"])->name("publishComment"); 
Route::get("/admin/deleteOrganization" , [AdminController::class , "DeleteOrganization"])->name("rejectOrganization"); 
Route::get("/admin/deleteComment" , [AdminController::class , "DeleteComment"])->name("rejectComment");


