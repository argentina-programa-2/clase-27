<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/index.css">
</head>

<body>
  <header class="p-3 px-4 d-flex justify-content-between navbar bg-dark">
    <a class="text-decoration-none" href="./">
      <h1 class="text-light">MyBlog</h1>
    </a>
    <div class="buttons noLogged">
      <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#registroModal">
        Registrar
      </button>

      <div class="modal modalRegistro fade" id="registroModal" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <form onsubmit="return registrar(event)" id="form-registro" class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">
                Registrate
              </h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">
                Registrarse
              </button>
            </div>
          </form>
        </div>
      </div>

      <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">
        Iniciar Sesion
      </button>

      <div class="modal modalLogin fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <form onsubmit="return login(event)" id="form-login" class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">
                Inicia Sesion
              </h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">
                Iniciar Sesion
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="logged">
      <p class="text-light" id="user_name"></p>
      <a href="admin.php" type="button" class="btn btn-primary mx-2">
        Administrar
      </a>
      <button type="button" onclick="cerrarSesion()" class="btn btn-danger mx-2">
        Cerrar Sesion
      </button>
    </div>


  </header>
  <div class="alert" role="alert">
  </div>
  <main class="">
    <div class="publicaciones">

    </div>
  </main>
  <script src="./js/usuario.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="./js/formulario.js"></script>
  <script src="./js/publicaciones.js"></script>
  <script src="./js/comentarios.js"></script>
</body>

</html>