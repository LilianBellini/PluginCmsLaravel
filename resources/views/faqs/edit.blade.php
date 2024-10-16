@extends('layouts.app')

@section('title', isset($faq) ? 'Modifier la Question' : 'Ajouter une Question')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        {{ isset($faq) ? 'Modifier la Question' : 'Ajouter une Question' }}
                    </h1>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ isset($faq) ? route('faq.update', $faq) : route('faq.store') }}"
            class="form fv-plugins-bootstrap5 fv-plugins-framework" id="kt_account_profile_details_submit">
            @csrf
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <div id="kt_account_settings_profile_details" class="collapse show">

                        @if (isset($faq))
                            @method('PUT')
                        @endif

                        <input type="hidden" id="user" name="user_id" value="{{ auth()->user()->id }}">

                        <div class="card mb-5 mb-xl-10">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Question</h2>
                                </div>
                            </div>
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label for="question" class="col-lg-4 col-form-label required fw-semibold fs-6">Question</label>
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <input type="text" id="question"
                                            name="question"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Entrez la question"
                                            value="{{ old('question', isset($faq) ? $faq->question : '') }}"
                                            required>
                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label for="answer" class="col-lg-4 col-form-label required fw-semibold fs-6">Réponse</label>
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <textarea id="answer"
                                            name="answer"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Entrez la réponse"
                                            required>{{ old('answer', isset($faq) ? $faq->answer : '') }}</textarea>
                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{ route('faq.index') }}" id="kt_ecommerce_add_product_cancel"
                            class="btn btn-light me-5">
                            Retour
                        </a>
                        <!--end::Button-->

                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">
                                {{ isset($faq) ? 'Mettre à jour' : 'Créer la Question' }}
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        <!--end::Button-->
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
