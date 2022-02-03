@extends('layouts.app')
@section('content')

    <nav>
        <div class="nav nav-tabs d-flex justify-content-center" id="nav-tab" role="tablist">
            <button class="nav-link active" style="color: #000;" id="nav-home-tab" data-bs-toggle="tab"
                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                aria-selected="true">Posts</button>
            <button style="color: #000" class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                aria-selected="false">Users</button>

        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active mt-5" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <table class="table">
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
                            <td>{{ $post->user->name }}</td>
                            <td>{{ date('F j, Y, g:i a', strtotime($post->updated_at)) }}</td>
                            <td class="d-flex ">
                                <a class="action-btn" href="{{ route('posts.edit', $post->id) }}">
                                    <i class="fas fa-edit edit-icon"></i></a>
                                <a class="action-btn" href="{{ route('posts.show', $post->id) }}">
                                    <i class="fas fa-info-circle edit-icon"></i></a>
                                <form class="del-icon-form " action="{{ route('posts.destroy', $post->id) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="action-del-btn" type="submit"><i
                                            class="fas fa-trash del-icon"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $posts->links('vendor.pagination.cust_pagination') }}
        </div>
        <div class="tab-pane fade  mt-5" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class="table">
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
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role == 2 ? 'User' : 'Admin' }}</td>
                                <td class="d-flex ">
                                    <a class="action-btn" href="{{ route('user.edit', $user->id) }}">
                                        <i class="fas fa-edit edit-icon"></i></a>
                                    <a class="action-btn" href="{{ route('user.profile', $user->id) }}">
                                        <i class="fas fa-info-circle edit-icon"></i></a>
                                    <form class="del-icon-form " action="{{ route('user.destroy', $user->id) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="action-del-btn" type="submit">
                                            <i class="fas fa-trash del-icon"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>



@endsection
