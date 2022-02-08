@extends('layouts.app')
@section('content')
    <nav>
        <div class="nav nav-tabs d-flex justify-content-center" id="nav-tab" role="tablist">
            <a href="{{ route('admin.dashboard') }}" class="nav-link " style="color: #000;">Posts</a>
            <a href="{{ route('admin.dashboard.user') }}" style="color: #000" class="nav-link active">Users</a>
        </div>
    </nav>

    <table class="table mt-5">
        <thead class="bg-secondary">
            <tr class="table-title">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td scope="row">{{ $user->id }}</td>
                    <td class="btn-promote">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role == 2 ? 'User' : 'Admin' }}</td>
                    <td class="d-flex ">
                        <a class="action-btn" href="{{ route('user.edit', $user->id) }}">
                            <i class="fas fa-edit edit-icon"></i>
                        </a>
                        <a class="action-btn" href="{{ route('user.profile', $user->id) }}">
                            <i class="fas fa-info-circle edit-icon"></i>
                        </a>
                        <a data-bs-toggle="modal" data-bs-target="#deleteConfirmation" class=" action-btn btn-delete"
                            data-item="{{ $user->id }}" data-name="{{ $user->name }}" type="submit">
                            <i class="fas fa-trash del-icon"></i>
                        </a>
                        @if ($user->id !== Auth::id())
                            <a data-item="{{ $user->id }}" data-name="{{ $user->name }}"
                                class="action-btn btn-promote" data-bs-toggle="modal" data-role="{{ $user->role }}"
                                data-bs-target="#promoteConfirmation">
                                <i class="fas {{ $user->role == 1 ? 'fa-minus-circle' : 'fa-plus-circle' }} edit-icon">
                                </i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
