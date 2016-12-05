<html>
	<head>
		<title>Impressão de Capas</title>
		<style type="text/css">
		.recipiente {
			text-align: center;
			vertical-align: middle;
			width: 100%;
			height: 768;
			page-break-inside: avoid;
		}
		</style>
	</head>
	<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<?
		require("funcoes.php");
		require("conectar_mysql.php");
		for($i = 0; $i < count($capas); $i++){
			$query = "SELECT c.id_titulo, t.pixel_w, t.pixel_h FROM titulos c, tipo_media t WHERE c.id_tipo_media = t.id_tipo_media AND id_titulo = " . $capas[$i];
			$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
			$registro = mysql_fetch_assoc($result);
			echo('<table width="100%" cellpadding="0" cellspacing="0"><tr><td class="recipiente"');
			if($i == 0) echo('>');
			else echo(' style="page-break-before: always;">');
			echo('<img src="capa.php?id_titulo=' . $registro["id_titulo"] . '" width="' . $registro["pixel_w"] . '" height="' . $registro["pixel_h"] . '">');
			echo('</td></tr></table>');
		}
		require("desconectar_mysql.php");
	?></body>
</html>
