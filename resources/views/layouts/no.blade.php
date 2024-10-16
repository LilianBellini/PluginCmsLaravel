<!DOCTYPE html>
<html lang="en">

<head>

	<title>@yield('title') | Systemin</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="robots" content="noindex, nofollow">

	@vite(['resources/css/app.css', 'resources/js/app.js'])



	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-DEXFC3C67M"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'G-DEXFC3C67M');
	</script>
	<div class="container">
		@include('layouts.alert')
	</div>
	@yield('content')

</html>