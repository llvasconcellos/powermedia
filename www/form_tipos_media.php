<?
require("funcoes.php");

if(($modo == "update") || ($modo == "copiar")){
	require("conectar_mysql.php");
	$query = "SELECT * FROM tipo_media WHERE id_tipo_media='" . $id_tipo_media . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
	$registro = mysql_fetch_assoc($result);
	$nome_tipo_media = $registro["nome_tipo_media"];
	$pixel_w = $registro["pixel_w"];
	$pixel_h = $registro["pixel_h"];
	require("desconectar_mysql.php");
}


inicia_pagina();
monta_titulo_secao("Cadastro de Tipos de Mídia", "browser_tipos_media.php");
?>
<script language="javascript">
	function valida_form(){
		var f = document.forms[0];
		if(f.nome_tipo_media.value == ""){
			alert("Informe o nome do Tipo");
			return false;
		}
		if(f.pixel_w.value == ""){
			alert("Informe a largura da capa em pixels.");
			return false;
		}
		if(f.pixel_h.value == ""){
			alert("Informe a altura da capa em pixels.");
			return false;
		}
		return true;
	}
	function apagar(){
	if(confirm('Deseja apagar este tipo de mídia e deixar todos os títulos cadastrados nele como "Não Definido"?'))
		self.location = 'salva_tipos_media.php?modo=apagar&id_tipo_media=<?=$id_tipo_media?>';
	}
</script>
<table width="100%">
	<tr>
		<td width="25%" valign="top" align="left">
			<? inicia_quadro_azul('width="100%"', "Tipo de Mídia"); ?>
			<div style="width: 100%; text-align:justify;">
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Tipos de mídia não estão apenas relacionados as mídias em si (DVDs, CDs, MDs, Fitas), mas também estão relacionados com os seus gêneros. Como ação, terror, infantil ou Pop, Rock, Techno. Então um exemplo de uso para este campo seria "DVDs Infantis".
			</div>
			<? termina_quadro_azul(); ?>
		</td>
		<td width="75%" align="center" valign="top">
			<? inicia_quadro_branco('width="90%"', "Formulário de Cadastro"); ?>
			<form action="salva_tipos_media.php" method="post" onSubmit="return valida_form();">
			<center>
				<table width="90%" border="0" cellspacing="3">
					<tr>
						<td class="label" width="30%">Nome do Tipo:</td>
						<td><input type="text" name="nome_tipo_media" value="<?=$nome_tipo_media?>" maxlength="50" class="input_text"></td>
					</tr>
					<tr>
						<td class="label" width="30%">Pixels de Largura da Capa:</td>
						<td><input type="text" name="pixel_w" value="<?=$pixel_w?>" maxlength="5" class="input_text"></td>
					</tr>
					<tr>
						<td class="label" width="30%">Pixels de Altura da Capa:</td>
						<td><input type="text" name="pixel_h" value="<?=$pixel_h?>" maxlength="5" class="input_text"></td>
					</tr>
					<tr>
						<td></td>
						<td align="right"><?
							if($modo == "update") echo('<input type="button" value="Apagar" class="botao_aqua" onclick="apagar();">');
							elseif ($modo == "add") echo('<input type="reset" value="Limpar Campos" class="botao_aqua">');
							?>&nbsp;<input type="submit" value="Salvar" class="botao_aqua">
						</td>
					</tr>
				</table>
			</center>
			<? 
			if($modo != "update") $modo = "add";
			echo('<input type="hidden" name="modo" value="' . $modo . '">');
			echo('<input type="hidden" name="id_tipo_media" value="' . $id_tipo_media . '">');
			?>
			</form>
			<? termina_quadro_branco(); ?>
		</td>
	</tr>
</table>
<script language="javascript">
	document.forms[0].elements[0].focus();
</script>
<?
termina_pagina();
?>