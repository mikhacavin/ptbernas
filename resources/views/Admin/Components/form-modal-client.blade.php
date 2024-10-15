<div class="modal fade" id="client-modal" tabindex="-1" role="dialog" aria-labelledby="client-modal-label"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="client-modal-label">Add New Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="client-form" class="client-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="client_id" id="client_id" value="">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <span class="error-message text-danger"></span>
                    </div>
                    <img id="image-thumbnail" src="" alt="Image Thumbnail" width="30%"
                        style="display: none;">
                    <div class="form-group">
                        <label for="image_url" id="thumbnail-title">Image</label>
                        <div class="custom-file">
                            <input type="file" class="form-control custom-file-input" id="image_url" name="image_url"
                                accept="image/png, image/jpg, image/jpeg" required>
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <span class="error-message text-danger"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Client</button>
                </form>
            </div>
        </div>
    </div>
</div>
