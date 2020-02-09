<?php
$arraycolors = array('0'=>'', '1'=>'', '2'=>'', '3'=>'', '4'=>'');
$tplcolor = intval($this->params->get('tcolour'));
$resp = intval($this->params->get('responsive'));
$font = intval($this->params->get('hfont'));
$bfont = intval($this->params->get('bfont'));


switch ($tplcolor) {
	case 1:
		$cssname='style_red';
		break;
	case 2:
		$cssname='style_yellow';
		break;
	case 3:
		$cssname='style_green';
		break;
	case 4:
		$cssname='style_grey';
		break;
	case 5:
		$cssname='style_black';
		break;
	default:
		$cssname='style';
		break;
}

switch ($font) {
	case 1:
		$fontfamily='<link href=\'https://fonts.googleapis.com/css?family=PT+Sans:400,700\' rel=\'stylesheet\' type=\'text/css\'>';
		$fontname='ptsans';
		break;
	case 2:
		/*$fontfamily='<link href=\'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700\' rel=\'stylesheet\' type=\'text/css\'>';*/
		$fontfamily='<link href=\'https://fonts.googleapis.com/css?family=Gloria+Hallelujah:400\' rel=\'stylesheet\' type=\'text/css\'>';
		$fontname='opensans';
		break;
	case 3:
		$fontfamily='<link href=\'https://fonts.googleapis.com/css?family=Droid+Sans:400,700\' rel=\'stylesheet\' type=\'text/css\'>';
		$fontname='droidsans';
		break;
	case 4:
		$fontfamily='';
		$fontname='centurygothic';
		break;
	case 5:
		$fontfamily='';
		$fontname='arial';
		break;
	default:
		$fontfamily='<link href=\'https://fonts.googleapis.com/css?family=Lato:300,400,700\' rel=\'stylesheet\' type=\'text/css\'>';
		$fontname='lato';
		break;
}

switch ($bfont) {
	case 1:
		$fontfamilybd='<link href=\'https://fonts.googleapis.com/css?family=PT+Sans:400,700\' rel=\'stylesheet\' type=\'text/css\'>';
		$bodyfont='ptsansbd';
		break;
	case 2:
		$fontfamilybd='<link href=\'https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700\' rel=\'stylesheet\' type=\'text/css\'>';
		$bodyfont='opensansbd';
		break;
	case 3:
		$fontfamilybd='<link href=\'https://fonts.googleapis.com/css?family=Droid+Sans:400,700\' rel=\'stylesheet\' type=\'text/css\'>';
		$bodyfont='droidsansbd';
		break;
	case 4:
		$fontfamilybd='';
		$bodyfont='centurygothicbd';
		break;
	case 5:
		$fontfamilybd='';
		$bodyfont='arialbd';
		break;
	default:
		$fontfamilybd='<link href=\'https://fonts.googleapis.com/css?family=Lato:300,400,700\' rel=\'stylesheet\' type=\'text/css\'>';
		$bodyfont='latobd';
		break;
}

?>