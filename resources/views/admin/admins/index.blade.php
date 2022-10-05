@extends('layouts.dashboard')

@section('title-page','admin')
@section('title','Admins')


@section('content')

    <div class="mb-5">
        <a href="{{ route('admin.admins.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
    </div>

    <x-alert type="success" />
    <x-alert type="info" />

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Created At</th>
            <th colspan="2"></th>
        </tr>
        </thead>
        <tbody>
        @forelse($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td><a href="{{ route('admin.admins.show', $admin->id) }}">{{ $admin->name }}</a></td>
                <td>{{ $admin->email }}</td>
                <td></td>
                <td>{{ $admin->created_at }}</td>
                <td>
                    @can('admins.update')
                        <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                    @endcan
                </td>
                <td>
                    @can('admins.delete')
                        <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="post">
                        @csrf
                        <!-- Form Method Spoofing -->
                            <input type="hidden" name="_method" value="delete">
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No admins defined.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $admins->withQueryString()->links() }}

@endsection
