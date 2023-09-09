<?php
    // Conexão com Banco de Dados
    require 'config.php';

    //Verificando se teve o envio de mensagem
    if(isset($_POST['nome']) && !empty($_POST['nome'])) {
        //caso ocorreu o envio vem para cá
        $nome = $_POST['nome'];
        $mensagem = $_POST['mensagem'];

        //prepara para adicionar no banco
        $sql = $pdo->prepare("INSERT INTO mensagens SET nome = :nome, msg = :msg, data_msg = NOW()");
        //Adicionando os itens
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":msg", $mensagem);
        $sql->execute();
        header("Location: index.php");
    }

?>

<!-- Campo de escrita do comentário -->
<fieldset>
    <form method="POST">
        Nome: <br>
        <input type="text" name="nome">
        <br><br>
        Mensagem: <br>
        <textarea name="mensagem"cols="30" rows="10"></textarea>
        <br><br>

        <input type="submit" value="Enviar Mensagem">
    </form>
</fieldset>
<br>

<?php
// Fazer a listagem dos comentários
$sql = "SELECT * FROM mensagens ORDER BY data_msg DESC";
$sql = $pdo->query($sql);

if($sql->rowCount() > 0 ) {
    foreach($sql->fetchAll() as $mensagem):
        ?>
            <strong><?php echo $mensagem['nome']; ?></strong>
            <br>
            <?php echo $mensagem['msg']; ?>
            <hr>
        <?php
    endforeach;
} else {

    echo "Não há mensagens.";
}

?>