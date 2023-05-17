@extends('layout.app')
@push('style')
    <style>
        .table-wrapper {
    overflow: auto;
}

.text-center {
    text-align: center;
}

.table-siswa, .table-date {
    border-collapse: collapse;
    width: 100%;
    margin: 0;
    padding: 0;
}

.table-siswa td {
    border: 1px solid silver;
    position: relative;
    padding: 5px;
}

.td-date .date {
    display: inline-block;
    width: 25px;
}

.label-checkbox {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    height: 100%;
    display: block;
    vertical-align: middle;
    background: #cecece;
}

.label-checkbox:hover {
    background: #bff8ff;
}

.label-checkbox input {
    margin: 0;
    -webkit-appearance: none;
    height: 100%;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    width: 100%;
    border: 0;
    cursor: pointer;
    outline: none;
}

.label-checkbox.active, .label-checkbox.active input, .label-checkbox input:checked {
    background: #2196F3;
}

.label-checkbox.active::before {
    content: "✓";
    display: block;
    position: absolute;
    z-index: 5;
    color: #fff;
    top: 15%;
    left: 35%;
}


.box-color {
    display: inline-block;
    width: 1em;
    height: 1em;
    vertical-align: middle;
}

.box-color.true {
   background: #2196F3;
}

.box-color.false {
   background: #cecece;
}
    </style>
@endpush

@section('content')
    <div class="card">
        <h3 class="card-header text-center">Attendance Cisarua 1</h3>
        <div class="card-body">
            <div class="table-wrapper">
                
                <table class="table-siswa">
                    <thead>
                        <tr>
                            <td rowspan="2" class="text-center">No</td>
                            <td rowspan="2" class="text-center">Nama</td>
                            <td rowspan="2" class="text-center">Nis</td>
                            <td colspan="31" class="text-center">Tanggal</td>
                            <td colspan="4" class="text-center">Jumlah</td>
                        </tr>
                        <tr class="table-row-head">
                            @for ($i = 1; $i <= 31; $i++)
                                <td>{{ $i }}</td>
                            @endfor
                            <td>H</td>
                            <td>S</td>
                            <td>I</td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody class="table-body-content">
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@push('script')
    @include('pages.attendance.script')
@endpush