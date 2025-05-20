<?php

class Rotas
{


     //metodo inicializar todas as ROTAS (URLs) da aplicação
     public function executar()
     {

          $url = '/';

          //var_dump($url);

          //verifica se a variável está definida na $_GET
          if (isset($_GET['url'])) {
               $url .= $_GET['url'];
          }

          //var_dump($url);

          //Defir uma variavel para armazenar parametros
          $parametro = array();



          //Varifique se a url não está vazia e não pode ser uma barra ( /)
          if (!empty($url) && $url != '/') {


               //var_dump("cheguei aqui");


               // Controller       (Controller)
               // Ação             (Método)
               // Informação Única (Parametro)    


               // servicos/nomeServico/1
               $url = explode('/', $url);

               array_shift($url); // remove a primeira posição  da ARRAY que é sempre a raiz

               $controladorAtual = ucfirst($url[0]) . 'Controller';

               array_shift($url);

               
               if (isset($url[0]) && !empty($url)) {
                    $acaoAtual = $url[0];
                    array_shift($url);

                    //var_dump('Nome da ação atual: ' . $acaoAtual);
                    //var_dump("Cheguei aqui e a URL não é vazia" . $url[0]);
               } else {
                    $acaoAtual = 'Index';
                    //var_dump("Cheguei aqui e a URL é vazia" . $url[0]);
                    //var_dump('Nome da ação atual: ' . $acaoAtual);
               }
               // Os parâmetros ficam na variável $url

               if (count($url) > 0) {
                    //var_dump(count($url));
                    $parametro = $url;
               }



               //var_dump($controladorAtual);
          } else {
               $controladorAtual = 'HomeController';
               $acaoAtual = 'index';
               //var_dump($controladorAtual);
               //var_dump($acaoAtual);
          }

          //verificar se o arquivo do CONTROLLER e a AÇÃO (metodo) existe
          if (
               !file_exists('../app/controllers/' . $controladorAtual . '.php') ||
               !method_exists($controladorAtual, $acaoAtual)
          ) {
               //var_dump('Não existe! ' . $controladorAtual);
               //var_dump('Não existe o metodo: ', $acaoAtual );

               //Se não existir definir o controller  e um Método padrão
               $controladorAtual = 'ErroController';
               $acaoAtual = 'index';
          }

          $controller = new $controladorAtual();

          call_user_func_array(array($controller, $acaoAtual), $parametro);
     }
}
