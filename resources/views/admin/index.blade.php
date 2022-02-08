@extends('layouts.app')
@section('content')
    <nav>
        <div class="nav nav-tabs d-flex justify-content-center" id="nav-tab" role="tablist">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active" style="color: #000;">Posts</a>
            <a href="{{ route('admin.dashboard.user') }}" style="color: #000" class="nav-link">Users</a>
        </div>
    </nav>

    <table class="table mt-5">
        <thead class="bg-secondary">
            <tr class="table-title">
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Latest Update</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td scope="row">{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td><a class="author-href-txt" href="{{ route('user.profile', $post->user->id) }}">
                            {{ $post->user->name }}</a></td>
                    <td>{{ date('F j, Y, g:i a', strtotime($post->updated_at)) }}</td>
                    <td class="d-flex ">
                        <a class="action-btn" href="{{ route('posts.edit', $post->id) }}">
                            <i class="fas fa-edit edit-icon"></i></a>
                        <a class="action-btn" href="{{ route('posts.show', $post->id) }}">
                            <i class="fas fa-info-circle edit-icon"></i></a>
                        <a data-bs-toggle="modal" data-bs-target="#deleteConfirmation" data-table="posts"
                            class=" action-btn btn-delete" data-item="{{ $post->id }}" type="submit">
                            <i class="fas fa-trash del-icon"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links('vendor.pagination.cust_pagination') }}


@endsection
