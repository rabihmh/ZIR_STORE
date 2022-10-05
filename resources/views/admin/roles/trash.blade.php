@extends('layouts.dashboard')
@section('title-page','admin')
@section('title','Trashed Categories')

@section('content')

    <div class="mb-5">
        <a href="{{route('admin.categories.index')}}" class="btn btn-sm btn-outline-primary">Back</a>
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
            <th>Status</th>
            <th>Deleted At</th>
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
                <td>{{$category->name}}</td>
                <td>{{$category->status}}</td>
                <td>{{$category->deleted_at}}</td>
                <td><img src="{{asset('storage/'.$category->image)}}" alt="" height="50"></td>
                <td>
                    <form action="{{route('admin.categories.restore',$category->id)}}" method="post">
                        {{csrf_field()}}

                        @method('put')
                        <button type="submit" class="btn btn-sm btn-outline-success">Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('admin.categories.force-delete',$category->id)}}" method="post">
                    {{csrf_field()}}

                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Force Delete</button>
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
    <div class="text-center">
        {{$categories->withQueryString()->links()}}
    </div>
@endsection
