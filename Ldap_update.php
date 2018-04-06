<?php
$cn = htmlspecialchars($_REQUEST['cn']);
include 'Ldap_connect.php';
if ($bind) {
    $moddata["sn"] = htmlspecialchars($_REQUEST['sn']);
	$moddata["givenname"] = htmlspecialchars($_REQUEST['givenname']);
	$moddata["mail"] = htmlspecialchars($_REQUEST['mail']);
	$moddata["telephonenumber"] = htmlspecialchars($_REQUEST['telephonenumber']);
	$moddata["mobile"] = htmlspecialchars($_REQUEST['mobile']);
	$moddata["homephone"] = htmlspecialchars($_REQUEST['homephone']);
	$moddata["departmentnumber"] = htmlspecialchars($_REQUEST['departmentnumber']);    
	
//	echo 'bind ok'; 
    // Удаление данных
    $r = ldap_modify($ldap, 'cn='.$cn.',ou=customphonebook,dc=ru',$moddata);
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