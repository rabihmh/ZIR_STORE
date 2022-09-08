@extends('layouts.dashboard')
@section('title-page','admin')
@section('title','Add Category')

@section('content')
    <form action="{{route('admin.categories.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.categories._form')
    </form>
@endsection
