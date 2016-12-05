<?
require("funcoes.php");
require("conectar_mysql.php");
inicia_pagina();
monta_titulo_secao("Geração de Catálogo", "home.php");
?>
<table width="100%">
	<tr>
		<td width="25%" valign="top" align="left">
			<? inicia_quadro_azul('width="100%"', "Catálogos"); ?>
			<div style="width: 100%; text-align:justify;">
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Tipos de mídia não estão apenas relacionados as mídias em si (DVDs, CDs, MDs, Fitas), mas também estão relacionados com os seus gêneros. Como ação, terror, infantil ou Pop, Rock, Techno. Então um exemplo de uso para este campo seria "DVDs Infantis".
			</div>
			<? termina_quadro_azul(); ?>
		</td>
		<td width="75%" align="center" valign="top">
			<? inicia_quadro_branco('width="90%"', "Configurações"); ?>
			<form action="gera_catalogo.php" method="post" target="_blank">
			<center>
				<table width="90%" border="0" cellspacing="3">
					<tr>
						<td class="label" width="45%">Tipo de Mídia:</td>
						<td>
							<select name="id_tipo_media">
								<?php
								$query2 = "SELECT id_tipo_media, nome_tipo_media FROM tipo_media ORDER BY nome_tipo_media";
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
						<td class="label">Largura Capa no Catálogo (pixels):</td>
						<td><input type="text" name="largura" value="<?=retorna_config("pixel_w_catalogo")?>" maxlength="4" class="input_text"></td>
					</tr>
					<tr>
						<td class="label">Quantidade de Capas por Linha no Catálogo:</td>
						<td><input type="text" name="linha" value="<?=retorna_config("capas_linha_catalogo")?>" maxlength="5" class="input_text"></td>
					</tr>
					<tr>
						<td class="label">Tamanho da fonte do catálogo em Pixels:</td>
						<td><input type="text" name="fonte" value="<?=retorna_config("tamanho_fonte_catalogo")?>" maxlength="5" class="input_text"></td>
					</tr>
					<tr>
						<td class="label">Quantidade de Linhas por Página do Catálogo:</td>
						<td><input type="text" name="linha_pagina" value="<?=retorna_config("linhas_pagina_catalogo")?>" maxlength="5" class="input_text"></td>
					</tr>
					<tr>
						<td class="label">Catálogo Completo:</td>
						<td align="left"><input type="checkbox" name="completo"></td>
					</tr>
					<tr>
						<td></td>
						<td align="right">
							<input type="submit" value="Proximo >>>" class="botao_aqua">
						</td>
					</tr>
				</table>
			</center>
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
require("desconectar_mysql.php");
?>