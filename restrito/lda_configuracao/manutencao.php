<?php
	include_once("../inc/autenticar.php");
	checkPerm("LSTLDACONF");
	
	function validaDados()
	{
		global $erro;
		global $acao;
		global $prazoresposta;
		global $qtdprorrogacaoresposta;
		global $prazosolicitacaorecurso;
		global $prazorespostarecurso;
		global $qtdeprorrogacaorecurso;
		global $diretorioarquivos;
		global $urlarquivos;
		global $nomeremetenteemail;
		global $emailremetente;
				
		if (empty($prazoresposta) or 
			empty($qtdprorrogacaoresposta) or
			empty($prazosolicitacaorecurso) or
			empty($prazorespostarecurso) or
			empty($qtdeprorrogacaorecurso) or
			empty($diretorioarquivos) or
			empty($urlarquivos) or
			empty($nomeremetenteemail) or
			empty($emailremetente))
		{
			$erro = "Todos os campos devem ser preenchidos.";
			return false;
		}
		//-----------------------------------------------------------------------
		
		return true;
	}
	
	//------------------------------------------------------------------------------------------
	$erro	= "";
	
	if ($_POST['acao'])
	{
	
		//recupera valores do formulario
		$acao                       = $_POST["acao"];
		$prazoresposta              = $_POST["prazoresposta"];
		$qtdprorrogacaoresposta     = $_POST["qtdprorrogacaoresposta"];
		$prazosolicitacaorecurso    = $_POST["prazosolicitacaorecurso"];
		$prazorespostarecurso       = $_POST["prazorespostarecurso"];
		$qtdeprorrogacaorecurso     = $_POST["qtdeprorrogacaorecurso"];
		$diretorioarquivos          = $_POST["diretorioarquivos"];
		$urlarquivos                = $_POST["urlarquivos"];
		$nomeremetenteemail         = $_POST["nomeremetenteemail"];
		$emailremetente             = $_POST["emailremetente"];		
		
		if ($acao == "Salvar")
                {
                        checkPerm("UPTLDACONF");

                        if(validaDados())
                        {
                                $sql="UPDATE lda_configuracao SET
                                        prazoresposta = '$prazoresposta',
                                        qtdprorrogacaoresposta = '$qtdprorrogacaoresposta',
                                        prazosolicitacaorecurso = '$prazosolicitacaorecurso',
                                        prazorespostarecurso = '$prazorespostarecurso',
                                        qtdeprorrogacaorecurso = '$qtdeprorrogacaorecurso',
                                        diretorioarquivos = '$diretorioarquivos',
                                        urlarquivos = '$urlarquivos',
                                        nomeremetenteemail = '$nomeremetenteemail',
                                        emailremetente = '$emailremetente'
                                        ";

                                if (execQuery($sql))
                                {
                                        logger("Alterado configuração do lei de acesso.");
                                        echo "<script>alert('Configuração atualizada com sucesso!');</script>";
                                }
                                else
                                {
                                        $erro = "Ocorreu um erro ao atualizar configuração.";
                                }
                        }
                                
				
		}
	}
        else
        {
            $sql = "select * from lda_configuracao";
            $rs = execQuery($sql);
            $row = mysqli_fetch_array($rs);
            $prazoresposta              = $row["prazoresposta"];
            $qtdprorrogacaoresposta     = $row["qtdprorrogacaoresposta"];
            $prazosolicitacaorecurso    = $row["prazosolicitacaorecurso"];
            $prazorespostarecurso       = $row["prazorespostarecurso"];
            $qtdeprorrogacaorecurso     = $row["qtdeprorrogacaorecurso"];
            $diretorioarquivos          = $row["diretorioarquivos"];
            $urlarquivos                = $row["urlarquivos"];
            $nomeremetenteemail         = $row["nomeremetenteemail"];
            $emailremetente             = $row["emailremetente"];
            

        }
?>