@extends('Layout.admin')
@section('title', 'About')

@section('content')
    <section>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">About</h3>
                    </div>
                    <form action="{{ route('about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="title">Title About</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" placeholder="Enter Title" name="title"
                                            value="{{ old('title', $about->title) }}" required>
                                        @error('title')
                                            <span class="error-message text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <img src="{{ asset('storage/' . $about->image_url) }}" width="100" alt="Image">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Change image Background ?</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('image_url') is-invalid @enderror"
                                                    id="exampleInputFile" name="image_url">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                        @error('image_url')
                                            <span class="error-message text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="vision">Vision</label>
                                        <textarea class="form-control @error('vission') is-invalid @enderror" id="vission" placeholder="Enter vision"
                                            name="vision" rows="5" required>{{ old('vision', $about->vision) }}</textarea>
                                        @error('vission')
                                            <span class="error-message text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="mission">Mision</label>
                                        <textarea class="form-control @error('mission') is-invalid @enderror" id="mission" placeholder="Enter mission"
                                            name="mission" rows="5" required>{{ old('mission', $about->mission) }}</textarea>
                                        @error('mission')
                                            <span class="error-message text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subTitle">Description About</label>
                                <textarea class="form-control mcetextarea @error('desc') is-invalid @enderror" id="subTitle" name="desc"
                                    rows="5">{{ old('desc', $about->desc) }}</textarea>
                                @error('desc')
                                    <span class="error-message text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="short_desc">Short Description About (home)</label>
                                <textarea class="form-control mcetextarea @error('short_desc') is-invalid @enderror" id="short_desc"
                                    placeholder="Enter Short Description" name="short_desc" rows="5" required>{{ old('short_desc', $about->short_desc) }}</textarea>
                                @error('short_desc')
                                    <span class="error-message text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Teams</h3>
                    </div>
                    <form action="{{ route('about.update', $about->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="team_title">Title Team</label>
                                <input type="text" class="form-control @error('team_title') is-invalid @enderror"
                                    id="team_title" placeholder="Enter Title Team" name="team_title"
                                    value="{{ old('team_title', $about->team_title) }}" required>
                                @error('team_title')
                                    <span class="error-message text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="team_desc">Short Description Team</label>
                                <textarea class="form-control @error('team_desc') is-invalid @enderror" id="team_desc"
                                    placeholder="Enter Team Description" name="team_desc" rows="5" required>{{ old('team_desc', $about->team_desc) }}</textarea>
                                @error('team_desc')
                                    <span class="error-message text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Our Team</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#team-modal">Add New
                                Team</button>
                        </div>
                        <table id="team-items" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
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
        </div>
    </section>
    @component('admin.datatables.teams')
    @endcomponent
    @component('admin.components.form-modal-team')
    @endcomponent
@endSection
