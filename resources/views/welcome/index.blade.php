@extends('master')
@section('title', 'Jadwal Penerbangan')

@section('content')
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
                            <th>Tanggal Pemberangkatan</th>
                            <th>Jam Berangkat</th>
                            <th>Jam Sampai</th>
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
                            <td>{{ $value->jam_berangkat }}</td>
                            <td>{{ $value->jam_sampai }}</td>
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
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Jadwal</label>
                                <input type="date" name="jadwal" id="select_jadwal" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Jam Berangkat</label>
                                <input type="time" name="jam_berangkat" id="jam_berangkat" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Jam Sampai</label>
                                <input type="time" name="jam_sampai" id="jam_sampai" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" name="stok" id="stok" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tarif</label>
                                <input type="number" name="tarif" id="tarif" class="form-control" required>
                            </div>
                        </div>
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

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Jadwal</label>
                                <input type="date" name="jadwal" id="edit_select_jadwal" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Jam Berangkat</label>
                                <input type="time" name="jam_berangkat" id="edit_jam_berangkat" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Jam Sampai</label>
                                <input type="time" name="jam_sampai" id="edit_jam_sampai" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" name="stok" id="edit_stok" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tarif</label>
                                <input type="number" name="tarif" id="edit_tarif" class="form-control" required>
                            </div>
                        </div>
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
            url: '{{ url()->current() . "/getting" }}',
            method: 'GET',
            data: {
                id: id
            },
            success: function(data) {
                $('#edit_id_jadwal').val(data[0].id_jadwal),
                    $('#edit_select_tujuan').val(data[0].id_bandara_tujuan),
                    $('#edit_select_asal').val(data[0].id_bandara_asal),
                    $('#edit_select_jadwal').val(data[0].tgl_jadwal),
                    $('#edit_select_pesawat').val(data[0].id_pesawat),
                    $('#edit_jam_berangkat').val(data[0].jam_berangkat),
                    $('#edit_jam_sampai').val(data[0].jam_sampai),
                    $('#edit_stok').val(data[0].stok),
                    $('#edit_tarif').val(data[0].tarif)
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

    function deleting(id) {
        var del = confirm("Apakah Anda Ingin Menghapus Data ini?");
        if (del == true) {
            $.ajax({
                url: '{{ url()->current() . "/delete" }}',
                method: 'GET',
                data: {
                    id: id
                },
            }).done(function(data) {
                if (data == 'success') {
                    location.reload();
                } else {
                    alert('Terjadi Kesalahan');
                }
            })
        }
    }
</script>
@endsection