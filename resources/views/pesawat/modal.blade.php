<div class="modal-dialog modal-md">
    <div class="modal-content">
        <form id="frmPesawat" action="{{ url()->current() . '/process' }}" method="POST" autocomplete="off">
            {{ csrf_field() }}
            @if($type == 'EDIT')
            <input type="hidden" name="id_pesawat" value="{{ $pesawat->id_pesawat }}">
            @endif
            <div class="modal-header">
                <h5 class="modal-title">{{ ucfirst(strtolower($type)) }} Data</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Pesawat</label>
                    <input type="text" name="pesawat" class="form-control" placeholder="Nama Pesawat" value="{{ $type == 'EDIT' ? $pesawat->nama_pesawat : null }}" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ $type == 'ADD' ? 'Tambah' : 'Edit' }}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('#frmPesawat').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let elementsForm = $(this).find('button, input');

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
</script>