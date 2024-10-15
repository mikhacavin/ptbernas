<script>
    $(document).ready(function() {
        $("#galleries-items").DataTable({
            "ordering": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ route('galleries.datatable') }}",
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
                    data: 'clients',
                    name: 'clients'
                },
                {
                    data: 'portfolio_id',
                    name: 'portfolio_id'
                },
                {
                    data: 'file_url',
                    name: 'file_url',
                    render: function(data, type, full, meta) {
                        if (data.match(/\.(jpeg|jpg|gif|png)$/) != null) {
                            return "<img src=\"/storage/" + data +
                                "\" width=\"80\"/ class=\"img-thumbnail\"/  >";

                        } else {
                            // Decode HTML entities
                            const decodedData = data
                                .replace(/&lt;/g, '<')
                                .replace(/&gt;/g, '>')
                                .replace(/&quot;/g, '"')
                                .replace(/&amp;/g, '&'); // Jika ada entitas &

                            // Regex untuk mendapatkan src
                            const regex = /src=["']([^"']+)["']/;
                            const match = decodedData.match(regex);

                            // Ambil nilai src dari hasil regex
                            const src = match ? match[1] : '';


                            return '<a href="#" onclick="var win = window.open(\'' + src +
                                '\', \'_blank\', \'width=800,height=600,menubar=no,toolbar=no,location=no,status=no,scrollbars=yes,resizable=yes\'); win.focus(); return false;">Video</a>';
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


        $('#galleries-form').submit(function(e) {
            e.preventDefault();

            var activityId = $('#activity-id').val();
            if (!activityId) {
                // Get the number of image files selected
                var imageCount = $('#exampleInputFile')[0].files.length;

                // Get the number of embed video inputs with values
                var embedVideoCount = $('#embed-video-container input[name="embed_video[]"]').filter(
                    function() {
                        return $(this).val() !== '';
                    }).length;

                // Check if at least one image or embed video is provided
                if (imageCount === 0 && embedVideoCount === 0) {
                    alert('Please upload at least one image or provide an embed video URL.');
                    return; // Stop form submission
                }
            }

            var url = activityId ? '/dashboard/edit-galleries/' + activityId :
                '{{ route('galleries.store') }}';

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
                        $('#galleries-modal-choose').modal('hide');

                        // Refresh the datatable
                        $("#galleries-items").DataTable().ajax.reload();

                        // Reset the form
                        $(this).trigger("reset");
                    }
                },
                error: function(xhr, status, error) {
                    // Tangani kesalahan
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            if (key.indexOf('images') !== -1) {
                                var imageIndex = key.split('.')[1];
                                $('#exampleInputFile').closest('.form-group').find(
                                    '.error-message').text(value[0]);
                            } else {
                                $('[name="' + key + '"]').closest('.form-group')
                                    .find('.error-message').text(value[0]);
                            }
                        });
                    } else {
                        // Tampilkan pesan kesalahan umum
                        alert('An unexpected error occurred. Please try again.');
                    }
                }
            });
        });


        $(document).on('click', '.edit', function() {
            var activityId = $(this).data('activity-id');
            $.ajax({
                type: 'GET',
                url: '/dashboard/galleries/' + activityId,
                success: function(data) {
                    console.log(data);
                    $('#galleries-modal-choose #activity-id').val(data.data.id);
                    $('#galleries-modal-choose #galleries-modal-label').text(
                        'Edit Data : ' +
                        data.data.title);
                    $('#galleries-modal-choose #title').val(data.data.title);
                    if (data.data.file_url.match(/\.(jpeg|jpg|gif|png)$/) !== null) {
                        $('#galleries-modal-choose #youtube-embed').hide().prop('required',
                            false).prop('disabled', true);
                        $('#galleries-modal-choose #add-embed-video').hide();
                        $('#galleries-modal-choose #embed-label').hide();
                        $('#galleries-modal-choose #image-label').show().text(
                            'Change Image?');
                        $('#galleries-modal-choose #exampleInputFile').show().prop(
                            'multiple', false).attr('name', 'images').prop('disabled',
                            false);
                        var domain = window.location.hostname;
                        var port = window.location.port;
                        var protocol = window.location.protocol;
                        var imageUrl = protocol + '//' + domain + (port ? ':' + port : '') +
                            '/storage/' + data.data.file_url;
                        $('#galleries-modal-choose #image-preview-upload').html(
                            '<img src="' + imageUrl +
                            '" class="img-thumbnail" alt="Image Preview" />');
                        $('#galleries-modal-choose #image-preview').show();
                    } else {
                        $('#galleries-modal-choose #youtube-embed').show().prop('required',
                            true).prop('disabled', false);
                        $('#galleries-modal-choose #add-embed-video').hide();
                        $('#galleries-modal-choose #image-label').hide();
                        $('#galleries-modal-choose #youtube-embed').val(data.data.file_url);
                        $('#galleries-modal-choose #exampleInputFile').hide().prop(
                            'multiple', false).attr('name', 'images').prop('disabled',
                            true);
                        $('#galleries-modal-choose #image-preview-upload').html('');
                        $('#galleries-modal-choose #image-preview').hide();
                    }
                    populatePortfolioOptions(data.data.portfolio_id);
                    // Show the modal
                    $('#galleries-modal-choose').modal('show');
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
        $('#galleries-modal-choose').on('hidden.bs.modal', function() {
            // Reset the form fields
            $('#galleries-form')[0].reset();
            // Reset the image preview
            $('#image-preview-upload').empty();
            // Reset the embed video inputs
            $('#embed-video-container input[name="embed_video[]"]').val('');
            // Reset the select2 dropdown
            $('.select2').val('').trigger('change');
            // Reset the form validation errors
            $('.error-message').text('');
            $('#embed-video-container').children().not(':first-child').remove();
            // Reset the modal content
            $('#galleries-modal-choose #galleries-modal-label').text('Upload Images');
            $('#galleries-modal-choose #title').val('');
            $('#galleries-modal-choose #activity-id').val('');
            $('#galleries-modal-choose #youtube-embed').show().prop('required',
                false).prop('disabled', false);
            $('#galleries-modal-choose #image-label').show().text(
                'Upload Images (max 20, PNG/JPEG only)?');
            $('#galleries-modal-choose #add-embed-video').show();
            $('#galleries-modal-choose #exampleInputFile').show().prop(
                'multiple', true).attr('name', 'images[]').prop('disabled', false);
            $('#galleries-modal-choose #image-preview').show();
            window.stepper.reset();
        });





        $(document).on('click', '.delete', function() {
            var serviceId = $(this).data('activity-id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/galleries/' + serviceId,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#galleries-items').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });


        // Inisialisasi Select2
        $('.select2').select2();


        $('#exampleInputFile').on('change', function(event) {
            const files = event.target.files;
            const maxFiles = 20;
            const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            const previewContainer = $('#image-preview-upload');

            // Clear previous preview
            previewContainer.empty();

            // Validate number of files
            if (files.length > maxFiles) {
                alert(`You can upload a maximum of ${maxFiles} files.`);
                event.target.value = ''; // Clear the input
                return;
            }

            // Show image preview
            for (let i = 0; i < files.length; i++) {
                if (!allowedExtensions.exec(files[i].name)) {
                    alert(`Invalid file type: ${files[i].name}. Please upload only PNG or JPEG files.`);
                    event.target.value = ''; // Clear the input
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = $('<img>', {
                        src: e.target.result,
                        class: 'img-thumbnail',
                        style: 'margin: 5px;'
                    });
                    previewContainer.append(img);
                };
                reader.readAsDataURL(files[i]); // Read file as URL
            }
        });

        // Add Embed Video Input
        $('#add-embed-video').click(function() {
            // Create the input element
            var input = $('<input>', {
                type: 'text',
                class: 'form-control mb-2 mr-2',
                name: 'embed_video[]',
                placeholder: 'Enter embed video URL'
            });

            // Create the remove button
            var removeButton = $('<button>', {
                class: 'btn btn-danger btn-sm remove-embed-video mb-2',
                type: 'button',
                text: 'x' // Or you can use HTML entity: '&times;'
            });

            // Create a container for the input and button
            var inputGroup = $('<div>', {
                class: 'input-group mb-2'
            }).append(input).append(removeButton);

            // Append the container to the embed-video-container
            $('#embed-video-container').append(inputGroup);
        });

        // Remove Embed Video Input (this part remains the same)
        $(document).on('click', '.remove-embed-video', function() {
            $(this).parent().remove();
        });



        function populatePortfolioOptions(selectedPortfolioId = '') {
            $.ajax({
                type: 'GET',
                url: '/dashboard/get-portfolio',
                success: function(data) {
                    // Kosongkan dropdown sebelum mengisi
                    $('.select2').empty();
                    // Tambahkan opsi kosong
                    $('.select2').append(new Option("Select Work (EMPTY)", ""));

                    $.each(data, function(index, item) {
                        var selected = selectedPortfolioId && selectedPortfolioId == item
                            .id ? ' selected' : '';
                        $('.select2').append(new Option(item.title + ' - ' + item.clients
                            .name, item.id, selected, selected));
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
