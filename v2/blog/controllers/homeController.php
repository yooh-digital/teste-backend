<?php

class homeController extends controller{
  
  public function index(){  

    $dados = array();

    $p = new Postagens();

    // Preparando a paginação
    $totalPostagens = $p->getTotalPostagens();    

    $paginas = ceil($totalPostagens / 3); // Cálculo do total de páginas, ceil() = arredonda resultado para cima

    $pg = 1; // Número inicial da primeira página

    if(isset($_GET['p']) && !empty($_GET['p'])){
      $pg = addslashes($_GET['p']); // Define o novo número da página atual
    }

    $postagemPorPagina = ($pg - 1) * 3; // Define o total de postagens para cada página, no caso, 3.    

    $dados['postagens'] = $p->getResumoPostagens($postagemPorPagina);
    $dados['paginas'] = $paginas;

    $this->loadTemplate('home', $dados);
  }  

}
