<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{route('index')}}">
            <img alt="Logo" src="{{ asset('assets/media/logos/default-dark.svg')}}" class="h-30px app-sidebar-logo-default" />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-sm h-30px w-30px rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-double-left fs-2 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>

    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="hover-scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

                    <!--start:dashboard-->
                    @editor
                    <div class="menu-item">
                        <div class="menu-item pt-5">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Tableaux de bord</span>
                            </div>
                            <!--end:Menu content-->
                        </div>
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('index') }}">
                            <i class="ki-duotone ki-chart-line-up fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="menu-title">Statistiques</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    @endeditor
                    <!--end:dashboard-->


                    <!--start:blog-->
                    @editor
                    <div class="menu-item">
                        <div class="menu-item pt-5">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Gestion du blog</span>
                            </div>
                            <!--end:Menu content-->
                        </div>
                        <a class="menu-link" href="{{ route('post.index') }}">
                            <i class="ki-duotone ki-archive fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="menu-title">Articles</span>
                        </a>

                        <a class="menu-link" href="{{ route('post.tag.index') }}">
                            <i class="ki-duotone ki-save-2 fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="menu-title">Tags</span>
                        </a>

                        <a class="menu-link" href="{{ route('post.category.index') }}">
                            <i class="ki-duotone ki-folder fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="menu-title">Catégories</span>
                        </a>


                    </div>
                    @endeditor
                    <!--end:blog-->

                    <!--start:Menu bateaux-->
                    @editor()
                    <div class="menu-item">
                        <!--begin:Menu item-->
                        <div class="menu-item pt-5">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Outils métier</span>
                            </div>
                            <!--end:Menu content-->
                            <!-- <a class="menu-link" href="{{ route('faq.index') }}">
                                <i class="ki-duotone ki-archive fs-2 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <span class="menu-title">FAQ</span>
                            </a> -->

                        </div>
                    </div>
                    @endeditor
                    <!--end:Menu bateaux-->

                    <!--start:Gestion utilisateur-->
                    @admin()
                    <div class="menu-item">
                        <!--begin:Menu item-->
                        <div class="menu-item pt-5">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Gestion utilisateur</span>
                            </div>
                            <!--end:Menu content-->
                        </div>

                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{route('admin.user.index')}}">

                                <i class="ki-duotone ki-user fs-2 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <span class="menu-title">Utilisateur</span>
                            </a>

                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{route('admin.newsletters.index')}}">

                                    <i class="ki-duotone ki-people fs-2 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>

                                    <span class="menu-title">Newsletters</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                        </div>
                    </div>
                    @endadmin
                    <!--end:Gestion utilisateur-->



                    <!--start:Gestion site-->
                    @admin()
                    <div class="menu-item">
                        <!--begin:Menu item-->
                        <div class="menu-item pt-5">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Gestion du site</span>
                            </div>
                            <!--end:Menu content-->
                        </div>

                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->



                            <a class="menu-link" href="{{ route('admin.setting.index') }}">
                                <i class="ki-duotone ki-setting-2 fs-2 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <span class="menu-title">Paramètres</span>
                            </a>
                            <!--end:Menu link-->
                        </div>

                    </div>
                    @endadmin
                    <!--end:Gestion site-->


                    <!--start:assistance-->
                    <div class="menu-item">
                        <!--begin:Menu item-->
                        <div class="menu-item pt-5">
                            <!--begin:Menu content-->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Assistance</span>
                            </div>
                            <!--end:Menu content-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="mailto:maintenance@systemin.fr" target="_blank">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-badge fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Support</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    </div>
                    <!--end:Gestion site-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <a href="{{ config('app.url_front') }}" class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100">
            <span class="btn-label">Voir le site</span>
        </a>
    </div>
    <!--end::Footer-->
</div>