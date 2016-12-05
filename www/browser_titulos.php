<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Títulos", "home.php");

$query = "SELECT ";
$query .= " CONCAT('<a title=\"Editar\" href=\"form_titulo.php?modo=update&id_titulo=', m.id_titulo , '\"><img border=\"0\" src=\"imagens/editar.gif\"></a>') as id_titulo,";
$query .= " CONCAT('<a title=\"Copiar\" href=\"form_titulo.php?modo=copiar&id_titulo=', m.id_titulo , '\"><img border=\"0\" src=\"imagens/copiar.gif\"></a>') as copiar,";
$query .= "m.nome_titulo, SUBSTRING(m.info_titulo,1,60) as info_titulo, t.nome_tipo_media, ";
$query .= "CONCAT('<a href=\"javascript: apagar(', m.id_titulo , ');\"><img border=\"0\" src=\"imagens/lixeira.gif\"></a>'),";
$query .= "m.id_titulo ";
$query .= " FROM titulos m LEFT OUTER JOIN tipo_media t ON m.id_tipo_media = t.id_tipo_media";

if(!empty($busca)) {
	if($organizar == "nome_titulo") $query .= " WHERE nome_titulo LIKE '%" . trim($busca) . "%'";
	if($organizar == "info_titulo") $query .= " WHERE info_titulo LIKE '%" . trim($busca) . "%'";
	if($id_tipo_media != -1) $query .= " AND t.id_tipo_media = " . $id_tipo_media;
}
elseif((strlen($id_tipo_media)>0) && ($id_tipo_media != -1)) $query .= " WHERE m.id_tipo_media = " . $id_tipo_media;


if(strlen($busca)>0) $string = "&busca=" . $busca;
if(strlen($organizar)>0) $string .= "&organizar=" . $organizar;
if(strlen($id_tipo_media)>0) $string .= "&id_tipo_media=" . $id_tipo_media;
if(strlen($visualizar)>0) $string .= "&visualizar=" . $visualizar;



$colunas[0]['largura'] = "3%";
$colunas[0]['label'] = "&nbsp;";
$colunas[0]['campo'] = "";
$colunas[0]['alinhamento'] = "left";

$colunas[1]['largura'] = "4%";
$colunas[1]['label'] = "&nbsp;";
$colunas[1]['campo'] = "";
$colunas[1]['alinhamento'] = "left";

$colunas[2]['largura'] = "30%";
$colunas[2]['label'] = 'Nome';
$colunas[2]['campo'] .= 'nome_titulo';
$colunas[2]['alinhamento'] = "left";

$colunas[3]['largura'] = "30%";
$colunas[3]['label'] = 'Info';
$colunas[3]['campo'] = 'info_titulo';
$colunas[3]['alinhamento'] = "left";

$colunas[4]['largura'] = "30%";
$colunas[4]['label'] = 'Tipo';
$colunas[4]['campo'] = "nome_tipo_media";
$colunas[4]['alinhamento'] = "center";

$colunas[5]['largura'] = "4%";
$colunas[5]['label'] = "&nbsp;";
$colunas[5]['campo'] = "";
$colunas[5]['alinhamento'] = "right";

inicia_quadro_branco('width="100%"', ''); ?>
	<table width="100%" cellpadding="2" cellspacing="2" border="0">
		<form action="<?=$_SERVER['PHP_SELF']?>" method="get">
		<tr>
			<td width="70" align="center">
				<a title="Clique para adicionar um novo título" href="form_titulo.php">
					<img border="0" align="absmiddle" src="imagens/icone_titulos_mais.jpg">
				</a>
				<br>
				<span style="font-size:9px;">Novo Título</span>
			</td>
			<td width="120" align="center">
				<a title="Clique para adicionar um novo título" href="form_titulo_massa.php">
					<img border="0" align="absmiddle" src="imagens/icone_titulos_massa_mais.jpg">
				</a>
				<br>
				<span style="font-size:9px;">Novos Títulos Em Massa</span>
			</td>
			<td width="40" class="label">Busca:</td>
			<td width="200"><input type="text" name="busca" class="input_text" value="<?=$busca?>"></td>
			<td width="150">
				<select name="organizar">
					<option value="nome_titulo"<? if($organizar == "nome_titulo") echo(" selected"); ?>>Nome</option>
					<option value="info_titulo"<? if($organizar == "info_titulo") echo(" selected"); ?>>Informações Adicionais</option>
				</select>
			</td>
			<td width="200">
				<? //die("id_tipo_media=" . $id_tipo_media); ?>
				<select name="id_tipo_media">
					<option value="-1"<? if($id_tipo_media == "-1") echo(" selected"); ?>>Todos</option>
					<option value="0"<? if($id_tipo_media == "0") echo(" selected"); ?>>Não Definido</option>
					<?php
					$query2 = "SELECT id_tipo_media, nome_tipo_media FROM tipo_media ORDER BY nome_tipo_media";
					require("conectar_mysql.php");
					$result = mysql_query($query2) or tela_erro("Erro na consulta ao Banco de dados: " . mysql_error(), false);
					while($registro = mysql_fetch_assoc($result)){
						echo('<option value="' . $registro["id_tipo_media"] . '"');
						if($registro["id_tipo_media"] == $id_tipo_media) echo(" selected");
						echo('>' . $registro["nome_tipo_media"] . '</option>');
					}
					require("desconectar_mysql.php");
					?>
				</select>
			</td>
			<td width="20"><input type="image" src="imagens/lupa.gif"></td>
			<td>&nbsp;</td>
			<td width="48"><?
				$string = str_replace("&visualizar=" . $visualizar, "", $string);
				if(empty($visualizar) || ($visualizar == "lista")) echo('<a href="' . $_SERVER['PHP_SELF'] . "?visualizar=icones" . $string . '"><img alt="Visualizar como icones" border="0" src="imagens/visualizar_icones_out.gif"></a><img alt="Visualizar como lista" src="imagens/visualizar_lista_over.gif">');
				elseif($visualizar == "icones") echo('<img alt="Visualizar como icones" src="imagens/visualizar_icones_over.gif"><a href="' . $_SERVER['PHP_SELF'] . "?visualizar=lista" . $string . '"><img alt="Visualizar como lista" border="0" src="imagens/visualizar_lista_out.gif"></a>');
			?></td>
		</tr>
		</form>
	</table>
<? termina_quadro_branco();?>
<script language="javascript">
	function apagar(id){
		if(confirm("Deseja remover este título do sistema?"))
			window.location = 'salva_titulo.php?modo=apagar&pagina=<?=$_REQUEST["pagina"]?>&id_titulo=' + id + '<?=$string?>';
	}
</script>
<? 
if($visualizar == "icones") browser_icones($query, $colunas, $string, '', 20, 4, 180); 
else browser($query, $colunas, $string, '', 20, 2, true);
?>
<script language="javascript">
	document.forms[0].elements[0].focus();
</script>
<? termina_pagina(); ?>
