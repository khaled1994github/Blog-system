@extends('layouts.app')

@section('title', 'dashboard')

@section('content')
@include('partials.navbar')
<div class="container mt-2">

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
    <div class="w-75 d-flex justify-content-between flex-row-reverse" style="margin:auto">

        <div>
            <form action="{{ route('dashboard') }}" method='get' id="search-post-form" onsubmit="removeSpaces();">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="keyword" value="{{ Request::get('keyword') }}"
                        id="search-input-field" placeholder="Search">
                    <button class="btn btn-outline-secondary" type="submit">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </div>
            </form>
        </div>

        @can('isAdmin')
            <div>
                <a href="{{ route('post.add') }}" class="btn btn-secondary"><b>Add New +</b></a>
            </div>
        @endcan
        
    </div>
    @foreach ($posts as $post)
        <div class="card mt-2 w-75" style="margin:auto">
            <div class="border-bottom d-inline d-flex p-3">

                <div>
                    <img class="rounded-circle" alt="avatar1" src="{{ asset('assets/img/admin.jpg') }}" width="50" />
                </div>

                <div class="flex-grow-1 ms-3">
                    <span class="font-monospace">{{ $post->user->name }}</span>
                    <br>
                    <i class="text-muted fw-light" style="font-size:12px">{{$post->diff_date}}</i>
                    <br>
                    <i class="text-muted fw-light" style="font-size:12px">{{$post->created_at}}</i>
                </div>
                @can('update', $post)
                    <div class=" m-2">
                        <a href="{{route('post.edit', [$post->id])}}" type="button" title="Edit Post"
                            class="btn btn-outline-primary btn-sm p-0 edit-post-btn" data-post-id="{{ $post->id }}"><span
                                class="material-symbols-outlined">edit</span></a>
                        <form method="POST" class="d-inline" action="{{route('post.delete', [$post->id])}}"
                            id="delete-post-form">
                            @csrf
                            @method('DELETE')
                            <button title="Delete Post" type="button"
                                class="btn btn-outline-danger btn-sm p-0 delete-post-button"><span
                                    class="material-symbols-outlined">delete</span></button>
                        </form>
                    </div>
                @endcan
            </div>

            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->content }}</p>
                <a href="#" data-post-id="{{ $post->id }}" class="comments-link">comments</a>
            </div>

            <div class="comments">
                <ul class="list-group list-group-flush" id="{{"comment-ul-" . $post->id}}" style="display:none">
                    <div id="{{ "comment-content-"}}{{$post->id }}"></div>
                    <div>
                        <li class="list-group-item">
                            <a style="display:none" href="" data-post-id="{{ $post->id }}" class="comments-load-link" id="{{ "comments-load-id-" . $post->id }}">
                                <b>load comments</b>
                            </a>
                        </li>
                    </div>
                </ul>

                <div class="input-group">
                    <div class="form-floating">
                        <input type="text" data-post-id="{{ $post->id }}" id="{{"add-comment-" . $post->id }}"
                            class="form-control border-0 add-comment-field" name="comment">
                        <span class="material-symbols-outlined" data-post-id="{{ $post->id }}" onclick="addComment(this)"
                            style="float: right; margin-right: 14px; margin-top: -35px; position: relative; z-index: 2; color:lightgrey; cursor:pointer">send</span>
                        <label>Add Comments +</label>
                    </div>
                </div>

            </div>
        </div>

    @endforeach
    <div class=" w-75 p-3" style="margin:auto">
        {{ $posts->appends(request()->input())->links() }} <!-- Display pagination links -->
    </div>
</div>
@endsection
@include('partials.edit-modal')
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="/assets/js/dashboard.js"></script>
@endpush