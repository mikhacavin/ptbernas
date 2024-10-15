<script>
    $(document).ready(function() {
        $("#category-items").DataTable({
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ route('category.datatable') }}",
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
                    data: 'slug',
                    render: function(data, type, row, meta) {
                        var domain = window.location.hostname;
                        var port = window.location.port;
                        var protocol = window.location.protocol;
                        var url = protocol + '//' + domain + (port ? ':' + port : '') +
                            '/blog?category=' + data;
                        return "<a href=\"" + url + "\" target=\"_blank\">" + url + "</a>";
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


        $('#category-form').submit(function(e) {
            e.preventDefault();
            var categoryId = $('#categories_id').val();
            var url = categoryId ? '/dashboard/edit-category/' + categoryId :
                '{{ route('category.store') }}';
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
                        $('#category-modal').modal('hide');

                        // Refresh the datatable
                        $("#category-items").DataTable().ajax.reload();

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

        $(document).on('click', '.edit-category', function() {
            var categoryId = $(this).data('category-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/category/' + categoryId,
                success: function(data) {
                    console.log(data);
                    $('#category-modal #category-modal-label').text(
                        'Edit Category : ' +
                        data.data.name);
                    $('#category-modal #name').val(data.data.name);
                    $('#category-modal #slug').val(data.data.slug);
                    $('#category-modal #categories_id').val(data.data.id);

                    // Show the modal
                    $('#category-modal').modal('show');
                }
            });
        });


        $('#category-modal').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });

        // When the modal is closed
        $('#category-modal').on('hidden.bs.modal', function() {
            $(this).find('#name, #slug, #categories_id').val('');
            $('.error-message').text('');
            $(this).find('#category-modal-label').text('Add Category');
        });


        $(document).on('click', '.delete-category', function() {
            var categoryId = $(this).data('category-id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/category/' + categoryId,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#category-items').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });



    });
</script>
