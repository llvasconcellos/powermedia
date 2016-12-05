<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Cadastro de Títulos em Massa", "browser_titulos.php");
?>
<script language="javascript">
	function valida_form(){
		var f = document.forms[0];
		if(f.nome_pessoa.value == ""){
			alert("Informe o nome da pessoa");
			return false;
		}
		if(f.email_pessoa.value == ""){
			alert("Informe o email da pessoa.");
			return false;
		}
		if(!checkEmail(f.email_pessoa.value)) return false;
		return true;
	}
	function edita_info(){
		var d = document.getElementById("box_info");
		var s = document.getElementById("seta_verde");
		
		if(d.style.height == "0px") d.style.height = "";
		else d.style.height = "0px";
		
		if(d.style.overflow == "hidden") d.style.overflow = "";
		else d.style.overflow = "hidden";
		
		if(d.style.visibility == "hidden") d.style.visibility = "visible";
		else d.style.visibility = "hidden";
		
		if(d.style.visibility == "hidden") s.src = "imagens/seta_verde_direita.gif";
		else s.src = "imagens/seta_verde_baixo.gif";
	}
</script>
<table width="100%">
	<tr>
		<td width="25%" valign="top" align="left">
			<? inicia_quadro_azul('width="100%"', "Título"); ?>
			<div style="width: 100%; text-align:justify;">
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Neste formulário é possivel gravar informações de clientes finais ou contatos em empresas consumidoras dos produtos anunciados.
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
			<? inicia_quadro_branco('width="100%"', "Formulário de Cadastro"); ?>
			<form action="salva_titulo_massa.php" method="post" onSubmit="return valida_form();" encType="multipart/form-data">
			<center><br>
				<? if(strlen($img_titulo) > 0) echo('<img src="imagem_dinamica.php?largura_limite=600&altura_limite=300&id_titulo=' . $id_titulo . '">'); ?>
				<br>
				<table width="80%" border="0" cellspacing="3" cellpadding="3">
					<tr>
						<td class="label" valign="top">Capas:</td>
						<td>
							<textarea name="info_titulo" style="width: 100%; height: 200px;" readonly><?
							if ($handle = opendir('dropbox')) {
								while (false !== ($file = readdir($handle))) {
									if(!is_dir($file)) echo($file . "\n");
								}
								closedir($handle);
							}
							?></textarea>
						</td>
					</tr>
					<tr>
						<td class="label" width="5%">Tipo:</td>
						<td>
							<select name="id_tipo_media">
								<option value="0">Não Definido</option>
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
					</tr>
					<tr>
						<td colspan="2" class="label" style="text-align: left;"><a href="Javascript: edita_info();"><img border="0" id="seta_verde" align="absmiddle" src="imagens/seta_verde_direita.gif"></a>Mais Informações</td>
					</tr>
					<tr>
						<td colspan="2" align="right">
							<div id="box_info" style="text-width: 100%; height: 0px; overflow: hidden; visibility: hidden; margin:2px;">
								<textarea name="info_titulo" style="width: 100%; height: 200px;"><?=$info_titulo?></textarea>
							</div>
						</td>
					</tr>
					<tr>
						<td class="label"></td>
						<td class="label">
							<fieldset>
								<legend><b>Ordem da Capa</b></legend>
								<table width="100%">
									<tr>
										<td width="40%" class="label">Normal</td>
										<td><input type="radio" name="ordem_capa_titulo" value="n" checked></td>
										<td width="10%">&nbsp;</td>
										<td width="40%" class="label">Invertida</td>
										<td><input type="radio" name="ordem_capa_titulo" value="i"></td>
									</tr>
								</table>
							</fieldset>
						</td>
					</tr>
					<tr>
					<td align="right" colspan="2"><input type="reset" value="Limpar Campos" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua">
					</td>
				</tr>
				</table>
			</center>
			<? termina_quadro_branco(); ?>
				<input type="hidden" name="modo" value="add">
			</form>
		</td>
	</tr>
</table>
<script language="javascript">
	document.forms[0].elements[1].focus();
</script>
<?
termina_pagina();
?>