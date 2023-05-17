<script>

    $(document).ready(function() {

        var table = $('.student-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('student.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'name', name: 'name'},
                {data: 'nis', name: 'nis'},
                {data: 'rayon', name: 'rayon'},
                {data: 'major', name: 'major'},
                {data: 'jk', name: 'jk'},
                {data: 'dob', name: 'dob'},
                {data: 'telp', name: 'telp'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        let method = 'POST'
        // STORE
        $('#student-form').submit(function(e) {
            e.preventDefault()
            const payload = new FormData(this)
            const url = $(this).attr('action')
            const validator = document.getElementById('student-form').checkValidity()
            if (validator) {
                $.ajax({
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        // method: method,
                        // method harcode post for upload image
                        method: 'POST',
                        data: payload,
                        async: false,
                        cache: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        processData: false,
                    })
                    .done(response => {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            })

                            table.ajax.reload()
                            $('#student-form').get(0).reset()
                            $('#student-modal').modal('hide')
                        }
                    })
                    .fail(response => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.responseJSON.message
                        })
                    })
            }

        })

        // //DELETE
        $(document).on('click', '.delete-btn', function(){
            Swal.fire({
                title: 'Are you sure',
                icon: 'info',
                showDenyButton: true,
                confirmButtonText: 'Yes',
                denyButtonText: `No`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    const url = '{{ url("student") }}/' + $(this).data('id')
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).done(response => {
                        console.log(response)
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            message: response.message
                        })
                        table.ajax.reload()
                     })
                }
            })
        })

        // //EDIT
        $(document).on('click', '.edit-btn', function(){
            const url = '{{ url("student") }}/' + $(this).data('id')
            $('#student-form').attr('action', url)
            method = 'PUT'

            let data = {}
            $.get(url).done(response => {
                if(response.success) data = response.data
                setForm(data)
                $('#student-modal').modal('show')
            })
        })

        function setForm(data) {
            $('input[name=name]').val(data.name)
            $('input[name=nis]').val(data.nis)
            $('input[name=dob]').val(data.dob)
            $('input[name=telp]').val(data.telp)
            $('select[name=rayon_id]').val(data.rayon_id)
            $('select[name=major_id]').val(data.major_id)
            $('.image-input-wrapper').attr('style', 'background-image: url({{ asset('storage/images/student') }}/' + encodeURIComponent(data.image) + ')')
        }

        $('.modal').on('hidden.bs.modal', function (event) {
            $('#student-form').attr('action', '{{ route("student.store") }}')
            method = 'POST'
            $('.btn-cancel-img').click()
            $('.image-input-empty').attr('style', 'background-image: url(assets/media/users/blank.png)')
        })

    })

</script>