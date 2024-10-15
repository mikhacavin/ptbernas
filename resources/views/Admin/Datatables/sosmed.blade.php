<script>
    $(document).ready(function() {
        $("#sosmed-items").DataTable({
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ route('socialmedialist.datatable') }}",
            "columns": [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'title',
                    name: 'title',
                    // data: null,
                    // name: 'title',
                    // render: function(data, type, row, meta) {
                    //     return `${row.title} <i class="bi ${row.icon}"></i>`;
                    // }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'url',
                    name: 'url',
                    "render": function(data, type, row, meta) {
                        if (data.length > 15) {
                            return data.substring(0, 15) + '...';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'image_url',
                    name: 'image_url',
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


        $('#sosmed-form').submit(function(e) {
            e.preventDefault();
            var serviceId = $('#sosmed_id').val();
            var url = serviceId ? '/dashboard/edit-socialmedialist/' + serviceId :
                '{{ route('socialmedialist.store') }}';

            var formData = new FormData(this);
            console.log(formData);

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
                        $('#sosmed-modal').modal('hide');

                        // Refresh the datatable
                        $("#sosmed-items").DataTable().ajax.reload();

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
            var sosmedId = $(this).data('sosmed-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/socialmedialist/' + sosmedId,
                success: function(data) {
                    console.log(data);
                    $('#sosmed-modal #sosmed-modal-label').text(
                        'Edit Social Media Item: ' +
                        data.data.name);
                    $('#sosmed-modal #title').val(data.data.title);
                    $('#sosmed-modal #name').val(data.data.name);
                    $('#sosmed-modal #icon').val(data.data.icon);
                    $('#sosmed-modal #url').val(data.data.url);
                    $('#sosmed-modal #sosmed_id').val(data.data.id);
                    $('#sosmed-modal #image_url').removeAttr('required');
                    var domain = window.location.hostname;
                    var port = window.location.port;
                    var protocol = window.location.protocol;
                    var imageUrl = protocol + '//' + domain + (port ? ':' + port : '') +
                        '/storage/' + data.data.image_url;
                    $('#sosmed-modal #image-thumbnail').attr('src', imageUrl).show();
                    $('#thumbnail-title').text('Change Image?');
                    // Show the modal
                    $('#sosmed-modal').modal('show');
                }
            });
        });


        $('#sosmed-modal').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });

        // When the modal is closed
        $('#sosmed-modal').on('hidden.bs.modal', function() {
            $(this).find('#title, #name,#icon, #url, #sosmed_id').val('');
            $(this).find('img').attr('src', '').css('display', 'none');
            $(this).find('.custom-file-label').text('Choose file');
            $(this).find('.error-message').text('');
            $(this).find('#thumbnail-title').text('Thumbnail');
            $(this).find('#sosmed-modal-label').text('Add Social Media Item');
            $(this).find('#image_url').attr('required', 'required');
            $(this).find('#image_url').val('');

        });

        $(document).on('click', '.delete', function() {
            var sosmedId = $(this).data('sosmed-id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/socialmedialist/' + sosmedId,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#sosmed-items').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });
    });
</script>
