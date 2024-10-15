<div class="modal fade" id="footer-modal" tabindex="-1" role="dialog" aria-labelledby="footer-modal-label"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="footer-modal-label">Add Footer Link Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="footer-form" class="footer-form" method="POST">
                    <input type="hidden" name="footer_id" id="footer_id" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="link">Url</label>
                                <input type="text" class="form-control" id="link" name="link" required>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" id="type" name="type" required>
                                    <option value="0">Quick Links</option>
                                    <option value="1">Other Pages</option>
                                </select>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
