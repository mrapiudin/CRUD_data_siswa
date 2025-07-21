@extends('template.app')

@section('content-dinamis')

<style>
    .container {
        margin-top: 20px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .table th {
        background-color: #f4f4f4;
        color: #333;
    }

    .table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table tr:hover {
        background-color: #f1f1f1;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }

    .btn {
        padding: 6px 12px;
        text-decoration: none;
        border-radius: 4px;
        display: inline-block;
        margin-right: 5px;
    }

    form {
        display: inline;
    }
    .btn {
        padding: 6px 12px;
        text-decoration: none;
        border-radius: 4px;
        display: inline-block;
        margin-right: 5px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .btn-danger:hover {
        background-color: #c82333;
        transform: scale(1.05);
    }
</style>

@if(session('failed'))
    <div class="alert alert-danger">
        {{ session('failed') }}
    </div>
@endif
    <div class="container">
        <h2>Kelola Akun User</h2>
        <a href="{{ route('headstaff.create') }}" class="btn btn-primary">Create User</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <form action="{{ route('headstaff.reset', $user->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-primary">Reset Password</button>
                            </form>
                            <form action="{{ route('headstaff.hapus', $user->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection