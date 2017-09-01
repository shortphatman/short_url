<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Cache-Control" content="no-store" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="includes/stylesheets/stylesheet.css">
  </head>
  <body>
	<div class="container-full">
		<div class="row">
			<div class="col-md-1 col-lg-2"></div>
			<div class="col-12 col-sm-11 col-md-10 col-lg-9" style="padding:15px;font-size:22px">
				URL Shortener
				<?php if(!empty($error_message)){ // Show error message if exists
					echo '<span style="color:red" class="alert alert-danger ">' . $error_message . '</span>';
				} ?>
			</div>
		</div>
	</div>
