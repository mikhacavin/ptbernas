<div class="modal fade" id="client-feedback-modal" tabindex="-1" role="dialog"
    aria-labelledby="client-feedback-modal-label" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="client-feedback-modal-label">Feedback Form Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="client-feedback-form" class="client-feedback-form" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="client_feedback_id" id="client_feedback_id" value="">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="title">Form Name</label>
                                <input type="text" class="form-control titleSlug" id="title" name="title" required>
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
                        <label for="client_id">Client</label>
                        <select class="form-control select2" id="client_id" name="client_id" required>
                            <option value="">Select Client</option>
                        </select>
                        <span class="error-message text-danger"></span>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="active">
                            <label class="custom-control-label" for="customSwitch1">Active?</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Client Feedback</button>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <p class="mx-auto">Link and QR will generated after Form Successfully created.</p>
            </div>
        </div>
    </div>
</div>
