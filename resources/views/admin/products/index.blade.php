@extends('layouts.dashboard')
@section('title-page','admin')
@section('title','Products')

@section('content')

    <div class="mb-5">
        <a href="{{route('admin.products.create')}}" class="btn btn-sm btn-outline-primary mx-auto">Add Category</a>
        {{--        <a href="{{route('admin.products.trash')}}" class="btn btn-sm btn-outline-primary">Trashed Category</a>--}}

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
            <th>Category</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Image</th>
            <th colspan="2">Options</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i=0;
        @endphp
        @forelse($products as $product)

            <tr>
                <td>{{$i+=1}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->category->name}}</td>
                <td>{{$product->store->name}}</td>
                <td>{{$product->status}}</td>

                <td>{{$product->created_at}}</td>
                <td><img src="{{asset('storage/'.$product->image)}}" alt="" height="50"></td>
                <td>
                    <a href="{{route('admin.products.edit',$product->id)}}"
                       class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                    <form action="{{route('admin.products.destroy',$product->id)}}" method="post">
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
                <td class="text-center text-danger text-lg text-bold" colspan="9">No products defined</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="text-center">
        {{$products->links()}}
    </div>
@endsection
