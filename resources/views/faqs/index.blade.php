@extends('layouts.app')

@section('title', 'Gestion des Questions Fréquemment Posées')

@section('content')
<div class="container-fluid h-100 d-flex flex-column">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Questions Fréquemment Posées
                </h1>
                <span class="text-gray-500 mt-1 fw-semibold fs-6">Liste de vos questions et réponses</span>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <div class="d-flex">
                    <a href="{{ route('faq.create') }}" class="btn btn-icon btn-sm btn-success flex-shrink-0 ms-4">
                        <i class="ki-duotone ki-plus fs-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <main class="flex-grow-1 pb-5 app-container container-xxl">
        <div class="mb-5">
            <div class="card card-flush border-0">
                <div class="card-body pt-6">
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle gs-0 gy-6 my-0">
                            <thead>
                                <tr class="fs-7 fw-bold text-gray-500">
                                    <th class="p-0 pb-3 min-w-300px text-start">QUESTION</th>
                                    <th class="p-0 pb-3 min-w-300px text-start">RÉPONSE</th>
                                    <th class="p-0 pb-3 w-50px text-end">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqs as $faq)
                                <tr>
                                    <td class="text-start">
                                        <span class="text-gray-800 fw-bold fs-6">{{ $faq->question }}</span>
                                    </td>
                                    <td class="text-start">
                                        <span class="text-gray-800 fs-6">{{ Str::limit($faq->answer, 80) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex">
                                            <a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-info btn-sm me-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form method="POST" action="{{ route('faq.destroy', $faq->id) }}" onsubmit="return confirm('Êtes-vous sûr ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit"><i class="bi bi-trash3"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @include('layouts.pagination', ['items' => $faqs])
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
