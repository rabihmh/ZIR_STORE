@extends('layouts.dashboard')

@section('title-page','admin')
@section('title','Edit Admin')

@section('content')

    <form action="{{ route('admin.admins.update', $admin->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('admin.admins._form', [
            'button_label' => 'Update'
        ])
    </form>

@endsection
