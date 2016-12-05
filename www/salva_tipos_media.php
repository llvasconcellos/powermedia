<?
require("funcoes.php");
require("permissao_documento.php");
require("conectar_mysql.php");

if($modo == "apagar"){
	$query = "UPDATE titulos SET id_tipo_media = 0 WHERE id_tipo_media='" . $id_tipo_media . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	
	$query = "DELETE FROM tipo_media WHERE id_tipo_media='" . $id_tipo_media . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error());
	$mensagem = "Tipo de mídia removido com sucesso!";
	$url = "browser_tipos_media.php?pagina=" . $pagina;
	if($result) tela_ok($mensagem, $url);
	die();
}


if($modo == "add"){
	$query = "SELECT nome_tipo_media FROM tipo_media WHERE nome_tipo_media='" . $nome_tipo_media . "'";
	$result = mysql_query($query) or tela_erro("Erro de conexão ao banco de dados: " . mysql_error(), false);
	if(mysql_num_rows($result)>0) tela_erro("Já existe um tipo de mídia cadastrado com este nome.", false);
	else{
		$query = "INSERT INTO tipo_media (nome_tipo_media, pixel_w, pixel_h) VALUES ";
		$query .= "('" . $nome_tipo_media ."', ";
		$query .= "'" . $pixel_w ."', ";
		$query .= "'" . $pixel_h ."') ";
		$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
		$result = mysql_query("SELECT LAST_INSERT_ID();") or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
		$registro = mysql_fetch_row($result);
		$id_tipo_media = $registro[0];
		$url = "form_tipos_media.php?modo=update&id_tipo_media=" . $id_tipo_media;
		$mensagem = "Tipo de mídia cadastrado com sucesso!";
	}
}
if($modo == "update"){
	$query = "UPDATE tipo_media SET ";
	$query .= "nome_tipo_media='" . $nome_tipo_media . "', ";
	$query .= "pixel_w='" . $pixel_w . "', ";
	$query .= "pixel_h='" . $pixel_h . "'";
	$query .= " WHERE id_tipo_media='" . $id_tipo_media . "'";
	$mensagem = "Informações alteradas com sucesso!";
	$url = "form_tipos_media.php?modo=update&id_tipo_media=" . $id_tipo_media;
	$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
}
if($result) tela_ok($mensagem, $url);

require("desconectar_mysql.php")
?>