<div class="modal fade" id="projects-modal" tabindex="-1" role="dialog" aria-labelledby="projects-modal-label"
    aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projects-modal-label">Add Projects Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="projects-form" class="projects-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="projects_id" id="projects_id" value="">
                    <div class="form-group">
                        <label for="desc">Projects Name</label>
                        <input type="text" class="form-control" id="desc" name="desc" required>
                        <span class="error-message text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="number">number</label>
                        <input type="number" class="form-control" id="number" name="number" required>
                        <span class="error-message text-danger"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Projects Item</button>
                </form>
            </div>
        </div>
    </div>
</div>
