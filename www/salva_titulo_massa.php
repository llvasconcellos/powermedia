<?
require("permissao_documento.php");
require("funcoes.php");
require("funcoes_strings.php");
require("conectar_mysql.php");

if($modo == "add"){
	if ($handle = opendir('dropbox')) {
		while (false !== ($file = readdir($handle))) {
			if(!is_dir($file)){
				$imagem_info = getimagesize("dropbox/" . $file);
				$imagem_tipo = $imagem_info[2];
				if($imagem_tipo != 2) $mensagem = "Existiam arquivos na pasta DROPBOX que não são do tipo JPG.";
				else{
					$nome_titulo = addslashes(substr($file, 0, -4)); 
					
					$query = "INSERT INTO titulos (nome_titulo, info_titulo, ordem_capa_titulo, id_tipo_media) VALUES ";
					$query .= "('" . $nome_titulo ."',";
					$query .= "'" . addslashes($info_titulo) ."',";
					$query .= "'" . $ordem_capa_titulo ."',";
					$query .= $id_tipo_media .")";
					$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
					$result = mysql_query("SELECT LAST_INSERT_ID();") or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
					$registro = mysql_fetch_row($result);
					$id_titulo = $registro[0];
				
					$img_titulo = "capas/" . str_pad($id_titulo, 11, "0", STR_PAD_LEFT) . ".jpg";
					if(rename("dropbox/" . $file, $img_titulo)){
						$query = "UPDATE titulos SET ";
						$query .= "img_titulo='" . $img_titulo . "'";
						$query .= " WHERE id_titulo='" . $id_titulo . "'";
						$result = mysql_query($query) or tela_erro("Erro ao atualizar registros no Banco de dados: " . mysql_error(), false);
					}
				}
			}
		}
		closedir($handle);
	}
	$url = "browser_titulos.php";
	if(strlen($mensagem) == 0) $mensagem = "Títulos cadastrados com sucesso!";
}

if($result) tela_ok($mensagem, $url);

require("desconectar_mysql.php");
?>