@extends('template.app')

@section('content-dinamis')
    <main class="main container" id="main"> 
        <form action="{{ route('data_siswa.tambah.proses')}}" class="card p-5" method="POST">
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
            
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="gender" class="col-sm-2 col-form-label">Jenis kelamin :   </label>
                <div class="col-sm-10">
                    <select class="form-select" name="gender" id="gender">
                        <option selected disabled hidden>Pilih</option>
                        <option value="laki-laki" {{old('gender')== "laki-laki" ? 'selected' : '' }}>laki</option>
                        <option value="perempuan" {{old('gender')== "perempuan" ? 'selected' : '' }}>cewe</option>
                    </select>
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="rombel" class="col-sm-2 col-form-label">Rombel : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="rombel" name="rombel" value="{{ old('rombel')}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="rayon" class="col-sm-2 col-form-label">Rayon :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="rayon" name="rayon">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Kirim</button>
        </form>
    </main>


@endsection

@push('script')
<script>
    const showSidebar = (toggleId, sidebarId, headerId, mainId  ) =>{
        const toggle = document.getElementById(toggleId),
            sidebar = document.getElementById(sidebarId),
            header = document.getElementById(headerId),
            main = document.getElementById(mainId)
    
        if(toggle && sidebar && header && main){
            toggle.addEventListener('click', ()=>{
                /* Show sidebar */
                sidebar.classList.toggle('show-sidebar')
                /* Add padding header */
                header.classList.toggle('left-pd')
                /* Add padding main */
                main.classList.toggle('left-pd')
            })
        }
    }
    showSidebar('header-toggle','sidebar', 'header', 'main')
    
</script>
@endpush