<?php include_once("functions.php");?>
<!DOCTYPE html>
<html><head><title>Login</title></head>
<body>
<h1>Login</h1>
<?php
    if(isset($_GET["error"])){
    $error=$_GET["error"];
    if($error==1)
    showError("username dan password tidak sesuai.");
    else if($error==2)
    showError("Anda Mengakses data dengan ilegal :(");
    else if($error==3)
    showError("Koneksi ke Database gagal. Autentikasi gagal.");
    else if($error==4)
    showError("Anda tidak boleh mengakses halaman sebelumnya karena belum login. Silahkan
    login terlebih dahulu!");
    else
    showError("Unknown Error.");
}
?>
<form method="post" name="form" action="login.php">
<table border="1">
<tr><th colspan="2">Login</th></tr>
<tr><td>Username</td>
    <td><input type="text" name="username" maxlength="5" size="5" value="");?></td></tr>
<tr><td>Password</td>
	<td><input type="password" name="pass" maxlength="8" size="9" value=""></td></tr>
<tr><td>&nbsp;</td>
	<td><input type="submit" name="TblLogin" value="Login"></td></tr>
</table>

</form>
</body>
</html>