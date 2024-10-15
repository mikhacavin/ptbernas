<div class="modal fade" id="team-modal" tabindex="-1" role="dialog" aria-labelledby="team-modal-label" aria-hidden="true"
    data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="team-modal-label">Add Team Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="team-form" class="team-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="team_id" id="team_id" value="">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="index">Index</label>
                                <input type="number" class="form-control" id="index" name="index" required>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img id="image-thumbnail" src="" alt="Image Thumbnail" width="30%"
                                style="display: none;">
                            <div class="form-group">
                                <label for="image_url" id="thumbnail-title">Image</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control custom-file-input" id="image_url"
                                        name="image_url" accept="image/png, image/jpg, image/jpeg" required>
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Team Item</button>
                </form>
            </div>
        </div>
    </div>
</div>
