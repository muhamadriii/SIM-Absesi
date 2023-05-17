<script>
    $(document).ready(function() {
        getData('{{url('attendance/get-data')}}')

        //getData
        function getData(url) {
            let data = {}
            $.get(url).done(response => {
                if(response.success) data = response.data
                displayData(data)
            })
        }

        function displayData(data){
            const table = $('.table-body-content')
            let i = 0

            data.forEach(element => {
                i++
                table.append(`
                    <tr id="${element.student.nis}"> 
                        <td>${i}</td>
                        <td>${element.student.name}</td>
                        <td>${element.student.nis}</td>
                    </tr>
                `)
                var tr = $('#'+element.student.nis)
                var dates = element.date

                for (var key in dates) {
                    let date = dates[key]
                    if (date && date.status == 0) {   
                        tr.append(`
                            <td id="${element.student.nis +'-'+ key}">
                                <div class="dropdown dropdown-inline mr-4">
                                    <button type="button" class="btn btn-light-success btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>H</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item btn-attendance py-1 text-danger btn-alpa" data-status="4" data-nis="${element.student.nis}" data-date="${key}">Alpa</a>
                                        <a class="dropdown-item btn-attendance py-1 text-warning btn-izin" data-status="1" data-nis="${element.student.nis}" data-date="${key}">Izin</a>
                                        <a class="dropdown-item btn-attendance py-1 text-secondary btn-sakit" data-status="5" data-nis="${element.student.nis}" data-date="${key}">Sakit</a>
                                    </div>
                                </div>
                            </td>
                        `)
                    }else
                    if (date && date.status == 1) {   
                        tr.append(`
                            <td id="${element.student.nis +'-'+ key}">
                                <div class="dropdown dropdown-inline mr-4">
                                    <button type="button" class="btn btn-light-warning btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>I</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item btn-attendance py-1 text-danger btn-alpa" data-status="4" data-nis="${element.student.nis}" data-date="${key}">Alpa</a>
                                        <a class="dropdown-item btn-attendance py-1 text-success btn-hadir" data-status="0" data-nis="${element.student.nis}" data-date="${key}">Hadir</a>
                                        <a class="dropdown-item btn-attendance py-1 text-secondary btn-sakit" data-status="5" data-nis="${element.student.nis}" data-date="${key}">Sakit</a>
                                    </div>
                                </div>
                            </td>
                        `)
                    }else
                    if (date && date.status == 4) {   
                        tr.append(`
                            <td id="${element.student.nis +'-'+ key}">
                                <div class="dropdown dropdown-inline mr-4">
                                    <button type="button" class="btn btn-light-danger btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>A</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item btn-attendance py-1 text-success btn-hadir" data-status="0" data-nis="${element.student.nis}" data-date="${key}">Hadir</a>
                                        <a class="dropdown-item btn-attendance py-1 text-warning btn-izin" data-status="1" data-nis="${element.student.nis}" data-date="${key}">Izin</a>
                                        <a class="dropdown-item btn-attendance py-1 text-secondary btn-sakit" data-status="5" data-nis="${element.student.nis}" data-date="${key}">Sakit</a>
                                    </div>
                                </div>
                            </td>
                        `)
                    }else
                    if (date && date.status == 5) {   
                        tr.append(`
                            <td id="${element.student.nis +'-'+ key}">
                                <div class="dropdown dropdown-inline mr-4">
                                    <button type="button" class="btn btn-light-primary btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>S</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item btn-attendance py-1 text-danger btn-alpa" data-status="4" data-nis="${element.student.nis}" data-date="${key}">Alpa</a>
                                        <a class="dropdown-item btn-attendance py-1 text-success btn-hadir" data-status="0" data-nis="${element.student.nis}" data-date="${key}">Hadir</a>
                                        <a class="dropdown-item btn-attendance py-1 text-warning btn-izin" data-status="1" data-nis="${element.student.nis}" data-date="${key}">Izin</a>
                                    </div>
                                </div>
                            </td>
                        `)
                    }else{
                        tr.append(`
                            <td id="${element.student.nis +'-'+ key}">
                                <div class="dropdown dropdown-inline mr-4">
                                    <button type="button" class="btn btn-light-secondary btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item btn-attendance py-1 text-danger btn-alpa" data-status="4" data-nis="${element.student.nis}" data-date="${key}">Alpa</a>
                                        <a class="dropdown-item btn-attendance py-1 text-success btn-hadir" data-status="0" data-nis="${element.student.nis}" data-date="${key}">Hadir</a>
                                        <a class="dropdown-item btn-attendance py-1 text-warning btn-izin" data-status="1" data-nis="${element.student.nis}" data-date="${key}">Izin</a>
                                        <a class="dropdown-item btn-attendance py-1 text-secondary btn-sakit" data-status="5" data-nis="${element.student.nis}" data-date="${key}">Sakit</a>
                                    </div>
                                </div>
                            </td>
                        `)
                    }
                }

            })
        }

    })


    $(document).ready(function() {
        $(document).on('click', '.btn-attendance', function(){
            let payload = {}
            payload['nis'] = $(this).data('nis')
            payload['date'] = $(this).data('date')
            payload['status'] = $(this).data('status')
            const url = '{{ route('attendance.presence')}}'

            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                method: 'POST',
                data: payload,
            })
            .done(response => {
                let data = {}
                if (response.success) {
                    data = response.data 
                    let box = $('#'+data.nis+'-'+data.date)
                    box.find('span').html('a')
                }
            })
            .fail(response => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.responseJSON.message
                })
            })
        })
    })
</script>