<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    //
    public function getAllPost() {
    	$post=file_get_contents('https://jsonplaceholder.typicode.com/posts');
    	$comment=file_get_contents('https://jsonplaceholder.typicode.com/comments');
    	$posts=json_decode($post);
    	$comments=json_decode($comment);
    	$arr=array();
    	foreach ($posts as $p) {
    		$new_post['post_id']=$p->id;
    		$new_post['post_title']=$p->title;
    		$new_post['post_body']=$p->body;
    		$new_count=0;
    		foreach ($comments as $c) {
    			if($c->postId == $p->id) $new_count++;
    		}
    		$new_post['total_number_of_comments']=$new_count;
    		$arr[]= $new_post;
    	}
    	return json_encode($arr);
    }

    public function getPost($id) {
      	$post=file_get_contents('https://jsonplaceholder.typicode.com/posts/'.$id);
      	$posts=json_decode($post);
    	$comment=file_get_contents('https://jsonplaceholder.typicode.com/comments');
    	$comments=json_decode($comment);
    	$new_post['post_id']=$posts->id;
    	$new_post['post_title']=$posts->title;
    	$new_post['post_body']=$posts->body;
    	$new_count=0;
    		foreach ($comments as $c) {
    			if($c->postId == $posts->id) $new_count++;
    		}
    	$new_post['total_number_of_comments']=$new_count;
    	return $new_post;
    }

    public function FilterComment(Request $request, $id) {
    	// dd($request->key);
    	if($id == 0){
    		$post=file_get_contents('https://jsonplaceholder.typicode.com/posts');
    		$comment=file_get_contents('https://jsonplaceholder.typicode.com/comments');
	    	$posts=json_decode($post);
	    	$comments=json_decode($comment);
	    	$arr=array();
	    	foreach ($posts as $p) {
	    		$new_post['post_id']=$p->id;
	    		$new_post['post_title']=$p->title;
	    		$new_post['post_body']=$p->body;
	    		$new_count=0;
	    		$param_search=0;
	    		$arr_c=array();
	    		foreach ($comments as $c) {
			    	if($request->name !=""){
			    		$check=( strstr( $c->name, $request->name ) ? "Yes" : "No" );
			    		if($check == "No") $param_search=1; 
			    	}
			    	if($request->email !=""){
			    		$check=( strstr( $c->email, $request->email ) ? "Yes" : "No" );
			    		if($check == "No") $param_search=1; 
			    	}
			    	if($request->email !=""){
			    		$check=( strstr( $c->email, $request->email ) ? "Yes" : "No" );
			    		if($check == "No") $param_search=1; 
			    	}
			    	if($param_search == 0 && $c->postId == $p->id){
			    		$new_comment['name']=$c->name;
			    		$new_comment['email']=$c->email;
			    		$new_comment['body']=$c->body;
			    		$new_count++;
			    		$arr_c[]= $new_comment;
			    	}
			    	
	    		}
	    		$new_post['total_number_of_comments']=$new_count;
	    		$new_post['comment']=$arr_c;
	    		$arr[]= $new_post;
	    	}
	    	return json_encode($arr);
    	}else{
    		$post=file_get_contents('https://jsonplaceholder.typicode.com/posts/'.$id);
	      	$posts=json_decode($post);
	    	$comment=file_get_contents('https://jsonplaceholder.typicode.com/comments');
	    	$comments=json_decode($comment);
	    	$new_post['post_id']=$posts->id;
	    	$new_post['post_title']=$posts->title;
	    	$new_post['post_body']=$posts->body;
	    	$new_count=0;
	    	$arr_c=array();
		    	foreach ($comments as $c) {
			    	if($request->name !=""){
			    		$check=( strstr( $c->name, $request->name ) ? "Yes" : "No" );
			    		if($check == "No") $param_search=1; 
			    	}
			    	if($request->email !=""){
			    		$check=( strstr( $c->email, $request->email ) ? "Yes" : "No" );
			    		if($check == "No") $param_search=1; 
			    	}
			    	if($request->email !=""){
			    		$check=( strstr( $c->email, $request->email ) ? "Yes" : "No" );
			    		if($check == "No") $param_search=1; 
			    	}
			    	if($param_search == 0 && $c->postId == $posts->id){
			    		$new_comment['name']=$c->name;
			    		$new_comment['email']=$c->email;
			    		$new_comment['body']=$c->body;
			    		$new_count++;
			    		$arr_c[]= $new_comment;
			    	}
			    	
	    		}
	    	$new_post['total_number_of_comments']=$new_count;
	    	$new_post['comment']=$arr_c;
	    	return $new_post;
	    }
      	
    	
    }

    
}
