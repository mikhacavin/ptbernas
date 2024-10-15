<div class="modal fade" id="certification-modal" tabindex="-1" role="dialog" aria-labelledby="certification-modal-label"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="certification-modal-label">Add Certification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="certification-form" class="certification-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="certification_id" id="certification_id" value="">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                        <span class="error-message text-danger"></span>
                    </div>
                    <div class="form-group">
                        <img id="image-preview" src="" alt="Image Thumbnail" width="30%"
                            style="display: none;">
                        <label for="image_url" id="thumbnail-title">Image</label>
                        <div class="custom-file">
                            <input type="file" class="form-control custom-file-input" id="image_url" name="image_url"
                                accept="image/png, image/jpg, image/jpeg" required>
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <span class="error-message text-danger"></span>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Certification</button>
                </form>
            </div>
        </div>
    </div>
</div>
