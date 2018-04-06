<?php

//ldap
    $adServer = 'localhost';
    $ldap = ldap_connect($adServer);
    $username = 'cn=admin,dc=ru';
    $password = 'ldappass';
    $ldaprdn =  $username;
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
    $bind = ldap_bind($ldap, $ldaprdn, $password);
   
	

?>