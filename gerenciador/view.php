<?php
$var_default = "path=".$_GET["path"]."&file=".$_GET["file"];
?>
<ol class="breadcrumb">
  <li><a href="index.php?path=<?php echo $_GET["path"];?>">Início</a></li>
  <li><a href="index.php?<?php echo $var_default;?>"><?php echo $_GET["file"];?></a></li>
</ol>

<a href="index.php?pag=insert&<?php echo $var_default;?>">
	<span class="glyphicon glyphicon-log-in"></span> Inserir
</a>

<?php

$manager->path($manager->get_one_path($_GET["path"]));
$res = $manager->get($_GET["file"]);
$fields = $manager->get_fields();
$num_fields = count($fields);
if($num_fields > 10){
	$width = ($num_fields-10)*10+100;
}else{
	$width = 100;
}
?>


<table class="table view" style="width:<?php echo $width; ?>%; max-width:<?php echo $width; ?>%">
	<thead>
	<tr>

		<th></th>
		<th></th>
		<?php
			$manager->path($manager->get_one_path($_GET["path"]));
			$res = $manager->get($_GET["file"]);
			foreach ($fields as $field) {
				echo "<th>";
				echo $field;
				echo "</th>";
			};
		?>
	</tr>
	</thead>
	<tbody>
		<?php
		$keyfield = $manager->get_keyfield();
			foreach ($res->result() as $row){
				if($row != NULL){
				echo "<tr>";
				echo "<td><a href='index.php?where=".$keyfield.",".$row->$keyfield."&action=delete&".$var_default."'><span class='glyphicon glyphicon-remove'></span></a></td>";
				echo "<td><a href='index.php?pag=update&where=".$keyfield.",".$row->$keyfield."&".$var_default."'><span class='glyphicon glyphicon-pencil'></span></a></td>";				
				foreach ($row as $col) {
					echo "<td>";
					echo $col;
					echo "</td>";
				}
				echo "</tr>";
				}
			};
		?>
		</tbody>
</table>