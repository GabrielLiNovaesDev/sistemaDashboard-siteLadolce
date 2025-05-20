<?php

// arquivos do phpmailer
require_once('phpmailer/src/PHPMailer.php');
require_once('phpmailer/src/SMTP.php');

function enviarEmail($dados)
{
    try {
        $enviar = new PHPMailer\PHPMailer\PHPMailer();
        $enviar->isSMTP();
        $enviar->SMTPDebug = 0;
        $enviar->Host = "smtp.hostinger.com";
        $enviar->Port = 465;
        $enviar->SMTPSecure = 'ssl';
        $enviar->SMTPAuth = true;
        $enviar->Username = 'ti26@smpsistema.com.br';
        $enviar->Password = "Senac@ti26";
        $enviar->isHTML(true);

        //Configurar o email principal
        $enviar->setFrom("ti26@smpsistema.com.br", $dados['nome']);
        $enviar->addAddress("glima.gn100@gmail.com", $dados['Contato La Dolce Gelato']);
        $enviar->Subject = $dados['assunto'];
        $enviar->msgHTML("Nome: {$dados['nome']} <br>
                                E-Mail: {$dados['email']} <br>
                                Assunto: {$dados['assunto']} <br>
                                Mensagem: {$dados['mensagem']}");
        $enviar->AltBody = "Nome: {$dados['nome']} \n
                                E-Mail: {$dados['email']} \n
                                Assunto: {$dados['assunto']} \n
                                Mensagem: {$dados['mensagem']}";

        if (!$enviar->send()) {
            throw new Exception("erro ao enviar o E-Mail: " . $enviar->ErrorInfo);
        }
    } catch (Exception $e) {
        return false;
    }
    return true;
}


// Email de resposta
function enviarEmailResposta($dados)
{
    try {
        $enviar = new PHPMailer\PHPMailer\PHPMailer();
        $enviar->isSMTP();
        $enviar->SMTPDebug = 0;
        $enviar->Host = "smtp.hostinger.com";
        $enviar->Port = 465;
        $enviar->SMTPSecure = 'ssl';
        $enviar->SMTPAuth = true;
        $enviar->Username = 'ti26@smpsistema.com.br';
        $enviar->Password = "Senac@ti26";
        $enviar->isHTML(true);

        //Configurar o email principal
        $enviar->setFrom("ti26@smpsistema.com.br", "Resposta La Dolce Gelato");
        $enviar->addAddress($dados['email'], $dados['nome']);
        $enviar->Subject = $dados['assunto'];
        $enviar->msgHTML("Olá: {$dados['nome']},
                                Em breve retornaremos seu contato.
                                Mensagem: {$dados['mensagem']}
                                Em caso de dúvidas ligar para (11) 95388-5367");
        $enviar->AltBody = "Olá: {$dados['nome']}, \n
                            Em breve retornaremos seu contato. \n
                            Mensagem: {$dados['mensagem']} \n  
                            Em caso de dúvidas ligar para (11) 95388-5367";
        $enviar->send();
    } catch (Exception $e) {
        return false;
    }
    return true;
}

// Função para salvar as informações de contato no banco de dados
function salvarContato($dados)
{
    try {
        // Abrir a conexão com o banco de dados utilizando PDO
        $pdo = new PDO("mysql:host=smpsistema.com.br;dbname=u283879542_omuratec", "u283879542_omuratec", "@OmuraTi26");

        // Conexão alternativa comentada (remota) — para uso em produção.
        //$pdo = new PDO("mysql:host=localhost;dbname=db_ladolce", "root", ""); // Conexão local com o banco 'db_ladolce' e usuário 'root'.

        // Configura o PDO para lançar exceções em caso de erro
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL para inserir as informações de contato na tabela 'tbl_contato'
        // A consulta utiliza parâmetros nomeados (placeholders) para evitar SQL Injection
        $inserir = "INSERT INTO tbl_contato (nome_contato, telefone_contato, email_contato, mensagem_contato, status_contato, assunto_contato)
                     VALUES (:nome, :tel, :email, :mensagem, 'Aguardando', :assunto)";

        // Prepara a consulta SQL
        $stmt = $pdo->prepare($inserir);

        // Associa os valores dos dados aos parâmetros na consulta SQL
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':tel', $dados['fone']);
        $stmt->bindParam(':email', $dados['email']);
        $stmt->bindParam(':assunto', $dados['assunto']);
        $stmt->bindParam(':mensagem', $dados['mensagem']);

        // Executa a consulta SQL no banco de dados
        $stmt->execute();

        // Retorna true se a inserção foi bem-sucedida
        return true;
    } catch (PDOException $e) {
        // Caso ocorra um erro na conexão ou execução da consulta, ele é registrado no log de erros
        error_log("Erro ao salvar no banco de dados: " . $e->getMessage());

        // Retorna false se ocorreu erro
        return false;
    }
}

// Estrutura lógica para verificar o envio do formulário e salvar os dados no banco
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    // Captura os dados do formulário e os sanitiza para evitar ataques de XSS e SQL Injection
    $dados = [
        'nome' => htmlspecialchars($_POST['nome']), // Protege o nome contra XSS
        'fone' => htmlspecialchars($_POST['fone']),
        'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL), // Filtra e sanitiza o email       
        'assunto' => htmlspecialchars($_POST['assunto']), // Protege o assunto contra XSS
        'mensagem' => htmlspecialchars($_POST['mensagem']), // Protege a mensagem contra XSS
    ];

    // Chama a função para salvar os dados no banco de dados
    $contatosalvo = salvarContato($dados);

    // Se o contato foi salvo com sucesso
    if ($contatosalvo) {

        // Envia um email para o administrador com os dados do contato
        $emailEnviado = enviarEmail($dados);

        // Se o email foi enviado com sucesso
        if ($emailEnviado) {
            // Envia uma resposta automática para o usuário
            enviarEmailResposta($dados);

            // Redireciona para a página principal com um status de sucesso
            header("Location: index.php?status=sucesso");
            exit; // Interrompe a execução do script após o redirecionamento
        } else {
            // Se não foi possível enviar o email, redireciona com erro
            header("Location: index.php?status=erro");
            exit;
        }
    } else {
        // Se houve erro ao salvar os dados no banco, redireciona com erro
        header("Location: index.php?status=erro_banco");
        exit;
    }
}
