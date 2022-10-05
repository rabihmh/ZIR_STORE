@extends('layouts.dashboard')
@section('title-page','admin')
@section('title','Categories')

@section('content')

    <div class="mb-5">
        @if(Auth::user()->can('categories.create'))
            <a href="{{route('admin.categories.create')}}" class="btn btn-sm btn-outline-primary mx-auto">Add
                Category</a>
        @endif
        <a href="{{route('admin.categories.trash')}}" class="btn btn-sm btn-outline-primary">Trashed Category</a>

    </div>

    @if(session()->has('deleted'))
        <div class="alert alert-danger">
            {{session('deleted')}}
        </div>
    @endif

    <x-alert type="success"/>
    <x-alert type="deleted"/>
    <x-alert type="info"/>

    <form action="{{URL::current()}}" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="mx-2"/>
        <select name="satus" class="form-control" class="mx-2">
            <option value="">All</option>
            <option value="active">Active</option>
            <option value="archived">Archived</option>
        </select>
        <button class="btn btn-sm btn btn-dark mx-2">Search</button>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Status</th>
            <th>Number of products</th>
            <th>Created At</th>
            <th>Image</th>
            <th colspan="2">Options</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i=0;
        @endphp
        @forelse($categories as $category)

            <tr>
                <td>{{$i+=1}}</td>
                <td><a href="{{route('admin.categories.show',$category->id)}}">{{$category->name}}</a></td>
                <td>{{$category->parent->name}}</td>
                <td>{{$category->status}}</td>
                <td>{{$category->count}}</td>
                <td>{{$category->created_at}}</td>
                <td><img src="{{asset('storage/'.$category->image)}}" alt="" height="50"></td>
                @can('categories.update')
                    <td>
                        <a href="{{route('admin.categories.edit',$category->id)}}"
                           class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                @endcan
                @can('categories.delete')
                    <td>
                        <form action="{{route('admin.categories.destroy',$category->id)}}" method="post">
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
                <td class="text-center text-danger text-lg text-bold" colspan="9">No categories defined</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="text-center">
        {{$categories->withQueryString()->appends(['search'=>1])->links()}}
    </div>
@endsection
