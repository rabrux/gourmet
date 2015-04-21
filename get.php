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
	if (strpos($e->innertext, '<h3>') !== false) {
		$header = preg_replace(array('/\&nbsp;/', '/\$/'), array('', ''), $e->innertext);
		$header = trim( strip_tags( $header ) );
		$array[$header] = array();
	} else {
		$flag = true;
		foreach ($e->find('td') as $f) {
			$platillo = array();
			if ($flag) {
				var_dump('name');
				// $platillo['name'] = trim( strip_tags( $f->innertext ) );
				// $flag = false;
			} else {
				var_dump('price');
				// $platillo['price'] = trim( strip_tags( $f->innertext ) );
			}
		}
		// var_dump($platillo);
		// exit;
	}
	// foreach ($e->find('td') as $f) {
		
	// }
	// var_dump(trim( strip_tags( $e->innertext ) ));
	// exit;
	// $arr[] = trim( strip_tags( $e->innertext ) );
}

var_dump($array); exit;

// foreach($html->find('table tr td') as $e){
// 	var_dump($e); 
// 	$arr[] = trim( strip_tags( $e->innertext ) );
// }

// print_r($arr); exit;

// $html = str_get_html($vartables);   
// $theData = array();

// foreach($html->find('table') as $onetable){
// foreach($onetable->find('tr') as $row) {

//     $rowData = array();
//     foreach($row->find('td') as $cell) {
//         if(substr_count($cell->innertext,"src")>0){
//         foreach($cell->find('img') as $element) {
//         $rowData[] = $element->src;
//         }
//         }else{
//         $rowData[] = $cell->innertext;
//         }
//     }

//     $theData[] = $rowData;
// }
// }

echo json_encode($theData); exit;

print_r($theData);

function httpGet($url)
{
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//  curl_setopt($ch,CURLOPT_HEADER, false); 
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}
?>

string(30) "Sopas                        $"
string(38) "&nbsp;                       Ensaladas"
string(38) "&nbsp;                       Antojitos"
string(37) "&nbsp;                       Guisados"
string(36) "&nbsp;                       Postres"