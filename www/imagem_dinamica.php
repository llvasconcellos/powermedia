<?
require("conectar_mysql.php");
$query = "SELECT * FROM titulos WHERE id_titulo=" . $id_titulo;
$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
$registro = mysql_fetch_assoc($result);
$img_titulo = $registro["img_titulo"];
$id_tipo_media = $registro["id_tipo_media"];
$ordem_capa_titulo = $registro["ordem_capa_titulo"];
require("desconectar_mysql.php");

$JPG_QUALITY = 90;


$imagem_arquivo = $img_titulo;
$imagem_info = getimagesize($imagem_arquivo);
$imagem_largura = $imagem_info[0];
$imagem_altura = $imagem_info[1];
$imagem_tipo = $imagem_info[2];

if($imagem_largura > $imagem_altura) $fator_proporcao = $largura_limite / $imagem_largura;
else $fator_proporcao = $altura_limite / $imagem_altura;
if ($fator_proporcao > 1) $fator_proporcao = 1;

$nova_largura_img = $imagem_largura * $fator_proporcao;
$nova_altura_img = $imagem_altura * $fator_proporcao;

$imagem_original = imagecreatefromjpeg($imagem_arquivo);

$nova_largura_img = $imagem_largura * $fator_proporcao;
$nova_altura_img = $imagem_altura * $fator_proporcao;
$nova_imagem = imagecreatetruecolor($nova_largura_img,$nova_altura_img) or die("erro de imagem"); 
imagecopyresampled($nova_imagem, $imagem_original, 0, 0, 0, 0, $nova_largura_img, $nova_altura_img, $imagem_largura, $imagem_altura) or die("erro de imagem"); 
if($ordem_capa_titulo == "i"){
	$nova_imagem = imagerotate($nova_imagem, 180, 255);
}
echo(imagejpeg($nova_imagem));
?>