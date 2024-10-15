<div class="modal fade" id="services-modal" tabindex="-1" role="dialog" aria-labelledby="services-modal-label"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="services-modal-label">Add Service Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="services-form" class="service-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="service_id" id="service_id" value="">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" class="form-control titleSlug" id="name" name="name"
                                    required>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control slug" id="slug" name="slug" required>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short_desc">Short Description</label>
                        <textarea class="form-control" id="short_desc" name="short_desc" required></textarea>
                        <span class="error-message text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea class="form-control mcetextarea" id="desc" name="desc"></textarea>
                        <span class="error-message text-danger"></span>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <img id="icon-thumbnail" src="" alt="Icon Thumbnail" width="30%"
                                    style="display: none;">
                                <label for="icon_url" id="icon-title">Mini Image</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control custom-file-input" id="icon_url"
                                        name="icon_url" accept="image/png, image/jpg, image/jpeg" required>
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <img id="image-thumbnail" src="" alt="Image Thumbnail" width="30%"
                                    style="display: none;">
                                <label for="image_url" id="thumbnail-title">Thumbnail</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control custom-file-input" id="image_url"
                                        name="image_url" accept="image/png, image/jpg, image/jpeg" required>
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Service Item</button>
                </form>
            </div>
        </div>
    </div>
</div>
