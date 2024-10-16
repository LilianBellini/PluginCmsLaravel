@extends('plugincmslaravel::layouts.app')

@section('title', isset($post) ? 'Modifier un Article' : 'Ajouter un Article')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        {{ isset($post) ? 'Modifier un Article' : 'Ajouter un Article' }}
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <form method="POST"
                        action="{{ isset($post) ? route('post.update', $post->id) : route('post.store') }}"
                        class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
                        enctype="multipart/form-data" id="kt_account_profile_details_submit">
                        @csrf
                        @if (isset($post))
                            @method('PUT')
                        @endif

                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Image</h2>
                                    </div>
                                </div>
                                <div class="card-body text-center pt-0">
                                    <style>
                                        .image-input-placeholder {
                                            background-image: url("{{ isset($post) ? asset('storage/' . $post->image) : asset('/assets/media/svg/files/blank-image.svg') }}");
                                        }

                                        [data-bs-theme="dark"] .image-input-placeholder {
                                            background-image: url("{{ isset($post) ? asset('storage/' . $post->image) : asset('/assets/media/svg/files/blank-image-dark.svg') }}");
                                        }
                                    </style>
                                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                        data-kt-image-input="true">
                                        <div class="image-input-wrapper w-150px h-150px"></div>
                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                            aria-label="Change avatar" data-bs-original-title="Change avatar"
                                            data-kt-initialized="1">
                                            <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                            <input type="file" name="image">
                                            <input type="hidden" name="avatar_remove">
                                        </label>
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            aria-label="Cancel avatar" data-bs-original-title="Cancel avatar"
                                            data-kt-initialized="1">
                                            <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                        </span>
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                            aria-label="Remove avatar" data-bs-original-title="Remove avatar"
                                            data-kt-initialized="1">
                                            <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                        </span>
                                    </div>
                                    <div class="text-muted fs-7">Ajouter l'image de l'article</div>
                                </div>
                            </div>

                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Status</h2>
                                    </div>
                                    <div class="card-toolbar">
                                        <div class="rounded-circle w-15px h-15px {{ isset($post) && $post->status == 1 ? 'bg-success' : 'bg-warning' }}"
                                            id="kt_ecommerce_add_product_status"></div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="">
                                        <select class="form-select mb-2" id="status" name="status">
                                            <option value="0"
                                                {{ old('status', isset($post) ? $post->status : 0) == 0 ? 'selected' : '' }}>
                                                Non publié</option>
                                            <option value="1"
                                                {{ old('status', isset($post) ? $post->status : 0) == 1 ? 'selected' : '' }}>
                                                Publié</option>
                                        </select>
                                    </div>
                                    <div class="text-muted fs-7">Le status de l'article</div>
                                </div>
                            </div>

                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Détails de l'article</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <label class="form-label">Catégories</label>
                                    <div class="fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
                                        <select name="category_id" aria-label="Choisir une catégorie" data-control="select2"
                                            data-placeholder="Choisir une catégorie..."
                                            class="form-select form-select-solid form-select-lg fw-semibold" tabindex="-1"
                                            aria-hidden="true">
                                            <option value="">Choisir une catégorie...</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', isset($post) ? $post->category_id : '') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->getTranslation(config('app.locale'))->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="text-muted fs-7 mb-7">Ajouter une catégorie à l'article</div>
                                    <a href="{{ route('post.category.create') }}"
                                        class="btn btn-light-primary btn-sm mb-10">
                                        <i class="ki-duotone ki-plus fs-2"></i> Créer une catégorie
                                    </a>

                                    <label class="form-label d-block">Tags</label>
                                    <div class="fv-row fv-plugins-icon-container">
                                        <select name="tags[]" multiple id="tag_multiple"
                                            class="form-select form-select-lg fw-semibold">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}"
                                                    {{ collect(old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : []))->contains($tag->id) ? 'selected' : '' }}>
                                                    {{ $tag->getTranslation(config('app.locale'))->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-muted fs-7">Ctrl + clic pour sélectionner plusieurs tags</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2"
                                role="tablist">
                                @foreach ($locales as $locale)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-active-primary pb-4 {{ $loop->first ? 'active' : '' }}"
                                            data-bs-toggle="tab" href="#kt_ecommerce_add_product_{{ $locale }}"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}" role="tab">
                                            {{ strtoupper($locale) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach ($locales as $locale)
                                    @php
                                        $translation = isset($post)
                                            ? $post->translations->where('locale', $locale)->first()
                                            : null;
                                    @endphp
                                    <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}"
                                        id="kt_ecommerce_add_product_{{ $locale }}" role="tab-panel">
                                        <div class="d-flex flex-column gap-7 gap-lg-10" style="max-width: 927.5px;">
                                            <div class="card card-flush py-4">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h2>{{ strtoupper($locale) }}</h2>
                                                    </div>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                        <label class="required form-label">Titre</label>
                                                        <input type="text" id="title_{{ $locale }}" name="translations[{{ $locale }}][title]" class="form-control mb-2" placeholder="Titre de l'article" value="{{ old('translations.'.$locale.'.title', $translation ? $translation->title : '') }}">
                                                        <div class="text-muted fs-7">Titre de l'article</div>
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                        <label class="required form-label">Slug</label>
                                                        <input type="text" id="slug_{{ $locale }}" name="translations[{{ $locale }}][slug]" class="form-control mb-2" placeholder="Slug" value="{{ old('translations.'.$locale.'.slug', $translation ? $translation->slug : '') }}">
                                                        <div class="text-muted fs-7">Nom de l'url de l'article</div>
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>

                                                    <div>
                                                        <label class="form-label required">Contenu</label>
                                                        <div>
                                                            <div id="content_{{ $locale }}"
                                                                data-content="{{ old('translations.' . $locale . '.content', $translation ? $translation->content : '') }}">
                                                            </div>
                                                            <textarea name="translations[{{ $locale }}][content]" id="textarea_{{ $locale }}"
                                                                style="display:none;" ></textarea>
                                                            <div id="editor_{{ $locale }}" style="min-height: 300px;"></div>
                                                        </div>
                                                        <div class="text-muted fs-7 mt-2">C'est à vous de jouer.</div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('post.index') }}" id="kt_ecommerce_add_product_cancel"
                                    class="btn btn-light me-5">Retour</a>
                                <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                    <span class="indicator-label">Enregistrer</span>
                                    <span class="indicator-progress">Please wait... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@include('plugincmslaravel::post.script')
@endsection
