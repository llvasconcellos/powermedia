<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Bemvindo ao PowerMedia Organizer!");
?>
<table width="100%">
	<tr>
		<td width="25%">
			<? inicia_quadro_azul('width="100%"', "PowerMedia Organizer"); ?>
			<div style="width: 100%; text-align:justify;">
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Seja Bemvindo ao PowerMedia Organizer, uma ferramenta poderosa para organização de CDs, DVDs, MDs, MP3 entre outros tipos de mídia. Encontre facilmente seus títulos com uma busca poderosa!
			</div>
			<? termina_quadro_azul(); ?>
		</td>
		<td width="75%">
			<? inicia_quadro_branco('width="100%"', "Pagina Inicial"); ?>
				<center>
					<table width="90%">
						<tr height="20">
							<td colspan="4">&nbsp;</td>
						</tr>
						<tr height="50">
							<td valign="top" align="center" width="25%"><a class="menu" href="browser_titulos.php?visualizar=icones"><img border="0" src="imagens/icone_titulos.jpg"></a></td>
							<td valign="top" align="center" width="25%"><a class="menu" href="browser_tipos_media.php"><img border="0" src="imagens/icone_tipos_media.jpg"></a></td>
							<td valign="top" align="center" width="25%"><a class="menu" href="form_catalogo.php"><img border="0" src="imagens/icone_catalogo.jpg"></a></td>
							<td valign="top" align="center" width="25%"><a class="menu" href="form_capas.php"><img border="0" src="imagens/icone_impressao.jpg"></a></td>
						</tr>
						<tr height="60">
							<td valign="top" align="center"><a class="menu" href="browser_titulos.php">Títulos</a></td>
							<td valign="top" align="center"><a class="menu" href="browser_tipos_media.php">Tipos de Mídia</a></td>
							<td valign="top" align="center"><a class="menu" href="form_catalogo.php">Impressão de Catálogo</a></td>
							<td valign="top" align="center"><a class="menu" href="form_capas.php">Impressão de Capas</a></td>
						</tr>
						<tr height="50">
							<td valign="top" align="center"><a class="menu" href="ie_margin_capa.reg"><img border="0" src="imagens/icone_margin.gif"></a></td>
							<td valign="top" align="center"><a class="menu" href="ie_margin_etiqueta.reg"><img border="0" src="imagens/icone_margin.gif"></a></td>
							<td valign="top" align="center"><a class="menu" href="form_etiquetas.php"><img border="0" src="imagens/icone_etiqueta.gif"></a></td>
							<td valign="top" align="center"><a class="menu" href="gravacao.php"><img border="0" src="imagens/nero.gif"></a></td>
							<!--<td valign="top" align="center"><img border="0" src="imagens/icone_ajuda_gr.gif"></td>-->
						</tr>
						<tr height="50">
							<td valign="top" align="center"><a class="menu" href="ie_margin_capa.reg">Margens Internet Explorer - Capa</a></td>
							<td valign="top" align="center"><a class="menu" href="ie_margin_etiqueta.reg">Margens Internet Explorer - Etiqueta</a></td>
							<td valign="top" align="center"><a class="menu" href="form_etiquetas.php">Impressão de Etiquetas</a></td>
							<td valign="top" align="center"><a class="menu" href="gravacao.php">Titulos Para Gravação</a></td>
							<!--<td valign="top" align="center">Ajuda</td>-->
						</tr>
						<tr height="50">
							<td valign="top" align="center"><a class="menu" href="configuracoes.php"><img border="0" src="imagens/icone_configuracao_gr.gif"></a></td>
							<td valign="top" align="center"></td>
							<td valign="top" align="center"></td>
							<td valign="top" align="center"></td>
							<!--<td valign="top" align="center"><img border="0" src="imagens/icone_ajuda_gr.gif"></td>-->
						</tr>
						<tr height="50">
							<td valign="top" align="center"><a class="menu" href="configuracoes.php">Configurações</a></td>
							<td valign="top" align="center"></td>
							<td valign="top" align="center"></td>
							<td valign="top" align="center"></td>
							<!--<td valign="top" align="center">Ajuda</td>-->
						</tr>
					</table>
				</center>
			<? termina_quadro_branco(); ?>
		</td>
	</tr>
</table>
<?
termina_pagina();
?>