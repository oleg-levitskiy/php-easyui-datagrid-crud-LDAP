<?php

$cn = htmlspecialchars($_REQUEST['cn']);

include 'Ldap_connect.php';

if ($bind) {
//	echo 'bind ok';
	$isertdata["objectclass"] = "inetOrgPerson";
    $isertdata["cn"] = $cn;
    $isertdata["sn"] = htmlspecialchars($_REQUEST['sn']);
	$isertdata["givenname"] = htmlspecialchars($_REQUEST['givenname']);
	$isertdata["mail"] = htmlspecialchars($_REQUEST['mail']);
	$isertdata["telephonenumber"] = htmlspecialchars($_REQUEST['telephonenumber']);
	$isertdata["mobile"] = htmlspecialchars($_REQUEST['mobile']);
	$isertdata["homephone"] = htmlspecialchars($_REQUEST['homephone']);
	$isertdata["departmentnumber"] = htmlspecialchars($_REQUEST['departmentnumber']);    

    // Добавление данных
    $r = ldap_add($ldap, 'cn='.$isertdata["cn"].', ou=customphonebook,dc=ru', $isertdata);

//	echo $r;
	
    @ldap_close($ldap);
	
	echo json_encode(array(
		'cn' => $isertdata["cn"],
		'givenname' => $isertdata["givenname"]
		));	
	
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>