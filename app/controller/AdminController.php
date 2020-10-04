<?php

class AdminController
{
   
    public function index()
    {
    
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('admin.html');
        
            $objPostagens = Postagem::selecionaTodos();

            $parametros = array();
            $parametros['postagens'] = $objPostagens;
           
            $conteudo = $template->render($parametros);
            echo $conteudo;
           
   }
   public function create(){
      
    $loader = new \Twig\Loader\FilesystemLoader('app/view');
    $twig = new \Twig\Environment($loader);
    $template = $twig->load('create.html');

    $parametros = array();
   
    $conteudo = $template->render($parametros);
    echo $conteudo;
   }
   public function insert(){
      try{

          Postagem::insert($_POST);
          echo '<script> alert("Publicação inserida com sucesso!");</script>';
          echo '<script> location.href="http://127.0.0.1/ProjetoMvc/?pagina=admin&metodo=index"</script>';
      }catch(Exception $e){
           echo '<script> alert("'.$e->getMessage().'");</script>';
           echo '<script> location.href="http://127.0.0.1/ProjetoMvc/?pagina=admin&metodo=create"</script>';
      }
   }
   public function change($paramId){
      $loader = new \Twig\Loader\FilesystemLoader('app/view');
      $twig = new \Twig\Environment($loader);
      $template = $twig->load('update.html');
      
      $post = Postagem::selecionarPorId($paramId); 
 
       
      $parametros = array();
      $parametros['id'] = $post->id;
      $parametros['titulo'] = $post->titulo;
      $parametros['conteudo'] =$post->conteudo;
      $conteudo = $template->render($parametros);
      echo $conteudo;
   }

   public function upDate(){
      try{
         Postagem::upDate($_POST);
         echo '<script> alert("Publicação Alterada com sucesso!");</script>';
         echo '<script> location.href="http://127.0.0.1/ProjetoMvc/?pagina=admin&metodo=index"</script>';
      }catch(Exception $e){
         echo '<script> alert("'.$e->getMessage().'");</script>';
         echo '<script> location.href="http://127.0.0.1/ProjetoMvc/?pagina=admin&metodo=change&id='.$_POST['id'].'"</script>';
      }
     
   }
   public function delete($paramId){
      try{
         Postagem::delete($paramId);
         echo '<script> alert("Publicação excluido com sucesso!");</script>';
         echo '<script> location.href="http://127.0.0.1/ProjetoMvc/?pagina=admin&metodo=index"</script>';
      }catch(Exception $e){
         echo '<script> alert("'.$e->getMessage().'");</script>';
         echo '<script> location.href="http://127.0.0.1/ProjetoMvc/?pagina=admin&metodo=index"</script>';
      }
     
   }
}
