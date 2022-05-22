@extends('layouts.app')

@section('content')
    <div class="container"> 
        Welcome {{ Auth::user()->name }}
        <br>Goto <a href="{{ url('post') }}">posts</a> page.
    </div>
@endsection
