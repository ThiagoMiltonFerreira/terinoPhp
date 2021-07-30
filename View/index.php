<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Título da página</title>
    <meta charset="utf-8">
  </head>
  <body>
  <?php
      if(isset($_GET['message'])){
        echo "<h1>".$_GET['message']."</h1>";
      }

  if(isset($_GET['alteracao']) && $_GET['alteracao']== 1 ){
    echo "<form action='../Controller/alterar.php' method='POST'>";
  }else {
    echo "<form action='../Controller/inserir.php' method='POST'>";
  }
  ?>
  
    <div class="form-group">
        <label for="inputNameCli">Nome do cliente: </label>
        <input type="text" class="form-control" name="nome_cliente" placeholder="Nome completo" value="<?php echo isset($_GET['nome_cliente']) ? $_GET['nome_cliente']: '';?>" required>
    </div>
    <div class="form-group">
        <label for="inputEmailCli">E-mail do cliente:</label>
        <input type="email" class="form-control" name="email_cliente" placeholder="Digite aqui o e-mail do cliente." value="<?php echo isset($_GET['email_cliente']) ? $_GET['email_cliente']: '';?>" required>
        <small id="inputEmailCli" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
    </div>
    <div class="form-group">
        <label for="inputTelCli">Telefone do cliente:</label>
        <input type="text" class="form-control phone-ddd-mask" name ="telefone_cliente" placeholder="(00) 00000-0000" id="telefone" value="<?php echo isset($_GET['telefone_cliente']) ? $_GET['telefone_cliente']: '';?>"required>   
    </div>
    <div class="form-group">
        <label for="inputPassword">Senha do cliente:</label>
        <input type="password" class="form-control" name="senha_cliente"placeholder="Senha" >
    </div>
    <div class="form-group">
        <label for="inputPassword">Data de nascimento do cliente:</label>
        <input type="date" class="form-control" name="data_nasc_cliente" value="<?php echo isset($_GET['data_nasc_cliente']) ? $_GET['data_nasc_cliente']: '';?>" required>
    </div> <br>
    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>
  <br><br>
  <button onclick="window.location.href = 'http://localhost/Construsite/View/?message=Visualizar Todos Clientes'" class="btn btn-primary">Visualizar todos clientes</button>

  <?php
      if(isset($_GET['message'])){
        include_once "../Controller/CarregarDados.php";
        $dados = $conexao->carregarDados();
      }else if(isset($_GET['id'])&&isset($_GET['alterar'])&&$_GET['alterar']==true){
        include_once "../Controller/CarregarDados.php";
        $dados = $conexao->carregarDadosPorId($_GET['id']);
      }else if (isset($_GET['id'])&&$_GET['deletar']==true){
        include_once "../Controller/CarregarDados.php";
        $dados = $conexao->deletarDadosPorId($_GET['id']);
      }
  ?>
</body>
</html>