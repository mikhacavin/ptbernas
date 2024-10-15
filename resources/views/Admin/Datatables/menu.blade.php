<script>
    $(document).ready(function() {
        $("#menu-items").DataTable({
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ route('menu.datatable') }}",
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
                    data: 'url',
                    name: 'url'
                },
                {
                    data: 'index',
                    name: 'index'
                },
                {
                    data: 'parent',
                    name: 'parent'
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


        $('#menu-form').submit(function(e) {
            e.preventDefault();
            var menuId = $('#menu_id').val();
            var url = menuId ? '/dashboard/edit-menu/' + menuId :
                '{{ route('menu.store') }}';

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
                        $('#menu-modal').modal('hide');

                        // Refresh the datatable
                        $("#menu-items").DataTable().ajax.reload();

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
            var menuId = $(this).data('menu-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/menu/' + menuId,
                success: function(data) {
                    console.log(data);
                    $('#menu-modal #menu-modal-label').text(
                        'Edit Menu Item: ' +
                        data.data.name);
                    $('#menu-modal #name').val(data.data.name);
                    $('#menu-modal #menu_id').val(data.data.id);
                    $('#menu-modal #url').val(data.data.url);
                    populatePortfolioOptions(data.data.index, data.data.parent);
                    // Show the modal
                    $('#menu-modal').modal('show');
                }
            });
        });

        $('#menu-modal').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });

        // When the modal is closed
        $('#menu-modal').on('hidden.bs.modal', function() {
            $(this).find('#name, #url, #menu_id, #index, #parent').val('');
            $(this).find('.error-message').text('');
            $(this).find('#menu-modal-label').text('Add Menu Item');
        });

        $('#add-new-menu').on('click', function() {
            populatePortfolioOptions();
        })



        $(document).on('click', '.delete', function() {
            var menuId = $(this).data('menu-id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/menu/' + menuId,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#menu-items').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });

        // Inisialisasi Select2
        $('.select2').select2();


        function populatePortfolioOptions(selectedIndex = '', selectedParent = '') {
            $.ajax({
                type: 'GET',
                url: '/dashboard/get-menu',
                success: function(data) {
                    console.log('data', data);
                    $('#index').empty();
                    $('#parent').empty().append(new Option("(EMPTY)", ""));

                    if (selectedIndex == 0) {

                        if (data.index == 0) {
                            $('#index').append(new Option(1, 1, true, true));
                        } else {
                            for (var i = 0; i < data.index; i++) {
                                var selected = i == selectedIndex ? ' selected' : '';
                                $('#index').append(new Option(i + 1, i + 1, selected, selected));
                            }
                        }
                    } else {
                        for (var i = 1; i <= data.index; i++) {
                            var selected = selectedIndex && selectedIndex == i ? ' selected' : '';
                            $('#index').append(new Option(i , i , selected, selected));
                        }
                    }

                    $.each(data.navbar, function(index, item) {
                        var selected = selectedParent && item.id == parseInt(selectedParent) ?
                            ' selected' : '';
                        $('#parent').append(new Option(item.name, item.id, selected,
                            selected));
                    });

                    // Refresh Select2
                    $('.select2').select2();
                },
                error: function() {
                    console.error('Gagal mengambil data');
                }
            });
        }
    });
</script>
