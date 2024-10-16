@extends('plugincmslaravel::layouts.app')

@section('title', 'Gestion des Articles')

@section('content')

<div class="container-fluid h-100 d-flex flex-column">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Article
                </h1>
                <span class="text-gray-500 mt-1 fw-semibold fs-6">Liste de vos articles</span>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <div class="d-flex"></div>
            </div>
        </div>
    </div>
    <main class="flex-grow-1 pb-5 app-container container-xxl">
        <div class="mb-5">
            <div class="card card-flush border-0">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                            <input id="search-input" type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Rechercher un article">
                        </div>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <a href="{{ route('post.create') }}" class="btn btn-primary">
                            Nouvel article
                        </a>
                    </div>
                </div>
                <div class="card-body pt-6">
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle gs-0 gy-6 my-0">
                            <thead>
                                <tr class="fs-7 fw-bold text-gray-500">
                                    <th class="p-0 pb-3 w-150px text-start">STATUS</th>
                                    <th class="p-0 pb-3 min-w-100px text-start">TITRE</th>
                                    <th class="p-0 pb-3 min-w-100px text-center">CATEGORIE</th>
                                    <th class="p-0 pb-3 w-250px text-center">TAG</th>
                                    <th class="p-0 pb-3 w-50px text-end">ACTION</th>
                                </tr>
                            </thead>
                            <tbody id="posts-table">
                                @foreach ($posts as $post)
                                @include('plugincmslaravel::plugincmslaravel::post.lign' , $post)
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @include('plugincmslaravel::layouts.pagination', ['items' => $posts])
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    document.getElementById('search-input').addEventListener('input', function() {
        const query = this.value;
        fetch(`/editor/post/search?query=${query}`, {
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