<?
require("funcoes.php");
require("permissao_documento.php");

if($_POST["modo"] == "update"){
	switch($_POST["config"]){
		case "senha":
			altera_valor("senha",$_POST["senha"]);
			$msg = "Senha alterada com sucesso!";
			break;
		case "pixel_w_catalogo":
			altera_valor("pixel_w_catalogo",$_POST["pixel_w_catalogo"]);
			$msg = "Largura da imagem do Catálogo alterada com sucesso!";
			break;
		case "capas_linha_catalogo":
			altera_valor("capas_linha_catalogo",$_POST["capas_linha_catalogo"]);
			$msg = "Quantidade de capas por linha no catálogo alterada com sucesso!";
			break;
		case "tamanho_fonte_catalogo":
			altera_valor("tamanho_fonte_catalogo",$_POST["tamanho_fonte_catalogo"]);
			$msg = "Tamanho da fonte do catálogo alterado com sucesso!";
			break;
		case "linhas_pagina_catalogo":
			altera_valor("linhas_pagina_catalogo",$_POST["linhas_pagina_catalogo"]);
			$msg = "Quantidade de Linhas por página no catálogo alterada com sucesso!";
			break;
		case "pixel_w_etiqueta":
			altera_valor("pixel_w_etiqueta",$_POST["pixel_w_etiqueta"]);
			$msg = "Largura da etiqueta alterada com sucesso!";
			break;
		case "pixel_h_etiqueta":
			altera_valor("pixel_h_etiqueta",$_POST["pixel_h_etiqueta"]);
			$msg = "Altura da etiqueta alterada com sucesso!";
			break;
		case "tamanho_fonte_etiqueta":
			altera_valor("tamanho_fonte_etiqueta",$_POST["tamanho_fonte_etiqueta"]);
			$msg = "Tamanho da fonte da etiqueta alterado com sucesso!";
			break;
		case "limite_caracteres_etiqueta":
			altera_valor("limite_caracteres_etiqueta",$_POST["limite_caracteres_etiqueta"]);
			$msg = "Limide de caracteres alterado com sucesso!";
			break;
		case "etiquetas_linha":
			altera_valor("etiquetas_linha",$_POST["etiquetas_linha"]);
			$msg = "Quantidade de etiquetas por linha alterada com sucesso!";
			break;
		case "linhas_pagina_etiqueta":
			altera_valor("linhas_pagina_etiqueta",$_POST["linhas_pagina_etiqueta"]);
			$msg = "Quantidade de linhas por pagina de etiquetas alterada com sucesso!";
			break;
		case "espacamento_etiquetas":
			altera_valor("espacamento_etiquetas",$_POST["espacamento_etiquetas"]);
			$msg = "Espaçamento entre etiquetas alterado com sucesso!";
			break;
	}
}
inicia_pagina();
monta_titulo_secao("Opções de Configuração", "home.php");
?>
<table width="100%">
	<tr>
		<td width="25%" valign="top">
			<? inicia_quadro_azul('width="100%"', "PowerMedia Organizer"); ?>
			<div style="width: 100%; text-align:justify;">
				<img align="absmiddle" src="imagens/info.gif">
				&nbsp;Neste formulário é possivel alterar as configurações essenciais para o funcionamento do sistema.
			</div>
			<? termina_quadro_azul(); ?>
		</td>
		<td width="75%">
			<? inicia_quadro_branco('width="100%"', "Pagina Inicial"); 
				if($_POST["modo"] == "update") echo('<span style="color: #FF0000; font-weight: bold;">' . $msg . '</span><br><br>'); ?>
				
					<span class="celula"><B>Senha de Administrador</B></span><br><br>
					<script language="javascript">
						function confirma_senha(){
							var f = document.forms[0];
							if(f.senha.value != f.confirma.value){
								alert('A senha não confere.');
								return false;
							}
							else return true;
						}
						function confirma_pixel_w(){
							var f = document.forms[1];
							if(f.pixel_w_catalogo.value == ""){
								alert('Digite um valor para a largura.');
								return false;
							}
							else if(!checkEmail(f.email_admin.value)) return false;
							else return true;
						}
						function confirma_capas_linha_catalogo(){
							var f = document.forms[2];
							if(f.capas_linha_catalogo.value == ""){
								alert('Digite uma quantidade.');
								return false;
							}
							else return true;
						}
						function confirma_tamanho_fonte_catalogo(){
							var f = document.forms[3];
							if(f.tamanho_fonte_catalogo.value == ""){
								alert('Digite um tamanho em pixels.');
								return false;
							}
							else return true;
						}
					</script>
					<center>
						<table width="80%">
							<tr>
								<td>
									<fieldset>
									<legend class="celula"><B>Senha de Administrador</B></legend>
									<table width="100%" cellpadding="2" cellspacing="2">
										<form onSubmit="return confirma_senha();" action="<?=$_SERVER['PHP_SELF']?>" method="post">
										<tr>
											<td align="right" width="25%">Senha:</td>
											<td><input type="password" name="senha" maxlength="8" class="input_text"></td>
										</tr>
										<tr>
											<td align="right">Confirma Senha:</td>
											<td><input type="password" name="confirma" maxlength="8" class="input_text"></td>
										</tr>
										<tr>
											<td></td>
											<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
										</tr>
										<input type="hidden" name="config" value="senha">
										<input type="hidden" name="modo" value="update">
										</form>
									</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Largura Capa no Catálogo (pixels)</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form onSubmit="return confirma_pixel_w();" action="<?=$_SERVER['PHP_SELF']?>" method="post">
											<tr>
												<td align="right" width="10%">Largura:</td>
												<td><input type="text" name="pixel_w_catalogo" maxlength="50" class="input_text" value="<?=retorna_config("pixel_w_catalogo")?>"></td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="pixel_w_catalogo">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Quantidade de Capas por Linha no Catálogo</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form onSubmit="return confirma_capas_linha_catalogo();" action="<?=$_SERVER['PHP_SELF']?>" method="post">
											<tr>
												<td align="right" width="15%">Quantidade:</td>
												<td><input type="text" name="capas_linha_catalogo" maxlength="50" class="input_text" value="<?=retorna_config("capas_linha_catalogo")?>"></td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="capas_linha_catalogo">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Tamanho da fonte do catálogo em Pixels</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form onSubmit="return confirma_tamanho_fonte_catalogo();" action="<?=$_SERVER['PHP_SELF']?>" method="post">
											<tr>
												<td align="right" width="15%">Tamanho:</td>
												<td><input type="text" name="tamanho_fonte_catalogo" maxlength="50" class="input_text" value="<?=retorna_config("tamanho_fonte_catalogo")?>"></td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="tamanho_fonte_catalogo">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Quantidade de Linhas por Página do Catálogo</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
											<tr>
												<td align="right" width="15%">Quantidade:</td>
												<td><input type="text" name="linhas_pagina_catalogo" maxlength="255" class="input_text" value="<?=retorna_config("linhas_pagina_catalogo")?>"></td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="linhas_pagina_catalogo">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Largura da Etiqueta (pixels)</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
											<tr>
												<td align="right" width="15%">Largura:</td>
												<td><input type="text" name="pixel_w_etiqueta" maxlength="255" class="input_text" value="<?=retorna_config("pixel_w_etiqueta")?>"></td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="pixel_w_etiqueta">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Altura da Etiqueta (pixels)</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
											<tr>
												<td align="right" width="15%">Altura:</td>
												<td><input type="text" name="pixel_h_etiqueta" maxlength="255" class="input_text" value="<?=retorna_config("pixel_h_etiqueta")?>"></td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="pixel_h_etiqueta">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Tamanho da fonte da Etiqueta (pixels)</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
											<tr>
												<td align="right" width="15%">Tamanho:</td>
												<td><input type="text" name="tamanho_fonte_etiqueta" maxlength="255" class="input_text" value="<?=retorna_config("tamanho_fonte_etiqueta")?>"></td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="tamanho_fonte_etiqueta">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Limite de Caracteres na Etiqueta</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
											<tr>
												<td align="right" width="15%">Limite:</td>
												<td><input type="text" name="limite_caracteres_etiqueta" maxlength="255" class="input_text" value="<?=retorna_config("limite_caracteres_etiqueta")?>"></td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="limite_caracteres_etiqueta">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Quantidade de Etiquetas por Linha</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
											<tr>
												<td align="right" width="15%">Quantidade:</td>
												<td><input type="text" name="etiquetas_linha" maxlength="255" class="input_text" value="<?=retorna_config("etiquetas_linha")?>"></td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="etiquetas_linha">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Quantidade de Linhas Por Página</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
											<tr>
												<td align="right" width="15%">Quantidade:</td>
												<td><input type="text" name="linhas_pagina_etiqueta" maxlength="255" class="input_text" value="<?=retorna_config("linhas_pagina_etiqueta")?>"></td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="linhas_pagina_etiqueta">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
									<br><br>
									<fieldset>
										<legend class="celula"><B>Espaçamento entre Etiquetas (pixels)</B></legend>
										<table width="100%" cellpadding="2" cellspacing="2">
											<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
											<tr>
												<td align="right" width="15%">Espaço:</td>
												<td><input type="text" name="espacamento_etiquetas" maxlength="255" class="input_text" value="<?=retorna_config("espacamento_etiquetas")?>"></td>
											</tr>
											<tr>
												<td></td>
												<td align="right"><input type="reset" value="Cancelar" class="botao_aqua">&nbsp;<input type="submit" value="Salvar" class="botao_aqua"></td>
											</tr>
											<input type="hidden" name="config" value="espacamento_etiquetas">
											<input type="hidden" name="modo" value="update">
											</form>
										</table>
									</fieldset>
									<br><br>
								</td>
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