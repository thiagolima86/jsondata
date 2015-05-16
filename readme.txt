/**
 * Jsondata
 * 
 * @package	Jasondata
 * @author	Thiago lima
 * @business Budweb
 * @link	http://www.budweb.com.br
 * ¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®
 * ¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦®®®®®®®®®®®®®®®®®®®®¦¦¦¦®®®®®®®®®®®®¦¦¦®®®®®®®®®®®®®¦¦¦¦®®®®®®
 * ®®¦¦¦¦¦¦¦®®®®¦¦¦¦¦®®®®®®®®®®®®®®®®®®®®®¦¦¦®®®®®®®®®®®¦¦¦¦¦¦®®®®®®®®®®®®¦¦¦®®®®®®
 * ®®®®¦¦¦¦®®®®¦¦¦¦¦®®®®¦¦¦¦®®¦¦¦¦®®¦¦¦¦¦¦¦¦¦®¦¦¦¦¦®¦¦¦¦®¦®¦¦¦®¦¦¦¦¦¦¦¦¦®®¦¦¦¦¦¦¦¦®
 * ®®®¦¦¦¦¦¦¦¦¦¦¦¦®®®®®®®¦¦¦®®¦¦¦®®¦¦¦¦¦¦¦¦¦¦®®¦¦¦¦®®¦¦¦®®®¦¦®¦¦¦®®®¦¦¦¦®®¦¦®¦¦¦¦¦®
 * ®®¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦®®®®¦¦¦®®¦¦¦®®¦¦¦®®®®¦¦¦®®®¦¦¦¦®¦¦¦¦®¦¦®®¦¦¦®¦¦¦¦®®®®¦¦®®®®¦¦¦
 * ®®¦¦¦¦¦¦®®®®¦¦¦¦¦¦¦¦®®¦¦¦®¦¦¦¦®®¦¦¦¦®®®¦¦¦®®®®¦¦¦¦¦¦¦¦¦¦®®®®¦¦¦®®®®®®®®¦¦¦®®¦¦¦®
 * ®®¦¦¦¦¦¦®®®®®®¦¦¦¦¦¦®®®¦¦¦®¦¦¦¦¦®®¦¦¦¦¦¦¦¦®®®®®®¦¦®®®¦¦®®®®®®¦¦¦¦¦¦¦®¦¦¦¦¦¦¦¦®®®
 * ®®¦¦¦¦¦¦®®®®®®¦¦¦¦¦¦®®®®®®®®®®®®®®®®®®®®®®®®®® ®®®®®®®®®®®®®®®®®®®®®®®®®®®® ®®®®
 * ®®®¦¦¦¦¦¦®®®®®¦¦¦¦¦®®®®®®®®® ®®  ® ®® ®®®®® ®® ®®  ®® ® ®® ®  ® ®®®®® ®® ®® ® ®®
 * ®®®®¦¦¦¦¦¦¦¦¦¦¦¦¦®®®®®®®®®®  ® ®  ®® ®®  ®®  ® ®®  ®®®  ®®® ® ® ®®®®®® ®  ®  ®®®
 * ®®®®®®®®®¦¦¦®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®®

COMO CHAMAR A BIBLIOTECA jSONDATA

	$this->load->library("jsondata");

______________________________________________________________________________________________
 
 CRIANDO ARQUIVO JSON
	$fields = array("id", "fruta", "cor", "sabor", "preco");
	$this->jsondata->AUTO_INCREMENT("id");
	$this->jsondata->create("Nome_do_arquivo", $fields);

	---------------------------------------------------------------------------
	Esse metodo cria um arquivo no diretorio padrão definida na variável $path
	Ele retorna Boolean (TRUE or FALSE);
	---------------------------------------------------------------------------
______________________________________________________________________________________________

SELECIONANDO OUTRO DIRETORIO

	$this->jsondata->path("./nova_pasta");

	---------------------------------------------------------------------------
	A pasta padrão é a "./tmp" ela deve ser previamente criada com permisão 755
	Sempre que precisar mudar a pasta padrão deve usar o metodo acima
	---------------------------------------------------------------------------
______________________________________________________________________________________________

DELETANDO O ARQUIVO JSON

	$this->jsondata->drop("Nome_do_arquivo" $array);
______________________________________________________________________________________________

INSERINDO NOVOS DADOS NO ARQUIVO JSON

	$data = array(array("id" => 20,
						"fruta" => "Limão",
						"cor" => "Verde",
						"sabor" => "Azedo"),
		array("id" => 30,
						"fruta" => "Azeitona",
						"cor" => "Oliva",
						"sabor" => "doce")
		);

	$this->jsondata->insert("Nome_do_arquivo", $data);
______________________________________________________________________________________________

RECEBENDO OS DADOS DO ARQUIVO JSON

		$query = $this->jsondata->get("Nome_do_arquivo");

		print_r($query->result()); //Imprime Object array

		Output:
		stdClass Object
		(
		    [0] => stdClass Object
		        (
		            [id] => 0
		            [fruta] => morango
		            [cor] => vermelha
		            [sabor] => doce
		        )

		    [1] => stdClass Object
		        (
		            [id] => 20
		            [fruta] => Limão
		            [cor] => Verde
		            [sabor] => Azedo
		        )

		    [2] => stdClass Object
		        (
		            [id] => 30
		            [fruta] => Azeitona
		            [cor] => Oliva
		            [sabor] => doce
		        )

	)


		---------------------------------------------------------------------------
		Condicional WHERE


		$this->jsondata->where("sabor", "doce")
		$query = $this->jsondata->get("Nome_do_arquivo");

		print_r($query->result()); //Imprime object array

		 stdClass Object
		(
		    [0] => stdClass Object
		        (
		            [id] => 0
		            [fruta] => morango
		            [cor] => vermelha
		            [sabor] => doce
		        )

		    [1] => stdClass Object
		        (
		            [id] => 30
		            [fruta] => Azeitona
		            [cor] => Oliva
		            [sabor] => doce
		        )

		)

		---------------------------------------------------------------------------
		Condicional WHERE usando chave primaria auto-increment

		$this->jsondata->where(1); //mesmo resultado para $this->jsondata->where("key", 1);
		$query = $this->jsondata->get("Nome_do_arquivo");

		print_r($query->result()); //Imprime object array

		output:
		stdClass Object
		(
		    [id] => 1
		    [fruta] => Morango
		    [cor] => Vermelho
		    [sabor] => Doce
		)

		---------------------------------------------------------------------------
		Metodos aninhado

		$query = $this->jsondata->select("fruta, cor")->where("sabor", "doce")->get("Demands");


		foreach($query->result() as $row){
			echo $row->fruta . " : " . $row->cor . "<br />";
		}

		output:
		morango : vermelha
		Azeitona : Oliva

		---------------------------------------------------------------------------
		row() e row_array();

		Retornam linha unica;

		Ex:
		$this->jsondata->where("id", 20);
		$query = $this->jsondata->get("Nome_do_arquivo");
		$r = $query->row();
		echo $r->fruta;

		output:
		Limão

		Ex2:
		$this->jsondata->where(0);
		$query = $this->jsondata->get("Nome_do_arquivo");
		$r = $query->row_array();
		echo $r["fruita"] . " - " . $r["sabor"];

		output:
		Limão - Azedo

		---------------------------------------------------------------------------
		sum() e average() SOMA E MÉDIA

		$res = $this->jsondata->get("Nome_do_arquivo");
		$soma = $res->sum("preco");
		echo "Soma " . $soma."<br>";

		$res = $this->jsondata->get("Nome_do_arquivo");
		$average = $res->average("preco");
		echo "Média " . $average;

		Output:
		Soma 8.75
		Média 2.9166666666667



______________________________________________________________________________________________

ATUALIZANDO DADOS 

		$data = array( "fruta" => "Tamarino",
					"cor" => "Marrom");

		$this->jsondata->where(1);
		$this->jsondata->update("Nome_do_arquivo", $data);

		---------------------------------------------------------------------------
		Retorno é booleano
		---------------------------------------------------------------------------


______________________________________________________________________________________________

DELETANDO LINHAS
	
	$this->jsondata->where("sabor", "doce");
	$this->jsondata->delete("Nome_do_arquivo");



