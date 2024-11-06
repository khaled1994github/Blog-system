$(document).ready(function () {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });

    $('.comments-link').on('click', function (e) {

        e.preventDefault();
        var postId = $(this).attr('data-post-id');

        if ($('#comment-content-' + postId).is(':empty')) {

            var url = window.location.origin + '/getcomments/' + postId;

            $.ajax({
                url: url
            }).done(function (data) {

                $('#comment-content-' + postId).append(data.comments);

                if (data.data.current_page < Math.ceil(data.data.total / data.data.per_page)) {
                    $('#comments-load-id-' + postId).attr('href', data.data.next_page_url);
                    $('#comments-load-id-' + postId).show();
                }
            })

        }

        if ($('#comment-content-' + postId).is(":visible")) {

            $('#comment-ul-' + postId).slideUp();
        } else {
            
            $('#comment-ul-' + postId).slideDown();
        }

    });


    $('.comments-load-link').on('click', function (e) {

        e.preventDefault();
        var postId = $(this).attr('data-post-id');

        if ($(this).attr('href') != null) {

            var url = $(this).attr('href');

            $.ajax({
                url: url
            }).done(function (data) {

                $('#comment-content-' + postId).append(data.comments);

                if (data.data.current_page < Math.ceil(data.data.total / data.data.per_page)) {

                    $('#comments-load-id-' + postId).attr('href', data.data.next_page_url);
                } else {

                    $('#comments-load-id-' + postId).attr('href', data.data.next_page_url);
                    $('#comments-load-id-' + postId).parent().hide();
                }
            })


        } else {

            $(this).hide();
        }
    });

    $('.add-comment-field').on("keyup", function (e) {

        if (e.which == 13) {
            addComment(this);
        }
    });
    
    $('#search-input-field').on('keyup', function(){
        if($(this).val() == ''){
            location.replace(window.location.origin + '/dashboard');
        }
    });

    $("#edit-comment-form").validate({
        rules: {
            comment: {
                required: true
            }
        },

        submitHandler: function (form) {

            var $commentId = $('#edit-comment-id-hidden-field').val();
            var url = window.location.origin + '/updatecomments/' + $commentId;

            var $data = {
                "comment": $('#edit-comment-textarea').val().trim()
            };
    
            $.ajax({
                type: 'POST',
                url: url,
                data: $data
            }).done(function (data) {

                $('#comment-content-paragraph-' + $commentId).text(data.comment);

                Swal.fire({
                    title: 'Comment updated successfully.',
                    type: 'Success',
                });

                $('#edit-comment-modal-id').modal('hide');
    
            })
    
    
    
        }
    });

    $('.delete-post-button').on('click', function(e){

        e.preventDefault();

        Swal.fire({

            title: 'Are you sure?',
            text: 'You want to delete this post',
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#FC6A57',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
            reverseButtons: true
        }).then((result) => {

            if (result.value) {

                $(this).parent().submit();
            }
        })
    })

});

$(document).on('click', '.edit-comment-btn', function (e) {

    var $commentId = $(this).attr('data-comment-id');
    $('#edit-comment-id-hidden-field').val($commentId);
    $('#edit-comment-textarea').val($('#comment-content-paragraph-' + $commentId).text().trim());
    $('#edit-comment-modal-id').modal('show');
});

function removeSpaces(){

    $keyword = $('#search-input-field').val().trim();
    $('#search-input-field').val($keyword);
    return true;
}

function addComment(e) {

    var postId = $(e).attr('data-post-id')
    var url = window.location.origin + '/addcomments/' + postId;

    if ($('#add-comment-' + postId).val().length !== 0) {

        var data = {
            "comment": $('#add-comment-' + postId).val()
        };
        
        $.ajax({
            type: 'POST',
            url: url,
            data: data
        }).done(function (data) {

            $('#comment-content-' + postId).html(data.comments);

            if (data.data.current_page < Math.ceil(data.data.total / data.data.per_page)) {
               
                $('#comments-load-id-' + postId).attr('href', window.location.origin+'/getcomments/' + postId + '?page=2');
                $('#comments-load-id-' + postId).show();
                $('#comments-load-id-' + postId).parent().show();
            }
            if (data.status) {

                Swal.fire({
                    title: 'Comment Added successfully.',
                    type: 'Success',
                });
            }
            $('#comment-ul-' + postId).slideDown();
        })
        if($(e).prop("tagName") == 'SPAN'){

            $(e).prev().val('');
        }else{

            $(e).val('');
            $(e).blur();
        }

    }

}

function deleteComment(e) {

    Swal.fire({

        title: 'Are you sure?',
        text: 'You want to delete this comment',
        type: 'warning',
        showCancelButton: true,
        cancelButtonColor: 'default',
        confirmButtonColor: '#FC6A57',
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        reverseButtons: true
    }).then((result) => {
        
        if (result.value) {

            var commentId = $(e).attr('data-comment-id');
            var postId = $(e).attr('data-post-id');
            var url = window.location.origin + '/deletecomments/' + commentId;

            $.ajax({
                type: 'DELETE',
                url: url
            }).done(function (data) {

                $('#comment-content-' + postId).html(data.comments);

                if (data.data.current_page < Math.ceil(data.data.total / data.data.per_page)) {

                    $('#comments-load-id-' + postId).attr('href', window.location.origin+'/getcomments/' + postId + '?page=2');
                    $('#comments-load-id-' + postId).show();
                    $('#comments-load-id-' + postId).parent().show();
                }

                if (data.status) {

                    Swal.fire({
                        title: 'Comment Deleted successfully.',
                        type: 'Success',
                    });
                }
                
                $('#comment-ul-' + postId).slideDown();
            })

        }
    })

}
