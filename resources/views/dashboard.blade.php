@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-primary">Create Post</a>
                    </br>
                    </br>
                    </br>
                    <h3>Your Blog Posts</h3>
                    @if(count($posts) > 0)
                    <table class="table table-striped">
                        <tr>
                           <th>Title</th>
                           <th>Edit</th>
                           <th>Delete</th>
                        </tr>
                        @foreach($posts as $post)
                          <tr>
                              <td>{{$post->title}}</td>
                              <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                              <td><a href="/posts/{{$post->id}}/delete" class="btn btn-default">Delete</a></td>
                          </tr>
                        @endforeach
                    </table>
                     @else 
                        <p>You have No Posts</p>
                     @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
