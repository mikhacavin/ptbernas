@extends('layout.admin')
@section('title', 'Project Activity Gallery & Certification')

@section('content')
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="text-center">Activity</h5>
                    </div>
                    <form action="{{ route('activity.update', $acitivityPage->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ $acitivityPage->title }}" />
                                <span class="error-message text-danger">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="subtitle">Subtitle</label>
                                <textarea name="subtitle" id="subtitle" class="form-control" rows="3">{{ $acitivityPage->subtitle }}</textarea>
                                <span class="error-message text-danger">
                                    @error('subtitle')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <img src="{{ asset('storage/' . $acitivityPage->image_url) }}" alt="image"
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
                                <button type="submit" class="btn btn-primary">Update Activity</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="text-center">Certification</h5>
                    </div>
                    <form action="{{ route('cert.update', $certificationPage->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="cert_title">Title</label>
                                <input type="text" name="cert_title" id="cert_title" class="form-control"
                                    value="{{ $certificationPage->title }}" />
                                <span class="error-message text-danger">
                                    @error('cert_title')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="cert_subtitle">Subtitle</label>
                                <textarea name="cert_subtitle" id="cert_subtitle" class="form-control" rows="3">{{ $certificationPage->subtitle }}</textarea>
                                <span class="error-message text-danger">
                                    @error('cert_subtitle')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <img src="{{ asset('storage/' . $certificationPage->image_url) }}" alt="image"
                                    width="100">
                                <label for="cert_image_url">Image Thumbnail</label>
                                <div class="custom-file">
                                    <input type="file" name="cert_image_url" id="cert_image_url"
                                        class="custom-file-input" accept="image/png, image/jpg, image/jpeg">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <span class="error-message text-danger">
                                    @error('cert_image_url')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Update Certification</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Ativity Gallery</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button id="tombol-open-modal" class="btn btn-warning" data-toggle="modal"
                                data-target="#galleries-modal-choose">Upload Activity Image</button>
                        </div>
                        <table id="galleries-items" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Activity Title</th>
                                    <th>Client</th>
                                    <th>Work</th>
                                    <th>File</th>
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
                        <h3 class="card-title">Certification</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button id="tombol-open-certification" class="btn btn-warning" data-toggle="modal"
                                data-target="#certification-modal">Add New
                                Certification</button>
                        </div>
                        <table id="certification-items" class="table table-bordered table-striped">
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
                    <!-- /.card-body  -->
                </div>
            </div>
        </div>
        @push('script')
            <script>
                // BS-Stepper Init
                document.addEventListener('DOMContentLoaded', function() {
                    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
                })
            </script>
        @endpush
    </section>
    @component('admin.datatables.galleries')
    @endcomponent
    @component('admin.datatables.certification')
    @endcomponent
    @component('admin.components.form-modal-galleries-choose')
    @endcomponent
    @component('admin.components.certification')
    @endcomponent
@endSection
