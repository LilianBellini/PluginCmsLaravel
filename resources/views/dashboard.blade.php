@extends('plugincmslaravel::layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="container-fluid h-100 d-flex flex-column">
    <main class="flex-grow-1 p-5">
        @editor
        <!-- Si l'utilisateur est admin alors on affiche ça -->
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-title h5">Catégories</div>
                        <p class="display-4 text-gray-700">{{ $categories }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-title h5">Articles</div>
                        <p class="display-4 text-gray-700">{{ $posts }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-title h5">Tags</div>
                        <p class="display-4 text-gray-700">{{ $tags }}</p>
                    </div>
                </div>
            </div>

            @endeditor
            @admin
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-title h5">Utilisateurs</div>
                        <p class="display-4 text-gray-700">{{ $users }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-title h5">Abonnés à la newsletter</div>
                        <p class="display-4 text-gray-700">{{ $newsletters }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endadmin

        @guest
        <p>Vous êtes identifié en tant qu'invité.</p>
        @endguest
    </main>
</div>
@endsection