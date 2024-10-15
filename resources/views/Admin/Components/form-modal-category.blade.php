<div class="modal fade" id="category-modal" tabindex="-1" role="dialog" aria-labelledby="category-modal-label"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="category-modal-label">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="category-form" class="category-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="categories_id" id="categories_id" value="">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control categorySlug" id="name" name="name"
                                    required>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="slug">Slug / URL</label>
                                <input type="text" class="form-control resultSlug" id="slug" name="slug"
                                    required>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
