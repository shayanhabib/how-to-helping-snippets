<?php // how to validate card php
function validatecard($number) {
    global $type;

    $cardtype = array(
        'visa' => '/^4[0-9]{12}(?:[0-9]{3})?$/',
        'mastercard' => '/^5[1-5][0-9]{14}$/',
        'amex' => '/^3[47][0-9]{13}$/',
        'diners' => '/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/',
        'discover' => '/^6(?:011|5[0-9]{2})[0-9]{12}$/',
        'jcb' => '/^(?:2131|1800|35\d{3})\d{11}$/',
        'any' => '/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/'
    );

    if (preg_match($cardtype['visa'],$number)) {
		$type= "visa";
        return 'visa';
    }
    else if (preg_match($cardtype['mastercard'],$number)) {
		$type= "mastercard";
        return 'mastercard';
    }
    else if (preg_match($cardtype['amex'],$number)) {
		$type= "amex";
        return 'amex';
    }
    else if (preg_match($cardtype['diners'],$number)) {
		$type= "diners";
        return 'diners';
    }
    else if (preg_match($cardtype['discover'],$number)) {
		$type= "discover";
        return 'discover';
    }
    else if (preg_match($cardtype['jcb'],$number)) {
		$type= "jcb";
        return 'jcb';
    }
    else {
		$type= "any";
        //return 'any';
        return false;
    } 
 }