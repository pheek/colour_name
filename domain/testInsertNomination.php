<?php

require_once 'InsertNomination.class.php';

 $in = new InsertNomination();
 $rgbID = $in->getRgbID(111, 112, 130);

 echo "rgbid = " . $rgbID;

?>