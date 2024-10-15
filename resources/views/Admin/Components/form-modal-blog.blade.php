<div class="modal fade" id="blog-modal" tabindex="-1" role="dialog" aria-labelledby="blog-modal-label"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="blog-modal-label">Add Blog Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="blog-form" class="blog-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="blog_id" id="blog_id" value="">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control titleSlug" id="title" name="title"
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
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control select2" id="category_id" name="category_id" required>
                                    <option value="">Choose Category</option>
                                </select>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img id="image-thumbnail" src="" alt="Image Thumbnail" width="30%"
                                style="display: none;">
                            <div class="form-group">
                                <label for="thumbnail" id="thumbnail-title">Thumbnail</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control custom-file-input" id="thumbnail"
                                        name="thumbnail" accept="image/png, image/jpg, image/jpeg" required>
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea class="form-control mcetextarea" id="desc" name="desc"></textarea>
                        <span class="error-message text-danger"></span>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Blog Post</button>
                </form>
            </div>
        </div>
    </div>
</div>

