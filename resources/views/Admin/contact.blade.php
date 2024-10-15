@extends('layout.admin')
@section('title', 'Contact')

@section('content')
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="text-center">Contact Detail</h5>
                    </div>
                    <form action="{{ route('contactPage.update', $contactDetail->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Page Title</label>
                                <input type="text" name="page_title" id="page_title" class="form-control"
                                    value="{{ $contactDetail->page_title }}" />
                                <span class="error-message text-danger">
                                    @error('page_title')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ $contactDetail->name }}" />
                                <span class="error-message text-danger">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="subtitle">Subtitle</label>
                                <textarea name="subtitle" id="subtitle" class="form-control" rows="3">{{ $contactDetail->subtitle }}</textarea>
                                <span class="error-message text-danger">
                                    @error('subtitle')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <img src="{{ asset('storage/' . $contactDetail->image_url) }}" alt="image"
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
                                <button type="submit" class="btn btn-primary">Update Contact</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="text-center">Address</h5>
                    </div>
                    <form action="{{ route('contact.update', $contact->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="address_title">Address Title</label>
                                <input type="text" name="address_title" id="address_title" class="form-control"
                                    value="{{ $contact->address_title }}" />
                            </div>
                            <div class="form-group">
                                <label for="address_desc">Address</label>
                                <textarea name="address_desc" id="address_desc" cols="20" rows="3" class="form-control">{{ $contact->address_desc }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="maps_embed">Map</label>
                                <textarea name="maps_embed" id="maps_embed" cols="20" rows="3" class="form-control">{{ $contact->maps_embed }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Update Address</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="text-center">Call</h5>
                    </div>
                    <form action="{{ route('contact.update', $contact->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="call_title">Call Title</label>
                                <input type="text" name="call_title" id="call_title" class="form-control"
                                    value="{{ $contact->call_title }}" />
                            </div>
                            <div class="form-group">
                                <label for="call_desc">Number Desc</label>
                                <textarea name="call_desc" id="call_desc" cols="20" rows="3" class="form-control">{{ $contact->call_desc }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Update Call</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="text-center">Email</h5>
                    </div>
                    <form action="{{ route('contact.update', $contact->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email_title">Email Title</label>
                                <input type="text" name="email_title" id="email_title" class="form-control"
                                    value="{{ $contact->email_title }}" />
                            </div>
                            <div class="form-group">
                                <label for="email_desc">Email Desc</label>
                                <textarea name="email_desc" id="email_desc" cols="20" rows="3" class="form-control">{{ $contact->email_desc }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Update Email</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="text-center">Open Hours</h5>
                    </div>
                    <form action="{{ route('contact.update', $contact->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="open_title">Open Hours Title</label>
                                <input type="text" name="open_title" id="open_title" class="form-control"
                                    value="{{ $contact->open_title }}" />
                            </div>
                            <div class="form-group">
                                <label for="open_desc">Open Hours Desc</label>
                                <textarea name="open_desc" id="open_desc" cols="20" rows="3" class="form-control">{{ $contact->open_desc }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Update Open Hours</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endSection
