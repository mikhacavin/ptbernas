@extends('layout.admin')
@section('title', 'Services')

@section('content')
    <section>
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Services</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('services.update', $services->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter Title"
                                    name="title" value="{{ $services->title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="subTitle">Desc</label>
                                <textarea class="form-control" id="subTitle" placeholder="Enter Sub Title" name="desc" rows="5" required>{{ $services->desc }}</textarea>
                            </div>
                            <img src="{{ asset('storage/' . $services->image_url) }}" width="100" alt="Image">
                            <div class="form-group">
                                <label for="exampleInputFile">Change image ?</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile"
                                            name="image_url">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">All Services</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#services-modal">Add New
                                Service</button>
                        </div>
                        <table id="services-items" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Short Desc</th>
                                    <th>Image</th>
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
            <script src="https://cdn.tiny.cloud/1/flaslgydxvivestoido2p1wiug67ocqud6p6spipwz26b2yk/tinymce/7/tinymce.min.js"
                referrerpolicy="origin"></script>

            <script>
                $.widget.bridge('uibutton', $.ui.button);
                $(document).ready(function() {
                    $('.custom-file-input').on('change', function() {
                        var fileName = $(this).val().split('\\').pop();
                        $(this).next('.custom-file-label').addClass("selected").html(fileName);
                    });
                    //Initialize Select2 Elements
                    $('.select2').select2()

                });

                tinymce.init({
                    selector: '.mcetextarea',
                    images_upload_url: '{{ route('dashboard.tinymce') }}',
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                });
            </script>
        @endpush
    </section>
    @component('admin.datatables.services')
    @endcomponent
    @component('admin.components.form-modal-services')
    @endcomponent
    @component('admin.components.slug', ['db' => 'serviceItems'])
    @endcomponent
@endSection
