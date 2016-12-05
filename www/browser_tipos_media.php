<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Tipos de Mídia", "home.php");

inicia_quadro_branco('width="100%"', ''); ?>
	<table width="100%" cellpadding="2" cellspacing="2" border="0">
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		<tr>
			<td width="100" align="center">
				<a title="Clique para adicionar um novo tipo de mídia" href="form_tipos_media.php">
					<img border="0" align="absmiddle" src="imagens/icone_tipos_media_mais.jpg">
				</a>
				<br>
				<span style="font-size:9px;">Novo Tipo de Mídia</span>
			</td>
			<td width="100" class="label">Busca:</td>
			<td width="200"><input type="text" name="busca" class="input_text" value="<?=$busca?>"></td>
			<td width="100">
				<select name="organizar">
					<option value="nome_tipo_media"<? if($organizar == "nome_tipo_media") echo(" selected"); ?>>Nome</option>
				</select>
			</td>
			<td width="20"><input type="image" src="imagens/lupa.gif"></td>
			<td>&nbsp;</td>
		</tr>
		</form>
	</table>
<? termina_quadro_branco();

$query = "SELECT ";
$query .= " CONCAT('<a title=\"Editar\" href=\"form_tipos_media.php?modo=update&id_tipo_media=', id_tipo_media , '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as id_segmento,";
$query .= " CONCAT('<a title=\"Copiar\" href=\"form_tipos_media.php?modo=copiar&id_tipo_media=', id_tipo_media , '\"><img border=\"0\" src=\"imagens/copiar.gif\"></a>') as copiar,";
$query .= "nome_tipo_media, ";
$query .= "CONCAT('<a href=\"javascript: apagar(', id_tipo_media , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>')";
$query .= " from tipo_media ";

if(!empty($busca)) {
	if($organizar == "nome_tipo_media"){
		$query .= " WHERE nome_tipo_media LIKE '%" . trim($busca) . "%'";
		$string = "&busca=" .  $busca . "&organizar=nome_tipo_media";
	}
}

$colunas[0]['largura'] = "3%";
$colunas[0]['label'] = "&nbsp;";
$colunas[0]['campo'] = "";
$colunas[0]['alinhamento'] = "left";

$colunas[1]['largura'] = "5%";
$colunas[1]['label'] = "&nbsp;";
$colunas[1]['campo'] = "";
$colunas[1]['alinhamento'] = "left";

$colunas[2]['largura'] = "87%";
$colunas[2]['label'] = 'Nome';
$colunas[2]['campo'] .= 'nome_tipo_media';
$colunas[2]['alinhamento'] = "left";

$colunas[3]['largura'] = "5%";
$colunas[3]['label'] = "&nbsp;";
$colunas[3]['campo'] = "";
$colunas[3]['alinhamento'] = "right";
?>
<script language="javascript">
	function apagar(id){
		if(confirm("Deseja remover este tipo de midia do sistema?"))
			window.location = 'salva_tipos_media.php?modo=apagar&pagina=<?=$_REQUEST["pagina"]?>&id_tipo_media=' + id + '<?=$string?>';
	}
</script>
<? 
browser($query, $colunas, $string, '', 20, 2, true); ?>
<script language="javascript">
	document.forms[0].elements[0].focus();
</script>
<? termina_pagina(); ?>
