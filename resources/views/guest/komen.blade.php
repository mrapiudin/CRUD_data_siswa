<!-- filepath: /d:/PROJECT-LARAVEL/pengaduan-masyrakat/resources/views/guest/komen.blade.php -->
@extends('template.app')
@section('content-dinamis')
    <style>
        body {
            background: #f8f8f8;
        }

        .pembungkus-card {
            background: #001f33;
            width: 94%;
            margin: auto;
            height: 20rem;
            ;
            border-radius: 0.5rem;
            margin-top: 1rem;
        }

        .pembungkus-card2 {
            background: #001f33;
            width: 94%;
            margin: auto;
            height: 11.5rem;
            border-radius: 0.5rem;
            margin-top: 1rem;
        }

        .pembungkus-card3 {
            background: #001f33;
            width: 94%;
            margin: auto;
            height: 100%;
            border-radius: 0.5rem;
            margin-top: 1rem;
        }


        .form-group {
            /* margin-bottom: 15px; */
            width: 100%;
            max-width: 400px;
        }


        .form-control {
            width: 210%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn1 {
            background-color: #9ae2ff;
            color: #000000;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            width: 14rem;
            height: 2.2rem;
            transition: 0.3s;
            font-weight: bold;
            margin-top: 1.5rem;
            margin-left: 7.5rem;
        }

        .btn1:hover {
            background-color: #00b3ff;
            box-shadow: 0 0 0 5px #78a7ff5f;
            color: #000000;
        }

        .alert {
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .card {
            width: 100%;
            border-radius: 0.5rem;
            background-color: #001f33;
            box-shadow: 0 1px 2px 0 rgba(255, 255, 255, 0.05);
            border: 1px solid transparent;
            margin: 1rem auto;
            display: flex;
        }

        .content {
            padding: 1.1rem;
            color: #ffffff;
        }

        .image {
            object-fit: cover;
            width: 85%;
            height: 19rem;
            background-color: rgb(239, 205, 255);
            border-radius: 0.5rem;
            margin-top: 0.5rem;
            margin-left: .4rem;
        }

        .image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0.5rem;
        }

        .title {
            color: #ffffff;
            font-size: 1.125rem;
            line-height: 1.75rem;
            font-weight: 600;
        }

        .desc {
            margin-top: 0.5rem;
            color: #ffffff;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .desc1 {
            margin-top: 0.5rem;
            color: #ffffff;
            font-size: 0.91rem;
            line-height: 1.25rem;
            width: 100%;
            padding-left: 1rem;
            padding-top: 0.5px;
        }

        .comment {
            color: #ffffff;
            margin: auto 1rem;
            border-radius: 0.5rem;
        }

        .form-group1 {
            /* margin-bottom: 15px; */
            width: 98.5%;
            max-width: 100%;
            display: flex;
            padding-top: 1rem;
        }


        .form-control1 {
            width: 210%;
            height: 5rem;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .comments {
            color: red
        }
    </style>

    <div class="pembungkus-card">
        <div class="card">
            <div class="image">
                <img src="{{ asset($repots->image) }}" class="w-full h-full object-cover"
                    onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';">
            </div>
            <div class="content">
                <h1 href="#">
                    <span class="title">{{ $repots['keluhan'] }}</span>
                </h1>
                <p class="desc">{{ \Carbon\Carbon::parse($repots['created_at'])->locale('id')->isoFormat('D MMMM YYYY') }}
                </p>
                <h2>tipe : {{ $repots['type'] }}</h2>
            </div>
        </div>
    </div>

    <div class="pembungkus-card2">
        <form id="commentForm" action="{{ route('guest.komen.proses') }}" method="POST">
            @csrf
            <input type="hidden" name="repot_id" value="{{ $repots->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <div class="form-group1">
                <label for="comment" class="comment">Tambahkan komentar : </label>
                <textarea name="comment" id="comment" class="form-control1" rows="3"></textarea>
            </div>
            <button type="submit" class="btn1">Kirim</button>
        </form>
        </div>



    <div class="pembungkus-card3">
        <div class="desc1">
            @foreach ($repots->comments as $comment)
                <div class="desc1" style="word-wrap: break-word;">
                    <p>{{ $comment->user->email }}</p>
                    <p>{{ \Carbon\Carbon::parse($comment->created_at)->locale('id')->diffForHumans() }}</p>
                    <h2>{{ $comment->comment }}</h2>
                    
                </div>
            @endforeach
        </div>
    </div>

    
@endsection
