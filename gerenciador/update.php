<?php
$var_default = "path=".$_GET["path"]."&file=".$_GET["file"];
$where = explode(",", $_GET["where"]);
?>
<ol class="breadcrumb">
  <li><a href="index.php?path=<?php echo $_GET["path"];?>">Início</a></li>
  <li><a href="index.php?<?php echo $var_default;?>"><?php echo $_GET["file"];?></a></li>
  <li><a href="index.php?pag=insert&<?php echo $var_default;?>">Atualizar</a></li>
</ol>
<h2>Atualizar <?php echo $_GET["file"];?></h2>

<form action="index.php?action=update&where=<?php echo $where[0].",".$where[1];?>&<?php echo $var_default;?>" method="post">
<?php


$manager->path($manager->get_one_path($_GET["path"]));
$res = $manager->get($_GET["file"]);
$fields = $res->get_fields();

$keyfield = $manager->get_keyfield();

$where = explode(",", $_GET["where"]);
$manager->path($manager->get_one_path($_GET["path"]));
$manager->where($where[0], $where[1]);;
$get = $manager->get($_GET["file"]);

$res = $res->row();

echo "<div class='row' >";
foreach ($fields as $value) {
	if($value != $keyfield){
		echo "<div class='col-md-3 form-group'>";
		echo "<label for='".$value."'>".$value."</label>";
		echo "<input type='text' class='form-control input-sm' name='".$value."' value='".$res->$value."'>";
		echo "</div>";
	}
}
echo "</div>";
?>
<div class="row">
	<div class="col-md-3 form-group">
			<label for=""></label>
			<input type="submit" class="btn btn-primary form-control input-sm" value="Salvar">
	</div>
</div>
</form>