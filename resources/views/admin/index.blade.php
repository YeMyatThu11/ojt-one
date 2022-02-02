@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between flex-wrap">

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
                            <form class="del-icon-form " action="{{ route('posts.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="action-del-btn" type="submit"><i class="fas fa-trash del-icon"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    {{ $posts->links('vendor.pagination.cust_pagination') }}
@endsection
