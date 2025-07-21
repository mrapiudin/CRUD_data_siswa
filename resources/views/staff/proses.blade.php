@extends('template.app')

@section('content-dinamis')
    <style>
        .pembungkus {
            /* display: flex; */
            margin-top: 20px;
            /* justify-content: center; */
        }

        .btn1 {
            background-color: #001f33;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            width: 14rem;
            height: 2.6rem;
            transition: 0.3s;
            font-weight: bold;
            margin-right: 0.5rem;
            /* margin-top: auto; */
            /* margin-left: 40rem; */
        }

        .btn2 {
            background-color: #25a8ff;
            color: #000000;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            width: 14rem;
            height: 2.6rem;
            transition: 0.3s;
            font-weight: bold;
            margin-right: 5rem;
        }


        .button {
            display: flex;
            justify-content: end;
            margin-top: 1.5rem;
        }

        .btn1:hover {
            background-color: #68d4ff;
            box-shadow: 0 0 0 5px #78a7ff5f;
            color: #000000;
        }

        .btn2:hover {
            background-color: #68d4ff;
            box-shadow: 0 0 0 5px #78a7ff5f;
            color: #000000;
        }

        .button {
            display: flex;
            justify-content: start;
            margin-top: 1.5rem;
        }
    </style>
    <div class="pembungkus">
        <div class="container">
            {{-- @dd($repot->respon)  --}}
            {{-- @php
                if ($repot->respon) {
                    $repot->respon_status = $repot->respon->respon_status ?? 'ON_PROCESS';
                } else {
                    $repot->respon_status = 'ON_PROCESS';
                }
            @endphp --}}
            <h1>{{ $repot->user->email }}</h1>
            <p class="desc">{{ \Carbon\Carbon::parse($repot['created_at'])->locale('id')->isoFormat('D MMMM YYYY') }}
                <b>Status tanggapan : {{ $repot->respon_status }}</b>
            </p>
            <h1 class="desc">{{ $repot->provinsi }}, {{ $repot->kota }}, {{ $repot->kecamatan }},
                {{ $repot->desa }}</h1>
            <p class="desc">{{ $repot->keluhan }} </p>


            <div class="button">
                <form id="progressForm" action="{{ route('staff.selesai.proses', $repot->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="progress_text" id="progressText">
                    <button type="submit" class="btn2">Nyatakan Selesai</button>

                </form>

                <form id="progressForm2" action="{{ route('staff.history.store', $repot->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="progress_text" id="progressText2">
                    <button type="button" class="btn1" id="alertButton">Tambah Progres</button>
                </form>

            </div>
            <div class="history">
                <h2>Progres</h2>
                <ul>
                    @if ($repot->history->isNotEmpty())
                        @foreach ($repot->history as $history)
                            @if (isset($history->history['progress_text']))
                                <li>{{ $history->history['progress_text'] }}</li>
                            @endif
                        @endforeach
                    @else
                        <li>No progress available</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        document.getElementById('alertButton').addEventListener('click', async function(event) {
            event.preventDefault();
            const { value: text } = await Swal.fire({
                input: "textarea",
                inputLabel: "Proses Perbaikan",
                inputPlaceholder: "Tulis Tanggapan disini ...",
                inputAttributes: {
                    'aria-label': 'Type your message here'
                },
                showCancelButton: true
            });
            if (text) {
                let progressText = document.getElementById('progressText2') ? document.getElementById('progressText2').value : '';
                let histories = progressText ? JSON.parse(progressText) : [];
                histories.push(text);
                let serializedData = {
                    progress_text: JSON.stringify(histories),
                    _token: "{{ csrf_token() }}"
                };
        
                $.ajax({
                    url: "{{ route('staff.history.store', $repot->id) }}",
                    type: 'POST',
                    data: serializedData,
                    success: function(response) {
                        Swal.fire('Berhasil!', 'Progres telah ditambahkan.', 'success');
                        // Reload the page to show the new progress
                        location.reload();
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', 'Terjadi kesalahan.', 'error');
                    }
                });
            }
        });
        </script>
@endsection
