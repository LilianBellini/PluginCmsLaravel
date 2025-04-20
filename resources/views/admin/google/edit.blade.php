@extends('plugincmslaravel::layouts.app')

@section('title', 'Connexion Google Search Console')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Connexion Google Search Console
                    </h1>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.google.credentials.update') }}" method="POST"
            class="form fv-plugins-bootstrap5 fv-plugins-framework" id="kt_google_credentials_form">
            @csrf
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Paramètres API Google</h2>
                            </div>
                        </div>

                        <div class="card-body border-top p-9">
                            <div class="row mb-6">
                                <label for="client_id" class="col-lg-4 col-form-label required fw-semibold fs-6">
                                    Client ID
                                </label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" id="client_id" name="client_id"
                                        class="form-control form-control-lg form-control-solid" placeholder="Client ID"
                                        value="{{ old('client_id', $credentials->client_id ?? '') }}" required>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="client_secret" class="col-lg-4 col-form-label required fw-semibold fs-6">
                                    Client Secret
                                </label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" id="client_secret" name="client_secret"
                                        class="form-control form-control-lg form-control-solid" placeholder="Client Secret"
                                        value="{{ old('client_secret', $credentials->client_secret ?? '') }}" required>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="site_url" class="col-lg-4 col-form-label required fw-semibold fs-6">
                                    Lien du site (sans https://) 
                                </label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" id="site_url" name="site_url"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="monsite.com"
                                        value="{{ old('site_url', $credentials->site_url ?? '') }}" required>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('index') }}" class="btn btn-light me-5">Retour</a>

                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Enregistrer</span>
                            <span class="indicator-progress">
                                Sauvegarde en cours...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection