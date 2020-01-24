<?php
//mssql_connect('SQL6006.site4now.net', 'DB_A42642_velocityapp_admin', 'velocity2018');


$server = 'SQL6006.site4now.net, 1433';
$connectionInfo = array( "Database"=>"DB_A42642_velocityapp", "UID"=>"DB_A42642_velocityapp_admin", "PWD"=>"velocity2018");
$conn = sqlsrv_connect( $server, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Not Connected.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>