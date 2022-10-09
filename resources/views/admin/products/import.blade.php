@extends('layouts.dashboard')
@section('title-page','admin')
@section('title', 'Import Product')

@section('content')

    <form action="{{ route('admin.products.import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <x-form.input label="Count" class="form-control-lg" role="input" name="count"/>
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>

@endsection
