<div class="modal fade" id="sosmed-modal" tabindex="-1" role="dialog" aria-labelledby="sosmed-modal-label"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sosmed-modal-label">Add Sosmed Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="sosmed-form" class="sosmed-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="sosmed_id" id="sosmed_id" value="">
                    <div class="form-group">
                        <label for="title">Platform Name</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                        <span class="error-message text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <span class="error-message text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="url">Url</label>
                        <input type="text" class="form-control" id="url" name="url" required>
                        <span class="error-message text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" required>
                        <span class="error-message text-danger"></span>
                    </div>
                    <img id="image-thumbnail" src="" alt="Image Thumbnail" width="30%"
                        style="display: none;">
                    <div class="form-group">
                        <label for="image_url" id="thumbnail-title">Thumbnail</label>
                        <div class="custom-file">
                            <input type="file" class="form-control custom-file-input" id="image_url" name="image_url"
                                accept="image/png, image/jpg, image/jpeg" required>
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <span class="error-message text-danger"></span>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Sosmed Item</button>
                </form>
            </div>
        </div>
    </div>
</div>
