<?php
// Note: DataBase Name Is "csv"

$time_start = microtime(true); //To show how long it took to process

// To store the temporarily data get from User 
$file = $_FILES["file"]["name"];
$table = $_POST['table'];
$pass='';

// To Read the CSV file 
ini_set('auto_detect_line_endings',TRUE);
$handle = fopen($file,'r');

// To Check the file 
if ( ($data = fgetcsv($handle) ) === FALSE ) {
?>	<h2 style="text-align: center;">Cannot read from csv <?php echo $file;  ?>  </h2>
   <?php
	die();
}
$fields = array();
$field_count = 0;

// To Create a Table with the Given table name by User
for($i=0;$i<count($data); $i++) {
    $f = strtolower(trim($data[$i]));
	
    if ($f) {
		$f = substr(preg_replace ('/[^0-9a-z]/', '_', $f), 0, 20);
        $field_count++;
        $fields[] = $f.' VARCHAR(50)';
		if($data[$i]=='password' || $data[$i]=='Password' ){
			$pass=$data[$i];
        
		}

    }
}

// To Connect the Database
$con=mysqli_connect("localhost","root","","csv");

// To Create a Table with the Given table name by User
$sql1 = "CREATE TABLE $table (" . implode(', ', $fields) . ')';
$reg1= mysqli_query($con,$sql1);

// To Insert the Data to the Database table
mysqli_query($con, '
    LOAD DATA LOCAL INFILE "'.$file.'"
        INTO TABLE '.$table.'
        FIELDS TERMINATED by \',\'
        LINES TERMINATED BY \'\n\'
		IGNORE 1 LINES 
		'
);

// To Encrypt The password Field 
if($pass!=''){
$sql2="UPDATE ".$table." SET ".$pass." = AES_ENCRYPT(".$pass.", 'encryption_key');";
$reg2= mysqli_query($con,$sql2);
}

// To Showing of no of records processed or failed
$sql4="SELECT * FROM ".$table;
$result = mysqli_query($con,$sql4);
$rows = mysqli_num_rows($result);


// To close the csv file
fclose($handle);
ini_set('auto_detect_line_endings',FALSE);
$time_end = microtime(true);
$execution_time = ($time_end - $time_start); //To show how long it took to process

//To Showing proper message in case of failures
if($rows){
?>

<body style="background-image: linear-gradient(-90deg, rgb(238, 123, 15), rgb(82, 39, 39));margin-top:20%;color:white">    
   
<h1 style="text-align: center;">Successfully Uploded</h1>
<h1 style="text-align: center;"><?php echo $rows; echo " "; ?> Number of Record Processed </h1>
<h2 style="text-align: center;">Process Time: <?php echo $execution_time;  ?> Seconds </h2>
<?php
}
else{
	?>
	<body style="background-image: linear-gradient(-90deg, rgb(238, 123, 15), rgb(82, 39, 39));margin-top:20%;color:white">    
   
	<h1 style="text-align: center;">Somenthing went Worng..........!</h1>	
	<?php
	}
?>