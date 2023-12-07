<!DOCTYPE html>
<html>
<head>
    <title>Tienda de Mascotas</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(45deg, #ff6b81, #ffb3ba, #baffc9, #bae1ff, #baffc9, #ffb3ba, #ff6b81);
            background-size: 800% 800%;
            animation: gradient 15s linear infinite;
            color: #333;
        }
        @keyframes gradient {
            0% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 100% 50%;
            }
            
        }
        @keyframes fadeIn {
            from {
              opacity: 0;
            }
             to {
              opacity: 1;
             }
        }

        @keyframes fadeOut {
              from {
              opacity: 1;
              }
             to {
                 opacity: 0;
            }
        }
        h1 {
            text-align: center;
            color: #555;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            background-color: #ffb3ba;
            border: none;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 5px;
            border: 2px solid #ff6b81;
        }
        .button:hover {
            background-color: #ff6b81;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0; top: 0;
            width: 100%; height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            animation: fadeIn 0.3s; /* Aplicar animación de entrada al modal */

        }
        .modal.fade-out {
            animation: fadeOut 0.3s; /* Aplicar animación de salida al modal */
        }
        .modal-content {
            width: 30%;
            background-color: #eff6fb;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 5px;
        }
        .modal-content input[type="text"],
        .modal-content input[type="number"] {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .modal-content form {
            text-align: center;
        }
        #listaMascotas ul {
            list-style-type: none;
            padding: 0;
        }
        #listaMascotas li {
            background-color: #eff6fb;
            margin: 10px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
    </style>

</head>
<body>
    <br>
    <h1>Tienda de Mascotas de Cesar Nava Vera </h1>
    <h1> Sistema CRUD </h1>

    <div class="button-container">
        <button class="button" onclick="abrirModal('modalAgregar')">Agregar Mascota</button>
        <button class="button" onclick="abrirModal('modalActualizar')">Actualizar Mascota</button>
        <button class="button" onclick="abrirModal('modalEliminar')">Eliminar Mascota</button>
    </div>
    <div id="listaMascotas"></div>

    <!-- Modal para Agregar Mascota -->
    <div id="modalAgregar" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal('modalAgregar')">&times;</span>
            <h2>Agregar Mascota</h2>
            <!-- Formulario para agregar mascota -->
            <form id="agregarMascotaForm">
                Nombre: <input type="text" id="nombre" name="nombre"><br>
                Tipo: <input type="text" id="tipo" name="tipo"><br>
                Edad: <input type="number" id="edad" name="edad"><br>
                <button type="button" onclick="agregarMascota()">Agregar Mascota</button>
            </form>
        </div>
    </div>

    <!-- Modal para Actualizar Mascota -->
    <div id="modalActualizar" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal('modalActualizar')">&times;</span>
            <h2>Actualizar Mascota</h2>
            <!-- Formulario para actualizar mascota -->
            <form id="actualizarMascotaForm">
    ID: <input type="number" name="id" id="update_id"><br>
    Nuevo Nombre: <input type="text" name="nombre" id="update_nombre"><br>
    Nuevo Tipo: <input type="text" name="tipo" id="update_tipo"><br>
    Nueva Edad: <input type="number" name="edad" id="update_edad"><br>
    <button type="button" onclick="actualizarMascota()">Actualizar Mascota</button>
</form>
        </div>
    </div>

    <!-- Modal para Eliminar Mascota -->
    <div id="modalEliminar" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal('modalEliminar')">&times;</span>
            <h2>Eliminar Mascota</h2>
            <!-- Formulario para eliminar mascota -->
            <form id="eliminarMascotaForm">
    ID: <input type="number" id="delete_id" name="id"><br> <!-- Asegúrate de que el atributo 'name' esté establecido como 'id' -->
    <button type="button" onclick="eliminarMascota()">Eliminar Mascota</button>
</form>
        </div>
    </div>

    <script>
        // Funciones para abrir y cerrar modales
        function abrirModal(idModal) {
            document.getElementById(idModal).style.display = 'block';
        }

        function cerrarModal(idModal) {
            document.getElementById(idModal).style.display = 'none';
        }

      // Función para Agregar Mascota
function agregarMascota() {
    var datos = new FormData(document.getElementById('agregarMascotaForm'));

    datos.append('operacion', 'crear');

    fetch('crud_operations.php', {
        method: 'POST',
        body: datos
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        cerrarModal('modalAgregar');
        cargarMascotas();
    })
    .catch(error => console.error('Error:', error));
}

// Función para Actualizar Mascota
function actualizarMascota() {
    var datos = new FormData(document.getElementById('actualizarMascotaForm'));
    datos.append('operacion', 'actualizar');

    fetch('crud_operations.php', {
        method: 'POST',
        body: datos
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        cerrarModal('modalActualizar');
        cargarMascotas();
    })
    .catch(error => console.error('Error:', error));
}

// Función para Eliminar Mascota
function eliminarMascota() {
    var datos = new FormData(document.getElementById('eliminarMascotaForm'));
    datos.append('operacion', 'eliminar');

    fetch('crud_operations.php', {
        method: 'POST',
        body: datos
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        cerrarModal('modalEliminar');
        cargarMascotas();
    })
    .catch(error => console.error('Error:', error));
}

        // Función para Cargar y Mostrar la Lista de Mascotas
        function cargarMascotas() {
            fetch('crud_operations.php', {
                method: 'POST',
                body: new URLSearchParams('operacion=leer')
            })
            .then(response => response.json())
            .then(data => {
                var lista = document.getElementById('listaMascotas');
                lista.innerHTML = '<ul>';
                data.forEach(function(mascota) {
                    lista.innerHTML += '<li>ID: ' + mascota.id + ', Nombre: ' + mascota.nombre + ', Tipo: ' + mascota.tipo + ', Edad: ' + mascota.edad + ' años</li>';
                });
                lista.innerHTML += '</ul>';
            })
            .catch(error => console.error('Error:', error));
        }

        // Funciones para abrir y cerrar modales con animación
function abrirModal(idModal) {
    var modal = document.getElementById(idModal);
    modal.style.display = 'block';
    modal.classList.remove('fade-out'); // Asegurarse de que la clase fade-out esté eliminada
}

function cerrarModal(idModal) {
    var modal = document.getElementById(idModal);
    modal.classList.add('fade-out'); // Agregar clase fade-out para animación de salida
    setTimeout(function() {
        modal.style.display = 'none'; // Ocultar modal después de la animación
    }, 300); // Ajusta el tiempo según la duración de tu animación (0.3 segundos en este ejemplo)
}

        window.onload = cargarMascotas;
    </script>
</body>
</html>