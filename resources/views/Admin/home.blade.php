@extends('Layout.admin')
@section('title', 'Home')

@section('content')
    <section>
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Hero</h3>
                    </div>
                    <form action="{{ route('hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter Title"
                                    name="title" value="{{ $hero->title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="subTitle">Sub Title</label>
                                <input type="text" class="form-control" id="subTitle" placeholder="Enter Sub Title"
                                    name="subtitle" value="{{ $hero->subtitle }}" required>
                            </div>
                            <div class="form-group">
                                <label for="video_url">Video Link</label>
                                <input type="text" class="form-control" id="video_url" placeholder="Enter Sub Title"
                                    name="video_url" value="{{ $hero->video_url }}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Projects</h3>
                    </div>
                    <form action="{{ route('socialmedia.update', $social_media->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title_projects">Title</label>
                                <input type="text" class="form-control" id="title_projects" placeholder="Enter Title"
                                    name="title_projects" value="{{ $social_media->title_projects }}" required>
                            </div>
                            <div class="form-group">
                                <label for="desc_projects">Sub Title</label>
                                <input type="text" class="form-control" id="desc_project" placeholder="Enter Sub Title"
                                    name="desc_projects" value="{{ $social_media->desc_projects }}" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Social Media</h3>
                    </div>
                    <form action="{{ route('socialmedia.update', $social_media->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter Title"
                                    name="title" value="{{ $social_media->title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="subtitle">Sub Title</label>
                                <input type="text" class="form-control" id="subtitle" placeholder="Enter Sub Title"
                                    name="subtitle" value="{{ $social_media->subtitle }}" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Testimonial</h3>
                    </div>
                    <form action="{{ route('testimonials.update', $testimonials->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter Title"
                                    name="title" value="{{ $testimonials->title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="subtitle">Sub Title</label>
                                <input type="text" class="form-control" id="subtitle" placeholder="Enter Sub Title"
                                    name="subtitle" value="{{ $testimonials->subtitle }}" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Social Media</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#sosmed-modal">Add
                                New</button>
                        </div>
                        <table id="sosmed-items" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title - Icon</th>
                                    <th>Name</th>
                                    <th>Link</th>
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
                        <h3 class="card-title">Projects</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#projects-modal">Add
                                Project</button>
                        </div>
                        <table id="projects-items" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">USP</h3>
                    </div>
                    <form action="{{ route('usp.update', $usp->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="specialization">Specialization</label>
                                <textarea class="form-control" id="specialization" placeholder="Enter Specialization" name="specialization"
                                    required>{{ $usp->specialization }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea class="form-control mcetextarea" id="desc" placeholder="Enter Description" name="desc"
                                    rows="4">{{ $usp->desc }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        @component('admin.datatables.sosmed')
        @endcomponent
        @component('admin.datatables.projects')
        @endcomponent
        @component('admin.components.form-modal-sosmed')
        @endcomponent
        @component('admin.components.form-modal-projects')
        @endcomponent
    </section>
@endSection
