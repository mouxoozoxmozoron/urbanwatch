<script>
    $(document).ready(function () {
        // Open modal and populate data
        $('.edit-editsytemadminmodel-btn').on('click', function (e) {
            e.preventDefault();
            var adminId = $(this).data('id');

            $.ajax({
                url: '/admin/edit/' + adminId,
                method: 'GET',
                success: function (response) {
                    // Populate form
                    $('#admin_id').val(response.id);
                    $('input[name="first_name"]').val(response.first_name);
                    $('input[name="last_name"]').val(response.last_name);
                    $('input[name="email"]').val(response.email);
                    $('input[name="phone"]').val(response.phone);

                    // Clear password fields
                    $('input[name="password"]').val('');
                    $('input[name="password_confirmation"]').val('');

                    // Show modal
                    $('#editsytemadminmodel').modal('show');
                },
                error: function () {
                    alert('Failed to load admin data.');
                }
            });
        });

        // Submit updated form
        $('#updateadminform').on('submit', function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: '/admin/update',
                method: 'POST',
                data: formData,
                success: function (response) {
                    alert(response.message);
                    $('#editsytemadminmodel').modal('hide');
                    // location.reload();
                },
                error: function (xhr) {
                    alert('Error: ' + xhr.responseJSON.message);
                }
            });
        });

            $(document).ready(function () {
            $(document).on('click', '.delete-admin-btn', function (e) {
                e.preventDefault();

                const adminId = $(this).data('id');

                if (confirm('Are you sure you want to delete this admin?')) {
                    $.ajax({
                        url: '/admin/delete/' + adminId,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            alert(response.message);
                            location.reload();
                        },
                        error: function (xhr) {
                            alert('Error: ' + xhr.responseJSON.message);
                        }
                    });
                }
            });
        });
    });
    </script>
