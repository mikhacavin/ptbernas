<script>
    $(document).ready(function() {
        $("#team-items").DataTable({
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ route('teams.datatable') }}",
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


        $('#team-form').submit(function(e) {
            e.preventDefault();
            var teamsId = $('#team_id').val();
            var url = teamsId ? '/dashboard/edit-teams/' + teamsId :
                '{{ route('teams.store') }}';

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
                        $('#team-modal').modal('hide');

                        // Refresh the datatable
                        $("#team-items").DataTable().ajax.reload();

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
            var teamId = $(this).data('team-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/teams/' + teamId,
                success: function(data) {
                    console.log(data);
                    $('#team-modal #team-modal-label').text(
                        'Edit Detail  : ' +
                        data.data.name);
                    $('#team-modal #thumbnail-title').text('Change Image?');
                    $('#team-modal #name').val(data.data.name);
                    $('#team-modal #title').val(data.data.title);
                    $('#team-modal #index').val(data.data.index);
                    $('#team-modal #twitter_link').val(data.data.twitter);
                    $('#team-modal #ig_link').val(data.data.ig);
                    $('#team-modal #fb_link').val(data.data.fb);
                    $('#team-modal #linkedin_link').val(data.data.linkedin);
                    $('#team-modal #team_id').val(data.data.id);
                    $('#team-modal #image_url').removeAttr('required');
                    var domain = window.location.hostname;
                    var port = window.location.port;
                    var protocol = window.location.protocol;
                    var imageUrl = protocol + '//' + domain + (port ? ':' + port : '') +
                        '/storage/' + data.data.image_url;
                    $('#team-modal #image-thumbnail').attr('src', imageUrl).show();
                    // Show the modal
                    $('#team-modal').modal('show');
                }
            });
        });


        $('#team-modal').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });

        // When the modal is closed
        $('#team-modal').on('hidden.bs.modal', function() {
            $(this).find('#name, #title, #index, #image_url, #team_id, #ig_link, #fb_link, #twitter_link, #linkedin_link').val('');
            $(this).find('img').attr('src', '').css('display', 'none');
            $(this).find('.custom-file-label').text('Choose file');
            $(this).find('.error-message').text('');
            $(this).find('#thumbnail-title').text('Image');
            $(this).find('#team-modal-label').text('Add Team Item');
            $(this).find('#image_url').attr('required', 'required');
        });

        // When the "Add New Data" button is clicked
        $('.add-new-data-button').on('click', function() {
            $('#team-modal').find('#name, #title, #index, #image_url, #team_id')
                .val('');
            $('#team-modal').find('img').attr('src', '').css('display', 'none');
            $('#team-modal').find('.custom-file-label').text('Choose file');
            $('#team-modal').find('#thumbnail-title').text('Image');
            $('#team-modal').find('#team-modal-label').text('Add Team Item');
            $('#team-modal').find('.error-message').text('');
            $('#team-modal').find('#image_url').attr('required', 'required');
        });

        $(document).on('click', '.delete', function() {
            var serviceId = $(this).data('team-id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/teams/' + serviceId,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#team-items').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });
    });
</script>
