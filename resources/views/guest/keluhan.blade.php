@extends('template.app')

@section('content-dinamis')
    <style>
        .pembungkus {
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 800px;
            width: 500px;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-right: 10rem;
        }

        h2 {
            text-align: center;
            margin:20px 0;
            
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }


        /* From Uiverse.io by Mhyar-nsi */
        button {
            background-color: #001f33;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            width: 100px;
            height: 45px;
            transition: 0.3s;
            font-weight: bold
        }

        button:hover {
            background-color: #68d4ff;
            box-shadow: 0 0 0 5px #78a7ff5f;
            color: #000000;
        }

        .img {
            width: 28rem;
            /* height: 30rem; */
            overflow: hidden;
            position: relative;
            margin: 0 
        }

        .alert {
            padding: 10px;
            background-color: #78a7ff5f;
            color: rgb(0, 0, 0);
            margin-bottom: 15px;
            border-radius: 8px;
        }
    </style>
    <div class="pembungkus">
        <div class="img">
            @if(Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success')}}
            </div>
        @endif
            <svg id="10015.io" viewBox="0 0 480 480" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" >
                <defs>
                    <clipPath id="blob">
                        <path fill="#474bff" d="M464.5,276.5Q464,313,448.5,346.5Q433,380,403,401.5Q373,423,340,434.5Q307,446,273.5,458.5Q240,471,203,469.5Q166,468,134,449Q102,430,78,402.5Q54,375,34.5,344Q15,313,16.5,276.5Q18,240,24,206Q30,172,43.5,139.5Q57,107,80,79Q103,51,135.5,34.5Q168,18,204,13Q240,8,274,19Q308,30,338,47Q368,64,395,86Q422,108,435,140.5Q448,173,456.5,206.5Q465,240,464.5,276.5Z" />
                    </clipPath>
                </defs>
                <image x="0" y="0" width="100%" height="100%" clip-path="url(#blob)" xlink:href="https://i.pinimg.com/736x/42/7b/35/427b35b9292452ebec8bf7e336ffaa3f.jpg" preserveAspectRatio="xMidYMid slice"></image>
            </svg>
    </div>
        <div class="container">
            <h2>Masukann keluhan disini</h2>
            <form action="{{route('guest.keluhan.proses')}}" method="POST" enctype="multipart/form-data">
                
                @csrf
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <select id="provinsi" name="provinsi" class="form-control">
                        <option value="">Pilih Provinsi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kota">Kota/Kabupaten</label>
                    <select id="kota" name="kota" class="form-control">
                        <option value="">Pilih Kota/Kabupaten</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kecamatan">Kecamatan</label>
                    <select id="kecamatan" name="kecamatan" class="form-control">
                        <option value="">Pilih Kecamatan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="desa">Desa/Kelurahan</label>
                    <select id="desa" name="desa" class="form-control">
                        <option value="">Pilih Desa/Kelurahan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="type">Tipe</label>
                   <select name="type" id="type" class="form-control">
                        <option selected disabled hidden>Pilih Tipe</option>
                        <option value="KEJAHATAN" {{old('type')== "KEJAHATAN" ? 'selected' : '' }}>Kejahatan</option>
                        <option value="SOSIAL" {{old('type')== "SOSIAL" ? 'selected' : '' }}>Sosial</option>
                        <option value="PEMBANGUNAN" {{old('type')== "PEMBANGUNAN" ? 'selected' : '' }}>Pembangunan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="keluhan">Keluhan</label>
                    <textarea id="keluhan" name="keluhan" class="form-control" rows="4"></textarea>
                </div>
                 <div class="form-group">
                    <label for="image">Upload Gambar</label>
                    <input type="file" id="image" name="image"  class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
                method: 'GET',
                success: function(data) {
                    let provinsiSelect = $('#provinsi');
                    data.forEach(function(provinsi) {
                        let option = `<option value="${provinsi.id}-${provinsi.name}" id="id-provinsi">${provinsi.name}</option>`;
                        provinsiSelect.append(option);
                    });
                }
            });

            $('#provinsi').change(function() {
                let provinsiId = $(this).val();
                const idProv = provinsiId.slice(0, 2);

                $.ajax({
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${idProv}.json`,
                    method: 'GET',
                    success: function(data) {
                        let kotaSelect = $('#kota');
                        kotaSelect.html('<option value="">Pilih Kota/Kabupaten</option>');
                        data.forEach(function(kota) {
                            let option =`<option value="${kota.id}-${kota.name}" id="id-kota">${kota.name}</option>`;
                            kotaSelect.append(option);
                        });
                    }
                });
            });

            $('#kota').change(function() {
                let kotaId = $(this).val();
                const idKota = kotaId.slice(0, 4);
                $.ajax({
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${idKota}.json`,
                    method: 'GET',
                    success: function(data) {
                        let kecamatanSelect = $('#kecamatan');
                        kecamatanSelect.html('<option value="">Pilih Kecamatan</option>');
                        data.forEach(function(kecamatan) {
                            let option = `<option value="${kecamatan.id}-${kecamatan.name}" id="id-kecamatan">${kecamatan.name}</option>`;
                            kecamatanSelect.append(option);
                        });
                    }
                });
            });

            $('#kecamatan').change(function() {
                let kecamatanId = $(this).val();
                const idKecamatan = kecamatanId.slice(0, 7);
                $.ajax({
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${idKecamatan}.json`,
                    method: 'GET',
                    success: function(data) {
                        let desaSelect = $('#desa');
                        desaSelect.html('<option value="">Pilih Desa/Kelurahan</option>');
                        data.forEach(function(desa) {
                            let option = `<option value="${desa.id}-${desa.name}" id="id-desa">${desa.name}</option>`;
                            desaSelect.append(option);
                        });
                    }
                });
            });
        });
    </script>
@endsection
