<?php 
/**
 * Arquivo de classes para manipulação do BD Oracle.
 * @package Eagle2class
 */

/**
 * Classe para utilização das função de conexão e manipulação do BD Oracle.
 * @author Diniz Lamaison
 * @package Eagle2class
 */
class OracleCielo{
	private $RemoteAddr;

	private $monitDB="(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=enterprise-scan.cielo.ind.br)(PORT=1521))(CONNECT_DATA=(SERVER=POOLED)(SERVICE_NAME=monit)))";
//	private $monitDB="(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=172.16.254.25)(PORT=1521))(CONNECT_DATA=(SERVER=POOLED)(SERVICE_NAME=monit)))";
//	private $monitDB="(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=172.16.254.39)(PORT=1521))(CONNECT_DATA=(SERVER=POOLED)(SERVICE_NAME=monit)))";
	private $monitUser="monitoramento";
	private $monitPass="monit2015clo";
    private $monitCharset="PORTUGUESE_BRAZIL.WE8ISO8859P1";

	public $activeArray=Array();
	public $activeParse=null;
	public $activeParseLimit=null;
	public $activeParsePages=null;
	
	public $conexao;
	
	function __construct(){
		$this->conexao=@ocilogon($this->monitUser,$this->monitPass,$this->monitDB);
		//$this->setConOficial();
		$this->execSql("alter session set \"_optimizer_filter_pred_pullup\"=false");
	}

	function __destruct(){
		@ocilogoff($this->conexao);
	}
	
	/**
     * Função que retorna uma conexão ativa com a base MONITORAMENTO (Oficial).
     * @return mixed Conexão Oracle.
     */
	public function getCon(){
		return $this->conexao;
	}
	
	/**
     * Função temporária para testes com a conexao oficial.
     * @return mixed Conexão Oracle.
     */
	public function setConOficial(){
		//$this->monitDB="(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=172.16.254.9)(PORT = 1521))(CONNECT_DATA = (SID = monit)))";
		$this->monitDB="(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=enterprise-scan.cielo.ind.br)(PORT = 1521))(CONNECT_DATA = (SERVER=shared)(SERVICE_NAME = monit)))";
//		$this->monitUser="monitoramento";
//		$this->monitPass="Kanal&t44";
//		$this->monitUser="monitora";
//		$this->monitPass="Pass120rd";

		$this->monitUser="monitoramento";
		//$this->monitPass="monit2013abc";
                $this->monitPass="monit2015clo";
                
		@ocilogoff($this->conexao);
		$this->conexao=@ocilogon($this->monitUser,$this->monitPass,$this->monitDB);
	}
	
	
	/**
     * Função que retorna o PARSE ativo do SQL de paginação.
     * @return mixed Parse Oracle.
     */
	public function getPagesParse(){
		if($this->activeParse!=null)
			return $this->activeParse;
		else 
			return false;
	}
	
	/**
     * Função que retorna o ARRAY fetch all do SQL de paginação.
     * @return array Array de Dados.
     */
	public function getPagesArray(){
		return $this->activeArray;
	}
	
	/**
     * Função que retorna a contagem de linhas do SQL ativo de paginação.
     * @return integer Número de linhas.
     */
	public function getPagesCount(){
		if($this->activeParsePages!=null)
			return $this->activeParsePages;
		else 
			return false;
	}
	
	/**
     * Função que retorna o limite estabelecido no SQL ativo de paginação.
     * @return integer Limite ativo na paginação.
     */
	public function getPagesLimit(){
		if($this->activeParseLimit!=null)
			return $this->activeParseLimit;
		else 
			return false;
	}
	
	/**
     * Função que executa um SQL e dá commit (Sem Retorno de Dados, utilizado para UPDATE, INSERT, DELETE).
     * @return bool|string True se a execução foi completada com sucesso, ou a mensagem de erro em caso de erro.
     */
	public function execSql($sql, $commit=true){
		$sqlParse = OCIParse($this->conexao, $sql);
		if(@OCIExecute($sqlParse, OCI_DEFAULT)){
			if($commit===true)
				OCIcommit($this->conexao);	
			return true;
		}
		else
			return false;
	}
	

	/**
     * Função que gera o HTML com páginas e controles da paginação ativa.
     * @param string $urlPost URL que a função javascript irá chamar as páginas (Normalmente usa-se $_SERVER["PHP_SELF"]).
     * @param integer $pgNum Número da página a ser chamada, normalmente usa-se a variável $_REQUEST['pageNum'] definida na classe. 
     * @param string $style CSS do estilo da tabela de controle de páginas.
     * @return string HTML com as páginas.
     */
	public function getPagesControlHTML($urlPost, $pgNum, $css){
		if($this->activeParse!=null && $this->activeParsePages!=null){
			if(empty($pgNum))
				$pgNum=1;
				
			$pgsCount = ceil($this->activeParsePages/$this->activeParseLimit);
			
			$res.= "<table class=\"".$css."\"><tr style=\"cursor:pointer;\">";
			
			if(($pgNum-1)<=0)
				$pgBackward=1;
			else
				$pgBackward=$pgNum-1;
				
			
			$res.= "<td onclick=\"simplePost(null,'".$urlPost."','pageNum=".$pgBackward."',null)\"><img src=\"imagens/16x16/backward.png\"></td>";
			for($i=1;$i<=$pgsCount;$i++){
				$res.= "<td onclick=\"simplePost(null,'".$urlPost."','pageNum=".$i."',null)\">";
				if($pgNum==$i)
					$res.= "<b>".$i."</b>";
				else
					$res.= "".$i."";
				$res.= "</td>";
			
				if(is_int($i/40)){ 
					$res.= "</tr><tr style=\"cursor:pointer;\">";
				}
			} 
			
			if($pgNum==$pgsCount)
				$pgForward=$pgNum;
			else
				$pgForward=$pgNum+1;
				
			$res.= "<td onclick=\"simplePost(null,'".$urlPost."','pageNum=".$pgForward."',null)\"><img src=\"imagens/16x16/forward.png\"></td>";
			$res.= "</tr></table>";
		}
		else{
			$res= "<table><tr><td>Paginação não realizada!</td></tr></table>";
		}
		return $res;
	}
	
	/**
     * Função que gera uma Toolbar do Ext com controles da paginação ativa.
     * @param string $urlPost URL que a função javascript irá chamar as páginas (Normalmente usa-se $_SERVER["PHP_SELF"]).
     * @param integer $pgNum Número da página a ser chamada, normalmente usa-se a variável $_REQUEST['pageNum'] definida na classe. 
     * @param string $objDiv ID da div aonde será rederizada a toolbar com o controle de paginacao.
     * @param string $idWindow ID da janela/tab/panel para enviar a requisicao dos dados.
     * @param boolean $onlyItens Define se deve ser retornado só o ítem do Toolbar (true), ou o Toolbar completo (default).
     * @return string Script da toolbar de paginação.
     */
	public function getPagesControl($urlPost, $idWindow, $pgNum, $objDiv, $onlyItens=false, $getParams=""){
		if($this->activeParse!=null && $this->activeParsePages!=null){
			
			$getParams=(!empty($getParams))?"&".$getParams:"";
			
			//$urlPost = $_SERVER["PHP_SELF"];
			$maxRecords = $this->activeParseLimit;
			$activePage = (empty($pgNum))?1:$pgNum;
			$pgsCount = ceil($this->activeParsePages/$this->activeParseLimit);
			$pgsCount = ($pgsCount==0)?1:$pgsCount;
			$pgBackward = (($activePage-1)<=0)?1:$activePage-1;
			$pgForward = ($pgNum==$pgsCount)?$activePage:$activePage+1;
			
			$disablePrev = ($activePage>1)?'false':'true';
			$disableNext = ($activePage<$pgsCount)?'false':'true';

			$pgFirstIcon = ($disablePrev=='false')?"page-first":"page-first-disabled";
			$pgPrevIcon  = ($disablePrev=='false')?"page-prev":"page-prev-disabled";
			$pgNextIcon  = ($disableNext=='false')?"page-next":"page-next-disabled";
			$pgLastIcon  = ($disableNext=='false')?"page-last":"page-last-disabled";
			
			$idWindow = (empty($idWindow))?"tabs.getActiveTab().getId()":"'".$idWindow."'";
			
			if(!$onlyItens){
				$scriptReturn = "
				<script>
					var pagesToolbar = new Ext.Toolbar();
					pagesToolbar.render('".$objDiv."');
					pagesToolbar.add(
					";
			}
			
			$scriptReturn .= "
					{
						iconCls: '".$pgFirstIcon."',
						disabled : ".$disablePrev.", 
						handler: function (){
									simplePost(".$idWindow.", '".$urlPost."', 'pageNum=1".$getParams."', null);
								}
					},
					{
						iconCls: '".$pgPrevIcon."',
						disabled : ".$disablePrev.",
						handler: function (){
									simplePost(".$idWindow.", '".$urlPost."', 'pageNum=".$pgBackward."".$getParams."', null);
								}
					},
					'Página ',
					new Ext.form.TextField({width:30, 
											allowBlank: false, 
											id:'npag',
											emptyText: '".$activePage."',
											listeners: {
									            change: function(form, newVal, oldVal){
									            	if(newVal>=1 && newVal<=".$pgsCount.")
									            		simplePost(".$idWindow.", '".$urlPost."', 'pageNum='+newVal+'".$getParams."', null);
									            	else
									                	sysMsg('Aviso','Número incorreto da página!');
									            },
												specialkey : function(form, evento){
													if(Ext.getCmp('npag').getValue()<=".$pgsCount.")
								            			simplePost(".$idWindow.", '".$urlPost."', 'pageNum='+Ext.getCmp('npag').getValue()+'".$getParams."', null);
													else
									                	sysMsg('Aviso','Número incorreto da página!');
									            }
									        }}),
					' de ',
					'".$pgsCount."',
					{
						iconCls: '".$pgNextIcon."',
						disabled : ".$disableNext.", 
						handler: function (){
									simplePost(".$idWindow.", '".$urlPost."', 'pageNum=".$pgForward."".$getParams."', null);
								}
					},
					{
						iconCls: '".$pgLastIcon."',
						disabled : ".$disableNext.",
						handler: function (){
									simplePost(".$idWindow.", '".$urlPost."', 'pageNum=".$pgsCount."".$getParams."', null);
								}
					}
					";
			
			if(!$onlyItens){
				$scriptReturn .= "
					);
				</script>
				";
			}
			
			return $scriptReturn;
		}
		else{
			return "";/*"<script>sysMsg('Atenção','Controle de Paginação não Gerado!');</script>";*/
		}
	}
	
	/**
     * Função que cria o parser para paginação do SQL passado. 
     * @param string $sql SQL da consulta que irá ser paginada.
     * @param integer $limit Definição do limite de registros por página.
     * @param integer $pg Número da página para buscar os resultados. Normalmente usa-se a variável $_REQUEST['pageNum'] definida na classe.
     * @param integer $nreg Número de registros da consulta pré adquiridos na primeira consulta e armazenado em cache para evitar reconsulta.
     * @return mixed Parse Oracle.
     */
	public function makePages($sql, $limit, $pg, $nreg=-1){
		$pg=(empty($pg))?1:$pg;
		$nreg=($nreg==null)?-1:$nreg;
		if($nreg<0){
			$parseCount = OCIParse($this->conexao,"SELECT COUNT(*) AS cnt FROM (".$sql.")");
			ociexecute($parseCount);
			ocifetchinto($parseCount, $cnt, OCI_ASSOC);
		}
		else{
			$cnt['CNT'] = $nreg;
		}
			
		$parse = OCIParse($this->conexao,"select * from (select zxyTMP.*, rownum as zxyCOUNT from (".$sql.") zxyTMP) where zxyCOUNT>=".((($pg-1)*$limit)+1)." and zxyCOUNT<=".$pg*$limit."");
		if(OCIExecute($parse)){
			$this->activeParse=$parse;
			$this->activeParseLimit=$limit;
			$this->activeParsePages=$cnt['CNT'];
			return $cnt['CNT'];
		}
		else 
			return false;
	}
	
	/**
     * Função que cria o array de dados para paginação do SQL passado. 
     * @param string $sql SQL da consulta que irá ser paginada.
     * @param integer $limit Definição do limite de registros por página.
     * @param integer $pg Número da página para buscar os resultados. Normalmente usa-se a variável $_REQUEST['pageNum'] definida na classe.
     * @return boolan True ou False se foi executado com sucesso.
     */
	public function makePagesArray($sql,$limit,$pg){
		$pg = (empty($pg))?1:$pg;
		$parse = oci_parse($this->conexao,"select * from (select zxyTMP.*, rownum as zxyCOUNT from (".$sql.") zxyTMP) where zxyCOUNT>=".((($pg-1)*$limit)+1)." and zxyCOUNT<=".$pg*$limit."");
		if(OCIExecute($parse)){
			$nrows = oci_fetch_all($parse, $array, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
			$this->activeArray=$array;
			$this->activeParseLimit=$limit;
			$this->activeParsePages=$nrows;
			return true;
		}
		else 
			return false;
	}
	
	/**
     * Função que limpa o parser SQL de paginação ativo.
     * @return bool TRUE ou FALSE.
     */
	public function freePages(){
		if($this->activeParse!=null){
			ocifreestatement($this->activeParse);
			$this->activeParse=null;
			$this->activeParseLimit=null;
			$this->activeParsePages=null;
		}
		return true;
	}
}
?>
