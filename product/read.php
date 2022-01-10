<?php

//required headers

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//database connection will be here

include_once '../config/database.php';
include_once '../objects/product.php';

//instantiate database and product

$database= new Database();
$db = $database->getConnection();

$product = new Product($db);

//read products will be here

//query products

$stmt = $product->read();


if(mysqli_num_rows($stmt)>0){

	//Products array
	$products_arr = array();
	// $products_arr["records"]= array();

    while ($r = mysqli_fetch_assoc($stmt)) {
        $rows["result"][]=$r;
       }
    
       echo json_encode($rows);
    
}else{

	http_response_code(404);

	echo json_encode(
		array("message" => "No products found")
	);

}

// no product found will be here


