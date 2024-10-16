@extends('plugincmslaravel::layouts.app')

@section('title', 'Paramètres du site')

@section('content')
<div class="container-fluid h-100 d-flex flex-column">
    <main class="flex-grow-1 p-4">
        <h1 class="w-full text-3xl text-black pb-6">Paramètres du site</h1>

        <div class="w-full mt-12">
            <p class="text-xl pb-3 d-flex align-items-center">
                <i class="fas fa-list mr-3"></i> Détails des Paramètres
            </p>

            @if ($setting->updated_at != null)
            <div class="alert alert-info text-left p-4 mb-2">Dernière modification : {{ $setting->updated_at }}</div>
            @endif

            <form method="POST" action="{{ route('admin.setting.update', $setting->id) }}">
                @csrf
                @method('PUT')
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label for="site_name" class="form-label">Nom du Site</label>
                        <input type="text" name="site_name" id="site_name" value="{{ $setting->site_name }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Description du Site</label>
                        <input type="text" name="description" id="description" value="{{ $setting->description }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="about" class="form-label">À propos</label>
                        <input type="text" name="about" id="about" value="{{ $setting->about }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="copy_right" class="form-label">Mention de droit d'auteur dans le pied de page</label>
                        <input type="text" name="copy_rights" id="copy_right" value="{{ $setting->copy_rights }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="url_insta" class="form-label">URL Instagram</label>
                        <input type="text" name="url_insta" id="url_insta" value="{{ $setting->url_insta }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="url_twitter" class="form-label">URL Twitter</label>
                        <input type="text" name="url_twitter" id="url_twitter" value="{{ $setting->url_twitter }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="url_linkedin" class="form-label">URL LinkedIn</label>
                        <input type="text" name="url_linkedin" id="url_linkedin" value="{{ $setting->url_linkedin }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="url_fb" class="form-label">URL Facebook</label>
                        <input type="text" name="url_fb" id="url_fb" value="{{ $setting->url_fb }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="contact_email" class="form-label">Email de contact</label>
                        <input type="text" name="contact_email" id="contact_email" value="{{ $setting->contact_email }}" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Mettre à jour les Paramètres</button>
            </form>
        </div>
    </main>
</div>
@endsection