<?php


class Postagem
{
   
    public static function selecinaTodasPostagem(){

    	$con = Connection::getConn();

    	$sql = "SELECT * FROM postagem ORDER BY id DESC";
    	$sql = $con->prepare($sql);
    	$sql->execute();

    	$resultados = array();

    	
    	while ($row = $sql->fetchObject('Postagem'))
    	{
    		$resultados[] = $row;
    	}
    	
    	if(!$resultados){
    		throw new Exception("Nenhuma postagem foi encontrada");
            return false;
    	}

    	return $resultados;

    }

     public static function selecionaPostagemId($idPost)
    {
    	$con = Connection::Getconn();

    	$sql = "SELECT * FROM postagem WHERE id = :id";
    	$sql = $con->prepare($sql);
    	$sql->bindValue(':id', $idPost, PDO::PARAM_INT);
    	$sql->execute();

    	$resultado = $sql->fetchObject('Postagem');

    	if(!$resultado){
    		throw new Exception("Nenhuma postagem foi encontrada", 1);
    	}else{
    		$resultado->comentarios = Comentario::buscarComentarios($resultado->id);	
    	}

    	return $resultado;
    }

    public static function insert($dadosPost)
    {

        if(empty($dadosPost['titulo']) || empty($dadosPost['conteudo'])){
            throw new Exception("Preencha todos os campos");
            return false;
        }

        $con = Connection::Getconn();

        $sql = "INSERT INTO postagem (titulo, conteudo) VALUES (:tit, :cont)";
        $sql = $con->prepare($sql);
        $sql->bindValue(':tit', $dadosPost['titulo']);
        $sql->bindValue(':cont', $dadosPost['conteudo']);
        $res = $sql->execute();

        if($res == false){
            throw new Exception("Falha ao inserir publicação");
            return false;
        }

        return true;
    }

    public static function update($params)
    {

        if(empty($params['titulo']) || empty($params['conteudo'])){
            throw new Exception("Preencha todos os campos");
            return false;
        }

        $con = Connection::Getconn();

        $sql = "UPDATE postagem SET titulo = :tit, conteudo = :cont WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $params['id']);
        $sql->bindValue(':tit', $params['titulo']);
        $sql->bindValue(':cont', $params['conteudo']);
        $resultado = $sql->execute();

        if($resultado == false){
            throw new Exception("Falha ao alterar publicação");
            return false;
        }

        return true;
    }

    public static function delete($paramId)
    {
        $con = Connection::Getconn();

        $sql = "DELETE FROM postagem WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $paramId, PDO::PARAM_INT);
        $resultado = $sql->execute();

        if($resultado == false){
            throw new Exception("Não foi possível deletar!", 1);
            return false;
        }

        return true;
    }

}