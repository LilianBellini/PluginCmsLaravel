@extends('layouts.app')

@section('title', 'Gestion des Catégories')

@section('content')
<div class="container-fluid h-100 d-flex flex-column">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Catégories
                </h1>
                <span class="text-gray-500 mt-1 fw-semibold fs-6">Liste de vos catégories</span>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <div class="d-flex">
                    <a href="{{ route('post.category.create') }}" class="btn btn-icon btn-sm btn-success flex-shrink-0 ms-4">
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
                                    <th class="p-0 pb-3 min-w-100px text-start">NOM</th>
                                    <th class="p-0 pb-3 min-w-100px text-center">AJOUTER PAR</th>
                                    <th class="p-0 pb-3 w-50px text-end">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td class="text-start">
                                        <span class="text-gray-800 fw-bold fs-6">
                                            {{ $category->translations->firstWhere('locale', 'fr')->name ?? 'Nom non disponible' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-gray-800 fw-bold fs-6">{{ $category->user->name }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex">
                                            <a href="{{ route('post.category.edit', $category->id) }}" class="btn btn-info btn-sm me-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form method="POST" action="{{ route('post.category.destroy', $category->id) }}" onsubmit="return confirm('Êtes-vous sûr ?')">
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
                    <div class="separator separator-dashed border-gray-200 mb-n4"></div>
                    <div class="d-flex flex-stack flex-wrap pt-10">
                        <div class="fs-6 fw-semibold text-gray-700">
                            Affichage de {{ $categories->firstItem() }} à {{ $categories->lastItem() }} sur {{ $categories->total() }} entrées
                        </div>
                        @if ($categories->hasPages())
                        <ul class="pagination">
                            @if ($categories->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="previous"></i></span>
                            </li>
                            @else
                            <li class="page-item">
                                <a href="{{ $categories->previousPageUrl() }}" class="page-link"><i class="previous"></i></a>
                            </li>
                            @endif
                            @foreach ($categories->links()->elements as $element)
                            @if (is_string($element))
                            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                            @endif
                            @if (is_array($element))
                            @foreach ($element as $page => $url)
                            @if ($page == $categories->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                            <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                            @endif
                            @endforeach
                            @endif
                            @endforeach
                            @if ($categories->hasMorePages())
                            <li class="page-item">
                                <a href="{{ $categories->nextPageUrl() }}" class="page-link"><i class="next"></i></a>
                            </li>
                            @else
                            <li class="page-item disabled">
                                <span class="page-link"><i class="next"></i></span>
                            </li>
                            @endif
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection