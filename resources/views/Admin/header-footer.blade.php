@extends('layout.admin')
@section('title', 'Contact')

@section('content')
    <section>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="text-center">Header</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn btn-warning" id="add-new-menu" data-toggle="modal" data-target="#menu-modal">Add
                                New
                                Menu</button>
                        </div>
                        <table id="menu-items" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Url</th>
                                    <th>Index</th>
                                    <th>Parent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="text-center">Footer</h5>
                    </div>
                    <form action="{{ route('footer.update', $footer->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="desc">Footer Desc</label>
                                                <textarea name="desc" id="desc" cols="20" rows="3" class="form-control">{{ $footer->desc }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="socmed_desc">Socmed Desc</label>
                                                <textarea name="socmed_desc" id="socmed_desc" cols="20" rows="3" class="form-control">{{ $footer->socmed_desc }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="quick_links_title">Qucik Links Title</label>
                                            <input type="text" name="quick_links_title" id="quick_links_title"
                                                class="form-control" value="{{ $footer->quick_links_title }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="other_pages_title">Other Pages Title</label>
                                            <input type="text" name="other_pages_title" id="other_pages_title"
                                                class="form-control" value="{{ $footer->other_pages_title }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="socmed_title">Socmed Title</label>
                                            <input type="text" name="socmed_title" id="socmed_title" class="form-control"
                                                value="{{ $footer->socmed_title }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <img src="{{ asset('storage/' . $footer->image_url) }}" width="100" alt="Image">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Certificate on Footer</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('image_url') is-invalid @enderror"
                                                    id="exampleInputFile" name="image_url"
                                                    accept="image/png, image/jpg, image/jpeg">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                        @error('image_url')
                                            <span class="error-message text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Update Footer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="text-center">Footer Links</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#footer-modal">Add New
                                Link</button>
                        </div>
                        <table id="footer-items" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Url</th>
                                    <th>Type</th>
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
    @component('admin.datatables.menu')
    @endcomponent
    @component('admin.datatables.footer')
    @endcomponent
    @component('admin.components.form-modal-menu')
    @endcomponent
    @component('admin.components.form-modal-footer')
    @endcomponent
@endSection

