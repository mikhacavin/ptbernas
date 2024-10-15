<script>
    $(document).ready(function() {
        $("#testimonial-items").DataTable({
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ route('testimoniallist.datatable') }}",
            "columns": [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        let rating = '';
                        for (let i = 0; i < data.rating; i++) {
                            rating += '⭐';
                        }
                        return data.name + ' ' + rating;
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'position',
                    name: 'position'
                },
                {
                    data: 'client_feedback_id',
                    name: 'client_feedback_id'
                },
                {
                    data: 'show',
                    render: function(data, type, row, meta) {
                        return data == 1 ? 'Show' : 'Hide';
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


        $('#testimonials-form').submit(function(e) {
            e.preventDefault();

            var testimonials_id = $('#testimonials_id').val();

            var url = testimonials_id ? '/dashboard/edit-testimoniallist/' + testimonials_id :
                '{{ route('testimoniallist.store') }}';

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
                        $('#testimonials-modal').modal('hide');

                        // Refresh the datatable
                        $("#testimonial-items").DataTable().ajax.reload();

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


        $(document).on('click', '.edit-testimonial', function() {
            var testimonialListID = $(this).data('testimonial-list-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/testimoniallist/' + testimonialListID,
                success: function(data) {
                    console.log(data);
                    $('#testimonials-form #testimonials_id').val(data.data.id);
                    populatePortfolioOptions(data.data.client_feedback_id);
                    $('#testimonials-form #rating' + data.data.rating).prop('checked',
                        true);
                    $('#testimonials-form #name').val(data.data.name);
                    $('#testimonials-form #position').val(data.data.position);
                    $('#testimonials-form #desc').val(data.data.desc);
                    $('#testimonials-form #show').prop('checked', data.data.show);
                    // Show the modal
                    $('#testimonials-modal').modal('show');
                }
            });
        });




        $('#galleries-modal-choose').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });

        $(document).on('click', '#tombol-open-modal', function() {
            populatePortfolioOptions();
        });



        // When the modal is closed
        $('#testimonials-modal').on('hidden.bs.modal', function() {
            // Reset the form fields
            $('#testimonials-form')[0].reset();
            // Reset the select2 dropdown
            $('.select2').val('').trigger('change');
            // Reset the form validation errors
            $('.error-message').text('');
            // Reset the modal content
            $('#testimonials-modal #testimonials-modal-label').text('Add Testimonials');
            $('#testimonials-modal #testimonials_id').val('');
            $('#testimonials-modal #client_feedback_form_id').val('').trigger('change');
            $('#testimonials-modal #rating input[name="rating"]').prop('checked', false);
            $('#testimonials-modal #name').val('');
            $('#testimonials-modal #position').val('');
            $('#testimonials-modal #desc').val('');
            $('#testimonials-modal #is_show').prop('checked', false);
        });





        $(document).on('click', '.delete-testimonial', function() {
            var testimonialId = $(this).data('testimonial-list-id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/testimoniallist/' + testimonialId,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#testimonial-items').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });


        // Inisialisasi Select2
        $('.select2data').select2();

        function populatePortfolioOptions(selectedPortfolioId = '') {
            $.ajax({
                type: 'GET',
                url: '/dashboard/get-feedback-form-client',
                success: function(data) {
                    // Kosongkan dropdown sebelum mengisi
                    $('.select2data').empty();
                    // Tambahkan opsi kosong
                    $('.select2data').append(new Option("Public Form", ""));

                    $.each(data, function(index, item) {
                        var selected = selectedPortfolioId && selectedPortfolioId == item
                            .id ? ' selected' : '';
                        $('.select2data').append(new Option(item.title + ' - ' + item
                            .clients.name, item.id, selected, selected));
                    });

                    // Refresh Select2
                    $('.select2data').select2();
                },
                error: function() {
                    console.error('Gagal mengambil data');
                }
            });
        }

    });
</script>
