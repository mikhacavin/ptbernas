<div class="modal fade" id="menu-modal" tabindex="-1" role="dialog" aria-labelledby="menu-modal-label"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menu-modal-label">Add Menu Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="menu-form" class="menu-form" method="POST">
                    <input type="hidden" name="menu_id" id="menu_id" value="">
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
                                <label for="url">Url</label>
                                <input type="text" class="form-control" id="url" name="url" required>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="index">Index</label>
                                <select class="form-control select2" id="index" name="index" required>
                                    <option value="">Choose Index</option>
                                </select>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="parent">Parent</label>
                                <select class="form-control select2" id="parent" name="parent">
                                    <option value="">Choose Parent (EMPTY)</option>
                                </select>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Menu Item</button>
                </form>
            </div>
        </div>
    </div>
</div>
