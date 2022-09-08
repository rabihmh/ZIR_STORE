@extends('layouts.dashboard')
@section('title-page','admin')
@section('title','Categories')

@section('content')

    <div class="mb-5">
        <a href="{{route('admin.categories.create')}}" class="btn btn-sm btn-outline-primary">Add Category</a>
    </div>
    {{--    @if(session('success'))--}}
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if(session()->has('info'))
        <div class="alert alert-info">
            {{session('info')}}
        </div>
    @endif
    @if(session()->has('deleted'))
        <div class="alert alert-danger">
            {{session('deleted')}}
        </div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Created At</th>
            <th>Image</th>
            <th colspan="2">Options</th>
        </tr>
        </thead>
        <tbody>

        @forelse($categories as $category)

            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->parent_id}}</td>
                <td>{{$category->created_at}}</td>
                <td><img src="{{asset('storage/'.$category->image)}}" alt="" height="50"></td>
                <td>
                    <a href="{{route('admin.categories.edit',$category->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                    <form action="{{route('admin.categories.destroy',$category->id)}}" method="post">
                    {{csrf_field()}}
                    <!--Form method spoofing-->
                        {{--<input type="hidden" name="_method" value="delete">--}}
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center text-danger text-lg text-bold" colspan="7">No categories defined</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
