<div class="modal fade" id="galleries-modal-choose" tabindex="-1" role="dialog" aria-labelledby="galleries-modal-label"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleries-modal-label">Upload Images</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-body p-0">
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header" role="tablist">
                                        <!-- your steps here -->
                                        <div class="step" data-target="#logins-part">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="logins-part" id="logins-part-trigger">
                                                <span class="bs-stepper-circle">1</span>
                                                <span class="bs-stepper-label">Choose Work</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#information-part">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="information-part" id="information-part-trigger">
                                                <span class="bs-stepper-circle">2</span>
                                                <span class="bs-stepper-label">Select Contents</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content">
                                        <form id="galleries-form" class="galleries-form" method="POST"
                                            enctype="multipart/form-data">
                                            <!-- your steps content here -->
                                            <div id="logins-part" class="content p-2" role="tabpanel"
                                                aria-labelledby="logins-part-trigger">
                                                <div class="form-group">
                                                    <label>Works</label>
                                                    <select class="form-control select2" style="width: 100%;"
                                                        name="works">
                                                        <option value="">Select Work (EMPTY)</option>
                                                    </select>
                                                </div>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="stepper.next()">Next</button>
                                            </div>
                                            <div id="information-part" class="content p-2" role="tabpanel"
                                                aria-labelledby="information-part-trigger">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="activity_id"
                                                        id="activity-id" value="">
                                                    <label>Title Activity</label>
                                                    <input type="text" class="form-control" name="title"
                                                        id="title" required>
                                                    <div class="error-message text-danger"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label id="image-label">Upload Images (max 20, PNG/JPEG
                                                        only)</label>
                                                    <input type="file" class="form-control" name="images[]"
                                                        accept=".png, .jpeg, .jpg" id="exampleInputFile" multiple>
                                                    <div class="error-message text-danger"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="embed_video" id="embed-label">Embed Video Youtube
                                                        URL</label>
                                                    <div id="embed-video-container">
                                                        <input type="text" class="form-control mb-2"
                                                            name="embed_video[]" placeholder="Enter embed video URL"
                                                            id="youtube-embed">
                                                    </div>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        id="add-embed-video">+ Add more</button>
                                                </div>
                                                <div style="display: flex; justify-content: space-between;">
                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="stepper.previous()">Previous</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                                <p class="fw-bold pt-3" id="image-preview">Image Preview :</p>
                                                <div id="image-preview-upload" class="mt-3"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                Note : If you leave the Works field empty, the image will set to default and will not
                                appear on Work Detail Activity.
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
