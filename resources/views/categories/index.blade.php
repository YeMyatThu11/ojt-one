@extends('layouts.app')
@section('content')

    <div class="d-flex justify-content-between flex-wrap category-index">
        @foreach ($categories as $category)
            <div class="catg-container bg-secondary d-flex">
                <p>{{ $category->name }}</p>
                <div class="catg-action-btn">
                    <a class="catg-edit" href="{{ route('categories.edit', $category->id) }}">
                        <i class="fas fa-edit"></i></a>
                    <a class="catg-detail" href="{{ route('categories.show', $category->id) }}">
                        <i class="fas fa-info-circle"></i></a>
                    {!! Form::open(['route' => ['categories.destroy', $category->id]]) !!}
                    <div class="catg-del-form">
                        <button class="catg-del-btn" type="submit">
                            <i class="fas fa-trash catg-del-icon"></i>
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        @endforeach
        <a href="{{ route('categories.create') }}" class="bg-secondary catg-add-btn">
            Add New <i class="fas fa-plus-circle catg-add-icon"></i>
        </a>
    </div>
@endsection
