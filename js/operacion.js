var tbl_operacion;

function listar_operacion() {
  tbl_operacion = $("#tabla_operacion").DataTable({
    ordering: false,
    bLengthChange: true,
    searching: { regex: false },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    detroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../controllers/operacion/controListarOperacion.php",
      type: "POST",
    },
    columns: [
      { defaultContent: "" },
      { data: "tc_codigo" },
      { data: "tc_nombre" },
      {
        data: "usu_estado",
        render: function (data, type, row) {
          if (data == "ACTIVO") {
            return "<button class='editar btn btn-outline-success btn-sm'><i class='fas fa-edit'></i></button>&nbsp;";
          } else {
            return "<button class='editar btn btn-outline-success btn-sm'><i class='fa fa-edit'></i></button>&nbsp;";
          }
        },
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  tbl_operacion.on("draw.dt", function () {
    var PageInfo = $("#tabla_operacion").DataTable().page.info();
    tbl_operacion
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
  });
}

/* REGISTRAR TIPO DE ASIENTO */

function abrirModalRegistrar() {
  $(".form-control").removeClass("is-invalid").removeClass("is-valid");
  $("#modalRegistrar").modal({ backdrop: "static", keyboard: false });
  $("#modalRegistrar").modal("show");
}

function registrarOperacion() {
  let codigo = document.getElementById("txt_codigo").value;
  let nombre = document.getElementById("txt_nombre").value;
  if (nombre.length == 0, codigo.length == 0) {
    return Swal.fire(
      "<b style='color:red;'>Advertencia</b>",
      "<b>Llene todo los campos.</b>"
    );
  }
  $.ajax({
    url: "../controllers/operacion/controRegisOperacion.php",
    type: "POST",
    data: {
      codigo: codigo,
      nombre: nombre,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        return Swal.fire(
          "<b style='color:green;'>Confirmación</b>",
          "Tipo de Operación contable registrado correctamente."
        ).then((value) => {
          document.getElementById("txt_nombre").value = "";
          document.getElementById("txt_codigo").value = "";
          $("#modalRegistrar").modal("hide");
          tbl_operacion.ajax.reload();
        });
      }
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "Este Tipo de Operación Contable ya está registrada."
      );
    } else {
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "No se pudo registrar este Tipo de Operación Contable."
      );
    }
  });
}

/* EDITAR TIPO DE ASIENTO */
$("#tabla_operacion").on("click", ".editar", function () {
  var data = tbl_operacion.row($(this).parents("tr")).data();
  if (tbl_operacion.row(this).child.isShown()) {
    var data = tbl_operacion.row(this).data();
  }
  $("#modalModificar").modal({ backdrop: "static", keyboard: false });
  $("#modalModificar").modal("show");
  $("#id_tipo").val(data.tc_id);
  $("#txt_codigoE").val(data.tc_codigo);
  $("#txt_nombreE").val(data.tc_nombre);
});

function modificarOperacion() {
  let id = document.getElementById("id_tipo").value;
  let codigo = document.getElementById("txt_codigoE").value;
  let nombre = document.getElementById("txt_nombreE").value;
  if (nombre.length == 0 || id.length == 0 || codigo.length == 0) {
    return Swal.fire(
      "<b style='color:red;'>Advertencia</b>",
      "<b>Llene todo los campos.</b>"
    );
  }
  $.ajax({
    url: "../controllers/operacion/controEditarOperacion.php",
    type: "POST",
    data: {
      id: id,
      codigo: codigo,
      nombre: nombre,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        return Swal.fire(
          "<b style='color:green;'>Confirmación</b>",
          "Tipo de Operación Contable editado correctamente."
        ).then((value) => {
          $("#modalModificar").modal("hide");
          tbl_operacion.ajax.reload();
        });
      }
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "Esta Tipo de Operación Contable ya está editado."
      );
    } else {
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "No se pudo editar el tipo de Operación Contable"
      );
    }
  });
}
