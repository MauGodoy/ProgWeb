<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Login</title>
	</head>
	<body>
		<h2>Login</h2>
		<?php
			if(isset($_SESSION['msg'])){
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
			if(isset($_SESSION['msgcad'])){
				echo $_SESSION['msgcad'];
				unset($_SESSION['msgcad']);
			}
		?>
		<form method="POST" action="validar.php"><br>
			<label>Usuário</label>
			<input type="text" name="login" placeholder="Digite seu login"><br><br>
			
			<label>Senha</label>
			<input type="password" name="senha" placeholder="Digite senha"><br><br>
			
			<input type="submit" name="btnLogin" value="Continuar">

			<input type="reset" value="Limpar" ><br><br>
			
			<a href="cadastrar.php">Criar conta</a>
		
		</form>
	</body>
</html>