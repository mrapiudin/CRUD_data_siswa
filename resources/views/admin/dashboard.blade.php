@extends('template.app')

@section('content-dinamis')
    <h1>WELCOMEEEE {{ Auth::user()->role }}</h1>
@endsection