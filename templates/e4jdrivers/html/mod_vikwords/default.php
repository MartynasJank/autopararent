<?php  
/**------------------------------------------------------------------------
 * mod_vikwords
 * ------------------------------------------------------------------------
 * author    Valentina Arras - Extensionsforjoomla.com
 * copyright Copyright (C) 2014 extensionsforjoomla.com. All Rights Reserved.
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * Websites: http://www.extensionsforjoomla.com
 * Technical Support:  templates@extensionsforjoomla.com
 * ------------------------------------------------------------------------
*/

defined('_JEXEC') or die('Restricted Area'); 
//jimport( 'joomla.methods' );
//JHTML::_('behavior.mootools');

$document = JFactory::getDocument();

JHtml::_('stylesheet', JURI::root().'modules/mod_vikwords/mod_vikwords.css', false, true, false, false);


$get_width = $params->get('width');
$get_height = $params->get('height');
$get_color = $params->get('colortitle');
$get_quotes = $params->get('addquotes');

$get_delay = $params->get('txt_delay');
$get_fadein = $params->get('txt_fadein');
$get_fadeout = $params->get('txt_fadeout');

?>

<?php for($v = 1; $v <= 10; $v++) {
	$get_title = $params->get('title_'.$v);
	$get_text = $params->get('text_'.$v);
	$slide_item = "";

	if(!empty($get_title) || ($get_text)) {
		$slide_item .= "<div class=\"vikqt_box\">";
		if(!empty($get_title)) {			
			$slide_item .="<span class=\"vikqt_title\" style=\"color:".$get_color.";\">".$get_title."</span>";
		}
		if(!empty($get_text)) {
			$slide_item .="<p class=\"vikqt_desc\">".$get_text."</p>";
		}
		$slide_item .= "</div>";
		$arrslide[]=$slide_item;
	}
}

 ?>
<?php if($get_quotes == 1) {?>
<div class="vikqt-quotes"></div>
<?php } ?>
<div class="vikqt-slide" style="width:<?php echo $get_width; ?>; height:<?php echo $get_height ?>;">
<?php
    if (is_array($arrslide)) {
		foreach($arrslide as $vsl) {			
			echo $vsl;
		}
	}
?>
</div>

<script language="JavaScript" type="text/javascript">
	jQuery(function($) {
	(function() {

    var quotes = $(".vikqt_box");
    var quoteIndex = -1;
    
    function showNextQuote() {
        ++quoteIndex;
        quotes.eq(quoteIndex % quotes.length)
            .fadeIn(<?php echo $get_delay; ?>)
            .delay(<?php echo $get_fadein; ?>)
            .fadeOut(<?php echo $get_fadeout; ?>, showNextQuote);
    }
    
    showNextQuote();
    
})() 
});
</script>
