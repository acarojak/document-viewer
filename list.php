<html>
<head>
	<title></title>
</head>

<body>

	<form method="POST" action="list.php">
		Serial Number:
		<input name="sn" type="text" size="45"/>
		<input type="hidden" value="1" name="check">
		<input type="submit" value="CHECK SERIAL">
	</form>
	<table border = "0">
	
<?php
//error_reporting(0);

	$a = $_POST['check'];
	$sn = $_POST['sn'];
	
	if(isset($a)){
		
		$host = "localhost"; //REPLACE THIS IF YOU USE OTHER THAN LOCALHOST
		$user = "root"; //REPLACE THIS IF YOUR DB USER IS NOT root
		$pwd = ""; //SET THIS IF YOUR DB HAS PASSWORD
		$dbname = "test"; //CHANGE THIS TO YOUR DB NAME
		$tblname = "data"; //CHANGE TO YOUR TABLE NAME
		
		$conn = mysqli_connect($host, $user, $pwd, $dbname);
		if(!$conn)
		{
			die("ERROR CONNECTING DB SERVER: ".mysqli_error());
		}else
		{
			$query = "SELECT * FROM $tblname WHERE col_sn = '$sn'"; //CHANGE col_sn TO YOUR COLUMN NAME FROM YOUR TABLE IN YOUR DATABASE
			$runQ = mysqli_query($conn, $query);
			if(!$runQ)
			{
				die("ERROR QUERYING: ".mysqli_error());
			}else{
				if(mysqli_affected_rows($conn)==0)
				{
					echo "DATA NOT FOUND";
				}else
				{
					$row = mysqli_fetch_array($runQ);
					$sn = $row['col_sn']; //THIS WILL FETCH DATA FROM COLUMN col_sn;
					$doc_date = $row['date'];
					$doc_url=$row['url'];
					
					echo "<th>SERIAL NUMBER</th><th>DOCUMENT DATE</th><th>ACTION</th>";
					echo "<tr>";
					echo "<td>".$sn."</td><td>".$doc_date."</td><td><a href=\"".$doc_url."\">DOWNLOAD</a><td></tr>";
				}
			}
		}
	}else
	{
		
	}

?>
	</table>
</body>
</html>