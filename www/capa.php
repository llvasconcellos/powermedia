<?
require("conectar_mysql.php");
$query = "SELECT * FROM titulos WHERE id_titulo=" . $id_titulo;
$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
$registro = mysql_fetch_assoc($result);
$img_titulo = $registro["img_titulo"];
$id_tipo_media = $registro["id_tipo_media"];
$ordem_capa_titulo = $registro["ordem_capa_titulo"];
require("desconectar_mysql.php");

$imagem_arquivo = imagecreatefromjpeg($img_titulo);
if($ordem_capa_titulo == "n"){
	$nova_imagem = imagerotate($imagem_arquivo, 180, 255);
	echo(imagejpeg($nova_imagem));
}
else echo(imagejpeg($imagem_arquivo));
?>