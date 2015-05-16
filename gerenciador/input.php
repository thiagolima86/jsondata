<code>
<?php
if(@$_GET["file"] != NULL){

	if(@$_GET["pag"] == NULL AND @$_GET["action"] == NULL){

		echo "Lendo dados!: <br /><br />";

		echo "\$jsondata->path('".$manager->get_one_path($_GET["path"])."');<br />";
		echo "\$get = \$jsondata->get(".$_GET["file"].");<br />";
		echo "\$get->result(); <span class='comment'>//get array </span>";

	}


	


	if(@$_GET["action"] == "insert"){

			if($action_ok){
				echo "Dados inseridos com sucesso!: <br /><br />";
			}else{
				echo "Problema ao inserir os dados: <br /><br />";
			}
			$data = $_POST;
			unset($data["save"]);

			echo "\$jsondata->path('".$manager->get_one_path($_GET["path"])."');<br />";
			echo "\$data = ";
			print_r($data);
			echo ";<br />";
			echo "\$jsondata->insert(".$_GET["file"].", \$data);<br />";

	}

	// Delete
		if(@$_GET["action"] == "delete"){

			$where = explode(",", $_GET["where"]);
			$path = $manager->get_one_path($_GET["path"]);

			echo "Linha apagada com sucesso!: <br /><br />";

			echo "\$jsondata->path('".$path."');<br />";
			echo "\$jsondata->where('".$where[0]."', ".$where[1]."); <br />";
			echo "\$jsondata->delete(".$_GET["file"].");";


		}
		// end delete

		// update
		if(@$_GET["action"] == "update"){
			
			if($action_ok){
				echo "Dados atualizado com sucesso!: <br /><br />";
			}else{
				echo "Problema ao atualizar os dados: <br /><br />";
			}

			$where = explode(",", $_GET["where"]);
			$path = $manager->get_one_path($_GET["path"]);

			echo "\$jsondata->path('".$path."');<br />";
			echo "\$jsondata->where('".$where[0]."', ".$where[1]."); <br />";
			echo "\$data = ";
			print_r($_POST);
			echo ";<br />";
			echo "\$jsondata->where(".$_GET["file"].");";


		}
		// end update

}

if(@$_GET["action"] == "create"){


			if($action_ok === "no_exists"){
				echo "Diretório não existe tente criá-lo manualmente: <br /><br />";
				exit();
			}elseif($action_ok === "no_writable"){
				echo "Diretório não possui permissão de escrita. Mude as permissões manualmente: <br /><br />";
				exit();
			}elseif($action_ok === "no_field"){
				echo "Preencha todos os campos correntamente: <br /><br />";
				exit();
			}elseif($action_ok){
				echo "Arquivo criado com sucesso!: <br /><br />";
			}else{
				echo "Problema ao criar arquivo: <br /><br />";
			}

			$name = $_POST["name"];
			$dir = $_POST["dir"];
			$fields = $_POST["fields"];
			$key = $_POST["key"];

			echo "\$jsondata->path(".$dir.");<br />";
			echo "\$jsondata->AUTO_INCREMENT(".$key.");<br />";
			echo "\$data = ";
			print_r($fields);
			echo ";<br />";
			echo "\$jsondata->create(".$name.", \$data);";

	}

?>

</code>