<?php 
session_start();
include('header.php');
$loginError = '';
if (!empty($_POST['username']) && !empty($_POST['pwd'])) {
	include ('Chat.php');
	$chat = new Chat();
	$user = $chat->loginUsers($_POST['username'], $_POST['pwd']);	
	if(!empty($user)) {
		$_SESSION['username'] = $user[0]['username'];
		$_SESSION['userid'] = $user[0]['userid'];
		$chat->updateUserOnline($user[0]['userid'], 1);
		$lastInsertId = $chat->insertUserLoginDetails($user[0]['userid']);
		$_SESSION['login_details_id'] = $lastInsertId;
		header("Location:index.php");
	} else {
		$loginError = "Usuario y Contraseña invalida";
	}
}

?>
<title>Sistema Chat/login.hph</title>
<?php include('container.php');?>
<div class="containerLogin">		
	<h2>Sistema de chat del plan de estudios de  la carrera de ISC</h1>		
	<div class="row">
		<div class="col-sm-4">
			<label style="font-size: larger;">Chat Login:</label>
			<br>		
			<form method="post">
				<div class="form-group">
				<?php if ($loginError ) { ?>
					<script>
						alert("Usuario y Contraseña invalida");
					</script>
				<?php } ?>
				</div>
				<div class="form-group">
					<label for="username">Usuario:</label>
					<input type="username" class="form-control" name="username" required style="text-align: center;">
				</div>
				<div class="form-group">
					<label for="pwd">Contraseña:</label>
					<input type="password" class="form-control" name="pwd" required style="text-align: center;">
				</div>  
				<br>
				<button  type="submit" name="login" class="btnLogin">Iniciar Sesion</button>
			</form>
			<br>
			<br>
			<p><b>Usuario</b> : Smith<br><b>Password</b> : 123</p>
		</div>
	</div>
</div>	
<?php include('footer.php');?>






