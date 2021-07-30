<?php

class Conexao{
    private $conn;
    public function __construct(){
        define("username", "root");
        define("password", "");
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=thiago_milton_Ferreira', username, password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

    }

    public function insereDados($dados){
      
        try {
            $stmt = $this->conn->prepare("INSERT INTO clientes (nome_cliente, email_cliente, telefone_cliente, senha_cliente, data_nasc_cliente) VALUES (:nome_cliente,:email_cliente,:telefone_cliente,:senha_cliente,:data_nasc_cliente)");
            $stmt->execute(array(  
                ':nome_cliente' => $dados['nome_cliente'],
                ':email_cliente' => $dados['email_cliente'],
                ':telefone_cliente' => $dados['telefone_cliente'],
                ':senha_cliente' => password_hash($dados['senha_cliente'], PASSWORD_DEFAULT),
                ':data_nasc_cliente' => $dados['data_nasc_cliente'],
            ));
          
            header("Location: http://localhost/Construsite/View/?message=DADOS INSERIDOS COM SUCESSO!");
          }catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

    }

    public function carregarDados(){
        $consulta = $this->conn->query("SELECT * FROM clientes");
        echo"
            <br>
            <br>
            <table class='table table-dark'>
            <thead>
                <tr>
                <th scope='col'>#</th>
                <th scope='col'>Nome</th>
                <th scope='col'>E-mail</th>
                <th scope='col'>Telefone</th>
                <th scope='col'>Data de nascimento</th>
                <th scope='col'>Ação</th>
                </tr>
            </thead>
        ";
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo"
            
              <tbody>
                <tr>
                  <th scope='row'>".$linha['id_cliente']."</th>
                  <td>".$linha['nome_cliente']."</td>
                  <td>".$linha['email_cliente']."</td>
                  <td>".$linha['telefone_cliente']."</td>
                  <td>".$linha['data_nasc_cliente']."</td>
                  <td> <a href= http://localhost/Construsite/View/?alterar=true&id=".$linha['id_cliente']." > Alterar </a> <br> <a href= http://localhost/Construsite/View/?deletar=true&id=".$linha['id_cliente']."> Deletar </a></td>
                </tr>
              </tbody>
            ";    
        }
        echo"</table>";  
    }
    public function carregarDadosPorId($id){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM clientes WHERE id_cliente=:id");
            $stmt->execute(array(  
                ':id' => $id,
            )); 
            $clientes = $stmt->fetch();
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        header("Location: http://localhost/Construsite/View/?nome_cliente=".$clientes['nome_cliente']."&email_cliente=".$clientes['email_cliente']."&telefone_cliente=".$clientes['telefone_cliente']."&data_nasc_cliente=".$clientes['data_nasc_cliente']."&alteracao=".true."");
        
    }
    public function deletarDadosPorId($id){
        try {
            $stmt = $this->conn->prepare("DELETE FROM clientes WHERE id_cliente = :id");
            $stmt->execute(array(  
                ':id' => $id,
            ));
            header("Location:http://localhost/Construsite/View/?message=Visualizar Todos Clientes");
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

       
    }
    public function AlterarDados($dados){
        try {
            $sql = "UPDATE clientes SET nome_cliente=:nome_cliente, email_cliente=:email_cliente, telefone_cliente=:telefone_cliente, senha_cliente=:senha_cliente, data_nasc_cliente=:data_nasc_cliente WHERE email_cliente=:email_cliente";
            $stmt= $this->conn->prepare($sql);
            $stmt->execute($dados);
            header("Location:http://localhost/Construsite/View/?message=Visualizar Todos Clientes");
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

     }

}

?>