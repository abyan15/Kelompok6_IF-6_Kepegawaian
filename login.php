<?php include_once("functions.php");?>
<?php
$db=dbConnect();
if($db->connect_errno==0){
	if(isset($_POST["TblLogin"])){
		$username=$db->escape_string($_POST["username"]);
		$pass=$db->escape_string($_POST["pass"]);
		$sql="SELECT username,pass,nama FROM admins
			  WHERE username='$username' and pass ='$pass'";
		$res=$db->query($sql);
		if($res){
			if($res->num_rows==1){
				$data=$res->fetch_assoc();
				session_start();
				$_SESSION["username"]=$data["username"];
				$_SESSION["nama"]=$data["nama"];
				header("Location: index.php");
			}
			else
				header("Location: awal.php?error=1");
		}
	}
	else
		header("Location: awal.php?error=2");
}
else
	header("Location: awal.php?error=3");
?>