<script>
    $(document).ready(function() {
        $("#cs-items").DataTable({
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ route('cs.datatable') }}",
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
                    data: 'phone',
                    name: 'phone'
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


        $('#cs-form').submit(function(e) {
            e.preventDefault();
            var csId = $('#cs_id').val();
            var url = csId ? '/dashboard/edit-cs/' + csId :
                '{{ route('cs.store') }}';

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
                        $('#cs-modal').modal('hide');

                        // Refresh the datatable
                        $("#cs-items").DataTable().ajax.reload();

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

        $(document).on('click', '.edit-customer-support', function() {
            var csId = $(this).data('customer-support-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/cs/' + csId,
                success: function(data) {
                    console.log(data);
                    $('#cs-modal #cs-modal-label').text(
                        'Edit Customer Support Item: ' +
                        data.data.name);
                    $('#cs-modal #name').val(data.data.name);
                    $('#cs-modal #cs_id').val(data.data.id);
                    $('#cs-modal #phone').val(data.data.phone);
                    var domain = window.location.hostname;
                    var port = window.location.port;
                    var protocol = window.location.protocol;
                    var imageUrl = protocol + '//' + domain + (port ? ':' + port : '') +
                        '/storage/' + data.data.image_url;
                    $('#cs-modal #image-thumbnail').attr('src', imageUrl).show();
                    // Show the modal
                    $('#cs-modal').modal('show');
                }
            });
        });
        $('#cs-modal').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });

        // When the modal is closed
        $('#cs-modal').on('hidden.bs.modal', function() {
            $(this).find('#name, #phone, #cs_id').val('');
            $(this).find('.error-message').text('');
            $(this).find('img').attr('src', '').css('display', 'none');
            $(this).find('#cs-modal-label').text('Add Customer Support');
        });

        $(document).on('click', '.delete-customer-support', function() {
            var csId = $(this).data('customer-support-id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/cs/' + csId,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#cs-items').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });

    });
</script>
