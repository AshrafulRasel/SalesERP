@extends('layouts.master')

@section('titel', 'Home | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    @include('partials.content')

@endsection
