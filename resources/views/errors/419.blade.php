<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Page not found</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('style/dist/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('style/dist/css/error.css') }}">
    <!-- Logo  -->
    <link rel="shortcut icon" type="" href="{{ asset('style/dist/img/CPSU_L.png') }}">

    <style>
    	.login-page, .register-page {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: none !important;
        }
    </style>

</head>
<body class="hold-transition">
	<div class="">
		<div class="">
			<section class="page_404">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 ">
							<div class="col-sm-10 col-sm-offset-1  text-center">
								<div class="four_zero_four_bg">
									<h1 class="text-center ">419</h1>
								</div>
								
								<div class="contant_box_404">
									<h3 class="h2">
										Oops! Your session has expired.
									</h3>
									
									<p>It looks like your session has expired. This could be due to inactivity or other reasons.!</p>
									
									<a href="{{ route('dash') }}" class="link_404">Go to Home</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
</html>