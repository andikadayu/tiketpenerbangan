@extends('master')
@section('title', 'Master - Data Pesawat')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Data Master Pesawat

                <div class="float-right">
                    <button type="button" class="btn btn-primary btn-sm" onclick="buttonAdd()">
                        Tambah Data Pesawat
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pesawat</th>
                            <th>Nama Pesawat</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php ($num = 1);
                        @foreach($pesawat as $key => $value)
                        <tr>
                            <td>{{ $num++ }}</td>
                            <td>{{ $value->id_pesawat }}</td>
                            <td>{{ $value->nama_pesawat }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="editPesawat('{{ $value->id_pesawat }}')">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deletePesawat('{{ $value->id_pesawat }}')">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function buttonAdd() {
        $.ajax({
            url: '{{ url()->current() . "/add" }}',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.RESULT == 'OK') {
                    $('#ModalGlobal').html(response.CONTENT);
                    $('#ModalGlobal').modal('show');
                } else {
                    alert(response.MESSAGE);
                }
            }
        }).fail(function() {
            alert('Have an error! Please contact developers');
        });
    }

    function deletePesawat(id_pesawat) {
        let quest = confirm('Apakah anda yakin ingin menghapus data tersebut?');

        if (quest) {
            $.ajax({
                url: '{{ url()->current() . "/delete" }}',
                method: 'POST',
                dataType: 'json',
                data: {
                    _token: '{{ csrf_token() }}',
                    id_pesawat: id_pesawat
                },
                success: function(response) {
                    if (response.RESULT == 'OK') {
                        window.location.reload();
                    } else {
                        alert(response.MESSAGE);
                    }
                }
            }).fail(function() {
                alert('Have an error! Please contact developers');
            });
        }
    }

    function editPesawat(id_pesawat) {
        $.ajax({
            url: '{{ url()->current() . "/edit" }}',
            method: 'GET',
            dataType: 'json',
            data: {
                id_pesawat: id_pesawat
            },
            success: function(response) {
                if (response.RESULT == "OK") {
                    $('#ModalGlobal').html(response.CONTENT);
                    $('#ModalGlobal').modal('show');
                } else {
                    alert(response.MESSAGE);
                }
            }
        }).fail(function() {
            alert('Have an error! Please contact developers');
        });
    }
</script>
@endsection