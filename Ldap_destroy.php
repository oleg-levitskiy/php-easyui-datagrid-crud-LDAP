<?php
$cn = htmlspecialchars($_REQUEST['cn']);
include 'Ldap_connect.php';
if ($bind) {
//	echo 'bind ok'; 
    // Удаление данных
    $r = ldap_delete($ldap, 'cn='.$cn.',ou=customphonebook,dc=ru');
//	echo $r;
if ($r){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}	
    @ldap_close($ldap);	
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>