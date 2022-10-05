@extends('layouts.dashboard')

@section('title-page','admin')
@section('title','create admin')

@section('content')

    <form action="{{ route('admin.admins.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('admin.admins._form')
    </form>

@endsection
