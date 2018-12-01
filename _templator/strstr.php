<?php

function strStartsWith($string1, $start) {
  $len1 = strlen($string1);
  $len2 = strlen($start);
  if($len2 > $len1) {
    return false;
  }
  $tmp_start = substr($string1, 0, $len2);
  return (0 == strcasecmp($tmp_start, $start));
}

function strEndsWith($string1, $end) {
	$len1 = strlen($string1);
	$len2 = strlen($end);
	if($len2 > $len1) {
		return false;
	}

	$tmp_end = substr($string1, $len1 - $len2, $len2);
	return (0 == strcasecmp($tmp_end, $end));
} // end function "strEndsWith"

/**
 * Find the last occurence of "$patt" within the given String "$str".
 * @param type $str   the String to look for the last occurence of "patt"
 * @param type $patt  this pattern will be searched for within "str"
 * @return int -1, iff $patt does not occure in $str. The last occurence of "patt" otherwise
 */
function strFindLastPos($str, $patt) {
    $lastFoundPos = -1;
    $tstPos       =  0;
    while($tstPos < strlen($str)) {
      $strEnd = substr($str, $tstPos);
      if(strStartsWith($strEnd, $patt)) {
          $lastFoundPos = $tstPos;
      }
      $tstPos++;
    }
    return $lastFoundPos;
  }

  function strIsSet($string) {
    if(! isset($string)    ) { return false; }
    if(strlen($string) <= 0) { return false; }
    return true;
  }

?>
