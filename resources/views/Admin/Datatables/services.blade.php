<script>
    $(document).ready(function() {
        $("#services-items").DataTable({
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ route('serviceitems.datatable') }}",
            "columns": [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name',
                    name: 'name',
                    render: function(data, type, full, meta) {
                        return data + ' <img src="/storage/' + full.icon_url +
                            '" width="30" class="img-thumbnail" style="margin-left: 10px;" />';
                    }
                },
                {
                    data: 'short_desc',
                    name: 'short_desc'
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


        $('#services-form').submit(function(e) {
            e.preventDefault();
            var serviceId = $('#service_id').val();
            var url = serviceId ? '/dashboard/edit-serviceitems/' + serviceId :
                '{{ route('serviceitems.store') }}';

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
                        $('#services-modal').modal('hide');

                        // Refresh the datatable
                        $("#services-items").DataTable().ajax.reload();

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
            var serviceId = $(this).data('service-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/serviceitems/' + serviceId,
                success: function(data) {
                    console.log(data);
                    $('#services-modal #services-modal-label').text(
                        'Edit Service Item: ' +
                        data.data.name);
                    $('#services-modal #thumbnail-title').text('Change thumbnail?');
                    $('#services-modal #name').val(data.data.name);
                    $('#services-modal #service_id').val(data.data.id);
                    $('#services-modal #slug').val(data.data.slug);
                    tinymce.activeEditor.setContent(data.data.desc);
                    $('#services-modal #short_desc').val(data.data.short_desc);
                    $('#services-modal #image_url').removeAttr('required');
                    var domain = window.location.hostname;
                    var port = window.location.port;
                    var protocol = window.location.protocol;
                    var imageUrl = protocol + '//' + domain + (port ? ':' + port : '') +
                        '/storage/' + data.data.image_url;
                    $('#services-modal #image-thumbnail').attr('src', imageUrl).show();
                    var imageMiniUrl = protocol + '//' + domain + (port ? ':' + port : '') +
                        '/storage/' + data.data.icon_url;
                    $('#services-modal #icon-thumbnail').attr('src', imageMiniUrl).show();
                    // Show the modal
                    $('#services-modal').modal('show');
                }
            });
        });


        $('#services-modal').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });

        // When the modal is closed
        $('#services-modal').on('hidden.bs.modal', function() {
            $(this).find('#name, #short_desc, #desc, #image_url, #service_id, #slug, #icon_url').val('');
            $(this).find('img').attr('src', '').css('display', 'none');
            $(this).find('.custom-file-label').text('Choose file');
            $(this).find('.error-message').text('');
            $(this).find('#thumbnail-title').text('Thumbnail');
            $(this).find('#services-modal-label').text('Add Service Item');
            $(this).find('#image_url').attr('required', 'required');
            $(this).find('#icon_url').attr('required', 'required');
            tinymce.activeEditor.setContent('');
        });

        // When the "Add New Data" button is clicked
        $('.add-new-data-button').on('click', function() {
            $('#services-modal').find('#name, #short_desc, #desc, #image_url, #service_id, #slug, #icon_url', )
                .val('');
            $('#services-modal').find('img').attr('src', '').css('display', 'none');
            $('#services-modal').find('.custom-file-label').text('Choose file');
            $('#services-modal').find('#thumbnail-title').text('Thumbnail');
            $('#services-modal').find('#services-modal-label').text('Add Service Item');
            $('#services-modal').find('.error-message').text('');
            $('#services-modal').find('#image_url').attr('required', 'required');
            $('#services-modal').find('#icon_url').attr('required', 'required');
            tinymce.activeEditor.setContent('');
        });

        $(document).on('click', '.delete', function() {
            var serviceId = $(this).data('service-id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/serviceitems/' + serviceId,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#services-items').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });
    });
</script>
