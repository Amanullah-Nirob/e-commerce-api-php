<?php

class Product{

	//database connection and table name
	private $conn;
	private $table_name ="products";

    // object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name; 
    public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //read function

    // read products
	function read(){
	 
	    // select all query
	    $query = "SELECT * FROM $this->table_name";
	 
	    // prepare query statement
	    $stmt = mysqli_query($this->conn,$query);

	    return $stmt;
	}


	//create product

	function create(){

	     // sanitize
	    $this->name=htmlspecialchars(strip_tags($this->name));
	    $this->price=htmlspecialchars(strip_tags($this->price));
	    $this->description=htmlspecialchars(strip_tags($this->description));
	    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
	    $this->category_name=htmlspecialchars(strip_tags($this->category_name));

	 
	    // query to insert record
	    $query = "INSERT INTO  $this->table_name (name,price,description,category_id,category_name) VALUES ('$this->name','$this->price','$this->description','$this->category_id','$this->category_name')";
	                                      
	 
	    // prepare query
	    // $stmt = mysqli_query($this->conn,$query);


	    // execute query
	    if($stmt = mysqli_query($this->conn,$query)){
	        return true;
	    }
	 
	    return false;
     
  
  }


  // used when filling up the update product form
function readOne(){
    // query to read single record
    $query = "SELECT * FROM $this->table_name";
 
    // prepare query statement
 
    $stmt = mysqli_query($this->conn,$query );
 
    // get retrieved row
    $row = mysqli_fetch_array($stmt);
 
    // set values to object properties
    $this->name = $row['name'];
    $this->price = $row['price'];
    $this->description = $row['description'];
    $this->category_id = $row['category_id'];
    $this->category_name = $row['category_name'];
   }



   // update the product
	function update(){

	    // sanitize
	    $this->name=htmlspecialchars(strip_tags($this->name));
	    $this->price=htmlspecialchars(strip_tags($this->price));
	    $this->description=htmlspecialchars(strip_tags($this->description));
	    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
	    $this->id=htmlspecialchars(strip_tags($this->id));
	 
	    // update query
	    $query = "UPDATE $this->table_name SET name = '$this->name', price = '$this->price',description = '$this->description',category_id = '$this->category_id' WHERE id ='$this->id' ";
	 
	    // prepare query statement

	    // execute the query
	    if(mysqli_query($this->conn,$query)){
	        return true;
	    }
	 
	    return false;
	}


	// delete the product
	function delete(){
	    // sanitize
	    $this->id=htmlspecialchars(strip_tags($this->id));
	 
	    // delete query
	    $query = "DELETE FROM " . $this->table_name . " WHERE id =".$this->id."";
	 
	    // prepare query
	    $stmt = mysqli_query($this->conn,$query);
	 

	    if($stmt){
	        return true;
	    }
	 
	    return false;
	     
	}


	function search($keywords){

	    $keywords=htmlspecialchars(strip_tags($keywords));
	   // $keywords = "%{$keywords}%";
	 
	    // select all query
	    $query = "SELECT FROM $this->table_name  WHERE
		         name LIKE '%{$keywords}%' OR description LIKE '%{$keywords}%' OR category_name LIKE '%{$keywords}%' ";
	 
	    // prepare query statement
	    $stmt = mysqli_query($this->conn,$query);
	 
	    return $stmt;
	}

}