<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projetos - Empresa</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    
    <header>
        <div class="container" id="nav-container">
          <?php
            include('navbar.php');
          ?>
        </div>
    </header>
    <main>
      <div class="container-fluid">
        <div class="container mt-4">
          <div class="row">
            <div class="col mt-12">
              <div class="card">
                <div class="card-header">
                  <?php
                    switch(@$_REQUEST["page"]){
                      case "projeto-listar":
                        include('projeto-listar.php');
                        break;
                      case "funcionario-listar":
                        include('funcionario-listar.php');
                        break;
                      case "funcionario-create":
                        include('funcionario-create.php');
                        break;
                      case "funcionario-editar":
                        include('funcionario-edit.php');
                        break;
                      case "dependente-listar":
                        include('dependente-listar.php');
                        break;
                      case "departamento-listar":
                        include('departamento-listar.php');
                        break;
                      default:
                        print"<h1>Bem vindos!!!</h1>";
                    }
                  ?>
                </div>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Rodapé -->
    <footer>
      <div id="copy-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>
                      Desenvolvido pelo Prof. Edilson Lima &copy; 2024
                    </p>
                </div>
            </div>
        </div>
      </div>
    </footer>
    
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>

