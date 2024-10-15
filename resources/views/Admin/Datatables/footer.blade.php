<script>
    $(document).ready(function() {
        $("#footer-items").DataTable({
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ route('footer.datatable') }}",
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
                    data: 'link',
                    name: 'link'
                },
                {
                    data: 'type',
                    name: 'type',
                    render: function(data, type, row, meta) {
                        if (data == 0) {
                            return 'Quick Link';
                        } else {
                            return 'Other Pages';
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


        $('#footer-form').submit(function(e) {
            e.preventDefault();
            var footerId = $('#footer_id').val();
            var url = footerId ? '/dashboard/edit-footer/' + footerId :
                '{{ route('footer.store') }}';

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
                        $('#footer-modal').modal('hide');

                        // Refresh the datatable
                        $("#footer-items").DataTable().ajax.reload();

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

        $(document).on('click', '.edit-footer', function() {
            var footerId = $(this).data('footer-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/footer/' + footerId,
                success: function(data) {
                    console.log(data);
                    $('#footer-modal #footer-modal-label').text(
                        'Edit Menu Item: ' +
                        data.data.title);
                    $('#footer-modal #footer_id').val(data.data.id);
                    $('#footer-modal #title').val(data.data.title);
                    $('#footer-modal #link').val(data.data.link);
                    $('#footer-modal #type').val(data.data.type).prop('selected', true);

                    // Show the modal
                    $('#footer-modal').modal('show');
                }
            });
        });

        $('#footer-modal').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });

        // When the modal is closed
        $('#footer-modal').on('hidden.bs.modal', function() {
            $(this).find('#title, #link, #footer_id').val('');
            $('#footer-modal #type').val('').prop('selected', false);
            $(this).find('.error-message').text('');
            $(this).find('#footer-modal-label').text('Add Footer Link Item');
        });

        $(document).on('click', '.delete-footer', function() {
            var footerId = $(this).data('footer-id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/footer/' + footerId,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#footer-items').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });

    });
</script>
