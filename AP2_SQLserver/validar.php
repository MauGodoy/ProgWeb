<?php
session_start();
include_once("conexao.php");
$btnLogin = filter_input(INPUT_POST, 'btnLogin', FILTER_SANITIZE_STRING);
if($btnLogin){
	$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
	if((!empty($login)) AND (!empty($senha))){
		
		

			function encontrou($log,$pass)   
		{   $conn = new PDO("sqlsrv:Database=dbphp7;server=localhost\SQL2014;ConnectionPooling=0","sa","_43690"); 
			$query = $conn->prepare("select count(*)  as num from tb_usuarios where login = '$log' and senha ='$pass' ");
			$query->execute();
			$retorno =$query->fetch(PDO::FETCH_ASSOC);
 			
			if ($retorno['num'] ==1)
				{
					return 1;
				}
			else		 
			{
              return 0;
			}
		}	
		
	
	$linhas=encontrou($login,$senha);	
	$result = $conn->query("select * from tb_usuarios where login='$login' and senha='$senha'");
	

	if($linhas==1)
		{ 
			
			$data = array();
			while ($registros = $result->fetch(PDO::FETCH_ASSOC))

				{

					$_SESSION['nomedouser'] = $registros["login"];
					echo "INFORMAÇÕES DO USUARIO: <br><br>";
					echo "Id usuario: ".$registros['idusuario']."<br>";
					echo "Login: ".$registros['login']."<br>";
					echo "Data de cadastro: " .date ('d/m/Y H:i:s', strtotime($registros['dacadastro']))."<br><br>";
					

					echo "<a href='sair.php'>Deslogar</a>";
				}
		}       
		else
		{
			$_SESSION['msg'] = "Senha invalida!";
			header("Location: login.php");
		 
		}
	}else{
		$_SESSION['msg'] = "Cadastre-se!";
		header("Location: login.php");
	}
}