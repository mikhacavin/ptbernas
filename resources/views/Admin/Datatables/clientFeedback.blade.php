<script>
    $(document).ready(function() {
        $("#client-feedback-items").DataTable({
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ route('clientfeedback.datatable') }}",
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
                    data: 'client_id',
                    name: 'client_id'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'active',
                    render: function(data, type, row, meta) {
                        return data == 1 ? 'Active' : 'Nonactive';
                    }
                },
                {
                    data: 'slug',
                    render: function(data, type, row, meta) {
                        var domain = window.location.hostname;
                        var port = window.location.port;
                        var protocol = window.location.protocol;
                        var url = protocol + '//' + domain + (port ? ':' + port : '') +
                            '/feedback/' + data;
                        return "<a href=\"" + url + "\" target=\"_blank\">" + url + "</a>";
                    }
                },
                {
                    data: 'slug',
                    render: function(data, type, row, meta) {
                        var qrId = 'qr-code-' + row.slug;
                        return `<div id="${qrId}" class="qr-code-container"></div>`; // Return a placeholder div
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            "drawCallback": function(settings) {
                generateQRCodes(); // Call function to generate QR codes after each draw
            }

        });


        $.ajaxSetup({
            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#client-feedback-form').submit(function(e) {
            e.preventDefault();
            var testimonialsId = $('#client_feedback_id').val();
            var url = testimonialsId ? '/dashboard/edit-clientfeedback/' + testimonialsId :
                '{{ route('clientfeedback.store') }}';

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
                        $('#client-feedback-modal').modal('hide');

                        // Refresh the datatable
                        $("#client-feedback-items").DataTable().ajax.reload();

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


        $(document).on('click', '.edit', function() {
            var feedback = $(this).data('client-feedback-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/clientfeedback/' + feedback,
                success: function(data) {
                    $('#client-feedback-form #client_feedback_id').val(data.data.id);
                    $('#client-feedback-form #title').val(data.data.title);
                    $('#client-feedback-form #slug').val(data.data.slug);
                    populatePortfolioOptions(data.data.client_id);
                    $('#client-feedback-form #customSwitch1').prop('checked', data.data
                        .active);

                    // Show the modal
                    $('#client-feedback-modal').modal('show');
                }
            });
        });




        $('#client-feedback-modal').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });

        $(document).on('click', '#tombol-open-modal-client', function() {
            populatePortfolioOptions();
        });



        // When the modal is closed
        $('#client-feedback-modal').on('hidden.bs.modal', function() {
            // Reset the form fields to initial value
            $('#client-feedback-form')[0].reset();
            $('#client-feedback-form #client_feedback_id').val('');
            $('#client-feedback-form #title').val('');
            $('#client-feedback-form #slug').val('');
            $('#client-feedback-form #customSwitch1').prop('checked', false);
            populatePortfolioOptions();
            $('#client-feedback-form .error-message').text('');
        });





        $(document).on('click', '.delete', function() {
            var feedbackId = $(this).data('client-feedback-id');
            console.log(feedbackId);
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/clientfeedback/' + feedbackId,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#client-feedback-items').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });


        // Inisialisasi Select2
        $('.select2').select2();


        function populatePortfolioOptions(selectedPortfolioId = '') {
            $.ajax({
                type: 'GET',
                url: '/dashboard/get-clients',
                success: function(data) {
                    // Kosongkan dropdown sebelum mengisi
                    $('.select2').empty();
                    // Tambahkan opsi kosong
                    $('.select2').append(new Option("Select Client", ""));

                    $.each(data, function(index, item) {
                        var selected = selectedPortfolioId && selectedPortfolioId ==
                            item
                            .id ? ' selected' : '';
                        $('.select2').append(new Option(item.name, item.id, selected,
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

        // Separate function to generate QR codes
        function generateQRCodes() {
            $('#client-feedback-items .qr-code-container').each(function() {
                var qrId = $(this).attr('id'); // Get the id of the QR code container
                var slug = qrId.replace('qr-code-', ''); // Extract the slug from the id
                var domain = window.location.hostname;
                var port = window.location.port;
                var protocol = window.location.protocol;
                var url = protocol + '//' + domain + (port ? ':' + port : '') + '/feedback/' + slug;



                var imageUrl = protocol + '//' + domain + (port ? ':' + port : '') +
                    '/assets/img/logo.png';

                var qrCode = new QRCodeStyling({
                    width: 100,
                    height: 100,
                    type: "svg",
                    data: url,
                    image: imageUrl,
                    dotsOptions: {
                        color: "#000",
                        type: "rounded"
                    },
                    backgroundOptions: {
                        color: "#fff"
                    },
                    imageOptions: {
                        crossOrigin: "anonymous",
                        margin: 1
                    }
                });

                // Append the QR code to the container
                qrCode.append(document.getElementById(qrId));

                // Add click event to download the QR code on click, with a confirmation step
                // Add click event to download the QR code on click, with a confirmation step
                $(`#${qrId}`).on('click', function() {
                    var confirmDownload = confirm("Do you want to download this QR code?");
                    if (confirmDownload) {
                        // Temporarily set the QR code size to 400x400 for download
                        qrCode.update({
                            width: 400,
                            height: 400
                        });

                        // Download the QR code
                        qrCode.download({
                            name: "qr-" + slug,
                            extension: "png"
                        });

                        // Reset the QR code size back to the original display size (100x100)
                        qrCode.update({
                            width: 100,
                            height: 100
                        });
                    } else {
                        // Do nothing if the user cancels
                        console.log("Download canceled by the user.");
                    }
                });
            });
        }

    });
</script>
