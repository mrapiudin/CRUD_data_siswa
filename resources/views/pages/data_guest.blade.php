@extends('template.app')

@section('content-dinamis')
    <style>
        body {
            background: #f8f8f8;
        }

        .pembungkus {
            /* display: flex; */
            margin-top: 20px;
            /* justify-content: center; */
        }

        .form-group {
            /* margin-bottom: 15px; */
            width: 100%;
            max-width: 62%;
        }

        .form-control {
            width: 150%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
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
            background-color: #001f33;
            color: #fff;
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

        .alert {
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .pembungkus-card {
            /* display: flex; */
            /* justify-content: space-around; */
            margin-top: 2.3rem;
        }

        .card {
            width: 80%;
            border-radius: 0.5rem;
            background-color: #ffffff;
            box-shadow: 0 1px 2px 0 rgba(255, 255, 255, 0.05);
            border: 1px solid transparent;
            margin: auto;
            margin-bottom: 2rem;
        }

        .card a {
            text-decoration: none
        }

        .content {
            padding: 1.1rem;
        }

        .image {
            object-fit: cover;
            margin: auto;
            margin-top: 0.3rem;
            width: 99%;
            height: 17rem;
            background-color: rgb(239, 205, 255);
            border-radius: 0.2rem;
        }

        .image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .title {
            color: #111827;
            font-size: 1.125rem;
            line-height: 1.75rem;
            font-weight: 600;
        }

        .desc {
            margin-top: 0.5rem;
            color: #6B7280;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .action {
            display: inline-flex;
            /* margin-top: .4rem; */
            margin: auto;
            color: #ffffff;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 500;
            align-items: center;
            gap: 1rem;
            background-color: #001f33;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .action span {
            transition: .3s ease;
        }

        .action:hover span {
            transform: translateX(4px);
        }

        .vote-view {
            display: flex;
            justify-content: flex-start;
            font-size: 1.3rem;
        }

        .view {
            font-size: 1.5rem;
            margin-left: 1rem;
        }
    </style>

    <div class="content">
        <div class="container">
            <h2>Layanan Pengaduan Masyarakat</h2>
            <div class="pembungkus">

                <form action="{{ route('guest.dashboard_guest') }}" method="GET" id="searchForm">
                    <div class="form-group">
                        <label for="province">Provinsi:</label>
                        <select id="province" name="province" class="form-control">
                            <option value="">Pilih provinsi</option>
                            <!-- Add options dynamically using JavaScript -->
                        </select>
                    </div>
                    <div class="button">
                        <button type="submit" class="btn1">Cari</button>
                        <button type="submit" class="btn2" id="cleartButton">Reset</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="pembungkus-card">
            @foreach ($repots as $index => $repot)
                <div class="card" data-aos="zoom-in" data-aos-delay="100" data-aos-easing="ease-in-out">
                    <div class="image">
                        <img src="{{ asset($repot->image) }}" class="w-full h-full object-cover"
                            onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';">
                    </div>
                    <div class="content">
                        <a href="{{ route('guest.keluhan.show', $repot->id) }}">
                            <span class="title">{{ $repot['keluhan'] }}</span>
                        </a>
                        <p class="desc">{{ \Carbon\Carbon::parse($repot['created_at'])->diffForHumans() }}</p>
                        <p class="desc">{{ $repot->user->email }}</p>

                        <form action="{{ route('guest.repot.vote', $repot->id) }}" method="POST" style="display:inline;" class="vote-form">
                            @csrf
                            <div class="vote-view">
                            <button type="submit" style="background:none; border:none; cursor:pointer;" class="vote-button">
                                <i class='bx bx-heart' style='color:#ff0505'></i> 
                                <span class="voting-count">{{ count(json_decode($repot->voting, true)) }}</span>
                            </button>
                            <div class="view" style="background:none; border:none;">
                            <i class='bx bx-show'></i>
                            <span class="voting-count">{{$repot->viewers}}</span>
                        </div>
                    </div>
                        </form>
                        
                         <!-- Display voting count -->
                        <!-- Display voting count -->
                    </div>
            
                        <a href="{{ route('guest.keluhan.show', $repot->id) }}" class="action">Baca selengkapnya<span
                                aria-hidden="true">→</span></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        $(document).ready(function() {
            // Fetch provinces and populate the select options
            $.ajax({
                url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
                type: 'GET',
                success: function(response) {
                    var provinceSelect = $('#province');
                    response.forEach(function(province) {
                        provinceSelect.append('<option value="' + province.id + '">' + province
                            .name + '</option>');
                    });
                },
                error: function(xhr) {
                    $('#result').html(
                        '<div class="alert alert-danger">An error occurred while fetching provinces</div>'
                    );
                }
            });
            $('#cleartButton').click(function() {
                $('#province').val('');
                $('#searchForm').submit();
            });
            
        });

    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.vote-form').forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                var button = form.querySelector('.vote-button i');
                
                fetch(form.action, {
                    method: form.method,
                    body: new FormData(form),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (button.classList.contains('bx-heart')) {
                            button.classList.remove('bx-heart');
                            button.classList.add('bxs-heart');
                        } else {
                            button.classList.remove('bxs-heart');
                            button.classList.add('bx-heart');
                        }
                        var votingCountElement = form.parentElement.querySelector('.voting-count');
                        votingCountElement.textContent = data.votingCount;
                    }
                });
            });
        });
    });
</script>
@endsection
