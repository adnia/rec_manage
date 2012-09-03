<?php

/**
 * Has form data been submitted?
 * 
 * @param $submit_id The form's submit button's ID in case there are
 *                   more than one forms displayed on one page.
 * 
 * @return true, if form data has been sent (i.e. we had a POST request)
 *         and false otherwise.
 */
function formDataSent($submit_id) {
	return ($_SERVER['REQUEST_METHOD'] == "POST"
		&& checkExistance($_POST, $submit_id));
}



/**
 * Debug function. Produce nicer output for var_dump().
 */
function htmldump($variable, $height="9em") {
	echo "<pre style=\"border: 1px solid #000; height: {$height}; overflow: auto; margin: 0.5em;\">";
	var_dump($variable);
	echo "</pre>\n";
}



/**
 * Check, whether a given parameter was specified in an associative
 * array
 * 
 * @param $params
 *   Associative array to check
 * @param $param
 *   Parameter name to check for
 * 
 * @return
 *   true, if $params contains $param,
 *   false otherwise
 */
function checkExistance($params, $param) {
	if (!isset($params[$param]))
		return false;
	if (is_string($params[$param]) && $params[$param] == "")
		return false;
	
	return true;
}

?>
