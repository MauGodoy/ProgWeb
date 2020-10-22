<?php
session_start();
ob_start();
$btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
if($btnCadUsuario){
	include_once 'conexao.php';
	$dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	
	$erro = false;
	
	$dados_st = array_map('strip_tags', $dados_rc);
	$dados = array_map('trim', $dados_st);
	
	if(in_array('',$dados)){
		$erro = true;
		$_SESSION['msg'] = "Preencha todos os campos!";
	}elseif((strlen($dados['senha'])) < 6){
		$erro = true;
		$_SESSION['msg'] = "Senha deve ter 6 caracteres!";
	}elseif(stristr($dados['senha'], "'")) {
		$erro = true;
		$_SESSION['msg'] = "Caracter inválido na senha!";
	}else{

		$result_login = "SELECT idusuario FROM tb_usuarios WHERE login='". $dados['login'] ."'";

		$resultado_login = $conn->prepare($result_login);
		$resultado_login->execute();

		

		if(($resultado_login) AND ($resultado_login->rowCount() != 0)){
			$erro = true;
			$_SESSION['msg'] = "Usuário já está sendo utilizado!";
		}
		
		
	}
	
	if(!$erro){
		
		
		
		$result_login = "INSERT INTO tb_usuarios (login, senha) VALUES (
						'" .$dados['login']. "',
						'" .$dados['senha']. "'
						)";
		$resultado_login = $conn->prepare($result_login);
		
		if($resultado_login->execute()){
			$_SESSION['msgcad'] = "Usuário cadastrado com sucesso!";
			header("Location: login.php");
		}else{
			$_SESSION['msg'] = "Erro ao cadastrar o usuário!";
			var_dump($erro);
			var_dump($resultado_login);
		}
	}

}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Cadastrar</title>
	</head>
	<body>
		<h2>Cadastro</h2>
		<?php
			if(isset($_SESSION['msg'])){
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
		?>
		<form method="POST" action=""><br>
			<label>Login</label>
			<input type="text" name="login" placeholder="Digite o login"><br><br>

			<label>Senha</label>
			<input type="password" name="senha" placeholder="Digite a senha"><br><br>
			
			<input type="submit" name="btnCadUsuario" value="Cadastrar"><br><br>
			
			<a href="login.php">Clique aqui</a> para logar
		
		</form>
	</body>
</html>