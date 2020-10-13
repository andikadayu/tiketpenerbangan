@extends('master')
@section('title', 'Jadwal Penerbangan')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">

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
                            <th>Nama</th>
                            <th>Pesawat</th>
                            <th>Asal-Tujuan</th>
                            <th>Waktu</th>
                            <th>Tanggal Pembelian</th>
                            <th>Jumlah</th>
                            <th>Tarif</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(count($order) > 0)

                        @php
                        $num = 1;
                        @endphp

                        @foreach($order as $key => $value)
                        <tr>
                            <td>{{ $num++ }}</td>
                            <td>{{ $value->nama }}</td>
                            <td>{{ $value->nama_pesawat }}</td>
                            <td>{{$value->bandara_asal}}-{{ $value->bandara_tujuan }}</td>
                            <td>{{ date('d F Y', strtotime($value->tgl_jadwal)) }}({{$value->berangkat}}-{{$value->sampai}})</td>
                            <td>{{ $value->tgl_pemesanan }}</td>
                            <td>{{ $value->jumlah_pesanan }}</td>
                            <td>{{$value->tarif}}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="text-center">No item found baka!</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
               Jumlah History : {{$order->count()}}
               {{$order->links()}}
            </div>
        </div>
    </div>
</div>

<script>
    
</script>
@endsection