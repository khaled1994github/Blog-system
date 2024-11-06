@foreach ($comments as $comment)
    <li class="list-group-item">
        <div class="d-flex">
            <div>
                <img class="rounded-circle" alt="avatar1" src="{{ asset('assets/img/user.jpg') }}" width="30" />
            </div>

            <div class="ms-3">
                <i style="font-size:12px">{{ $comment->user->name }}</i>
                <br>
                <i class="text-muted fw-light" style="font-size:12px">{{$comment->diff_date}}</i>
                
            </div>
            <div class="flex-grow-1 mx-3">
                <p id="{{"comment-content-paragraph-" . $comment->id }}">
                    {{ $comment->comment }}
                </p>
                <i class="text-muted fw-light flex-fill" style="font-size:12px">{{$comment->created_at}}</i>
            </div> 
        </div>

        <div class="d-flex">
            
            <div class="flex-fill">

                @can('update', $comment)
                    <button type="button" title="Edit Comment" class="btn btn-outline-primary btn-sm p-0 edit-comment-btn float-end" data-comment-id="{{ $comment->id }}">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                @endcan

                @can('delete', $comment)
                    <button type="button" title="Delete Comment" onclick="deleteComment(this)"class="btn btn-outline-danger btn-sm p-0 float-end" data-comment-id="{{ $comment->id }}" data-post-id="{{ $comment->post_id }}" id="{{"delete-comment-" . $comment->id }}">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                @endcan
                
            </div>
            
        </div>
            
    </li>

@endforeach