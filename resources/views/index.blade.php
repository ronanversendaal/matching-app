@extends('layout.master')

@section('content')
<div class="content container col-sm-6 col-sm-offset-3 col-md-5 col-md-offset-4">
    <picker user="{{json_encode(Auth::user())}}" list="{{json_encode($clients)}}"></picker>
</div>
@endsection