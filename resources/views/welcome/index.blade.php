<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <title>Welcome, Kelompok 2</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: url('<?= asset('assets/img/bg.jpg') ?>');

        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #07689f;">
        <a class="navbar-brand" href="{{ url('/') }}">Kelompok 2</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid" style="margin-top: 1rem;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Data Jadwal Penerbangan

                        <div class="float-right">
                            <button type="button" onclick="buttonAdd();" class="btn btn-primary btn-sm">Tambah Data</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ url()->current() }}" method="GET" autocomplete="off">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Search</label>
                                        <input type="search" name="search" class="form-control" placeholder="Search ..." value="{{ $request->get('search') }}">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Action</label>
                                        <button type="submit" class="btn btn-primary btn-block">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pesawat</th>
                                    <th>Bandara Asal</th>
                                    <th>Bandara Tujuan</th>
                                    <th>Jadwal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(count($jadwal) > 0)

                                @php
                                $num = 1;
                                @endphp

                                @foreach($jadwal as $key => $value)
                                <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>{{ $value->nama_pesawat }}</td>
                                    <td>{{ $value->bandara_asal }}</td>
                                    <td>{{ $value->bandara_tujuan }}</td>
                                    <td>{{ date('d F Y', strtotime($value->tgl_jadwal)) }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick="editing(<?= $value->id_jadwal ?>);">Edit</button>
                                        <button class="btn btn-sm btn-danger" onclick="deleting(<?= $value->id_jadwal ?>)">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6" class="text-center">No item found baka!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-label="modalAdd" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="frmAddData" action="{{ url()->current() . '/process_add' }}" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pesawat</label>
                            <select name="pesawat" id="select_pesawat" class="form-control" required>
                                @foreach($pesawat as $key => $value)
                                <option value="{{ $value->id_pesawat }}">{{ $value->nama_pesawat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Asal</label>
                            <select name="asal" id="select_asal" class="form-control" required>
                                @foreach($bandara as $key => $value)
                                <option value="{{ $value->id_bandara }}">{{ $value->nama_bandara . ' - ' . $value->lokasi_bandara }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tujuan</label>
                            <select name="tujuan" id="select_tujuan" class="form-control" required>
                                @foreach($bandara as $key => $value)
                                <option value="{{ $value->id_bandara }}">{{ $value->nama_bandara . ' - ' . $value->lokasi_bandara }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jadwal</label>
                            <input type="date" name="jadwal" id="select_jadwal" class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-label="modalAdd" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="frmUpdateData" action="{{ url()->current() . '/process_update' }}" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title">Update Data</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id_jadwal" id="edit_id_jadwal">
                        <div class="form-group">
                            <label>Pesawat</label>
                            <select name="pesawat" id="edit_select_pesawat" class="form-control" required>
                                @foreach($pesawat as $key => $value)
                                <option value="{{ $value->id_pesawat }}">{{ $value->nama_pesawat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Asal</label>
                            <select name="asal" id="edit_select_asal" class="form-control" required>
                                @foreach($bandara as $key => $value)
                                <option value="{{ $value->id_bandara }}">{{ $value->nama_bandara . ' - ' . $value->lokasi_bandara }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tujuan</label>
                            <select name="tujuan" id="edit_select_tujuan" class="form-control" required>
                                @foreach($bandara as $key => $value)
                                <option value="{{ $value->id_bandara }}">{{ $value->nama_bandara . ' - ' . $value->lokasi_bandara }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jadwal</label>
                            <input type="date" name="jadwal" id="edit_select_jadwal" class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script>
        function buttonAdd() {
            $('#modalAdd').modal('show');
        }

        $('#frmAddData').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let elementsForm = $(this).find('button, select, input');

            elementsForm.attr('disabled', true);

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    elementsForm.removeAttr('disabled');

                    if (response.RESULT == 'OK') {
                        window.location.reload();
                    } else {
                        alert(response.MESSAGE);
                    }
                }
            }).fail(function() {
                elementsForm.removeAttr('disabled');

                alert('Have an error! Please contact developers');
            });
        });

        function editing(id) {
            $('#modalEdit').modal('show');
            $.ajax({
                url: 'getting',
                method: 'get',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#edit_id_jadwal').val(data[0].id_jadwal),
                        $('#edit_select_tujuan').val(data[0].id_bandara_tujuan),
                        $('#edit_select_asal').val(data[0].id_bandara_asal),
                        $('#edit_select_jadwal').val(data[0].tgl_jadwal),
                        $('#edit_select_pesawat').val(data[0].id_pesawat)
                }
            });
        }

        $('#frmUpdateData').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let elementsForm = $(this).find('button, select, input');
            elementsForm.attr('disabled', true);

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    elementsForm.removeAttr('disabled');

                    if (response.RESULT == 'OK') {
                        window.location.reload();
                    } else {
                        alert(response.MESSAGE);
                    }
                }
            }).fail(function() {
                elementsForm.removeAttr('disabled');

                alert('Have an error! Please contact developers');
            });

        })
    </script>
</body>

</html>