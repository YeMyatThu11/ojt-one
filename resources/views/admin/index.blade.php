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
                            <td><a class="author-href-txt" href="{{ route('user.profile', $post->user->id) }}">
                                    {{ $post->user->name }}</a></td>
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
                                    <button class="action-del-btn"><i class="fas fa-trash del-icon"></i></button>
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
                                    <a data-bs-toggle="modal" data-bs-target="#deleteConfirmation"
                                        data-item="{{ $user->id }}" data-name={{ $user->name }}
                                        class=" action-btn btn-delete" type="submit">
                                        <i class="fas fa-trash del-icon"></i>
                                    </a>
                                    @if ($user->role == 2)
                                        <a data-item="{{ $user->id }}" data-name={{ $user->name }}
                                            class="action-btn btn-promote" data-bs-toggle="modal"
                                            data-bs-target="#promoteConfirmation">
                                            <i class="fas fa-plus-circle edit-icon"></i>
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="promoteConfirmation" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered model-dialog-adm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Confirm</h5>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form class="user-promote-form" action="" method="post">
                            @csrf
                            @method('put')
                            <button type="button" class="btn btn-secondary action-promote-btn">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteConfirmation" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered model-dialog-adm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete User</h5>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form class="del-icon-form " action="" method="post">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-secondary action-delete-btn">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(() => {
            var userId;
            $(document).on("click", ".btn-promote", function() {
                userId = $(this).attr('data-item');
                var username = $(this).attr('data-name');
                $('.modal-body').text(`Are you sure about promoting user "${username}" into admin?`);
            });
            $(document).on("click", ".action-promote-btn", () => {
                $('.user-promote-form').attr("action", `/user/${userId}/promote`);
                $('.user-promote-form').submit();
            });
            $(document).on("click", ".btn-delete", function() {
                userId = $(this).attr('data-item');
                var username = $(this).attr('data-name');
                $('.modal-body').text(`Are you sure about deleting user "${username}"?`);
            });
            $(document).on("click", ".action-delete-btn", () => {
                $('.del-icon-form').attr("action", `/user/${userId}`);
                $('.del-icon-form').submit();
            });
        });
    </script>

@endsection
