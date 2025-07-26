$(document).ready(function() {
    $('#tabla_contactos,#tabla_agenda,#tabla_usuarios_y_roles').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            "ordering": true
        }
    });
});