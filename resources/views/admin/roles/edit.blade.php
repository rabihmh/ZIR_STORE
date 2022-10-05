@extends('layouts.dashboard')
@section('title-page','admin')
@section('title','Roles')

@section('content')
    <form action="{{route('admin.roles.update',$role->id)}}" method="post">
        @csrf
        @method('put')
        @include('admin.roles._form',[
     'button_label'=>'Update'
 ])

    </form>
@endsection
