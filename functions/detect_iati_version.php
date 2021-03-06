<?php
/*
 * 
 * name: detect_iati_version
 * @param $xml - XML DOM returned from the get_xml function (see get_xml.php)
 * @return a valid IATI version number or FALSE
 * 
 */
function detect_iati_version ($xml) {
  include './vars.php'; //to bring in $iati_versions. Use this rather than global so that tests.php still works
  //global $iati_versions;
  //Get all iati-activities elements. There should only be one!
  if ($xml->getElementsByTagName("iati-organisation")->length == 0) {
    $version = $xml->getElementsByTagName( "iati-activities" );
    $root_element = "iati-activities";
  } else {
    $version = $xml->getElementsByTagName( "iati-organisations" );
    $root_element = "iati-organisations";
  }
  
  //Check there is only one. If there is more then one, return false
  if ($version->length != 1) {
    //echo "FALSE";
    global $error_msg;
    $error_msg .= "More than one " . $root_element . " element was found - cannot check version";
    return FALSE;
    
  }
  //Find the supplied version
  $version = $version->item(0)->getAttribute("version");
  $version = htmlspecialchars($version);
  //echo $version;
  return $version;   
}
?>
