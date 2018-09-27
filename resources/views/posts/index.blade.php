@extends('layouts.app')
@section('content')


@foreach($posts as $post)
    <h1>{{$post->title}}</h1><br/>
    <p>{{$post->body}}</p><br/>
    <p>{{$post->created_at->format('D d, M, Y')}}</p><br/>
    <p>{{$post->updated_at->format('D d, M, Y')}}</p>
                                        
@endforeach

@endsection
