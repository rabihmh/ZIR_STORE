@extends('layouts.dashboard')
@section('title-page','admin')
@section('title','Roles')

@section('content')

    <div class="mb-5">
        @can('create','App\Models\Role')
        <a href="{{route('admin.roles.create')}}" class="btn btn-sm btn-outline-primary mx-auto">Add
            Roles</a>
        @endcan

    </div>

    @if(session()->has('deleted'))
        <div class="alert alert-danger">
            {{session('deleted')}}
        </div>
    @endif

    <x-alert type="success"/>
    <x-alert type="deleted"/>
    <x-alert type="info"/>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created At</th>
            <th colspan="2">Options</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i=0;
        @endphp
        @forelse($roles as $role)

            <tr>
                <td>{{$i+=1}}</td>
                <td><a href="{{route('admin.roles.show',$role->id)}}">{{$role->name}}</a></td>
                <td>{{$role->created_at}}</td>
                @can('update',$role)
                    <td>
                        <a href="{{route('admin.roles.edit',$role->id)}}"
                           class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                @endcan
                @can('delete',$role)
                    <td>
                        <form action="{{route('admin.roles.destroy',$role->id)}}" method="post">
                        {{csrf_field()}}
                        <!--Form method spoofing-->
                            {{--<input type="hidden" name="_method" value="delete">--}}
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                @endcan
            </tr>
        @empty
            <tr>
                <td class="text-center text-danger text-lg text-bold" colspan="4">No roles defined</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="text-center">
        {{$roles->withQueryString()->links()}}
    </div>
@endsection
