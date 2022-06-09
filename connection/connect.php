<?php $conn = oci_connect('Cleckshop', '6114', '//localhost/xe'); if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit; 
}
?>
