@extends('layouts.app')
@section('content')
<h1 class="mt-2">Post Create</h1>
<hr>
@if($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $err)
            <li>{{$err}}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{route('posts.store')}}" method="post">
    @csrf
    <input type="text" name="title" class="form-control mb-3" placeholder="Enter Title" >
    <textarea type="text" name="content" rows="4" class="form-control mb-3" placeholder="Content" ></textarea>
    <input type="hidden" name="public_post" value=1 class="form-control mb-3" >
    <input type="hidden" name="author_id" class="form-control mb-3"  value="001">

    <input class="form-check-input" type="checkbox" value="1" name="category_list[]">
    <label class="form-check-label" >
       Health
      </label>
    <input class="form-check-input" type="checkbox" value="2" name="category_list[]">
    <label class="form-check-label" >
       Food
      </label>
      <input class="form-check-input" type="checkbox" value="3" name="category_list[]">
      <label class="form-check-label" >
         Travel
        </label>
        <input class="form-check-input" type="checkbox" value="4" name="category_list[]">
        <label class="form-check-label" >
           photography
          </label>
    <button class="btn btn-primary float-end px-5">Submit</button>
</form>
@endsection

