@extends('plugincmslaravel::layouts.app')

@section('title', 'Gestion de la newsletter')

@section('content')
<div class="container-fluid h-100 d-flex flex-column">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Newsletters
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <span class="text-gray-500 mt-1 fw-semibold fs-6">Liste de la newsletter</span>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Filter menu-->
                <div class="d-flex">
                    <a href="{{ route('admin.newsletters.create') }}" class="btn btn-icon btn-sm btn-success flex-shrink-0 ms-4">
                        <i class="ki-duotone ki-plus fs-2"></i>
                    </a>
                </div>
                <!--end::Filter menu-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <main class="flex-grow-1 pb-5 app-container container-xxl">
        <div class="mb-5">
            <!--begin::Table widget 17-->
            <div class="card card-flush border-0">
                <!--begin::Body-->
                <div class="card-body pt-6">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed align-middle gs-0 gy-6 my-0">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fs-7 fw-bold text-gray-500">
                                    <th class="p-0 pb-3 w-150px text-start">EMAIL</th>
                                    <th class="p-0 pb-3 w-50px text-end">ACTION</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @foreach($newsletters as $newsletter)
                                <tr>
                                    <td class="ps-0 text-start">
                                        <span class="text-gray-800 fw-bold fs-6 d-block">{{ $newsletter->email }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex">
                                            <a href="{{ route('admin.newsletters.edit', $newsletter->id) }}" class="btn btn-info btn-sm me-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.newsletters.destroy', $newsletter->id) }}" onsubmit="return confirm('Êtes-vous sûr ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit"><i class="bi bi-trash3"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                    <!--end::Table-->

                    <!--begin::Separator-->
                    <div class="separator separator-dashed border-gray-200 mb-n4"></div>
                    <!--end::Separator-->

                    <div class="d-flex flex-stack flex-wrap pt-10">
                        <div class="fs-6 fw-semibold text-gray-700">
                            Affichage de {{ $newsletters->firstItem() }} à {{ $newsletters->lastItem() }} sur {{ $newsletters->total() }} entrées
                        </div>

                        <!--begin::Pages-->
                        @if ($newsletters->hasPages())
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($newsletters->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="previous"></i></span>
                            </li>
                            @else
                            <li class="page-item">
                                <a href="{{ $newsletters->previousPageUrl() }}" class="page-link"><i class="previous"></i></a>
                            </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($newsletters->links()->elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                            @foreach ($element as $page => $url)
                            @if ($page == $newsletters->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                            <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                            @endif
                            @endforeach
                            @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($newsletters->hasMorePages())
                            <li class="page-item">
                                <a href="{{ $newsletters->nextPageUrl() }}" class="page-link"><i class="next"></i></a>
                            </li>
                            @else
                            <li class="page-item disabled">
                                <span class="page-link"><i class="next"></i></span>
                            </li>
                            @endif
                        </ul>
                        @endif
                        <!--end::Pages-->
                    </div>
                    <!--end::Pagination-->
                </div>
                <!--end: Card Body-->
            </div>
            <!--end::Table widget 17-->
        </div>
</div>
</main>
@endsection