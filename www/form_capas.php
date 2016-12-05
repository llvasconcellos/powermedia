<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Impressão de Capas", "home.php");
require("conectar_mysql.php");

if(strlen($id_tipo_media) == 0){
	$query = "SELECT id_tipo_media FROM tipo_media ORDER BY nome_tipo_media LIMIT 1";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
	$registro = mysql_fetch_assoc($result);
	$id_tipo_media = $registro["id_tipo_media"];
}
?>
<script language="javascript">
	if((screen.width != 1024) || (screen.height != 768)) alert('Para correta impressão das capas a sua resolução de tela deve ser de 1024x768 e as margens devem estar zeradas.');
	
	function adiciona_aos_papeis(){
		var f = document.forms[0];
		var papeis_usuario = document.forms[0].elements['capas[]'];
		for(var i = 0; i < f.titulos.options.length; i++){
			if(f.titulos.options[i].selected){
				var opcao = document.createElement("OPTION");
				opcao.text = f.titulos.options[i].text;
				opcao.value = f.titulos.options[i].value;
				papeis_usuario.options.add(opcao);
			}
		}
	}
	function remove_dos_papeis(){
		var f = document.forms[0];
		var papeis_usuario = document.forms[0].elements['capas[]'];
		for(var i = 0; i < papeis_usuario.options.length; i++){
			if(papeis_usuario.options[i].selected){
				var opcao = document.createElement("OPTION");
				opcao.text = papeis_usuario.options[i].text;
				opcao.value = papeis_usuario.options[i].value;
				f.titulos.options.add(opcao);
				papeis_usuario.options.remove(i);
				i = -1;
			}
		}
	}
	function valida_form(){
		var f = document.forms[0];
		var c = f.elements['capas[]'];
		for(var i = 0; i < c.options.length; i++) c.options[i].selected = true;
		return true;
	}
	function janela_imagem(){
		window.open('imagem_dinamica.php?largura_limite=5000&id_titulo=' + document.forms[0].titulos.value, 'Tabela', 'width=520,height=350,status=no,resizable=yes,top=30,left=100,dependent=yes,alwaysRaised=yes,scrollbars=yes');
	}
</script>
<table width="100%">
	<tr>
		<td width="100%" align="center" valign="top">
		<? inicia_quadro_branco('width="90%"', "Impressão de Capas"); ?>
			<form name="info" action="<?=$_SERVER['PHP_SELF']?>" method="post" onSubmit="return valida_form();" target="_blank">
			<table width="100%" border="0">
				<tr>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td align="left">
						<a name="imagem">&nbsp;</a><a href="Javascript: janela_imagem();"><img border="0" id="imagem_capa" src="imagens/selecione.gif"></a>
					</td>
				</tr>
				<tr>
					<td width="48%">
						<label class="conteudo_quadro_branco">Capas Para Imprimir</label>
						<select name="capas[]" multiple style="width: 100%; height: 250px;">
							<?
							for($i = 0; $i < count($capas); $i++){
								$query = "SELECT id_titulo, nome_titulo FROM titulos WHERE id_titulo = " . $capas[$i];
								$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
								while($registro = mysql_fetch_assoc($result)) echo('<option value="' . $registro["id_titulo"] . '">' . $registro["id_titulo"] . " - " . $registro["nome_titulo"] . '</option>');
							}
							?>
						</select>
					</td>
					<td>
						<a href="#imagem" onClick="adiciona_aos_papeis();">
							<img border="0" onMouseOver="this.src = 'imagens/voltar2_over.gif';" onMouseOut="this.src = 'imagens/voltar2_out.gif';" src="imagens/voltar2_out.gif">
						</a>
						<a href="#imagem" onClick="remove_dos_papeis();">
							<img border="0" onMouseOver="this.src = 'imagens/avancar_over.gif';" onMouseOut="this.src = 'imagens/avancar_out.gif';" src="imagens/avancar_out.gif">
						</a>
					</td>
					<td width="48%">
						<label class="conteudo_quadro_branco">Titulos Disponíveis</label>
						<select id="titulos" multiple name="titulos" style="width: 100%; height: 250px;" onChange="imagem_capa.src='imagem_dinamica.php?largura_limite=150&id_titulo=' + this.value; window.location = window.location + '#imagem';" onDoubleClick="alert('lixo');">
							<?
							$query = "SELECT id_titulo, nome_titulo FROM titulos WHERE id_tipo_media = " . $id_tipo_media . " ORDER BY nome_titulo";
							$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
							while($registro = mysql_fetch_assoc($result)) echo('<option value="' . $registro["id_titulo"] . '">' . $registro["id_titulo"] . " - " . $registro["nome_titulo"] . '</option>');
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>
						<select name="id_tipo_media" onChange="valida_form(); document.forms[0].target='_self'; document.forms[0].submit();">
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
					<td></td>
					<td></td>
					<td align="right">
						<input type="button" value="Proximo >>>" class="botao_aqua" onClick="document.forms[0].action = 'gera_impressao_capas.php'; valida_form();  document.forms[0].target='_blank'; document.forms[0].submit();">
					</td>
				</tr>
			</table>
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