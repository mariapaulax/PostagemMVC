<?php

class HomeController
{
    public function index()
    {
        try{
            $colecPostagem =  Postagem::selecionaTodos();

            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');
            
            $parametros = array();
            $parametros['postagens'] = $colecPostagem;
            $conteudo = $template->render($parametros);
            echo $conteudo;
           
             
        }catch (Exception $e){
            echo $e->getMessage();
        }
   }
}
