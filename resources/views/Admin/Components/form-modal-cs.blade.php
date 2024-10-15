<div class="modal fade" id="cs-modal" tabindex="-1" role="dialog" aria-labelledby="cs-modal-label" aria-hidden="true"
    data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cs-modal-label">Add Customer Support</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cs-form" class="cs-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="cs_id" id="cs_id" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Whatsapp Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <img id="image-thumbnail" src="" alt="Image Thumbnail" width="30%"
                        style="display: none;">
                    <div class="form-group">
                        <label for="image_url">Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image_url" name="image_url">
                                <label class="custom-file-label" for="image_url">Choose file</label>
                            </div>
                        </div>

                        <span class="error-message text-danger"></span>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
