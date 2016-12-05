<?
require("permissao_documento.php");
require("funcoes.php");
require("funcoes_strings.php");
require("conectar_mysql.php");

error_reporting(E_ALL);
if($modo == "apagar"){
	$query = "SELECT img_titulo FROM titulos WHERE id_titulo=" . $id_titulo;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
	$path = mysql_fetch_row($result);
	$path = $path[0];
	unlink($path);

	$query = "DELETE FROM titulos WHERE id_titulo=" . $id_titulo;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
		
	$mensagem = "Título removido com sucesso!";
	$url = "browser_titulos.php?pagina=" . $pagina;
	if($result) tela_ok($mensagem, $url);
	die();
}

if($modo == "add"){
	$query = "INSERT INTO titulos (nome_titulo, info_titulo, ordem_capa_titulo, id_tipo_media) VALUES ";
	$query .= "('" . $nome_titulo ."',";
	$query .= "'" . $info_titulo ."',";
	$query .= "'" . $ordem_capa_titulo ."',";
	$query .= $id_tipo_media .")";
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
	$result = mysql_query("SELECT LAST_INSERT_ID();") or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
	$registro = mysql_fetch_row($result);
	$id_titulo = $registro[0];
	
	$url = "form_titulo.php?modo=update&id_titulo=" . $id_titulo;
	$mensagem = "Título cadastrado com sucesso!";
}
if($modo == "update"){
	$query = "UPDATE titulos SET ";
	$query .= "nome_titulo='" . $nome_titulo . "', ";
	$query .= "info_titulo='" . $info_titulo . "', ";
	$query .= "ordem_capa_titulo='" . $ordem_capa_titulo . "', ";
	$query .= "id_tipo_media=" . $id_tipo_media;
	$query .= " WHERE id_titulo='" . $id_titulo . "'";
	$mensagem = "Informações alteradas com sucesso!";
	$url = "form_titulo.php?modo=update&id_titulo=" . $id_titulo;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
}

if((strlen($_FILES["img_titulo"]["tmp_name"]) > 0) && (strlen($_FILES["contra_capa_titulo"]["tmp_name"]) == 0)){
	$query = "SELECT img_titulo FROM titulos WHERE id_titulo=" . $id_titulo;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
	$path = mysql_fetch_row($result);
	$path = $path[0];
	unlink($path);
	
	$imagem_info = getimagesize($_FILES["img_titulo"]["tmp_name"]);
	$imagem_tipo = $imagem_info[2];
	if($imagem_tipo != 2) tela_erro("Envie apenas imagens do tipo JPG.", false);
	else{
		$img_titulo = "capas/" . str_pad($id_titulo, 11, "0", STR_PAD_LEFT) . ".jpg";
		if(move_uploaded_file($_FILES["img_titulo"]["tmp_name"], $img_titulo)){
			$query = "UPDATE titulos SET ";
			$query .= "img_titulo='" . $img_titulo . "'";
			$query .= " WHERE id_titulo='" . $id_titulo . "'";
			$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
		}
	}
}
elseif((strlen($_FILES["img_titulo"]["tmp_name"]) > 0) && (strlen($_FILES["contra_capa_titulo"]["tmp_name"]) > 0)){
	$query = "SELECT img_titulo FROM titulos WHERE id_titulo=" . $id_titulo;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
	$path = mysql_fetch_row($result);
	$path = $path[0];
	unlink($path);	
	
	$capa = imagecreatetruecolor(1350, 750) or die("Problema com inicialização da imagem");
	$frente = imagecreatefromjpeg($_FILES["img_titulo"]["tmp_name"]);
	$verso = imagecreatefromjpeg($_FILES["contra_capa_titulo"]["tmp_name"]);
	
	$pixels = getimagesize($_FILES["img_titulo"]["tmp_name"]);
	$largura_frente = $pixels[0];
	$altura_frente = $pixels[1];

	$pixels = getimagesize($_FILES["contra_capa_titulo"]["tmp_name"]);
	$largura_verso = $pixels[0];
	$altura_verso = $pixels[1];


	imagecopyresampled($frente, $frente, 0, 0, 0, 0, 675, 750, $largura_frente, $altura_frente);
	imagecopyresampled($verso, $verso, 0, 0, 0, 0, 675, 750, $largura_verso, $altura_verso);

	imagecopymerge($capa, $frente, 0, 0, 0, 0, 675, 750, 100);
	imagecopymerge($capa, $verso, 676, 0, 0, 0, 675, 750, 100);
	
	
	$img_titulo = "capas/" . str_pad($id_titulo, 11, "0", STR_PAD_LEFT) . ".jpg";
	imagejpeg($capa, $img_titulo);
	
	$query = "UPDATE titulos SET ";
	$query .= "img_titulo='" . $img_titulo . "'";
	$query .= " WHERE id_titulo='" . $id_titulo . "'";
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
	
}

if($result) tela_ok($mensagem, $url);

require("desconectar_mysql.php");
?>