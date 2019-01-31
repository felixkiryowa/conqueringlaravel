@extends('layouts.app')
@section('content')
<a href="/posts" class="btn btn-default">Go Back</a>
  <h1>Create Post</h1> 
  {!! Form::open(['action' => 'postsController@store','method' => 'POST','enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
      {{Form::label('title', 'Title')}}
      {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
      {{Form::label('body', 'Body')}}
      {{Form::textarea('body','',['id' => 'article-ckeditor','class'=>'form-control','placeholder'=>'Post Body'])}}
    </div>
    <div class="form-group">
        <label for="cover_image">Upload File</label>
        <input type="file" class="form-control" name="uploaded_file"/>
    </div>
    
    {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}
                                 
@endsection

