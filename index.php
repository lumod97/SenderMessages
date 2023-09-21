<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar mensajes</title>
    <!-- Agrega el enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Detalla tu mensaje</h1>

        <!-- Formulario con 4 campos de entrada -->
        <form method="POST" action="" id="formulario">
            <div class="form-group">
                <label for="mensaje">Mensaje:</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="3" placeholder="Ingresa tu mensaje"></textarea>
            </div>
            <div class="form-group">
                <label for="telefono">Telefono:</label>
                <textarea class="form-control" id="telefono" name="telefono" rows="3" placeholder="Ingresa tu telefono"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
        </form>

        <!-- Tabla con Bootstrap -->
        <table class="table mt-4" id="contactosTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
                    <th>Seleccionar</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los datos se generarán dinámicamente aquí usando JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Agrega el enlace al archivo JavaScript de Bootstrap (opcional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Objeto con los datos de los contactos
        var contactos = [
            { id: 1, nombre: "Juan Pérez", correo: "juan@example.com", telefono: "123-456-7890" },
            { id: 2, nombre: "María López", correo: "maria@example.com", telefono: "987-654-3210" },
            { id: 3, nombre: "Luiggi Moretti", correo: "luiggigmd.97@gmail.com", telefono: "946027276" }
            // Agrega más contactos aquí
        ];

        // Función para generar la tabla
        function generarTabla() {
            var tbody = document.querySelector("#contactosTable tbody");

            for (var i = 0; i < contactos.length; i++) {
                var contacto = contactos[i];
                var row = document.createElement("tr");

                row.innerHTML = `
                    <td>${contacto.id}</td>
                    <td>${contacto.nombre}</td>
                    <td>${contacto.correo}</td>
                    <td>${contacto.telefono}</td>
                    <td><input type="checkbox" name="seleccionar[]" value="${contacto.telefono}"></td>
                `;

                tbody.appendChild(row);
            }
        }

        // Llama a la función para generar la tabla cuando la página se carga
        window.onload = generarTabla;

        // Manejador de evento para el envío del formulario
        document.getElementById("formulario").addEventListener("submit", function (event) {
            

            var checkboxes = document.querySelectorAll('input[name="seleccionar[]"]:checked');
            var valoresSeleccionados = Array.from(checkboxes).map(function (checkbox) {
                return checkbox.value;
            });

            console.log("Valores seleccionados:", valoresSeleccionados);
        });
    </script>
</body>
</html>


<?php
if (isset($_POST['enviar'])) {
    // Coloca aquí tu código PHP para enviar mensajes
    // $nombre = $_POST['nombre'];
    // $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];
    echo $telefono;
    echo $mensaje;
    
    // Realiza el envío del mensaje aquí
    $url = 'https://graph.facebook.com/v17.0/133997583125112/messages';

    $token = 'EAAOXxdZBouLMBO7YXWrnAfcOuGBkCUmBk7TvYh9nPbVHTb2xz818JIZAU7s2MZCc972dlL7pbvccx1R5Y15C9FFs0aLPjbklRiZC7s2FLaOuh7FyxZCstqeTAaW2XI5RsH6B3RuDn9FrhO5dCLy87zcu4d5qrlqxxi3llIq1D1yYtu6Yi8ZAbcLM84bBvH6DvOGm695oqpkxgfXtG3DXgZD';

    $message = ''
        . '{'
        . '"messaging_product": "whatsapp", '
        . '"to": "51946027276", '
        . '"type": "template", '
        . '"template": '
            . '{'
                . '"name": "hello_world",'
                . '"language": {'
                . '"code":"en_US"'
                .'},'
            . '}'
        . '}';

    $header = array("Authorization: Bearer " . $token , "Content-Type: application/json",);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $message);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = json_decode(curl_exec($curl), true);

    print_r($response);

    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);
}
?>
