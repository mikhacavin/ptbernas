@extends('layout.admin')
@section('title', 'Testimonials/Feedback')

@section('content')
    <section>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Feedback Form Specific Client</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button id="tombol-open-modal-client" class="btn btn-warning" data-toggle="modal"
                                data-target="#client-feedback-modal">Add New Feedback Form Client</button>
                        </div>
                        <table id="client-feedback-items" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Form Name</th>
                                    <th>Client</th>
                                    <th>Created At</th>
                                    <th>Active?</th>
                                    <th>Link</th>
                                    <th>QR</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">All Feedback / Testimonials Data</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button id="tombol-open-modal" class="btn btn-warning" data-toggle="modal"
                                data-target="#testimonials-modal">Add New
                                Testimonials</button>
                        </div>
                        <table id="testimonial-items" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name & Rating</th>
                                    <th>Created At</th>
                                    <th>Job / Position</th>
                                    <th>Form Client</th>
                                    <th>Show?</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        @push('script')
            <script src="https://cdn.jsdelivr.net/npm/qr-code-styling-v2@1.6.1/lib/qr-code-styling.min.js"></script>
        @endpush
        @push('style')
            <style>
                .rate {
                    border-bottom-right-radius: 12px;
                    border-bottom-left-radius: 12px
                }

                .rating {
                    display: flex;
                    flex-direction: row-reverse;
                    justify-content: center
                }

                .rating>input {
                    display: none
                }

                .rating>label {
                    position: relative;
                    width: 1em;
                    font-size: 30px;
                    font-weight: 300;
                    color: #FFD600;
                    cursor: pointer
                }

                .rating>label::before {
                    content: "\2605";
                    position: absolute;
                    opacity: 0
                }

                .rating>label:hover:before,
                .rating>label:hover~label:before {
                    opacity: 1 !important
                }

                .rating>input:checked~label:before {
                    opacity: 1
                }

                .rating:hover>input:checked~label:before {
                    opacity: 0.4
                }

                .buttons {
                    top: 36px;
                    position: relative
                }
            </style>
        @endpush
    </section>
    @component('admin.datatables.clientFeedback')
    @endcomponent
    @component('admin.datatables.feedback')
    @endcomponent
    @component('admin.components.form-modal-client-feedback')
    @endcomponent
    @component('admin.components.form-modal-feedback')
    @endcomponent
    @component('admin.components.slug', ['db' => 'clientFeedback'])
    @endcomponent
@endSection
