<script>
    $(document).ready(function() {
        $("#projects-items").DataTable({
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ route('projects.datatable') }}",
            "columns": [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'desc',
                    name: 'desc',

                },
                {
                    data: 'number',
                    name: 'number'
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


        $('#projects-form').submit(function(e) {
            e.preventDefault();
            var projectId = $('#projects_id').val();
            var url = projectId ? '/dashboard/edit-projects/' + projectId :
                '{{ route('projects.store') }}';

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
                        $('#projects-modal').modal('hide');

                        // Refresh the datatable
                        $("#projects-items").DataTable().ajax.reload();

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

        $(document).on('click', '.edit-projects', function() {
            var projectsId = $(this).data('project-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/projects/' + projectsId,
                success: function(data) {
                    console.log(data);
                    $('#projects-modal #projects-modal-label').text(
                        'Edit Project Item: ' +
                        data.data.desc);
                    $('#projects-modal #projects_id').val(data.data.id);
                    $('#projects-modal #desc').val(data.data.desc);
                    $('#projects-modal #number').val(data.data.number);
                    $('#projects-modal').modal('show');
                }
            });
        });


        $('#projects-modal').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });

        // When the modal is closed
        $('#projects-modal').on('hidden.bs.modal', function() {
            $(this).find('#desc, #number, #projects_id').val('');
            $(this).find('#projects-modal-label').text('Add Projects Item');

        });

        $(document).on('click', '.delete-projects', function() {
            var projectId = $(this).data('project-id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/projects/' + projectId,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#projects-items').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });
    });
</script>
