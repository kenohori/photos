<?php

$lang = FALSE;
if (isset($_GET["lang"])) {
	$lang = $_GET["lang"];
	setCookie("lang", $lang, time()+60*60*24*365);
} else if (isset($_COOKIE["lang"])) $lang = $_COOKIE["lang"];
else $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
if ($lang != 'es' and $lang != 'en') $lang = 'en';

$query = parse_url($_SERVER["REQUEST_URI"]);
$urltouse = "";
if (isset($query['host'])) $urltouse = $query['host'].$query['path'];
else $urltouse = $query['path'];
$options = array();
if (isset($query['query'])) {
	$optionsstring = explode('&', $query['query']);
	foreach ($optionsstring as $option) {
		$key = urldecode(substr($option, 0, strpos($option, '=')));
		$value = urldecode(substr($option, strpos($option, '=')+1));
		$options[$key] = $value;
	}
} unset($options['lang']);

$menuoptions = array(
	'es' => array(
		"http://www.gdmc.nl/ken/index" => "Inicio",
		"photos" => "Fotos"
	),
	'en' => array(
		"http://www.gdmc.nl/ken/index" => "Home",
		"photos" => "Photos"
	)
);

$languages = array(
	'en',
	'es'
);

$homepage = array(
	'en' => 'Photos of Ken Arroyo Ohori',
	'es' => 'Fotos de Ken Arroyo Ohori'
);

$togglenavigation = array(
	'en' => 'Toggle navigation',
	'es' => 'Alternar navegaci&oacute;n'
);

echo('<!DOCTYPE html>
<html lang="'.$lang.'">
	<head>
        <meta charset="utf-8">
        <title>Ken Arroyo Ohori');
$subtitle = substr($query['path'], strrpos($query['path'], '/')+1, strrpos($query['path'], '.')-strrpos($query['path'], '/')-1);
if (isset($menuoptions[$lang][$subtitle])) echo(' | '.$menuoptions[$lang][$subtitle]);
echo('</title>
		<meta name="description" content="'.$homepage[$lang].'">
		<meta name="keywords" content="Ken Arroyo,Ken Arroyo Ohori,Gustavo Adolfo Ken Arroyo Ohori,photos,fotos">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Ken Arroyo Ohori">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/blueimp-gallery.min.css" rel="stylesheet">
		<link href="css/ken.css" rel="stylesheet">
		<link href="css/black.css" rel="stylesheet">
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-default" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">'.$togglenavigation[$lang].'</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="http://www.gdmc.nl/ken/index.php">Ken Arroyo Ohori</a>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
');
				
foreach($menuoptions[$lang] as $page => $option) {
echo("\t\t\t\t\t\t");
if ($subtitle == $page) echo('<li class="active">');
else echo ("<li>");
echo('<a href="'.$page.'.php">'.$option."</a></li>\n");
}

echo('					</ul>
				<ul class="nav navbar-nav pull-right">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$lang.' <b class="caret"></b></a>
						<ul class="dropdown-menu">'."\n");

foreach ($languages as $thislang) {
if ($thislang != $lang) {
echo('								<li><a href="'.$urltouse);
if (sizeof($options) > 0) echo('?');
echo(str_replace('+', '%20', http_build_query($options)));
if (sizeof($options) > 0) echo ('&');
else echo('?');
echo('lang='.$thislang.'">'.$thislang.'</a></li>'."\n");
}
}
					
echo('							</ul>
					</li>
				</ul>
			</div>
		</div>
		<div id="wrap">
			<div id="main" class="clear-top">'."\n");
?>
