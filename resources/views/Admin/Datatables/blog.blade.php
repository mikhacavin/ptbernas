<script>
    $(document).ready(function() {
        $("#blog-items").DataTable({
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ route('blog.datatable') }}",
            "columns": [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'slug',
                    render: function(data, type, row, meta) {
                        var domain = window.location.hostname;
                        var port = window.location.port;
                        var protocol = window.location.protocol;
                        var url = protocol + '//' + domain + (port ? ':' + port : '') +
                            '/blog/' + data;
                        return "<a href=\"" + url + "\" target=\"_blank\">" + url + "</a>";
                    }
                },
                {
                    data: 'thumbnail',
                    render: function(data, type, full, meta) {
                        if (data !== null && data !== '') {
                            return "<img src=\"/storage/" + data +
                                "\" width=\"80\"/ class=\"img-thumbnail\"/  >";
                        } else {
                            return "<img src=\"/storage/assets-public/noImage.png\" width=\"80\"/ class=\"img-thumbnail\"/   >";
                        }
                    }
                },
                {
                    data: 'category_id',
                    render: function(data, type, row, meta) {
                        return row.category ? row.category.name : '';
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],

        });


        $.ajaxSetup({
            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#blog-form').submit(function(e) {
            e.preventDefault();
            var blogId = $('#blog_id').val();
            var url = blogId ? '/dashboard/edit-blog/' + blogId :
                '{{ route('blog.store') }}';
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.success) {
                        // Hide the modal
                        $('#blog-modal').modal('hide');

                        // Refresh the datatable
                        $("#blog-items").DataTable().ajax.reload();

                        // Reset the form
                        $(this).trigger("reset");
                    }
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('[name="' + key + '"]').closest('.form-group').find(
                            '.error-message').text(value[0]);
                    });
                }
            });
        });

        $(document).on('click', '.edit', function() {
            var blogId = $(this).data('blogpost-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/blog/' + blogId,
                success: function(data) {
                    console.log(data);
                    $('#blog-modal #blog-modal-label').text(
                        'Edit Post : ' +
                        data.data.title);
                    $('#blog-modal #thumbnail-title').text('Change thumbnail?');
                    $('#blog-modal #title').val(data.data.title);
                    $('#blog-modal #slug').val(data.data.slug);
                    populatePortfolioOptions(data.data.category_id);
                    tinymce.activeEditor.setContent(data.data.desc);
                    $('#blog-modal #blog_id').val(data.data.id);

                    var domain = window.location.hostname;
                    var port = window.location.port;
                    var protocol = window.location.protocol;
                    var imageUrl = protocol + '//' + domain + (port ? ':' + port : '') +
                        '/storage/' + data.data.thumbnail;
                    $('#blog-modal #image-thumbnail').attr('src', imageUrl).show();
                    $('#blog-modal #thumbnail').removeAttr('required');

                    // Show the modal
                    $('#blog-modal').modal('show');
                }
            });
        });

        $('#blog-modal').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });

        // When the modal is closed
        $('#blog-modal').on('hidden.bs.modal', function() {
            $(this).find('#title, #slug, #thumbnail, #blog_id').val('');
            $(this).find('img').attr('src', '').css('display', 'none');
            $(this).find('.custom-file-label').text('Choose file');
            $(this).find('.error-message').text('');
            $(this).find('#thumbnail-title').text('Thumbnail');
            $(this).find('#blog-modal-label').text('Add Blog Post');
            $(this).find('#thumbnail').attr('required', 'required');
            tinymce.activeEditor.setContent('');
            populatePortfolioOptions();
        });


        // When the "Add New Data" button is clicked
        $('#add-blog').on('click', function() {
            tinymce.activeEditor.setContent('');
            populatePortfolioOptions();
        });

        $(document).on('click', '.delete', function() {
            var blogId = $(this).data('blogpost-id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/blog/' + blogId,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#blog-items').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });



        // Inisialisasi Select2
        $('.select2').select2();

        function populatePortfolioOptions(selectedPortfolioId = '') {
            $.ajax({
                type: 'GET',
                url: '/dashboard/get-category',
                success: function(data) {
                    // Kosongkan dropdown sebelum mengisi
                    $('.select2').empty();
                    // Tambahkan opsi kosong
                    $('.select2').append(new Option("Select Category", ""));

                    $.each(data, function(index, item) {
                        var selected = selectedPortfolioId && selectedPortfolioId ==
                            item
                            .id ? ' selected' : '';
                        $('.select2').append(new Option(item.name, item.id, selected,
                            selected));
                    });

                    // Refresh Select2
                    $('.select2').select2();
                },
                error: function() {
                    console.error('Gagal mengambil data');
                }
            });
        }


    });
</script>
