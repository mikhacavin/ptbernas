<div class="modal fade" id="works-modal" tabindex="-1" role="dialog" aria-labelledby="works-modal-label" aria-hidden="true"
    data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="works-modal-label">Add New Portfolio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="works-form" class="works-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="works_id" id="works_id" value="">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="client_data">Client</label>
                                <select class="form-control" id="client_data" name="client_data" required>
                                    <option value="">Choose Client</option>
                                </select>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="service_id">Service</label>
                                <select class="form-control" id="service_id" name="service_id" required>
                                    <option value="">Choose Service</option>
                                </select>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                        <span class="error-message text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="desc">Desc</label>
                        <textarea class="form-control mcetextarea" id="desc" name="desc"></textarea>
                        <span class="error-message text-danger"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Work</button>
                </form>
            </div>
        </div>
    </div>
</div>
