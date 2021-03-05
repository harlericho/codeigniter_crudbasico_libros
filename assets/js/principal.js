$(document).ready(function () {
    listado();
});

function listado() {
    $.ajax({
        type: "POST",
        url: "libros/listado",
        dataType: "json",
        success: function (data) {
            html = "<table class='table table-striped' id='tablafiltro' style='width:100%' ><thead>";
            html += "<tr><th scope='col'>Nombre</th><th scope='col'>Descripcion</th><th scope='col'>Acciones</th></tr></thead>";
            html += "<tbody>";
            //var tbody = "<tbody>";
            for (var key in data) {
                html += "<tr>";
                html += "<td>" + data[key]['nombre'] + "</td>";
                html += "<td>" + data[key]['descripcion'] + "</td>";
                html += `<td>
               <a href="#" id="del" value="${data[key]['id']}" class="btn btn-sm btn-danger" title="Eliminar">
               <i class="fas fa-trash-restore"></i>
               </a>
               <a href="#" id="edit" value="${data[key]['id']}" class="btn btn-sm btn-success" title="Editar">
               <i class="fas fa-pencil-alt"></i>
               </a>
               </td>`;
            }
            html += "</tr></tbody></table>"
            $("#tabla").html(html);
            //tabla filtro
            $('#tablafiltro').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });
        }
    });
}

$("#btnGuardar").click(function (e) {
    if (validaciones() == true) {
        let id = $("#id").val();
        let data = $("#principal").serialize();
        if ($.trim(id) == "") {
            guardar(data);
        } else {
            modificar(data);
        }
    }
    e.preventDefault();
});

function guardar(data) {
    $.ajax({
        type: "POST",
        url: "libros/guardar",
        data: data,
        success: function (response) {
            if (response) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.warning('Libro guardado');
                $("#exampleModal").modal("hide");
                $("#principal")[0].reset();
                listado();
            }
        }
    });
}

function modificar(data) {
    $.ajax({
        type: "POST",
        url: "libros/actualizar",
        data: data,
        success: function (response) {
            if (response) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.warning('Libro actualizado');
                $("#exampleModal").modal("hide");
                $("#principal")[0].reset();
                listado();
            }
        }
    });
}


$(document).on("click", "#edit", function (e) {
    let idEditar = $(this).attr("value");
    $.ajax({
        type: "POST",
        url: "libros/ideditar",
        dataType: "json",
        data: { idEditar: idEditar },
        success: function (data) {
            if (data.res == 'suc') {
                $("#exampleModal").modal("show");
                $("#id").val(data.post.id);
                $("#nombre").val(data.post.nombre);
                $("#des").val(data.post.descripcion);
            }
        },
    });
    e.preventDefault();
});


$(document).on("click", "#del", function (e) {
    let idEliminar = $(this).attr("value");
    Swal.fire({
        title: 'Seguro desea eliminar?',
        text: "Solo se cambiara el estado del registro",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "libros/eliminar",
                data: { idEliminar: idEliminar },
                success: function (response) {
                    if (response) {
                        listado();
                    }
                }
            });
            Swal.fire(
                'Eliminado!',
                'Su registro cambio de estado',
                'success'
            )
        }
    })
    e.preventDefault();
});

function validaciones() {
    let nombre = $("#nombre").val();
    let des = $("#des").val();
    if ($.trim(nombre) == "") {
        alertify.set('notifier', 'position', 'top-right');
        alertify.warning('Escriba un nombre');
        $("#nombre").focus();
    } else if ($.trim(des) == "") {
        alertify.set('notifier', 'position', 'top-right');
        alertify.warning('Escriba una descripcion ');
        $("#des").focus();
    } else {
        return true;
    }
}


function limpiar() {
    document.getElementById("id").value = '';
    document.getElementById("nombre").value = '';
    document.getElementById("des").value = '';

    //$("#modaladd")[0].reset();
}