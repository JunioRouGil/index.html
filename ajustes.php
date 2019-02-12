// Alterações no formulário
// Adicionar action e method na tag <form>
// Na action, colocar o nome do arquivo que vai receber os dados e vai gravar no banco
// No arquivo persistir.php você vai precisar receber os dados do formulário e gravar no banco
// Alterar o tipo do arquivo de index.html para index.php (para o php poder pegar o IP do usuário e a data)


// INÍCIO DO FORMULÁRIO
<div class="modal-body">
                        <form action="persistir.php" method="post">
                            <div class="row">
                                <div class="form-group col-6 mx-auto mt-4">
                                    <input type="text" class="form-control" id="name" name="nome" placeholder="Nome Completo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6 mx-auto">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="SeuEmail@email.com.br">
                                    <small id="emailHelp" class="form-text text-muted">
                                        Seus dados estÃ£o seguros conosco. Prometemos nunca enviar spam ou compartilhar com
                                        parceiros
                                    </small>
                                </div>
                                <br />
                                <?php
                                    // Verifica o tipo da hospedagem e define como vai pegar o IP
                                    function get_client_ip() {
                                        $ipaddress = '';
                                        if (isset($_SERVER['HTTP_CLIENT_IP']))
                                            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                                        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                                            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                        else if(isset($_SERVER['HTTP_X_FORWARDED']))
                                            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                                        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                                            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                                        else if(isset($_SERVER['HTTP_FORWARDED']))
                                            $ipaddress = $_SERVER['HTTP_FORWARDED'];
                                        else if(isset($_SERVER['REMOTE_ADDR']))
                                            $ipaddress = $_SERVER['REMOTE_ADDR'];
                                        else
                                            $ipaddress = 'UNKNOWN';
                                        return $ipaddress;
                                    }
                                ?>  
                                <!-- PARA OCULTAR, MUDAR O TYPE PARA hidden -->
                                    <input type="hidden" value="<?=get_client_ip();?>" name="ip">
                                    <input type="hidden" value="<?= date('Y-m-d h:i:s')?>" name="data">
                            </div>


                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary mb-3">Enviar</button>
                            </div>
                        </form>
                    </div>
                    
// FIM DO FORMULÁRIO





// INÍCIO DO ARQUIVO "GERAR CSV"

// ESSE FOI UM TRECHO DE CÓDIGO QUE EU ACHEI E TESTEI COM O MEU BANCO MYSQL E FUNCIONOU
// VOCÊ VAI PRECISAR PESQUISAR COMO ACESSAR O BANCO FIREBASE E ADAPTAR A LINHA 72 PARA A SUA NECESSIDADE
// PASSANDO AS INFORMAÇÕES DE ACESSO AO SEU BANCO FIREBASE

// VOCÊ ESTAVA TENTANDO GERAR O ARQUIVO CSV NO ARQUIVO SAVE.PHP
// PELO QUE EU ENTENDI, VOCÊ NÃO PRECISA GERAR O CSV NO BLOG
// PRECISA ENTREGAR O CSV COM OS LEADS
// OU SEJA, PRIMEIRO VOCÊ VAI PRECISAR GRAVAR OS LEADS NO BANCO
// PARA DEPOIS PEGAR DO BANCO E SALVAR NO CSV (IGUAL ESTÁ SENDO FEITO NO SCRIPT ABAIXO)
// PS. O SCRIPT ABAIXO PROVAVELMENTE NÃO ESTÁ DO JEITO QUE VOCÊ PRECISA MAS JÁ ESTÁ GERANDO O CSV

<?php
   
   header( 'Content-type: application/csv' );   
   header( 'Content-Disposition: attachment; filename=file.csv' );   
   header( 'Content-Transfer-Encoding: binary' );
   header( 'Pragma: no-cache');

   // Alterar a linha de conexão abaixo para os dados do seu banco Firebase
   $pdo = new PDO( 'mysql:host=localhost;dbname=sysrh', 'root', 'n6260111' );
   $stmt = $pdo->prepare( 'SELECT * FROM cargo' );   
   $stmt->execute();
   $results = $stmt->fetchAll( PDO::FETCH_ASSOC );

   $out = fopen( 'php://output', 'w' );
   foreach ( $results as $result ) 
   {
      fputcsv( $out, $result );
   }
   fclose( $out );
?>
    
    
