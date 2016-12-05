<?
require("funcoes.php");
inicia_pagina();
monta_titulo_secao("Titulos Para Gravação", "gravacao.php");
?>
<html>
	<head>
		<title>Impressão de Capas</title>
		<style type="text/css">
		td {
			text-align: left;
			vertical-align: top;
			font-size: <?=$fonte?>;
			font-family:Arial, Helvetica, sans-serif;
			page-break-inside: avoid;
		}
		</style>
	</head>
	<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<center>
	<? inicia_quadro_branco('width="80%"', "Títulos para Gravação"); ?>
		<br><br>
		<table width="80%" cellspacing="5" cellpadding="5" border="0">
			<?
			require("conectar_mysql.php");
			$codigos = split("\n", $codigos);
			for($i = 0; $i < count($codigos); $i++){
				$query = "SELECT * FROM titulos WHERE id_titulo = " . $codigos[$i];
				$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
				$titulo = mysql_fetch_assoc($result); ?>
				<tr>
					<td width="100"><img border="0" src="imagem_dinamica.php?largura_limite=100&id_titulo=<?=$titulo["id_titulo"]?>"></td>
					<td valign="middle"><?=$titulo["id_titulo"]?>&nbsp;-&nbsp;<?=$titulo["nome_titulo"]?></td>					
				</tr>
				<tr><td>&nbsp;</td></tr>
			<? } ?>
		</table>
		<? termina_quadro_branco(); ?>
		</center>
		<? require("desconectar_mysql.php"); ?>
	</body>
</html>
