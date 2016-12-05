<?
require("funcoes.php");
require("conectar_mysql.php");
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
		<table width="100%" cellspacing="5" cellpadding="5" border="0">
		<tr>
		<?
		require("conectar_mysql.php");		
		if($completo == "on"){
			$query = "TRUNCATE TABLE historico_catalogo";
			$result = mysql_query($query);
		}
		$query = "SELECT t.id_titulo, t.id_tipo_media, t.nome_titulo FROM titulos t LEFT OUTER JOIN historico_catalogo h ON t.id_titulo = h.id_titulo WHERE h.id_titulo IS NULL AND t.id_tipo_media = " . $id_tipo_media . " ORDER BY nome_titulo";
		$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
		$j = 0; 
		$i = 1;
		while ($vcd = mysql_fetch_assoc($result)) { 
			$query2 = "INSERT INTO historico_catalogo VALUES(" . $vcd["id_titulo"] . "," .  $vcd["id_tipo_media"] . ")";
			$result2 = mysql_query($query2);
		?>
			<td>
				<img border="0" src="imagem_dinamica.php?largura_limite=<?=$largura?>&id_titulo=<?=$vcd["id_titulo"]?>">
				<br>
				<?=$vcd["id_titulo"]?>&nbsp;-&nbsp;<?=$vcd["nome_titulo"]?><br>
			</td>
		<?
			$j++;
			if ($j == $linha){
				if($i == $linha_pagina){
					echo('</tr><tr style="page-break-before: always;">');
					$i = 1;
				}
				else{
					echo("</tr><tr>");
					$i++;
				}
				$j = 0;
				
			}
		}
		?>
		</tr>
	</table>
		<? require("desconectar_mysql.php"); ?>
	</body>
</html>
