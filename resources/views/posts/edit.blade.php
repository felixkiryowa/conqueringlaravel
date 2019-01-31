@extends('layouts.app')
@section('content')
<a href="/posts" class="btn btn-default">Go Back</a>
  <h1>Create Post</h1> 
  {!! Form::open(['action' => ['postsController@update',$post->id],'method' => 'POST']) !!}
    <div class="form-group">
      {{Form::label('title', 'Title')}}
      {{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
      {{Form::label('body', 'Body')}}
      {{Form::textarea('body',$post->body,['id' => 'article-ckeditor','class'=>'form-control','placeholder'=>'Post Body'])}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}
                                 
@endsection

