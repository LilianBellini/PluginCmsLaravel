<!DOCTYPE html>

<html lang="fr">

<head>

	<base href="../" />
	<title>@yield('title') | Falcon Racing Europe</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.png')}}" />
	<!--begin::Fonts(mandatory for all pages)-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,500,600,700" />
	<!--end::Fonts-->
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<!--end::Global Stylesheets Bundle-->
	<script>
		// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
	</script>
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
	<!--begin::Theme mode setup on page load-->
	<script>
		var defaultThemeMode = "light";
		var themeMode;
		if (document.documentElement) {
			if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
				themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
			} else {
				if (localStorage.getItem("data-bs-theme") !== null) {
					themeMode = localStorage.getItem("data-bs-theme");
				} else {
					themeMode = defaultThemeMode;
				}
			}
			if (themeMode === "system") {
				themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
			}
			document.documentElement.setAttribute("data-bs-theme", themeMode);
		}
	</script>
	<!--end::Theme mode setup on page load-->
	<!--begin::App-->
	<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
		<!--begin::Page-->
		<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
			<!--begin::Header-->
			<div id="kt_app_header" class="app-header">
				<!--begin::Header container-->
				<div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
					<!--begin::sidebar mobile toggle-->
					<div class="d-flex align-items-center d-lg-none ms-n3 me-2" title="Show sidebar menu">
						<div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
							<i class="ki-duotone ki-abstract-14 fs-1">
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</div>
					</div>
					<!--end::sidebar mobile toggle-->
					<!--begin::Mobile logo-->
					<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
						<a href="index.html" class="d-lg-none">
							<img alt="Logo" src="{{asset('assets/media/logos/default.svg')}}" class="theme-light-show h-30px" />
							<img alt="Logo" src="{{asset('assets/media/logos/default-dark.svg')}}" class="theme-dark-show h-30px" />
						</a>
					</div>
					<!--end::Mobile logo-->
					<!--begin::Header wrapper-->
					@include('plugincmslaravel::layouts.navigation')
					<!--end::Header wrapper-->
				</div>
				<!--end::Header container-->
			</div>
			<!--end::Header-->
			<!--begin::Wrapper-->
			<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
				<!--begin::Sidebar-->
				@include('plugincmslaravel::layouts.sidebar')
				<!--end::Sidebar-->

				@include('plugincmslaravel::layouts.alert')

				<!--begin::Main-->
				@yield('content')
				<!--end:::Main-->
				@include('plugincmslaravel::layouts.footer')
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<script>
		var hostUrl = "assets/";
	</script>
	<!--begin::Global Javascript Bundle(mandatory for all pages)-->
	<!-- <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
	<script src="{{asset('assets/js/scripts.bundle.js')}}"></script> -->
	<!--end::Global Javascript Bundle-->
	<!--begin::Vendors Javascript(used for this page only)-->
	<!-- <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
	<script src="{{asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js')}}"></script>
	<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script> -->
	<!--end::Vendors Javascript-->
	<!--begin::Custom Javascript(used for this page only)-->
	<!-- <script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
	<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
	<script src="{{asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
	<script src="{{asset('assets/js/custom/utilities/modals/create-campaign.js')}}"></script>
	<script src="{{asset('assets/js/custom/utilities/modals/top-up-wallet.js')}}"></script>
	<script src="{{asset('assets/js/custom/utilities/modals/create-account.js')}}"></script>
	<script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
	<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script> -->
	<!--begin::Custom Javascript(used for this page only)-->
</body>
<!--end::Body-->

</html>