<div style="margin-top: 1rem;">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Pesawat</th>
                <th>Jadwal Penerbangan</th>
                <th>Jam Pemberangkatan</th>
                <th>Jam Sampai</th>
                <th>Stok</th>
                <th>Tarif</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @if(count($jadwal) == 0)
            <tr>
                <td colspan="8" class="text-center">Tidak ada jadwal yang ditemukan</td>
            </tr>
            @else
            @php ($num = 1)
            @foreach($jadwal as $key => $value)
            <tr>
                <td>{{ $num++ }}</td>
                <td>{{ $value->nama_pesawat }}</td>
                <td>{{ date('d F Y', strtotime($value->tgl_jadwal)) }}</td>
                <td>{{ $value->jam_berangkat }}</td>
                <td>{{ $value->jam_sampai }}</td>
                <td>{{ $value->stok }}</td>
                <td>{{ $value->tarif }}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" onclick="btnOrder('{{ $value->id_jadwal }}')">Order</button>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>