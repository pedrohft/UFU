<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
  <title>Clínica</title>

  <style>
    body {
      margin: 0;
      background-color: #fff;
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      line-height: 1.5rem;
      position: relative;
      min-height: 100vh;
    }
    
    a {
      text-decoration: none;
    } 

    .container {
      padding-top: 1rem;
      padding-bottom: 4.5rem;
    }

    footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      text-align: center;
    }

    @media only screen and (max-width: 576px) {
      nav {
        display: flex;
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm">
    <img src="../images/logo.png" alt="logo" width="50">
    <p class="h5 my-0 mr-md-auto fw-normal">Clínica Lawrence</p>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="novo_funcionario.php">Novo Funcionário</a>
      <a class="p-2 text-blue" href="novo_paciente.php">Novo Paciente</a>
      <a class="p-2 text-dark" href="funcionarios.php">Listar Funcionários</a>
      <a class="p-2 text-dark" href="pacientes.php">Listar Pacientes</a>
      <a class="p-2 text-dark" href="enderecos.php">Listar Endereços</a>
      <a class="p-2 text-dark" href="todos_agendamentos.php">Listar todos Agendamentos</a>
      <?php
        if(isset($_SESSION["medico"]) && $_SESSION["medico"]) {
          echo <<<HTML
            <a class="p-2 text-dark" href="meus_agendamentos.php">Listar meus Agendamentos</a>
          HTML;
        }
      ?>
    </nav>
    <button class="btn btn-outline-primary"><?= isset($_SESSION["nome"]) ? $_SESSION["nome"] : "Pessoa" ?></button>
  </header>
  
  <main>
    <div class="container mt-5">
      <form method="POST" class="row g-3">
        <div class="form-floating col-sm-4">
          <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
          <label for="nome" class="form-label">Nome</label>
        </div>

        <div class="form-floating col-sm-4">
          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
          <label for="email" class="form-label">Email</label>
        </div>
      
        <div class="form-floating col-sm-4">
          <input type="tel" class="form-control" name="telefone" id="telefone" placeholder="Telefone">
          <label for="telefone" class="form-label">Telefone</label>
        </div>  

        <div class="form-floating col-sm-4">
          <input type="text" class="form-control" name="cep" id="cep" placeholder="CEP">
          <label for="cep" class="form-label">CEP</label>
        </div>
        
        <div class="form-floating col-sm-4">
          <input type="text" class="form-control" name="logradouro" id="logradouro" placeholder="Avenida João Naves de Ávila">
          <label for="logradouro" class="form-label">Logradouro</label>
        </div>
      
        <div class="form-floating col-sm-4">
          <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro">
          <label for="bairro" class="form-label">Bairro</label>
        </div>
        
        <div class="form-floating col-sm-4">
          <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade">
          <label for="cidade" class="form-label">Cidade</label>
        </div>

        <div class="form-floating col-sm-4">
          <select name="estado" id="estado" class="form-select">
            <option selected>Sel.</option>
            <option value="MG">MG</option>
            <option value="SP">SP</option>
            <option value="RJ">RJ</option>
          </select>
          <label for="estado" class="form-label">Estado</label>
        </div>

        <div class="form-floating col-sm-4">
          <input type="number" class="form-control" name="peso" id="peso" placeholder="Peso">
          <label for="peso" class="form-label">Peso</label>
        </div>

        <div class="form-floating col-sm-4">
          <input type="number" class="form-control" name="altura" id="altura" placeholder="Altura">
          <label for="altura" class="form-label">Altura</label>
        </div>

        <div class="form-floating col-sm-4">
          <select name="sangue" id="sangue" class="form-select">
            <option selected>Sel.</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
          </select>
          <label for="sangue" class="form-label">Tipo sanguíneo</label>
        </div>
  
        <div class="col-sm-12">
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </div>
  </main>

  <footer class="footer mt-auto py-3 bg-light text-center">
    <p>&copy; 2020 Company, Inc.</p>
  </footer>

  <script>
    window.onload = () => {
      $('form').on('submit', (e) => {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'cadastro_novo_paciente.php',
          data: $('form').serialize(),
          success: res => {
            res = JSON.parse(res);
            alert(res['response']);
            $("input").val("");
            $("select").val("Sel.");
          }
        })
      })

      $('#cep').mask('00000-000')
    }    
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>
</body>
</html>