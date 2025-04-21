@extends('plugincmslaravel::layouts.app')

@section('title', isset($page) ? 'Modifier une Page SEO' : 'Ajouter une Page SEO')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/jsoneditor@latest/dist/jsoneditor.min.css" rel="stylesheet" type="text/css">
<script src="https://cdn.jsdelivr.net/npm/jsoneditor@latest/dist/jsoneditor.min.js"></script>

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ isset($page) ? 'Modifier une Page SEO' : 'Ajouter une Page SEO' }}
                </h1>
            </div>
        </div>
    </div>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <form method="POST"
                          action="{{ isset($page) ? route('admin.page.update', $page) : route('admin.page.store') }}"
                          class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework">
                        @csrf
                        @isset($page)
                            @method('PUT')
                        @endisset

                        <!-- Colonne gauche : Ville, Secteur, Template -->
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <!-- Ville -->
                            <div class="card card-flush py-4">
                                <div class="card-header"><h2 class="card-title">Ville</h2></div>
                                <div class="card-body pt-0">
                                    <select name="city_id" class="form-select form-select-solid" required>
                                        <option value="">Choisir une ville...</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                @selected(old('city_id', $page->city_id ?? '') == $city->id)>
                                                {{ $city->getTranslation('fr')->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Secteur -->
                            <div class="card card-flush py-4">
                                <div class="card-header"><h2 class="card-title">Secteur</h2></div>
                                <div class="card-body pt-0">
                                    <select name="sector_id" class="form-select form-select-solid" required>
                                        <option value="">Choisir un secteur...</option>
                                        @foreach ($sectors as $sector)
                                            <option value="{{ $sector->id }}"
                                                @selected(old('sector_id', $page->sector_id ?? '') == $sector->id)>
                                                {{ $sector->getTranslation('fr')->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Template -->
                            <div class="card card-flush py-4">
                                <div class="card-header"><h2 class="card-title">Template</h2></div>
                                <div class="card-body pt-0">
                                    <input type="text" name="template" class="form-control form-control-solid"
                                           placeholder="Nom du template"
                                           value="{{ old('template', $page->template ?? 'default') }}" required>
                                    <div class="text-muted fs-7 mt-2">
                                        Nom du template Blade à utiliser (ex. : <code>default</code>)
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Colonne droite : Contenu JSON par langue -->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            @foreach(config('app.langages') as $locale)
                                <div class="card card-flush py-4">
                                    <div class="card-header">
                                        <h2 class="card-title">Contenu JSON — {{ strtoupper($locale) }}</h2>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div id="jsoneditor_{{ $locale }}" style="height: 400px;"></div>
                                        <input type="hidden" name="translations[{{ $locale }}][data]" id="data-json-input-{{ $locale }}"
                                               value="{{ old('translations.' . $locale . '.data', isset($page) ? json_encode($page->getTranslation($locale)->data ?? []) : '{}') }}">
                                        <div class="text-muted fs-7 mt-2">
                                            Ce contenu sera injecté dans le template pour <strong>{{ strtoupper($locale) }}</strong>.
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Boutons -->
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.page.index') }}" class="btn btn-light me-5">Retour</a>
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ isset($page) ? 'Mettre à jour' : 'Créer la page' }}</span>
                                    <span class="indicator-progress">Patientez...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    @foreach(config('app.langages') as $locale)
        const container_{{ $locale }} = document.getElementById("jsoneditor_{{ $locale }}");
        const hiddenInput_{{ $locale }} = document.getElementById("data-json-input-{{ $locale }}");

        const editor_{{ $locale }} = new JSONEditor(container_{{ $locale }}, {
            mode: "code",
            onChangeText: function(jsonString) {
                hiddenInput_{{ $locale }}.value = jsonString;
            }
        });

        try {
            editor_{{ $locale }}.set(JSON.parse(hiddenInput_{{ $locale }}.value || "{}"));
        } catch (e) {
            editor_{{ $locale }}.set({});
        }
    @endforeach
</script>
@endsection
