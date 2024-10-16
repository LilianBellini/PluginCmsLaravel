@extends('layouts.app')

@section('title', 'Rôles')

@section('content')
<div class="container-fluid h-100 d-flex flex-column">
    <main class="flex-grow-1 p-4">
        <h1 class="w-full text-3xl text-black pb-6">Rôles</h1>

        <div class="w-full mt-12">
            <p class="text-xl pb-3 d-flex align-items-center">
                <i class="fas fa-list mr-3"></i> Enregistrements de Rôles
            </p>
            <div class="table-responsive bg-white">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection