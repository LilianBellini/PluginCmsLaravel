@extends('layouts.app')

@section('title', 'Gestion des utilisateurs')

@section('content')
<div class="container-fluid h-100 d-flex flex-column">
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Utilisateurs
                </h1>
                <!--begin::Breadcrumb-->
                <span class="text-gray-500 mt-1 fw-semibold fs-6">Liste des utilisateurs</span>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Filter menu-->
                <div class="d-flex">

                </div>
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <main class="flex-grow-1 pb-5 app-container  container-xxl">
        <div class="mb-5">
            <!--begin::Table widget 17-->
            <div class="card card-flush border-0 ">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4"><span class="path1"></span><span class="path2"></span></i> <input id="search-input" type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Rechercher un article">
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Body-->
                <div class="card-body pt-6">

                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed align-middle gs-0 gy-6 my-0">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fs-7 fw-bold text-gray-500">
                                    <th class="p-0 pb-3 min-w-100px text-start">NOM</th>
                                    <th class="p-0 pb-3 min-w-100px text-start">EMAIL</th>
                                    <th class="p-0 pb-3 min-w-100px text-center">ROLE</th>
                                    <th class="p-0 pb-3 w-50px text-end">ACTION</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->

                            <!--begin::Table body-->
                            <tbody id="posts-table">
                                @foreach ($users as $user)
                                <tr>

                                    <td class="ps-0 text-start">
                                        <span class="text-gray-800 fw-bold fs-6 d-block">{{ $user->name }}</span>
                                    </td>
                                    <td class="ps-0 text-start">
                                        <span class="text-gray-800 fw-bold fs-6 d-block">{{ $user->email }}</span>
                                    </td>

                                    <td class="text-center">
                                        <span class="text-gray-800 fw-bold fs-6">{{ $user->role->name }}</span>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-inline-flex">
                                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-info btn-sm me-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.user.destroy', $user->id) }}" onsubmit="return confirm('Êtes-vous sûr ?')">
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
                            Affichage de {{ $users->firstItem() }} à {{ $users->lastItem() }} sur {{ $users->total() }} entrées
                        </div>

                        <!--begin::Pages-->
                        @if ($users->hasPages())
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($users->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="previous"></i></span>
                            </li>
                            @else
                            <li class="page-item">
                                <a href="{{ $users->previousPageUrl() }}" class="page-link"><i class="previous"></i></a>
                            </li>
                            @endif

                            @foreach ($users->links()->elements as $element)
                            @if (is_string($element))
                            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                            @endif

                            @if (is_array($element))
                            @foreach ($element as $page => $url)
                            @if ($page == $users->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                            <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                            @endif
                            @endforeach
                            @endif
                            @endforeach

                            @if ($users->hasMorePages())
                            <li class="page-item">
                                <a href="{{ $users->nextPageUrl() }}" class="page-link"><i class="next"></i></a>
                            </li>
                            @else
                            <li class="page-item disabled">
                                <span class="page-link"><i class="next"></i></span>
                            </li>
                            @endif
                        </ul>
                        @endif
                    </div>

                    <!--end::Pagination-->
                </div>
                <!--end: Card Body-->
            </div>
            <!--end::Table widget 17-->
        </div>
</div>
</main>

<script>
    document.getElementById('search-input').addEventListener('input', function() {
        const query = this.value;
        fetch(`/admin/post/search?query=${query}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                const postsTable = document.getElementById('posts-table');
                postsTable.innerHTML = data.html;
            });
    });
</script>

@endsection