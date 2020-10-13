<div class="modal-dialog modal-md">
    <div class="modal-content">
        <form id="frmOrder" action="{{ url()->current() . '/process' }}" method="POST" autocomplete="off">
            {{ csrf_field() }}
            <input type="hidden" name="id_jadwal" value="{{ $jadwal->id_jadwal }}">
            <div class="modal-header">
                <h5 class="modal-title">Order Tiket Penerbangan</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <label>Jumlah Pembelian</label>
                    <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Pembelian" required>
                </div>

                <div class="text-center">
                    <p>Belum mempunyai akun? <a href="{{ url('register') }}" class="text-decoration-none" target="_blank">Daftar disini</a></p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Order</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
<script>
    $("#frmOrder").submit(function(e) {
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
                    alert(response.MESSAGE);

                    setTimeout(() => {
                        window.location.href = '{{ url("dashboard") }}';
                    }, 1000);
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