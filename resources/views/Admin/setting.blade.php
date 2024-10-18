@extends('layout.admin')
@section('title', 'Contact')

@section('content')
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="text-center">Setting</h5>
                    </div>

                    <form action="{{ route('setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="site_name">Nama Situs</label>
                                <input type="text" name="site_name" id="site_name" class="form-control"
                                    value="{{ $setting->site_name }}" />
                                <span class="error-message text-danger">
                                    @error('site_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Form Forward</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ $setting->email }}">
                                <span class="error-message text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <img src="{{ asset('storage/' . $setting->image_url) }}" alt="image" width="100">
                                <label for="image_url">Logo</label>
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
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="text-center">Customer Support (WA)</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn btn-warning" id="add-new-cs" data-toggle="modal" data-target="#cs-modal">Add
                                New
                                CS</button>
                        </div>
                        <table id="cs-items" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Whatsapp Number</th>
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

    @component('admin.datatables.cs')
    @endcomponent
    @component('admin.components.form-modal-cs')
    @endcomponent
@endSection
