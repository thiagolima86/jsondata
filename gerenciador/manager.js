$(document).ready(function(){

	num_fields();
});

function num_fields(){
	$("#btn_fields_num").click(function(){
		var num = $("#fields_num").val();
		$("#fields_num").val("");
		var i = 0;
		var fields = ""; 
		if(num>0){
		while(num > i){
			fields += "<div class='row'>";
			fields += "<div class='col-md-8'><input type='text' name='fields[]' class='form-control input-sm field' value='' /></div>";
			fields += "<div class='col-md-2'><input type='radio' name='key' value='' /></div>";
			fields += "<div class='col-md-2'><a class='del_field'><span class='glyphicon glyphicon-remove'></span></a></div>";
			fields += "</div>";
			i++;
		}
		$(".fields").append(fields);
		$(".add_fields").show();
		num_fields();
		}else{
			alert("Numero de campos indefinido");
		}

		
	});

	$(".del_field").click(function(){
		$(this).parent("div").parent(".row").remove();
	});

	$(".field").keyup(function(){
		var field = $(this).val();
		$(this).parent("div").parent(".row").find("input[name=key]").val(field);
	});
}