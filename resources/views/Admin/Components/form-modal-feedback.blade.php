<div class="modal fade" id="testimonials-modal" tabindex="-1" role="dialog" aria-labelledby="testimonials-modal-label"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="testimonials-modal-label">Add Testimonials</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="testimonials-form" class="testimonials-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="testimonials_id" id="testimonials_id" value="">
                    <div class="form-group">
                        <label for="client_feedback_id">Feedback Form Client</label>
                        <select class="form-control select2 select2data" id="client_feedback_id"
                            name="client_feedback_id">
                        </select>
                        <span class="error-message text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <div class="rating">
                            <input type="radio" id="rating5" name="rating" value="5">
                            <label for="rating5">☆</label>
                            <input type="radio" id="rating4" name="rating" value="4">
                            <label for="rating4">☆</label>
                            <input type="radio" id="rating3" name="rating" value="3">
                            <label for="rating3">☆</label>
                            <input type="radio" id="rating2" name="rating" value="2">
                            <label for="rating2">☆</label>
                            <input type="radio" id="rating1" name="rating" value="1">
                            <label for="rating1">☆</label>
                        </div>
                        <span class="error-message text-danger"></span>
                    </div>
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
                                <label for="position">Job / Position</label>
                                <input type="text" class="form-control" id="position" name="position" required>
                                <span class="error-message text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="desc">Desc</label>
                        <textarea class="form-control" id="desc" name="desc" required></textarea>
                        <span class="error-message text-danger"></span>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="show" name="show">
                            <label class="custom-control-label" for="show">Show?</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Testimonials</button>
                </form>
            </div>
        </div>
    </div>
</div>
