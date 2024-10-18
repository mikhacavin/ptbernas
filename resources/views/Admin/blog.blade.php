@extends('layout.admin')
@section('title', 'Blog / Articles')

@section('content')
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h5 class="text-center">Blog</h5>
                    </div>
                    <form action="{{ route('blogpage.update', $blogPage->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ $blogPage->title }}" />
                                <span class="error-message text-danger">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="subtitle">Subtitle</label>
                                <textarea name="subtitle" id="subtitle" class="form-control" rows="3">{{ $blogPage->subtitle }}</textarea>
                                <span class="error-message text-danger">
                                    @error('subtitle')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <img src="{{ asset('storage/' . $blogPage->image_url) }}" alt="image" width="100">
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
                                <button type="submit" class="btn btn-primary">Update Blog</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Categories</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#category-modal">Add New
                                Category</button>
                        </div>
                        <table id="category-items" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category Name</th>
                                    <th>Slug / URL</th>
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
                        <h3 class="card-title">All Blog Posts</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn btn-warning" id="add-blog" data-toggle="modal" data-target="#blog-modal">Add
                                New
                                Article</button>
                        </div>
                        <table id="blog-items" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Image Thumbnail</th>
                                    <th>Category</th>
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
            <script>
                const titleSlug = document.querySelector('.categorySlug');
                const resultSlug = document.querySelector('.resultSlug');
                const dbCategory = 'category';
                console.log(dbCategory);


                titleSlug.addEventListener('change', function() {
                    fetch('/dashboard/slug/slugMaker?title=' + titleSlug.value + '&db=' + dbCategory)
                        .then(response => response.json())
                        .then(data => resultSlug.value = data.slug)
                });
            </script>
        @endpush
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
    @component('admin.datatables.blog')
    @endcomponent
    @component('admin.components.form-modal-blog')
    @endcomponent
    @component('admin.datatables.category')
    @endcomponent
    @component('admin.components.form-modal-category')
    @endcomponent
    @component('admin.components.slug', ['db' => 'blogPosts'])
    @endcomponent
@endSection
