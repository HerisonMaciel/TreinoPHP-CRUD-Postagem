<?php

	class Comentario
	{
		public static function buscarComentarios($idPost)
		{
			$con = Connection::getConn();

			$sql = "SELECT * FROM comentario WHERE id_postagem = :id";
			$sql = $con->prepare($sql);
			$sql->bindValue(':id', $idPost, PDO::PARAM_INT);
    		$sql->execute();

    		$resultado = array();

    		while($row = $sql->fetchObject('Comentario')){
    			$resultado[] = $row;
    		}

    		return $resultado;

		}

		public static function inserirComent($params)
		{
			$con = Connection::getConn();

			$sql = "INSERT INTO comentario (nome, mensagem, id_postagem) VALUES (:nom, :mens, :idp)";
			$sql = $con->prepare($sql);
			$sql->bindValue(':nom', $params['nome']);
			$sql->bindValue(':mens', $params['mensagem']);
			$sql->bindValue(':idp', $params['id_postagem']);
    		$resultado = $sql->execute();
    		
    		if($resultado==false){
    			throw new Exception("Não foi possível comentar!");
    			return false;
    		}

    		return true;
		}
	}