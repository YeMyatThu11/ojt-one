@extends('layouts.app')
@section('content')

    <div class="d-flex justify-content-between flex-wrap">
        @foreach ($categories as $category)
            <div class="catg-container bg-secondary d-flex">
                <p>{{ $category->name }}</p>
                <div class="action-btn">
                    <a href="{{ route('categories.edit', $category->id) }}"
                        style="text-decoration: none;color:#fff;padding:3px 6px">
                        <i class="fas fa-edit" style="color:#fff"></i></a>
                    <a href="{{ route('categories.show', $category->id) }}"
                        style="text-decoration: none;color:#fff;padding:3px 6px">
                        <i class="fas fa-info-circle" style="color:#fff"></i></a>
                    <form style="padding:3px 6px;margin:0;" action="{{ route('categories.destroy', $category->id) }}"
                        method="post">
                        @csrf
                        @method('delete')
                        <button style="background: #fff;border: 0;padding:0;" class="btn mr-3 btn-danger btn-sm"
                            type="submit"><i class="fas fa-trash" style="color: #fff"></i></button>

                    </form>
                </div>
            </div>
        @endforeach
        <a href="{{ route('categories.create') }}" class="bg-secondary"
            style="text-decoration: none;padding: 10px;margin:5px;border-radius: 20px;color:#fff;">Add New Post <i
                class="fas fa-plus-circle" style="color:#fff;padding-left:5px"></i></a>
    </div>
@endsection

<style>
    .catg-container {
        margin: 5px;
        padding: 10px;
        border-radius: 20px;
    }

    .catg-container p {
        color: #fff;
        margin: 0;
    }

    .catg-container:hover>.action-btn {
        display: flex;
    }

    .catg-container :focus+.action-btn {
        display: flex;
    }

    .action-btn {
        display: none;
    }

</style>
