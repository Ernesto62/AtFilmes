<?php
$con=new mysqli("localhost","root","","filmes");
if($con->connect_errno!=0){
	echo "Ocorreu um erro no acesso á base de dados".$con->connect_error;
	exit;
}

else{
	if (!isset($_SESSION['login'])){
		$_SESSION['login']="incorreto";
	}
	if ($_SESSION['login']="correto"){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="ISO=8859-1">
		<title>Filmes</title>
	</head>
	<body>
		<a href="filmes_create.php">Create</a>
		<h1>Lista de Filmes</h1>
		<?php
		$stm=$con->prepare('select*from filmes');
		$stm->execute();
		$res=$stm->get_result();
		while($resultado=$res->fetch_assoc()){
			echo '<a href="filmes_show.php?filme='.$resultado['id_filme'].'">';
			echo $resultado['titulo'];
			echo '</a> ';
			echo '<a href="filmes_delete.php?filme='.$resultado['id_filme'].'"> eliminar</a>';
			
			echo '<a href="filmes_edit.php?filme='.$resultado['id_filme'].'"> editar</a>';
			echo '<br>';
		}
		$stm->close();
		?>

	<?php
}

else{
	echo 'Para entrar nesta página necessita de efetuar <a href="login.php">login</a>';
}
} //end if - if($con->connect_errno!=0)
?>