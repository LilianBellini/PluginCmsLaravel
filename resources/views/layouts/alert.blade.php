@if (session()->has('success') || $errors->any() || session('error') || session()->has('status'))
<div class="my-2">
    <!-- Session Status -->
    @if(session()->has('success'))
    <div class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row p-5 m-7">
        <!--begin::Icon-->
        <i class="ki-duotone ki-pencil fs-2hx text-success me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span></i> <!--end::Icon-->

        <!--begin::Content-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <h4 class="fw-semibold">{{ session()->get('success') }}</h4>
        </div>
        <!--end::Content-->

        <!--begin::Close-->
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
            <i class="ki-duotone ki-cross fs-1 text-success"><span class="path1"></span><span class="path2"></span></i> </button>
        <!--end::Close-->
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-7">
        <!--begin::Icon-->
        <i class="ki-duotone ki-message-text-2 fs-2hx text-danger me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> <!--end::Icon-->

        <!--begin::Content-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            @foreach ($errors->all() as $error)
            <h4 class="fw-semibold">{{ $error }}</h4>
            @endforeach
        </div>
        <!--end::Content-->

        <!--begin::Close-->
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
            <i class="ki-duotone ki-cross fs-1 text-danger"><span class="path1"></span><span class="path2"></span></i> </button>
        <!--end::Close-->
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-7">
            <!--begin::Icon-->
            <i class="ki-duotone ki-message-text-2 fs-2hx text-danger me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> <!--end::Icon-->

            <!--begin::Content-->
            <div class="d-flex flex-column pe-0 pe-sm-10">
                <h4 class="fw-semibold">{{ session('error') }}</h4>
            </div>
            <!--end::Content-->

            <!--begin::Close-->
            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                <i class="ki-duotone ki-cross fs-1 text-danger"><span class="path1"></span><span class="path2"></span></i> </button>
            <!--end::Close-->
        </div>
    </div>
    @endif

    @if (session()->has('status'))
    <div class="alert alert-dismissible bg-light-info d-flex flex-column flex-sm-row p-5 mb-7">
        <!--begin::Icon-->
        <i class="ki-duotone ki-information fs-2hx text-info me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span></i> <!--end::Icon-->

        <!--begin::Content-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <h4 class="fw-semibold">{{ session('status') }}</h4>
        </div>
        <!--end::Content-->

        <!--begin::Close-->
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
            <i class="ki-duotone ki-cross fs-1 text-info"><span class="path1"></span><span class="path2"></span></i> </button>
        <!--end::Close-->
    </div>
    @endif
</div>
@endif