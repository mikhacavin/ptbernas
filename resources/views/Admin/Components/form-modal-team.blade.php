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
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="index">Index</label>
                                        <input type="number" class="form-control" id="index" name="index"
                                            required>
                                        <span class="error-message text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Social Media Information</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-twitter-x"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Twitter Link" id="twitter_link" name="twitter_link">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Facebook Link" id="fb_link" name="fb_link">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Instagram Link" id="ig_link" name="ig_link">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-linkedin"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="LinkedIn Link" id="linkedin_link" name="linkedin_link">
                                    </div>
                                </div>
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
