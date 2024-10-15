<script>
    $(document).ready(function() {
        $("#works-items").DataTable({
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ route('works.datatable') }}",
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
                    data: 'service_id',
                    name: 'service_id'
                },
                {
                    data: 'client_id',
                    name: 'client_id'
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

        function populateClientsAndServices(selectedClientId = '', selectedServiceId = '') {
            // Fetch clients and services data
            $.ajax({
                type: 'GET',
                url: '{{ route('clientsServices.collaboration') }}',
                success: function(data) {
                    // Populate clients
                    $('#client_data').empty().append('<option value="">Choose Client</option>');
                    $.each(data.clients, function(index, client) {
                        $('#client_data').append('<option value="' + client.id + '"' + (
                                client.id == selectedClientId ? ' selected' : '') +
                            '>' + client.name + '</option>');
                    });

                    // Populate services
                    $('#service_id').empty().append('<option value="">Choose Service</option>');
                    $.each(data.serviceItems, function(index, service) {
                        $('#service_id').append('<option value="' + service.id + '"' + (
                                service.id == selectedServiceId ? ' selected' : '') +
                            '>' + service.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error:", error);
                }
            });
        }



        $('#works-form').submit(function(e) {
            e.preventDefault();
            var workId = $('#works_id').val();
            var url = workId ? '/dashboard/edit-works/' + workId :
                '{{ route('works.store') }}';

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
                        $('#works-modal').modal('hide');

                        // Refresh the datatable
                        $("#works-items").DataTable().ajax.reload();

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

        $(document).on('click', '.editPorto', function() {
            var worksId = $(this).data('portfolio-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/works/' + worksId,
                success: function(data) {
                    $('#works-modal #works-modal-label').text('Edit Portfolio : ' + data
                        .data.title);
                    $('#works-modal #works_id').val(data.data.id);
                    $('#works-modal #title').val(data.data.title);
                    var dateValue = data.data.date.split(' ')[0]; // Extract date
                    $('#works-modal #date').val(dateValue);
                    $('#works-modal #location').val(data.data.location);
                    tinymce.activeEditor.setContent(data.data.desc);

                    populateClientsAndServices(data.data.client_id, data.data.service_id);

                    var domain = window.location.hostname;
                    var port = window.location.port;
                    var protocol = window.location.protocol;
                    var imageUrl = protocol + '//' + domain + (port ? ':' + port : '') +
                        '/storage/' + data.data.image_url;
                    $('#works-modal #image-thumbnail').attr('src', imageUrl).show();
                    // Show the modal
                    $('#works-modal').modal('show');
                }
            });
        });


        $('#works-modal').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });

        $(document).on('click', '#tombol-open-modal', function() {
            populateClientsAndServices();
            $('#works-form')[0].reset();
        });

        // When the modal is closed
        $('#works-modal').on('hidden.bs.modal', function() {
            $(this).find('#title, #date, #location, #works_id').val('');
            $(this).find('.error-message').text('');
            $(this).find('#works-modal-label').text('Add New Portfolio');
            tinymce.activeEditor.setContent('');
        });

        $(document).on('click', '.deletePorto', function() {
            var worksId = $(this).data('portfolio-id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/works/' + worksId,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#works-items').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });
    });
</script>
