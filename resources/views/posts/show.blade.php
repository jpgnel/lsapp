@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-secondary">Go Back</a>
    <br>
    <br>
    <h1>{{$post->title}}</h1>  
    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
    <br><br>
    <div>
        <p>{!!$post->body!!}</p>
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    @if (!Auth::guest())
        @if (Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-light">Edit</a>

            {!!Form::open(['action' => ['PostsController@destroy', $post->id],'method' => 'POST', 'class'=> 'float-right' ,'onsubmit' => 'return confirmDelete()'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
    <script>
        function confirmDelete() {
        var result = confirm('Are you sure you want to delete?');

            if (result) {
                return true;
            } else {
                return false;
            }
        }   
    </script>
@endsection