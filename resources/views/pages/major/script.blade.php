<script>

    $(document).ready(function() {

        var table = $('.major-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('major.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'parent', name: 'parent'},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });


        let method = 'POST'

        // STORE
        $('#major-form').submit(function(e) {
            e.preventDefault()
            const payload = new FormData(this)
            const url = $(this).attr('action')
            const validator = document.getElementById('major-form').checkValidity()
            
            if (validator) {
                $.ajax({
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        method: method,
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
                            $('#major-form').get(0).reset()
                            $('#major-modal').modal('hide')
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
                    const url = '{{ url("major") }}/' + $(this).data('id')
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
            const url = '{{ url("major") }}/' + $(this).data('id')
            $('#major-form').attr('action', url)
            method = 'PUT'

            let data = {}
            $.get(url).done(response => {
                if(response.success) data = response.data
                setForm(data)
                $('#major-modal').modal('show')
            })
        })

        function setForm(data) {
            $('input[name=name]').val(data.name)
        }

        // $('.modal').on('hidden.bs.modal', function (event) {
        //     $('#major-form').attr('action', '{{ route("major.store") }}')
        //     method = 'POST'
        // })

    })

</script>