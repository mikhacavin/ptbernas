<script>
    $(document).ready(function() {
        $("#client-items").DataTable({
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ route('client.datatable') }}",
            "columns": [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name',
                    name: 'name'
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


        $('#client-form').submit(function(e) {
            e.preventDefault();
            var clientId = $('#client_id').val();
            var url = clientId ? '/dashboard/edit-client/' + clientId :
                '{{ route('client.store') }}';

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
                        $('#client-modal').modal('hide');

                        // Refresh the datatable
                        $("#client-items").DataTable().ajax.reload();

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
            var serviceId = $(this).data('client-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/client/' + serviceId,
                success: function(data) {
                    console.log(data);
                    $('#client-modal #client-modal-label').text(
                        'Edit Client: ' +
                        data.data.name);
                    $('#client-modal #thumbnail-title').text('Change Image?');
                    $('#client-modal #name').val(data.data.name);
                    $('#client-modal #client_id').val(data.data.id);
                    $('#client-modal #image_url').removeAttr('required');
                    var domain = window.location.hostname;
                    var port = window.location.port;
                    var protocol = window.location.protocol;
                    var imageUrl = protocol + '//' + domain + (port ? ':' + port : '') +
                        '/storage/' + data.data.image_url;
                    $('#client-modal #image-thumbnail').attr('src', imageUrl).show();
                    // Show the modal
                    $('#client-modal').modal('show');
                }
            });
        });


        $('#client-modal').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });

        // When the modal is closed
        $('#client-modal').on('hidden.bs.modal', function() {
            $(this).find('#name, #image_url, #client_id').val('');
            $(this).find('img').attr('src', '').css('display', 'none');
            $(this).find('.custom-file-label').text('Choose file');
            $(this).find('.error-message').text('');
            $(this).find('#thumbnail-title').text('Image');
            $(this).find('#client-modal-label').text('Add New Client');
            $(this).find('#image_url').attr('required', 'required');
        });

        // When the "Add New Data" button is clicked
        $('.add-new-data-button').on('click', function() {
            $('#client-modal').find('#name, #image_url, #client_id')
                .val('');
            $('#client-modal').find('img').attr('src', '').css('display', 'none');
            $('#client-modal').find('.custom-file-label').text('Choose file');
            $('#client-modal').find('#thumbnail-title').text('Thumbnail');
            $('#client-modal').find('#client-modal-label').text('Add New Client');
            $('#client-modal').find('.error-message').text('');
            $('#client-modal').find('#image_url').attr('required', 'required');
        });

        $(document).on('click', '.delete', function() {
            var serviceId = $(this).data('client-id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/client/' + serviceId,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#client-items').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });
    });
</script>
