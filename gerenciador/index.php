<?php
	include "class/manager.php";
	$manager = new Manager();

	$action_ok = $manager->actions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Gerenciador Json Data</title>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="style.css" />

	<script  src="jquery/jquery-1.11.2.min.js" language="javascript" type="text/javascript"></script>
	<script  src="bootstrap/js/bootstrap.min.js" language="javascript" type="text/javascript"></script>
	<script  src="manager.js" language="javascript" type="text/javascript"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<div id="header" class="col-md-12">
			<div class="title"><h2>Gerenciador Jsondata <small>By Budweb</small></h2></div>
		</div>
	</div>
	<div class="row">
		<div id="menu" class="col-md-2">
			<div class="row">
			<div class="col-md-12">
			<div class="dropdown">
			  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
			   Escolha uma pasta
			    <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
			<?php
			foreach ($manager->get_paths() as $row) {
				if($row != NULL){
				echo "<li role='presentation'>";
				echo "<a role='menuitem' tabindex='-1' href='?path=".$row->id."'>";
				echo "<span class='glyphicon glyphicon-folder-open'></span> &nbsp;";
				echo $row->path_name;
				echo "</a>";
				echo "</li>";
			}
			}
			

			?>
			</ul>
			</div>  <!-- Menu drop -->

			</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php
					if(@$_GET["path"] != NULL){
					$path_now = $manager->get_one_path($_GET["path"]);
					echo $path_now;
					}
					?>

				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<?php
					if(@$_GET["path"] != NULL):
						if(!file_exists($path_now)){
							echo "o gerenciador não conseguiu criar um diretorio. Tente fazê-lo manualmente";
						}else{
					$files = $manager->scan_folder($_GET["path"]);
					echo "<ul class='files'>";
					foreach ($files as $file){
						$filename =  pathinfo($file);
						echo "<a href='?path=".$_GET["path"]."&file=".$filename["filename"]."'>";
						echo "<li>";
						echo "<span class='glyphicon glyphicon-list-alt'></span> ";
						echo $filename["filename"];
						echo "</li>";
						echo "</a>";
					}

					echo "</ul>";
					}
					endif;
					?>
				</div>
			</div>


		</div>
		<div id="content"class="col-md-10">
			<?php
			if(@$_GET["file"] == NULL){
				include "main.php";
			}else{
				if(@$_GET["pag"] == NULL){
					include "view.php";
				}else{
					include $_GET["pag"].".php";
				}
			}

			?>

		</div>
	</div>
	<div class="row">
		<div id="footer" class="col-md-12">
			<p>Input:</p>
			<?php
			
				include "input.php";
			

			?>
		</div>
	</div>
</div>
</body>
</html>