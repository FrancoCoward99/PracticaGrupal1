<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Formulario de Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../styles/style.css">
  <script src="../scripts/script.js"></script>
</head>

<body class="bg-light">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header text-center">
            <h4>Formulario de Registro</h4>
          </div>
          <div class="card-body">
            <form id="register-form" method="post" action="">

              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" maxlength="10" minlength="2" id="nombre"
                  placeholder="Ingresa tu nombre" required>
              </div>

              <div class="mb-3">
                <label for="edad" class="form-label">Edad</label>
                <input type="number" min="18" max="100" class="form-control" id="edad" placeholder="Ingresa tu edad"
                  required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" placeholder="ejemplo@correo.com" required>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" required placeholder="Contraseña">
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Confirmar contraseña</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirme su contraseña" required>
              </div>

              <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fechaNacimiento" required>
              </div>

              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="terminos" required>
                <label class="form-check-label" for="terminos">
                  Acepto los términos y condiciones
                </label>
              </div>

              <label class="form-label d-block mb-2">Género</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="genero" id="masculino" value="masculino" required>
                <label class="form-check-label" for="masculino">Masculino</label>
              </div>
              <div class="form-check form-check-inline mb-3">
                <input class="form-check-input" type="radio" name="genero" id="femenino" value="femenino" required>
                <label class="form-check-label" for="femenino">Femenino</label>
              </div>

              <div class="d-grid">
                <!-- <button type="submit" onclick="validaFormulario()" class="btn btn-primary">Validar</button> -->

                <button type="submit"
                  class="btn btn-primary">Registrarse</button>
              </div>
            </form>

            <p>Ya tiene una cuenta? <a href="login.php">Inicie sesión acá</a> </p>

            <div id="register-error" class="mt-3">

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>