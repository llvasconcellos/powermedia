<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Titulos Para Gravação", "home.php");
?>
<script language="javascript">
	function valida_form(){
		var f = document.forms[0];
		if(f.codigos.value == ""){
			alert("Digite algum código");
			return false;
		}
	}
</script>
<table width="100%">
	<tr>
		<td width="25%" valign="top" align="left">
			<? inicia_quadro_azul('width="100%"', "Gravação"); ?>
			<div style="width: 100%; text-align:justify;">
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Digite os códigos dos titulos que deseja visualizar separados pela tecla enter. Um código para cada linha.
				<center>
					<hr>
					<a title="Clique para adicionar um novo tipo de mídia" href="form_tipos_media.php">
						<img border="0" align="absmiddle" src="imagens/icone_tipos_media_mais.jpg">
					</a>
					<br>
					<span style="font-size:9px;">Novo Tipo de Mídia</span>
					<hr>
					<a title="Clique para adicionar um novo título" href="form_titulo.php">
						<img border="0" align="absmiddle" src="imagens/icone_titulos_mais.jpg">
					</a>
					<br>
					<span style="font-size:9px;">Novo Título</span>
					<hr>
					<a title="Clique para adicionar um novo título" href="form_titulo_massa.php">
						<img border="0" align="absmiddle" src="imagens/icone_titulos_massa_mais.jpg">
					</a>
					<br>
					<span style="font-size:9px;">Novos Títulos Em Massa</span>
				</center>
			</div>
			<? termina_quadro_azul(); ?>
		</td>
		<td width="75%" align="center" valign="top">
			<? inicia_quadro_branco('width="100%"', "Códigos para Gravação"); ?>
			<form action="gera_gravacao.php" method="post" onSubmit="return valida_form();">
			<center><br>
				<table width="80%" border="0" cellspacing="3" cellpadding="3">
					<tr>
						<td width="5%" class="label" valign="top">Códigos:</td>
						<td>
							<textarea name="codigos" style="width: 100%; height: 300px;"></textarea>
						</td>
					</tr>
					<tr>
						<td align="right" colspan="2"><input type="reset" value="Limpar Campos" class="botao_aqua">&nbsp;<input type="submit" value=" Visualizar " class="botao_aqua"></td>
					</tr>
				</table>
			</center>
			<? termina_quadro_branco(); ?>
			</form>
		</td>
	</tr>
</table>
<script language="javascript">
	document.forms[0].elements[0].focus();
</script>
<?
termina_pagina();
?>