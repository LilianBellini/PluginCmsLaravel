@extends('plugincmslaravel::layouts.app')

@section('title', isset($city) ? 'Modifier la Ville' : 'Ajouter une Ville')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        {{ isset($city) ? 'Modifier la Ville' : 'Ajouter une Ville' }}
                    </h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <form method="post"
                    action="{{ isset($city) ? route('admin.page.city.update', $city) : route('admin.page.city.store') }}"
                    class="form fv-plugins-bootstrap5 fv-plugins-framework" id="kt_account_profile_details_submit">
                    @csrf


                    @if (isset($city))
                        @method('PUT')
                    @endif

                    @foreach (config('app.langages') as $locale)
                        <div class="card mb-5 mb-xl-10">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ strtoupper($locale) }}</h2>
                                </div>
                            </div>
                            <div id="kt_account_settings_profile_details" class="collapse show">
                                <div class="card-body border-top p-9">
                                    <div class="row mb-6">
                                        <label for="name_{{ $locale }}"
                                            class="col-lg-4 col-form-label required fw-semibold fs-6">Nom</label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                            <input type="text" id="name_{{ $locale }}" name="translations[{{ $locale }}][name]"
                                                class="form-control form-control-lg form-control-solid"
                                                placeholder="Nom de la Ville en {{ strtoupper($locale) }}"
                                                value="{{ old('translations.' . $locale . '.name', isset($city) ? $city->getTranslation($locale)->name : '') }}"
                                                required>
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label for="slug_{{ $locale }}"
                                            class="col-lg-4 col-form-label required fw-semibold fs-6">Slug</label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                            <input type="text" id="slug_{{ $locale }}" name="translations[{{ $locale }}][slug]"
                                                class="form-control form-control-lg form-control-solid"
                                                placeholder="Slug de la Ville en {{ strtoupper($locale) }}"
                                                value="{{ old('translations.' . $locale . '.slug', isset($city) ? $city->getTranslation($locale)->slug : '') }}"
                                                required>
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach

                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{ route('admin.page.city.index') }}" id="kt_ecommerce_add_product_cancel"
                            class="btn btn-light me-5">
                            Retour
                        </a>
                        <!--end::Button-->

                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">
                                {{ isset($city) ? 'Mettre à jour' : 'Ajouter la Ville' }}
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        <!--end::Button-->
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@include('plugincmslaravel::city.script')