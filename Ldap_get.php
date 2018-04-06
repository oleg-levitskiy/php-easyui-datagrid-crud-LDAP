<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$resultjson = array();
	

include 'Ldap_connect.php';

    if ($bind) {
  //  echo 'binding';
        $filter="(objectClass=*)";
        $result = ldap_search($ldap,"ou=customphonebook,dc=ru",$filter);
        ldap_sort($ldap,$result,"cn");
        $info = ldap_get_entries($ldap, $result);
		
	//	echo '<br> INFO: <br>';
		
		
  //    echo('INFO COUNT:'.$info["count"].'<br>');
	  	  
	  $records = array();
	  $items = array();
	   $resultjson["total"] = $info["count"];	
	  unset($info["count"]);
	  unset($info[0]);
	  
//	  echo('<pre>');
 //          print_r($info);
//        echo('</pre>');
	  
	//  for ($i=0; $i<$info["count"]; $i++)
		foreach ($info as $infoarrays => $infoarraysvalue)
        {
  //         echo $i.'===================================================';
          
	//	  echo('<pre>');
             //print_r($infoarrays);
	//		 print_r($infoarraysvalue);
   //        echo('</pre>');
		  
		  foreach ($infoarraysvalue as $infoelement => $infoelementvalue) {
	//		   echo '--------------------------------------------------';
			   $items[$infoelement] = $infoelementvalue[0];
			   
			  
		  }
		  
//		  echo('<pre>');
//			   print_r($infoelement);
//			   echo (' = ');
  //           print_r($items);
 //          echo('</pre>'); 

		  
 //          echo "cn:". $info[$i]["cn"][0] .", givenname:" . $info[$i]["givenname"][0] .",  sn:".$info[$i]["sn"][0]."<br>";
            //echo '<pre>';
            //var_dump($info);
            //echo '</pre>';
            //$userDn = $info[$i]["distinguishedname"][0];
       
	array_push($records, $items);
	
	

	   }
	   
	   
	//   echo('<br>TEST');
	   
	   $resultjson["rows"] = $records;
//print_r($resultjson);
	echo json_encode($resultjson);
	
	
	   
        @ldap_close($ldap);
    } else {
        $msg = "Invalid email address / password";
        echo $msg;
    }
	
	

?>