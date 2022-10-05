@extends('layouts.dashboard')
@section('title-page','admin')
@section('title','Add Role')

@section('content')
    <form action="{{route('admin.roles.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.roles._form')
    </form>
@endsection
