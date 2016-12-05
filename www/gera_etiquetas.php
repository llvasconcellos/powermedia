<?
require("funcoes.php");
require("conectar_mysql.php");
?>
<html>
	<head>
		<title>Impressão de Etiquetas</title>
		<style type="text/css">
		td {
			text-align: center;
			vertical-align: middle;
			font-size: <?=$fonte?>;
			font-family:Arial, Helvetica, sans-serif;
			page-break-inside: avoid;
			width: <?=$largura?>;
			height: <?=$altura?>;
		}
		</style>
	</head>
	<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
		<table width="100%" cellpadding="0" cellspacing="0" <? if($borda == "on") echo('border="1"'); ?>>
		<tr>
		<?
		$j = 0; 
		$i = 1;
		for($count = 0; $count < $qtd_impressa; $count++){
			echo("<td>&nbsp;</td>");
			$j++;
			if ($j == $etiquetas_linha){
				if($i == $linhas_pagina_etiqueta){
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
		if(strlen($multiplicador) == 0){
			for($i = 0; $i < count($capas); $i++){
				$query = "SELECT * FROM titulos WHERE id_titulo = " . $capas[$i];
				$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
				$vcd = mysql_fetch_assoc($result); 
				?>
					<td style="page-break-inside: avoid;">
						<font color="#FF0000"><?=$vcd["id_titulo"]?></font>&nbsp;-&nbsp;<?=substr($vcd["nome_titulo"], 0, $limite_caracteres)?><br>
					</td>
					<td style="width:<?=$espacamento_etiquetas?>;"></td>
				<?
				$j++;
				if ($j == $etiquetas_linha){
					if($i == $linhas_pagina_etiqueta){
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
		}
		else{
			$query = "SELECT * FROM titulos WHERE id_titulo = " . $capas[0];
			$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
			$vcd = mysql_fetch_assoc($result); 
			for($i = 0; $i <= $multiplicador; $i++){ ?>
					<td style="page-break-inside: avoid;">
						<font color="#FF0000"><?=$vcd["id_titulo"]?></font>&nbsp;-&nbsp;<?=substr($vcd["nome_titulo"], 0, $limite_caracteres)?><br>
					</td>
					<td style="width:<?=$espacamento_etiquetas?>;"></td>
				<?
				$j++;
				if ($j == $etiquetas_linha){
					if($i == $linhas_pagina_etiqueta){
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
		}
		?>
		</tr>
	</table>
		<? require("desconectar_mysql.php"); ?>
	</body>
</html>