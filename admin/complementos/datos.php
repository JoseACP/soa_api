<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="proto_form.css" />
    <title>Formulario Prototipos</title>
  </head>
  <body>
    <!-- Botón volver -->
    <div class="wrap">
    <a class="button" href='complementos.php' style="padding: 15px; text-decoration: none;">Volver</a>
    </div>
        <!--  -->
    <div class="login-page">
      <div class="form">
        <form action="insertar.php" method="post" class="login-form">
        <input type="hidden" name="id">
        <h4>Nombre</h4>
        <input type="text" class="form-control mb-3" name="name" >
        <h4>Descripción</h4>
        <input type="text" class="form-control mb-3" name="description" >
        <h4>Precio</h4>
        <input type="text" class="form-control mb-3" name="cost">
          <button type="submit" name="register" id="enviar">Enviar</button>
        </form>
      </div>
    </div>
  </body>
</html>
