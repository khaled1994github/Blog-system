@extends('layouts.app')

@section('title', 'add-edit-post')

@section('content')
@include('partials.navbar')
<div class="container mt-2">

@if ($errors->any())
    @foreach ($errors->all() as $error)
<div class="toast show fade" style="margin:auto" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <strong class="me-auto text-danger">error</strong>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    {{$error}}
  </div>
</div>
@endforeach
@endif

@if (session('success'))
<div class="toast show fade" style="margin:auto" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <strong class="me-auto text-success">Success</strong>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    {{session('success')}}
  </div>
</div>
@endif

    <div class="card mt-2 w-75 p-2" style="margin:auto">
        <div class="border-bottom">
            <h3 class="text-center">{{ $type }} Post</h3>
        </div>
        <div class="card-body pb-0">
            <form action="{{ $type == 'Edit' ? route('post.edit', [$post->id]) : route('post.add')}}" method='post' id="add-edit-post-form">
                @csrf
                <div class="mb-3">
                    <label for="Title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Enter post title" value="{{ $type == 'Edit' ? $post->title : old('title') }}">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" name="content" rows="3">{{ $type == 'Edit' ? $post->content : old('content') }}</textarea>
                </div>

                <button class="btn btn-secondary">Save</button>
            </form>
        </div>


    </div>

</div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="{{ asset('/assets/js/add-post.js') }}"></script>
@endpush