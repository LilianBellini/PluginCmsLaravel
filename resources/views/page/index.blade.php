@extends('plugincmslaravel::layouts.app')

@section('title', 'Gestion des Pages SEO')

@section('content')
<div class="container-fluid h-100 d-flex flex-column">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Pages SEO
                </h1>
                <span class="text-gray-500 mt-1 fw-semibold fs-6">Liste des pages générées ou éditées à la main</span>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('admin.page.create') }}" class="btn btn-icon btn-sm btn-success flex-shrink-0 ms-4">
                    <i class="ki-duotone ki-plus fs-2"></i>
                </a>
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
                                    <th class="p-0 pb-3 min-w-150px text-start">VILLE</th>
                                    <th class="p-0 pb-3 min-w-150px text-start">SECTEUR</th>
                                    <th class="p-0 pb-3 min-w-100px text-start">TEMPLATE</th>
                                    <th class="p-0 pb-3 w-50px text-end">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pages as $page)
                                <tr>
                                    <td class="text-start">
                                        <span class="text-gray-800 fw-bold fs-6">
                                            {{ $page->city->getTranslation('fr')->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-start">
                                        <span class="text-gray-800 fw-bold fs-6">
                                            {{ $page->sector->getTranslation('fr')->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-start">
                                        <span class="badge badge-light-primary">{{ $page->template }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex">
                                            <a href="{{ route('admin.page.edit', $page->id) }}" class="btn btn-info btn-sm me-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.page.destroy', $page->id) }}" onsubmit="return confirm('Êtes-vous sûr ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-10">Aucune page disponible.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="separator separator-dashed border-gray-200 mb-n4"></div>

                    <div class="d-flex flex-stack flex-wrap pt-10">
                        <div class="fs-6 fw-semibold text-gray-700">
                            Affichage de {{ $pages->firstItem() }} à {{ $pages->lastItem() }} sur {{ $pages->total() }} entrées
                        </div>
                        @if ($pages->hasPages())
                        <ul class="pagination">
                            {{ $pages->links() }}
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
