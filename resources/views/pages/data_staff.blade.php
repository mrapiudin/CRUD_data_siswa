@extends('template.app')

@section('content-dinamis')
 
<style>
    .container {
    margin-top: 20px;
}



.table {
    width: 92%;
    margin-bottom: 1rem;
    color: #212529;
    border-collapse: collapse;
    margin: auto;
}

.table th,
.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #001f33;
 
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #001f33;
}


.table-bordered th,
.table-bordered td {
    border: 1px solid #e7e7e7;
}

.table-bordered thead th,
.table-bordered thead td {
    border-bottom-width: 2px;
}

td {
    background-color: #fafafa;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05);
}

.text-center {
    text-align: center;
}

.mt-3 {
    margin-top: 1rem;
}


h1 {
    text-align: center;
    margin: auto;
}

button {
    background-color: #00233a;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 8px;
    width: 100px;
    height: 50px;
    transition: 0.3s;
    font-weight: bold;
}

img {
    width: 4rem;
    height: 4rem;
    object-fit: cover;
    border-radius: 50%;
    margin: auto;
}

a.btn-success {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    background-color: #28a745;
    border-radius: 8px;
    text-decoration: none;
    transition: background-color 0.3s, transform 0.3s;
}

a.btn-success:hover {
    background-color: #218838;
    transform: scale(1.05);
}

a.btn-success:active {
    background-color: #1e7e34;
    transform: scale(1);
}
</style>

<div class="pembungkus">

    <h1>Data Pengaduan {{ Auth::user()->name }}</h1>
    <a href="{{ route('staff.export') }}" class="btn btn-success">Export to Excel</a>
<div class="container">
<table class="table table-striped table-bordered border-secondary mt-3 text-center">
    <thead>
        <tr>
            <th>Gambar dan  pengirim</th>
            <th>Lokasi & tanggal</th>
            <th>Deskripsi</th>
            <th>Jumlah Vote</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($repots as $index => $repot) 
        <tr>
            <td><img src="{{ asset($repot->image) }}" class="w-full h-full object-cover"
                onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';"> <br>{{ $repot->user->email }}</td>
            <td><p class="desc">{{ $repot->provinsi }}, {{ $repot->kota }}, {{ $repot->kecamatan }},
                {{ $repot->desa }}</p>{{ \Carbon\Carbon::parse($repot->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}</td>
            <td>{{  Str::limit($repot->keluhan, 20, '...') }}</td>
            <td>{{ count(json_decode($repot->voting, true)) }}</td>
            <td><button onclick="showOption({{ $repot->id }})">Aksi</button></td>
        </tr>
        
    </tbody>
    @endforeach
</table>    

    </div>
</div>

    <script src="sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   async function showOption(repotId) {
    const { value: action } = await Swal.fire({
        title: "Tindak Lanjut Pengaduan",
        input: "select",
        inputOptions: {
            reject: "Tolak",
            process: "Proses Perbaikan"
        },
        inputPlaceholder: "Pilih aksi",
        showCancelButton: true,
        inputValidator: (value) => {
            return new Promise((resolve) => {
                if (value) {
                    resolve();
                } else {
                    resolve("Anda harus memilih aksi");
                }
            });
        }
    });
    if (action) {
        if (action === 'process') {
            window.location.href = `{{ url('staff/proses') }}/${repotId}`;
        } else {
            Swal.fire(`Anda memilih: ${action}`);
        }
    }
}
</script>


@endsection