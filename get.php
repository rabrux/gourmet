<?php

header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

// httpGet('http://www.elbuengourmet.mx/menu-de-hoy.php');

include_once 'simple_html_dom.php';

$html = str_get_html(httpGet('http://www.elbuengourmet.mx/menu-de-hoy.php'));

$array = array();

foreach ($html->find('table tr') as $e) {
	$tiempo = false;
	if (strpos($e->innertext, '<h3>') !== false) {
		$header = preg_replace(array('/\&nbsp;/', '/\$/'), array('', ''), $e->innertext);
		$header = trim( strip_tags( $header ) );
		$array[$header] = array();
		$platillos = array();
	} else {
		$flag = true;
		$platillo = array();
		foreach ($e->find('td') as $f) {
			if ($flag) {
				$flag = false;
				$platillo['name'] = trim( strip_tags( $f->innertext ) );
			} else {
				$platillo['price'] = trim( strip_tags( $f->innertext ) );
			}
		}
		array_push($platillos, $platillo);
	}

	//$array[$header] = array_merge($platillos, $platillos);
	$array[ $header ] = $platillos;

}
header('Content-Type: application/json', true, 200);
echo json_encode($array); exit;

function httpGet($url)
{
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}
?>

