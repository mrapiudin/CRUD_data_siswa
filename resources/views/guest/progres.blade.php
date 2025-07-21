<!-- filepath: /D:/PROJECT-LARAVEL/pengaduan-masyrakat/resources/views/guest/progres.blade.php -->
@extends('template.app')

@section('content-dinamis')
    <style>
        .pembungkus {
            width: 90%;
            height: auto;
            padding: 1rem;
            background-color: #001f33;
            font-weight: bold;
            border-radius: 5px;
            color: aliceblue;
            margin: 1.5rem auto;
        }

        .item {
            display: inline-block;
            margin-right: 1rem;
            color: floralwhite;
            transition: 1s;
        }

        .pembungkus-container {
            padding: 1rem;
            background-color: transparent;
            border-radius: 1rem;
        }

        .pembungkus-a {
            text-align: center;
        }


        .image {
            margin: 0% auto;
            display: flex;
            justify-content: center;
        }

        img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .btn1 {
            background-color: #68d4ff;
            color: #001f33;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            width: 14rem;
            height: 2.6rem;
            transition: 0.3s;
            font-weight: bold;
            margin-right: 0.5rem;
        }

        .btn1:hover {
            background-color: #68d4ff;
            box-shadow: 0 0 0 5px #78a7ff5f;
        }

        .section {
            display: none;
        }
        .text-center {
            text-align: center;
            margin: auto;
            color: #001f33;
        }
    </style>

    <h1 class="text-center">Progres Pengaduan</h1>
    @foreach ($repots as $index => $repot)
        <div class="pembungkus">
            <div class="pembungkus-a">
                <p class="desc">Pengaduan {{ \Carbon\Carbon::parse($repot->created_at)->locale('id')->diffForHumans() }}
                </p>
                <a href="#" class="item" onclick="showSection('data-{{ $index }}')">Data</a>
                <a href="#" class="item" onclick="showSection('gambar-{{ $index }}')">Gambar</a>
                <a href="#" class="item" onclick="showSection('status-{{ $index }}')">Status</a>
            </div>
            <div class="pembungkus-container">
                <main id="data-{{ $index }}" class="section">
                    <p class="desc">Tipe: {{ $repot->type }}</p>
                    <p class="desc">Lokasi: {{ $repot->provinsi }}, {{ $repot->kota }}, {{ $repot->kecamatan }},
                        {{ $repot->desa }}</p>
                    <p class="desc">Deskripsi: {{ $repot->keluhan }}</p>
                </main>

                <aside id="gambar-{{ $index }}" class="section">
                    <div class="image">
                        <img src="{{ asset($repot->image) }}" class="w-full h-full object-cover"
                            onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';">
                    </div>
                </aside>

                <section id="status-{{ $index }}" class="section">
                    <p class="desc">Pengaduan belum di respon</p>
                    <button type="submit" class="btn1" onclick="showDeleteAlert()">Hapus</button>
                </section>
            </div>
        </div>

        <form id="deleteForm" action="{{ route('guest.hapus', $repot->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $repot->id }}">
        </form>
    @endforeach


    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.section').forEach(section => {
                section.style.display = 'none';
            });
            document.getElementById(sectionId).style.display = 'block';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showDeleteAlert() {
            Swal.fire({
                title: "Apa kamu yakin ingin menghapus keluhan ini?",
                text: "Pikirkan dengan matang sebelum menghapus",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#0099ff",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Saya yakin"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: $('#deleteForm').attr('action'),
                        type: 'POST',
                        data: $('#deleteForm').serialize(),
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Keluhan berhasil dihapus',
                                icon: 'success',
                                allowOutsideClick: false,
                                confirmButtonText: 'Tutup'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(response) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Keluhan gagal dihapus',
                                icon: 'error',
                                allowOutsideClick: false,
                                confirmButtonText: 'Tutup'
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
