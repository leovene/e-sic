<?php
  //include("../inc/autenticar.php");
  include("../inc/security.php");
  
  $q = $_REQUEST['q'];

  $sql = "select cep, logradouro, bairro, cidade as municipio, uf as estado
		  from vw_cep
		  where cep like '$q%'
		  and cidade = 'Natal'
		  and uf = 'RN'
		  limit 0,10";

  $resultado = execQuery($sql);
  $codigos = "";
  while ($row = mysqli_fetch_array($resultado)){
	
	$codigos .= '"'.$row['cep'].'",' ;
	$nomes .= '"'.htmlentities($row['logradouro']).' - '.htmlentities($row['bairro']).', '.htmlentities($row['municipio']).'/'.$row['estado'].'",' ;
	
  
  }
  $codigos = substr($codigos,0,strlen($codigos)-1);
  $nomes = substr($nomes,0,strlen($nomes)-1);
  ?>
  
  showQueryDiv("<?php echo $q;?>", new Array(<?php echo $codigos;?>), new Array(<?php echo $nomes;?>))
  
  
  
