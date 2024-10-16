@extends('layouts.app')

@section('title', 'Édition du profil')

@section('content')
<div class="d-flex flex-column flex-column-fluid">

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Mon profil
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
</div>
<div class="app-main flex-column flex-row-fluid " id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content  flex-column-fluid ">

            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container  container-xxl ">
                <!--begin::Form-->

                <!--end::Form-->

                <!--begin::Additional Forms-->
                <div class="mb-5">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="mb-5">
                    @include('profile.partials.update-password-form')
                </div>

                <div class="">
                    @include('profile.partials.delete-user-form')
                </div>

            </div>


        </div>


    </div>
</div>
</div>
<!--end::Additional Forms-->
<!--end::Content wrapper-->
</div>

<link href="{{ asset('assets/plugins/custom/quil/css/quil.css') }}" rel="stylesheet">
<script src="{{ asset('assets/plugins/custom/quil/js/quil.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quill = new Quill('#editor', {
            theme: 'snow'
        });
        var content = document.getElementById('content').getAttribute('data-content');

        // Charge le contenu existant dans Quill
        quill.root.innerHTML = content;

        quill.on('text-change', function() {
            document.getElementById('textarea').value = quill.root.innerHTML;
        });
    });
</script>
<script src="{{ asset('assets/js/custom/select2-4.0.13/dist/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('select[name="category_id"]').select2({
            placeholder: "Choisir une catégorie...",
            allowClear: true
        });

        $('#tag_multiple').select2({
            placeholder: "Sélectionner des tags",
            allowClear: true
        });
    });
</script>

@endsection