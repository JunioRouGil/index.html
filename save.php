<?php
    //Caminho e nome do arquivo (se colocar s� o nome do arquivo, ele deve estar na mesma pasta do PHP !!)
    $file = "lista.csv";
    //Carregar o arquivo existente
    $current = file_get_contents($file);
    //Criar (usando informa��es fornecidas pelo formul�rio HTML) e adicionar nova linha ao conte�do j� existente
    $current .= $_POST['nome'].', '.$_POST['mail'].', '.$_POST['sexo'][0]."\n";
    //Adicionar conte�do todo ao arquivo
    file_put_contents($file, $current);
?>