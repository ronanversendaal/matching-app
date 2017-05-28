@extends('layout.master')

@section('content')
            <div class="content container col-sm-6 col-sm-offset-3 col-md-5 col-md-offset-4">
                <picker list="{{$clients}}"></picker>
            </div>
@endsection