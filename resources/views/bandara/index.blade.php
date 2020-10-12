@extends('master')
@section('title', 'Master - Data Bandara')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Data Master Pesawat

                <div class="float-right">
                    <button type="button" class="btn btn-primary btn-sm" onclick="buttonAdd()">
                        Tambah Data Bandara
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Kode Bandara</th>
                            <th>Nama Bandara</th>
                            <th>Lokasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                       
                    <tbody>
                        @foreach($bandara as $b)
                        <tr>
                            <td>{{$b->id_bandara}}</td>
                            <td>{{$b->nama_bandara}}</td>
                            <td>{{$b->lokasi_bandara}}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="getData('{{$b->id_bandara}}')">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteData('{{$b->id_bandara}}')">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$bandara->links()}}
            </div>
        </div>
    </div>
</div>
<!-- Add Model -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-label="modalAdd" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="save_bandara" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Bandara</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                             <div class="form-group">
                                <label>Nama Bandara</label>
                                <input type="text" name="nama_bandara" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                           <div class="form-group">
                            <label>Kode Bandara</label>
                            <input type="text" name="id_bandara" class="form-control" style="text-transform:uppercase" required maxlength="3">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                     <div class="form-group">
                        <label>Lokasi Bandara</label>
                        <input type="text" name="lokasi_bandara" id="lokasi_bandara" class="form-control"style="text-transform:capitalize;" required>
                    </div> 
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
    </form>
</div>
</div>
</div>
</div>
<!-- Update Modal -->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-label="modalAdd" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="update_bandara" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Bandara</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                             <div class="form-group">
                                <label>Nama Bandara</label>
                                <input type="text" name="nama_bandara" id="edit_nama_bandara" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                           <div class="form-group">
                            <label>Kode Bandara</label>
                            <input type="text" name="id_bandara" id="edit_id_bandara" class="form-control" style="text-transform:uppercase" required maxlength="3" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                     <div class="form-group">
                        <label>Lokasi Bandara</label>
                        <input type="text" name="lokasi_bandara" id="edit_lokasi_bandara" class="form-control"style="text-transform:capitalize;" required>
                    </div> 
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
    </form>
</div>
</div>
</div>
</div>
<script>
    function buttonAdd() {
        $('#modalAdd').modal('show');
    }
     $('#save_bandara').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let elementsForm = $(this).find('button, select, input');

        elementsForm.attr('disabled', true);

        $.ajax({
            url: 'save-bandara',
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

    function getData(id) {
        $('#modalUpdate').modal('show');
        $.ajax({
            url : 'get-bandara',
            method:'get',
            data:{id:id},
            success:function (data) {
                $('#edit_nama_bandara').val(data.nama_bandara),
                $('#edit_id_bandara').val(data.id_bandara),
                $('#edit_lokasi_bandara').val(data.lokasi_bandara)
            }
        })
    }

    $('#update_bandara').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let elementsForm = $(this).find('button, select, input');

        elementsForm.attr('disabled', true);

        $.ajax({
            url: 'update-bandara',
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

    function deleteData(id) {
        let cf = confirm('Apakah Anda yakin ingin menghapus Data?');
        if (cf) {
            $.ajax({
                url : 'delete-bandara',
                method:'get',
                dataType:'json',
                data:{id:id},
                success:function (response) {
                    if (response.RESULT == 'OK') {
                        window.location.reload();
                    } else {
                        alert(response.MESSAGE);
                    }
                }
            })
        }
    }


</script>
@endsection