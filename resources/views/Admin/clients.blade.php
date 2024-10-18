@extends('layout.admin')
@section('title', 'Clients and Works')

@section('content')
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="text-center">Clients</h5>
                    </div>
                    <form action="{{ route('portfolioclients.update', $portfolioClientsPage->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title_page">Page Title_page</label>
                                <input type="text" name="title_page" id="title_page" class="form-control"
                                    value="{{ $portfolioClientsPage->title_page }}" />
                                <span class="error-message text-danger">
                                    @error('title_page')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="title_client">Title Client</label>
                                <input type="text" name="title_client" id="title_client" class="form-control"
                                    value="{{ $portfolioClientsPage->title_client }}" />
                                <span class="error-message text-danger">
                                    @error('title_client')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <img src="{{ asset('storage/' . $portfolioClientsPage->image_url) }}" alt="image"
                                    width="100">
                                <label for="image_url">Image Thumbnail</label>
                                <div class="custom-file">
                                    <input type="file" name="image_url" id="image_url" class="custom-file-input"
                                        accept="image/png, image/jpg, image/jpeg">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <span class="error-message text-danger">
                                    @error('image_url')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Update Clients</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="text-center">Portfolio</h5>
                    </div>
                    <form action="{{ route('portfolioclients.update', $portfolioClientsPage->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title_portfolio">Title Portfolio</label>
                                <input type="text" name="title_portfolio" id="title_portfolio" class="form-control"
                                    value="{{ $portfolioClientsPage->title_portfolio }}" />
                                <span class="error-message text-danger">
                                    @error('title_portfolio')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="subtitle_portfolio">Subtitle</label>
                                <textarea name="subtitle_portfolio" id="subtitle_portfolio" class="form-control" rows="3">{{ $portfolioClientsPage->subtitle_portfolio }}</textarea>
                                <span class="error-message text-danger">
                                    @error('subtitle_portfolio')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Update Porfolio</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Clients</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#client-modal">Add New
                                Client</button>
                        </div>
                        <table id="client-items" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Works / Portfolio</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#works-modal"
                                id="tombol-open-modal">Add New
                                Work</button>
                        </div>
                        <table id="works-items" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Service</th>
                                    <th>Client</th>
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
    @component('admin.datatables.clients')
    @endcomponent
    @component('admin.datatables.works')
    @endcomponent
    @component('admin.components.form-modal-client')
    @endcomponent
    @component('admin.components.form-modal-works')
    @endcomponent
@endSection
