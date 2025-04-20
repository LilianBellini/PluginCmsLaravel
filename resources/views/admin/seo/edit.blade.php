@extends('plugincmslaravel::layouts.app')

@section('title', 'Profil SEO de l’entreprise')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <!-- Toolbar -->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Profil SEO de l’entreprise
                    </h1>
                    <span class="text-muted fs-6 fw-semibold">Définissez les préférences de génération automatique de contenus</span>
                </div>
            </div>
        </div>

        <!-- Publication automatique après génération -->



        <!-- Content -->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <form method="POST" action="{{ route('admin.seo.update') }}" class="form">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-body p-10">

                            <!-- Auto publication -->
                            <div class="mb-10">
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input type="hidden" name="auto_publish_enabled" value="0">
                                    <input type="checkbox" name="auto_publish_enabled" class="form-check-input"
                                           value="1"
{{ filter_var(old('auto_publish_enabled', $profile->auto_publish_enabled), FILTER_VALIDATE_BOOLEAN) ? 'checked' : '' }}>
                                    <span class="form-check-label">Publication automatique activée</span>
                                </label>
                            </div>

                            <div class="mb-10">
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input type="hidden" name="auto_publish_generated_article" value="0">
                                    <input type="checkbox" name="auto_publish_generated_article" class="form-check-input"
                                        value="1" {{ filter_var(old('auto_publish_generated_article', $profile->auto_publish_generated_article), FILTER_VALIDATE_BOOLEAN) ? 'checked' : '' }}>
                                    <span class="form-check-label">Publier automatiquement après génération</span>
                                </label>
                                <div class="form-text">Si activé, l’article généré sera immédiatement publié. Sinon, il restera en brouillon pour édition manuelle.</div>
                            </div>

                            <!-- Fréquence -->
                            <div class="mb-10">
                                <label class="form-label required">Fréquence de génération</label>
                                <select name="generation_frequency" class="form-select">
                                    <option value="">-- Choisir --</option>
                                    <option value="daily" {{ old('generation_frequency', $profile->generation_frequency) === 'daily' ? 'selected' : '' }}>Tous les jours</option>
                                    <option value="weekly_1" {{ old('generation_frequency', $profile->generation_frequency) === 'weekly_1' ? 'selected' : '' }}>1 fois par semaine</option>
                                    <option value="weekly_2" {{ old('generation_frequency', $profile->generation_frequency) === 'weekly_2' ? 'selected' : '' }}>2 fois par semaine</option>
                                    <option value="weekly_3" {{ old('generation_frequency', $profile->generation_frequency) === 'weekly_3' ? 'selected' : '' }}>3 fois par semaine</option>
                                </select>
                            </div>

                            <div class="mb-10">
                                <label class="form-label required">Part d’articles SEO (%)</label>
                                <input type="number"
                                       name="article_mix_ratio"
                                       class="form-control"
                                       min="0" max="100" step="5"
                                       value="{{ old('article_mix_ratio', $profile->article_mix_ratio ?? 70) }}">
                                <div class="form-text">
                                    100 = uniquement SEO ; 0 = uniquement News.  
                                    Exemple : 70 génèrera ~70 % d’articles SEO et ~30 % d’articles “Actu”.
                                </div>
                            </div>

                            <!-- Company info -->
                            <div class="mb-10">
                                <label class="form-label required">Nom de l’entreprise</label>
                                <input type="text" name="company_name" class="form-control"
                                       value="{{ old('company_name', $profile->company_name) }}" required>
                            </div>

                            <div class="mb-10">
                                <label class="form-label required">Positionnement (proposition de valeur)</label>
                                <textarea name="positioning" class="form-control" rows="3" required>{{ old('positioning', $profile->positioning) }}</textarea>
                            </div>

                            <!-- Lists -->
                            <div class="mb-10">
                                <label class="form-label">Valeurs clés</label>
                                <input type="text" name="values" class="form-control"
                                       value="{{ old('values', implode(',', $profile->values ?? [])) }}">
                                <div class="form-text">Séparées par des virgules (ex : transparence, efficacité…)</div>
                            </div>

                            <div class="mb-10">
                                <label class="form-label">Types de clients ciblés</label>
                                <input type="text" name="target_clients" class="form-control"
                                       value="{{ old('target_clients', implode(',', $profile->target_clients ?? [])) }}">
                                <div class="form-text">Ex : PME, CTO, chefs de projet</div>
                            </div>

                            <div class="mb-10">
                                <label class="form-label">Zones géographiques ciblées</label>
                                <input type="text" name="locations" class="form-control"
                                       value="{{ old('locations', implode(',', $profile->locations ?? [])) }}">
                                <div class="form-text">Ex : Bordeaux, Montpellier</div>
                            </div>

                            <div class="mb-10">
                                <label class="form-label required">Ton à adopter</label>
                                <input type="text" name="tone" class="form-control"
                                       value="{{ old('tone', $profile->tone) }}" required>
                                <div class="form-text">Ex : professionnel mais accessible, moderne, léger</div>
                            </div>

                            <div class="mb-10">
                                <label class="form-label">Thèmes prioritaires</label>
                                <input type="text" name="priority_themes" class="form-control"
                                       value="{{ old('priority_themes', implode(',', $profile->priority_themes ?? [])) }}">
                                <div class="form-text">Ex : automatisation RH, intégration API, IA éthique</div>
                            </div>

                            <div class="mb-10">
                                <label class="form-label">Sujets ou expressions à éviter</label>
                                <input type="text" name="blacklist" class="form-control"
                                       value="{{ old('blacklist', implode(',', $profile->blacklist ?? [])) }}">
                                <div class="form-text">Ex : promesses magiques, révolutionnaire</div>
                            </div>

                            <!-- Image style -->
                            <div class="mb-10">
                                <label class="form-label">Style graphique des images générées</label>
                                <textarea name="image_style_prompt" class="form-control" rows="2">{{ old('image_style_prompt', $profile->image_style_prompt) }}</textarea>
                                <div class="form-text">Ex : Illustration vectorielle, flat design, moderne et épuré</div>
                            </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-5">
                        <a href="{{ route('index') }}" class="btn btn-light me-5">Annuler</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Enregistrer</span>
                            <span class="indicator-progress">Patientez… <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
