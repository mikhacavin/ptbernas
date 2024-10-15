<script>
    $(document).ready(function() {
        $("#certification-items").DataTable({
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ route('certification.datatable') }}",
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


        $('#certification-form').submit(function(e) {
            e.preventDefault();

            var certificationId = $('#certification_id').val();


            var url = certificationId ? '/dashboard/edit-certification/' + certificationId :
                '{{ route('certification.store') }}';

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
                        $('#certification-modal').modal('hide');

                        // Refresh the datatable
                        $("#certification-items").DataTable().ajax.reload();

                        // Reset the form
                        $(this).trigger("reset");
                    }
                },
                error: function(xhr, status, error) {
                    // Tangani kesalahan
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('[name="' + key + '"]').closest('.form-group')
                                .find('.error-message').text(value[0]);
                        });
                    } else {
                        // Tampilkan pesan kesalahan umum
                        alert('An unexpected error occurred. Please try again.');
                    }
                }
            });
        });


        $(document).on('click', '.edit-certification', function() {
            var certificationId = $(this).data('certification-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/certification/' + certificationId,
                success: function(data) {
                    console.log(data);
                    $('#certification-modal #certification_id').val(data.data.id);
                    $('#certification-modal #certification-modal-label').text(
                        'Edit Certification : ' +
                        data.data.title);
                    $('#certification-modal #title').val(data.data.title);
                    $('#certification-modal #image_url').val('');
                    $('#certification-modal #image_url').siblings('.custom-file-label')
                        .text('Choose file');
                    $('#certification-modal #thumbnail-title').text('Change Image?');
                    $('#certification-modal #image_url').prop('required', false);
                    var domain = window.location.hostname;
                    var port = window.location.port;
                    var protocol = window.location.protocol;
                    var imageUrl = protocol + '//' + domain + (port ? ':' + port : '') +
                        '/storage/' + data.data.image_url;
                    $('#certification-modal #image-preview').attr('src', imageUrl).show();
                    // Show the modal
                    $('#certification-modal').modal('show');
                }
            });
        });



        $('#certification-modal').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });

        // When the modal is closed
        $('#certification-modal').on('hidden.bs.modal', function() {
            // Reset the form fields
            $('#certification-form')[0].reset();
            // Reset the form validation errors
            $('.error-message').text('');
            // Reset the modal content
            $('#certification-modal #certification-modal-label').text('Add Certification');
            $('#certification-modal #title').val('');
            $('#certification-modal #certification_id').val('');
            $('#certification-modal #image_url').val('');
            $('#certification-modal #image_url').siblings('.custom-file-label').text('Choose file');
            $('#certification-modal #thumbnail-title').text('Image');
            $('#certification-modal #image_url').prop('required', true);
            $('#certification-modal #image-preview').val('').hide();
        });





        $(document).on('click', '.delete-certification', function() {
            var certificationId = $(this).data('certification-id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/certification/' + certificationId,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#certification-items').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });

    });
</script>
