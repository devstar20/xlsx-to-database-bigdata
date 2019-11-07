<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
//ini_set('MAX_EXECUTION_TIME', '-1');

require_once __DIR__.'/../src/SimpleXLSX.php';

echo '<h1>Parse pricingtableupload.xslx</h1><pre>';
if ( $xlsx = SimpleXLSX::parse('new.xlsx') ) {
	//print_r( $xlsx->rows() );
	
		
	  //$conn = new PDO( "mysql:host=localhost;dbname=test_xlsx", "root", "");
      // $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  $id = 196001;
	  $db_host = "localhost";
	  $db_username = "root";
		$db_password = "";
		$db_name = "test_xlsx";

$db_connection = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die('Cannot Connect');
	
	ini_set('max_execution_time', 600);
	set_time_limit(600);


 	foreach ($xlsx->rows() as $fields)
    {
		$id ++;
			$sql = "INSERT INTO wp_pricing_lookup (
					id,
					system, 
					code, 
					provide_id, 
					total_discharges, 
					average_covered_charges, 
					average_total_payments, 
					average_payments_made, 
					difference
					) 
					VALUES (
					'".$id."',
					'".$fields[0]."',
					'".$fields[1]."',
					'".$fields[2]."',
					'".$fields[3]."',
					'".$fields[4]."',
					'".$fields[5]."',
					'".$fields[6]."',
					'".$fields[7]."');
					"; 
					mysqli_query($db_connection, $sql);
    }
	
	/* $stmt = $conn->prepare( "INSERT INTO wp_pricing_lookup (system, code, provide_id, total_discharges, average_covered_charges, average_total_payments, average_payments_made, difference) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindParam( 1, $system);
    $stmt->bindParam( 2, $code);
    $stmt->bindParam( 3, $provide_id);
    $stmt->bindParam( 4, $total_discharges);
    $stmt->bindParam( 5, $average_covered_charges);
	$stmt->bindParam( 6, $average_total_payments);
	$stmt->bindParam( 7, $average_payments_made);
	$stmt->bindParam( 8, $difference);
   */
	
	
} else {
	echo SimpleXLSX::parseError();
}
echo '<pre>';