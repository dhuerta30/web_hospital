<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $_ENV["APP_NAME"] }} | Reset</title>
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href='{{ $_ENV["BASE_URL"] }}theme/plugins/fontawesome-free/css/all.min.css'>
</head>
<body>
<style>
    body {
        background: #5d6d7e!important;
    }
    li.list-group-item.bg-primary.text-white.text-center {
        font-size: 20;
        font-weight: 500;
    }
</style>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-10 m-auto">
            <?= $reset; ?>
        </div>
    </div>
</div>
<div id="artify-ajax-loader">
    <img width="300" src='{{ $_ENV["BASE_URL"] }}app/libs/artify/images/ajax-loader.gif' class="artify-img-ajax-loader"/>
</div>
</body>
</html>