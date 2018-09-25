<?php
function parseEmoticons ($text) {

    $emoticons = array();
    $emoticons[] = array(":)", "<img src='modules/Forums/images/smiles/icon_smile.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":D", "<img src='modules/Forums/images/smiles/icon_biggrin.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":(", "<img src='modules/Forums/images/smiles/icon_sad.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array("8O", "<img src='modules/Forums/images/smiles/icon_eek.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":?", "<img src='modules/Forums/images/smiles/icon_confused.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array("8)", "<img src='modules/Forums/images/smiles/icon_cool.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":lol:", "<img src='modules/Forums/images/smiles/icon_lol.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":x", "<img src='modules/Forums/images/smiles/icon_mad.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":P", "<img src='modules/Forums/images/smiles/icon_razz.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":oops:", "<img src='modules/Forums/images/smiles/icon_redface.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":cry:", "<img src='modules/Forums/images/smiles/icon_cry.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":evil:", "<img src='modules/Forums/images/smiles/icon_evil.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":twisted:", "<img src='modules/Forums/images/smiles/icon_twisted.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":roll:", "<img src='modules/Forums/images/smiles/icon_twisted.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":wink:", "<img src='modules/Forums/images/smiles/icon_wink.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":!", "<img src='modules/Forums/images/smiles/icon_exclaim.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":?", "<img src='modules/Forums/images/smiles/icon_question.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":idea:", "<img src='modules/Forums/images/smiles/icon_idea.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":arrow:", "<img src='modules/Forums/images/smiles/icon_arrow.gif' alt='' align='absmiddle' BORDER=0>");
    $emoticons[] = array(":o", "<img src='modules/Forums/images/smiles/icon_surprised.gif' alt='' align='absmiddle' BORDER=0>");
    foreach ($emoticons as $emoticon) {
	    $text = str_replace($emoticon[0],$emoticon[1],$text);
    }
    return $text;
}

?>
