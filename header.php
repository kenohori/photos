<?php

$query = parse_url($_SERVER["REQUEST_URI"]);

echo('<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <title>Photos | Ken Arroyo Ohori</title>
	  <meta name="description" content="Ken Arroyo Ohori">
	  <meta name="keywords" content="Gustavo Adolfo Ken Arroyo Ohori">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <meta name="author" content="Ken Arroyo Ohori">
	  <link href="css/bootstrap.min.css" rel="stylesheet">
	  <link href="css/font-awesome.min.css" rel="stylesheet">
	  <link href="css/ken.css" rel="stylesheet">
		<link href="css/blueimp-gallery.min.css" rel="stylesheet">
		<link href="css/black.css" rel="stylesheet">
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-default" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="https://3d.bk.tudelft.nl"><img class="tud-logo" src="img/3dgeoinfo.png" /></a>
				<a class="navbar-brand" href="https://3d.bk.tudelft.nl/ken/en/">Ken Arroyo Ohori</a>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li><a href="https://3d.bk.tudelft.nl/ken/en/">About</a></li>
					<li class="active"><a href="https://fotos.ken.mx/photos.php">Photos</a></li>
					<li><a href="https://3d.bk.tudelft.nl/ken/en/blog/">Blog</a></li>
					<li><a href="https://3d.bk.tudelft.nl/ken/en/papers/">Papers</a></li>
					<li><a href="https://3d.bk.tudelft.nl/ken/en/thesis/">PhD thesis</a></li>
					<li><a href="https://3d.bk.tudelft.nl/ken/en/code/">Code</a></li>
					<li><a href="https://3d.bk.tudelft.nl/ken/en/contact/">Contact</a></li>
				</ul>
				<ul class="nav navbar-nav pull-right">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">en <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="photos.php?'.$query['query'].'">en</a></li>
							<li><a href="fotos.php?'.$query['query'].'">es</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<div id="wrap">
			<div id="main" class="clear-top">'."\n");
?>
