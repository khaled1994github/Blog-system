<div class="modal fade" id="edit-comment-modal-id" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit comment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="edit-comment-form">
                        <input type="hidden" name="comment_id" id="edit-comment-id-hidden-field">
                        <div class="row">
                            <div class="col-9">
                                <div class="mb-3">
                                    <div>
                                    <label>Comment</label>
                                        <textarea id="edit-comment-textarea" class="form-control"
                                            placeholder="Leave a comment here" name="comment"></textarea>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <button type="submit" title="Edit Comment"
                                        class="btn btn-outline-primary">
                                        <b>Save</b>
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>