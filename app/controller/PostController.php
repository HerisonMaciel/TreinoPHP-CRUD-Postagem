<?php


class PostController
{
    public function index($params)
    {	

    	try{

    		$postagemId = Postagem::selecionaPostagemId($params);
            
    		$loader = new \Twig\Loader\FilesystemLoader('app/view');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('single.html');

			$parametros = array();
            $parametros['id'] = $postagemId->id;
			$parametros['titulo'] = $postagemId->titulo;
            $parametros['conteudo'] = $postagemId->conteudo;
            $parametros['comentarios'] = $postagemId->comentarios;

			$conteudo = $template->render($parametros);
 			echo $conteudo;


    	}catch(Exception $e){
    		echo $e->getMessage();
    	}

    }

    public function addComent()
    {
        try {
            $comentario = Comentario::inserirComent($_POST);   
            header('location: ?pagina=post&id='.$_POST['id_postagem'].'');
        } catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage().'")</script>';
            echo '<script>location.href="?pagina=post&id='.$_POST['id_postagem'].'"</script>';
        }
        
    }

}