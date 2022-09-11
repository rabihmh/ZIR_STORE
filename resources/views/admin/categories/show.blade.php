@extends('layouts.dashboard')
@section('title-page','admin')
@section('title','Categories')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i=0;
            $products=$category->products()->with('store')->latest()->paginate(5);
        @endphp
        @forelse($products as $product)

            <tr>
                <td>{{$i+=1}}</td>
                <td>{{$product->name}}</td>
                {{--                @php--}}
                {{--                    $store=\App\Models\Store::select('name')->where('id',$product->store_id)->first()--}}
                {{--                @endphp--}}
                <td>{{$product->store->name}}</td>
                <td>{{$product->status}}</td>
                <td>{{$product->created_at}}</td>

            </tr>
        @empty
            <tr>
                <td class="text-center text-danger text-lg text-bold" colspan="9">No categories defined</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{$products->withQueryString()->links()}}
@endsection
