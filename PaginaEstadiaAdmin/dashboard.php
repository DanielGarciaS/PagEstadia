<?php     // inicio de sesion
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/estilos;dashboard.css">
</head>
<body>
    <!-- barra de navegacion -->
    <nav class="navbar">
        <div class="navbar-container">
            <a class="navbar-brand" href="#">PsicoAgenda UTSC</a>
            <ul class="navbar-menu">
                <li><a href="#" onclick="mostrarSeccion('inicio')">Inicio</a></li>
                <li><a href="#" onclick="mostrarSeccion('agenda')">Agenda</a></li>
                <li><a href="#" onclick="mostrarSeccion('citas')">Citas</a></li>
                <li><a href="#" onclick="mostrarSeccion('expedientes')">Expedientes</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </nav>

    <!-- contenido del dashboard -->
    <div class="dashboard-container">
        <!-- INICIO --> 
        <section id="inicio" class="seccion">
    <h1>Bien día, <?= htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>Bienvenido al sistema de gestión de PsicoAgenda UTSC. Aquí puedes manejar tus citas, agenda y expedientes.</p>

    <!-- secciones que puede tener -->
    <div class="resumen">
        <div class="resumen-prox">
            <h2>Próximas Citas</h2>
            <p>3 citas programadas para hoy</p>
        </div>
        <div class="resumen-expr">
            <h2>Expedientes Recientes</h2>
            <p>2 expedientes actualizados recientemente</p>
        </div>
        <div class="resumen-notis">
            <h2>Notificaciones</h2>
            <p>Tienes 5 nuevas notificaciones</p>
        </div>
        <div class="recordatorios">
        <h2>Recordatorios</h2>
        <ul>
            <li>Revisar tal cita</li>
            <li>Confirmar cita con tal</li>
            <li>Termina el expediente de tal </li>
        </ul>
    </div>
    </div>
</section>

        
        <!-- Agenda -->
        <section id="agenda" class="seccion" style="display:none;">
            <h2>Agenda</h2>
            <!-- calendario interactivo -->

            <link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.css' rel='stylesheet' />
            <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/jquery.min.js'></script>
            <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/moment.min.js'></script>
            <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.js'></script>
            
            <div class="calendar-container">
               <div id="calendar"></div>
            </div>
        <script>
$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultView: 'month',
        editable: true,
        events: [
            {
                title: 'Cita con Juan Pérez',
                start: '2024-06-15T10:00:00',
                end: '2024-06-15T11:00:00'
            },
            {
                title: 'Cita con María Gómez',
                start: '2024-06-15T11:00:00',
                end: '2024-06-15T12:00:00'
            }
        ]
    });
});
</script>
        </section>
        
        <!-- Citas -->
        <section id="citas" class="seccion" style="display:none;">
            <h2>Citas</h2>
            <h3>Próximas Citas</h3>
    <ul class="citas-lista">
        <li>
            <div class="cita">
                <p><strong>Paciente:</strong> Juan Pérez</p>
                <p><strong>Fecha:</strong> 15 de junio, 10:00 AM</p>
                <button class="ver-detalles">Ver Detalles</button>
                <button class="editar-cita">Editar</button>
                <button class="cancelar-cita">Cancelar</button>
            </div>
        </li>
    </ul>
       <!-- boton de agregar citas -->
       <button class="agregar-cita">Agregar Nueva Cita</button>
        </section>
        


        <!-- Expedientes -->
        <section id="expedientes" class="seccion" style="display:none;">
            <h2>Expedientes</h2>
        <!-- Botón para subir archivos -->
    <div class="upload-container">
        <input type="file" id="fileUpload" multiple>
        <button onclick="uploadFiles()">Subir Archivos</button>
    </div>
    <!-- Lista de archivos -->
    <div class="files-container">
        <h3>Archivos Subidos</h3>
        <ul id="filesList">
            <!-- Archivos aquí -->
        </ul>
    </div>
</section>
    






    <script>
        //no me acueldo
        function mostrarSeccion(idSeccion) {
            var secciones = document.getElementsByClassName('seccion');
            for (var i = 0; i < secciones.length; i++) {
                secciones[i].style.display = 'none';
            }
            var seccion = document.getElementById(idSeccion);
            if (seccion) {
                seccion.style.display = 'block';
            }
        }
        //script para funcionalidad de subir editar archivos en la parte de expedientes
        // Array para almacenar los archivos subidos
let filesArray = [];

// Función para subir archivos
function uploadFiles() {
    let files = document.getElementById('fileUpload').files;
    for (let i = 0; i < files.length; i++) {
        filesArray.push(files[i]);
    }
    displayFiles();
}

// Función para mostrar los archivos en la lista
function displayFiles() {
    let filesList = document.getElementById('filesList');
    filesList.innerHTML = '';
    for (let i = 0; i < filesArray.length; i++) {
        let fileItem = document.createElement('li');
        fileItem.innerHTML = `
            ${filesArray[i].name}
            <div class="file-actions">
                <button onclick="viewFile(${i})">Ver</button>
                <button onclick="editFile(${i})">Editar</button>
                <button onclick="deleteFile(${i})">Eliminar</button>
            </div>
        `;
        filesList.appendChild(fileItem);
    }
}

// Función para ver un archivo (simplificada)
function viewFile(index) {
    alert(`Ver archivo: ${filesArray[index].name}`);
}

// Función para editar un archivo (simplificada)
function editFile(index) {
    alert(`Editar archivo: ${filesArray[index].name}`);
}

// Función para eliminar un archivo
function deleteFile(index) {
    filesArray.splice(index, 1);
    displayFiles();
}

    </script>
</body>
</html>

