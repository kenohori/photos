<?php
include('cabeza.php');

$lang = 'es';

$localisedtext = array(
	'en' => array(
		'Previous' => 'Previous',
		'Next' => 'Next',
		'Slideshow' => 'Slideshow',
		'Download' => 'Download',
		'Albums' => 'Albums',
		'albums' => 'albums',
		'photos' => 'photos'),
	'es' => array(
		'Previous' => 'Anterior',
		'Next' => 'Siguiente',
		'Slideshow' => 'Diapositivas',
		'Download' => 'Descargar',
		'Albums' => '&Aacute;lbums',
		'albums' => '&aacute;lbums',
		'photos' => 'fotos'),
);

$geonames = array(
	'en' => array(
		'Lugares' => 'Places',
		'Viajes' => 'Trips',
		'Lovaina' => 'Leuven',
		'Escocia e Inglaterra' => 'Scotland and England',
		'Estambul' => 'Istambul',
		'Francia e Italia' => 'France and Italy',
		'Eslovaquia y Austria' => 'Slovakia and Austria',
		'Italia' => 'Italy',
		'Inglaterra' => 'England',
		'Dinamarca' => 'Denmark',
		'Nueva York y Boston' => 'New York and Boston',
		'Europa' => 'Europe',
		'Tailandia' => 'Thailand',
		'Argentina, Uruguay y Chile' => 'Argentina, Uruguay and Chile',
		'Praga' => 'Prague',
		'Islandia' => 'Iceland',
		'Reino Unido' => 'United Kingdom',
		'Vietnam y Camboya' => 'Vietnam and Cambodia',
		'Suiza, Alemania y Liechtenstein' => 'Switzerland, Germany and Liechtenstein',
		'Marruecos' => 'Morroco',
		'Alemania, Eslovenia, Croacia y Bosnia' => 'Germany, Slovenia, Croatia and Bosnia',
		'Tula y Real del Monte' => 'Tula and Real del Monte',
		'Egipto' => 'Egypt',
		'Oeste de Sicilia' => 'Western Sicily',
		'Bolduque' => '\'s-Hertogenbosch',
		'Gante' => 'Ghent',
		'Nimega' => 'Nijmegen',
		'Lieja' => 'Li&egrave;ge',
		'La Haya' => 'The Hague',
		'Frisia' => 'Friesland',
		'Escalda oriental' => 'Eastern Scheldt',
		'Aquisgran' => 'Aachen',
		'Ciudad de Mexico' => 'Mexico City',
		'Rio Rin' => 'River Rhine',
		'Cerdena' => 'Sardinia',
		'Irlanda' => 'Ireland',
		'Belgica' => 'Belgium',
		'Espana' => 'Spain',
		'Japon' => 'Japan',
		'Japon y China' => 'Japan and China',
		'Tequisquiapan y Bernal' => 'Tequisquiapan and Bernal',
		'Sureste de Asia y Dubai' => 'Southeast Asia and Dubai',
		'Playas de Oaxaca' => 'Oaxacan Beaches',
		'Republica Checa' => 'Czech Republic',
		'Cataluna' => 'Catalonia',
		'Qatar e India' => 'Qatar and India',
		'Noruega' => 'Norway',
		'La Luna' => 'The Moon',
		'Japon y Corea del Sur' => 'Japan and South Korea',
		'Rumania' => 'Romania',
		'Chipre' => 'Cyprus',
		'Suroeste de Inglaterra' => 'Southwest England',
		'Alemania y Paises Bajos' => 'Germany and the Netherlands',
		'Polonia' => 'Poland',
		'Este de Sicilia' => 'Eastern Sicily',
		'Bosnia y Montenegro' => 'Bosnia and Montenegro',
		'Israel, Palestina y Jordania' => 'Israel, Palestine and Jordan',
		'Escocia' => 'Scotland',
		'Sur de Francia y Andorra' => 'Southern France and Andorra',
		'Sureste de Asia y Abu Dabi' => 'Southeast Asia and Abu Dhabi',
		'Barrancas del Cobre y Baja California' => 'Copper Canyon and Baja California'
	),
	'es' => array(
		'Aquisgran' => 'Aquisgrán',
		'Amsterdam' => 'Ámsterdam',
		'Ciudad de Mexico' => 'Ciudad de México',
		'Rio Rin' => 'Río Rin',
		'Teotihuacan' => 'Teotihuacán',
		'Cerdena' => 'Cerdeña',
		'Belgica' => 'Bélgica',
		'Espana' => 'España',
		'Paris' => 'París',
		'Japon' => 'Japón',
		'Japon y China' => 'Japón y China',
		'Tepoztlan' => 'Tepoztlán',
		'Mazatlan' => 'Mazatlán',
		'Bajio' => 'Bajío',
		'Republica Checa' => 'República Checa',
		'Cataluna' => 'Cataluña',
		'Japon y Corea del Sur' => 'Japón y Corea del Sur',
		'Alemania y Paises Bajos' => 'Alemania y Países Bajos',
		'Andalucia' => 'Andalucía'
	)
);

$album = $_GET['album'];
if (PHP_OS == "Linux") $album = urldecode($album);
$basedir = $album.'/';
if (!isset($_GET['album'])) {
	$basedir = '';
} if (is_dir('./albums/'.$basedir) and strpos($basedir, '..') === FALSE) {

	// Get the contents and count them
	$entries = scandir('./albums/'.$basedir);
	$shownentries = array();
	$datedentries = array();
	$albumshere = 0;
	$photoshere = 0;
	foreach ($entries as $entry) {
		if ($entry[0] != '.') {
			if (preg_match('/^[0-9]{4}-[0-9]{2}/', $entry)) $datedentries[] = $entry;
			else $shownentries[] = $entry;
			if (is_dir('./albums/'.$basedir.$entry)) $albumshere++;
			else if (strpos(strtolower($entry), '.jpg') !== FALSE) $photoshere++;
		}
	} arsort($datedentries);
	$shownentries = array_merge($shownentries, $datedentries);
	
	// Bread crumbs
	echo('				<ul class="breadcrumb">'."\n");
	$folders = explode('/', $_GET['album']);
	if (!isset($_GET['album'])) {
		echo('					<li class="active">'.$localisedtext[$lang]['Albums'].' (');
		if ($albumshere > 0) {
			echo($albumshere.' '.$localisedtext[$lang]['albums']);
			if ($photoshere > 0) echo(', '.$photoshere.' '.$localisedtext[$lang]['photos']);
		} else if ($photoshere > 0) echo($photoshere.' '.$localisedtext[$lang]['photos']);
		echo(')</li>'."\n");
	} else {
		echo('					<li><a href="fotos.php">'.$localisedtext[$lang]['Albums'].'</a></li> <span class="divider">/</span>'."\n");
	} $pathsofar = '';
	for ($i = 0; $i < sizeof($folders) and isset($_GET['album']); $i++) {
		$folder = $folders[$i];
		$displayfolder = preg_replace('/^[0-9]{4}-[0-9]{2} /', '', $folder);
		if (isset($geonames[$lang][$displayfolder])) $displayfolder = $geonames[$lang][$displayfolder];
		if ($i < sizeof($folders)-1) {
			$pathsofar .= $folder;
			echo('					<li><a href="fotos.php?album='.$pathsofar.'">'.$displayfolder.'</a></li> <span class="divider">/</span>'."\n");
			$pathsofar .= '/';
		} else {
			if (PHP_OS == "Linux") echo('					<li class="active">'.$displayfolder.' (');
			else echo('					<li class="active">'.$displayfolder.' (');
			if ($albumshere > 0) {
				echo($albumshere.' '.$localisedtext[$lang]['albums']);
				if ($photoshere > 0) echo(', '.$photoshere.' '.$localisedtext[$lang]['photos']);
			} else if ($photoshere > 0) echo($photoshere.' '.$localisedtext[$lang]['photos']);
			echo(')</li>'."\n");
		}
	} echo('				</ul>'."\n");
	
	// Start
	$year = -1;
	foreach ($shownentries as $entry) {
		$thisyear = substr($entry, 0, 4);
		if (!preg_match('/^[0-9]{4}$/', $thisyear)) $thisyear = '';
		if ($thisyear != $year) {
			if ($year != -1) {
				echo('				<br><br>'."\n");
			} if ($thisyear != '') {
				echo('				<p class="lead">'.$thisyear."</p><hr>\n");
			} //echo('				<div id="photos" class="container">'."\n");
			$year = $thisyear;
		} 
		
		// For directories
		if (is_dir('./albums/'.$basedir.$entry)) {
			$directoriestocheck = array();
			$directoriestocheck[] = $basedir.$entry;
			$photosindirectory = array();
			$itemsindir = 0;
			$filesinthisdir = scandir('./albums/'.$basedir.$entry);
			foreach ($filesinthisdir as $file) {
				if ($file[0] != '.') $itemsindir++;
			} while (sizeof($directoriestocheck) > 0) {
				$thisdirectory = array_pop($directoriestocheck);
				if (strpos($thisdirectory, '.') !== FALSE) continue;
				if (!file_exists('./thumbnails/'.$thisdirectory)) mkdir('./thumbnails/'.$thisdirectory);
				$filesindir = scandir('./albums/'.$thisdirectory);
				foreach ($filesindir as $file) {
					if (is_dir('./albums/'.$thisdirectory.'/'.$file)) $directoriestocheck[] = $thisdirectory.'/'.$file;
					else if (strpos(strtolower($file), '.jpg') !== FALSE) $photosindirectory[] = $thisdirectory.'/'.$file;
				}
			} $randomphotokey = array_rand($photosindirectory);
			if (!file_exists('./thumbnails/'.$photosindirectory[$randomphotokey])) {
				$image = imagecreatefromjpeg('./albums/'.$photosindirectory[$randomphotokey]);
				$orig_width = (float)imagesx($image);
				$orig_height = (float)imagesy($image);
				$orig_ratio = $orig_height/$orig_width;
				$height = 200.0;
				$width = $height/$orig_ratio;
				$new_image = imagecreatetruecolor($width, $height);
				imagecopyresampled($new_image, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
				imagejpeg($new_image, './thumbnails/'.$photosindirectory[$randomphotokey]);
			} $displayentry = preg_replace('/^[0-9]{4}-[0-9]{2} /', '', $entry);
			if (isset($geonames[$lang][$displayentry])) {
				if (PHP_OS == "Linux") $displayentry = utf8_decode($geonames[$lang][utf8_encode($displayentry)]);
				else $displayentry = $geonames[$lang][$displayentry];
			} if (PHP_OS == "Linux") echo('				<div style="display:inline-block"><a href="fotos.php?album='.utf8_encode(str_replace('%2F', '/', rawurlencode($basedir.$entry))).'" class="thumbnail text-center" style="margin:5px"><img src="./thumbnails/'.utf8_encode(str_replace('%2F', '/', rawurlencode($photosindirectory[$randomphotokey]))).'"><div class="caption"><i class="fa fa-folder-o"></i> '.utf8_encode($displayentry).' ('.$itemsindir.')</div></a></div>'."\n");
			else echo('				<div style="display:inline-block"><a href="fotos.php?album='.$basedir.$entry.'" class="thumbnail text-center" style="margin:5px"><img src="./thumbnails/'.$photosindirectory[$randomphotokey].'"><div class="caption"><i class="fa fa-folder-o"></i> '.$displayentry.' ('.$itemsindir.')</div></a></div>'."\n");
			//else echo('					<a href="fotos.php?album='.$basedir.$entry.'" class="thumbnail"><img src="./thumbnails/'.$photosindirectory[$randomphotokey].'"><div class="caption"><i class="icon-folder-close-alt"></i> '.$displayentry.' ('.$itemsindir.')</div></a>'."\n");
		} 
		
		// For single files
		else {
			if (!file_exists('./thumbnails/'.$basedir.$entry)) {
				$image = imagecreatefromjpeg('./albums/'.$basedir.$entry);
				$orig_width = (float)imagesx($image);
				$orig_height = (float)imagesy($image);
				$orig_ratio = $orig_height/$orig_width;
				$height = 200.0;
				$width = $height/$orig_ratio;
				$new_image = imagecreatetruecolor($width, $height);
				imagecopyresampled($new_image, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
				imagejpeg($new_image, './thumbnails/'.$basedir.$entry);
			} if (PHP_OS == "Linux") echo('				<div style="display:inline-block"><a href="./albums/'.utf8_encode(str_replace('%2F', '/', rawurlencode($basedir.$entry))).'" title="'.$entry.'" class="thumbnail" data-gallery style="margin:5px"><img src="./thumbnails/'.utf8_encode(str_replace('%2F', '/', rawurlencode($basedir.$entry))).'" alt="'.$entry.'"></a></div>'."\n");
			else echo('				<div style="display:inline-block"><a href="./albums/'.$basedir.$entry.'" title="'.$entry.'" class="thumbnail" data-gallery style="margin:5px"><img src="./thumbnails/'.$basedir.$entry.'" alt="'.$entry.'"></a></div>'."\n");
		}
	} //echo('				</div>'."\n");
	echo('				<div id="blueimp-gallery" class="blueimp-gallery">
					<div class="slides"></div>
    				<h3 class="title"></h3>
    				<a class="prev">‹</a>
    				<a class="next">›</a>
    				<a class="close">×</a>
    				<a class="play-pause"></a>
    				<ol class="indicator"></ol>
				</div>'."\n");
} else {
	echo ('<p>WTF!<p>');
}

include('pie.php');
?>
