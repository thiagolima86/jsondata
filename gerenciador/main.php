<div class="row">
	<div class="col-md-4">
		<fieldset>
	<legend>Cadastrar Nova Pasta</legend>

	<div class="row">
		<form name="newpath" action="newpath.php" method="post">
		<div class="col-md-5 form-group">
			 <label for="pathname">Name do diretório</label>
			<input type="text" name="pathname" class="form-control input-sm">
		</div>
		<div class="col-md-5 form-group">
			<label for="path">Path relativo</label>
			<input type="text" multiple webkitdirectory name="path"  class="form-control input-sm"></div>
		<div class="col-md-2 form-group">
			<label for=""></label>
			<input type="submit" class="btn btn-primary" value="ok"></div>
		</form>
	</div>
	<div class="row">
		<div class="col-md-12">
			<ul>
				<?php

				foreach ($manager->get_paths() as $row) {
					if($row != NULL){
					echo "<li>";
					echo "<span class='glyphicon glyphicon-folder-open'></span> &nbsp;";
					echo $row->path_name;
					echo "<a href='delete_path.php?id=". $row->id."'> <span class='glyphicon glyphicon-remove'></span></a>";
					echo "</li>";
					}
					
				}

				?>
			</ul>
		</div>
	</div>

</fieldset>

	</div>
	<div class="col-md-7 col-md-offset-1">
		<fieldset>
	<legend>Criar novo arquivo Json</legend>
	<form name="create_data" action="index.php?action=create" method="post">
	<div class="row">
		<div class="col-md-3 form-group">
			  <label for="dir">Escolha uma pasta</label>
			<select name="dir" class="form-group">
			  <option value=""></option>
			<?php
			foreach ($manager->get_paths() as $row) {
				if($row != NULL){
				echo "<option value='".$row->path."'>";
				echo $row->path_name;
				echo "</option>";
			}
			}
			

			?>
			</select>
		</div>
		<div class="col-md-5 form-group">
			<label for="name">Nome do arquivo</label>
			<input type="text" name="name"  class="form-control input-sm">
		</div>
		<!-- <div class="col-md-2 form-group">
			<label for=""></label>
			<input type="submit" class="btn btn-primary" value="ok"></div>
		</form> -->
	
		<div class="col-md-3">
			<label for="fields_num">Adic. Campos</label>
			<div class="input-group">
      			<input type="number" name="fields_num" id="fields_num"  class="form-control input-sm">
     			<span class="input-group-btn">
        			<button id="btn_fields_num" class="btn  btn-primary input-sm" type="button">
        				<span class='glyphicon glyphicon-plus'></span>
        			</button>
      			</span>
    		</div> <!-- input group -->
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 add_fields" style="display:none">
			
			<div class="row head">
				<div class="col-md-8"><strong>Campos</strong></div>
				<div class="col-md-2"><strong>Chave</strong></div>
				<div class="col-md-2"><strong></strong></div>
			</div>
			<div class="row">
				<div class="col-md-12 fields">
				</div>
				
			</div>

			<div class="row">
				<div class="col-md-8">
					<input type="submit" class="form-control btn btn-primary input-sm" value="Criar">
				</div>
			</div>
		</div>
	</div>
	
</form>
</fieldset>
	</div>
</div>

