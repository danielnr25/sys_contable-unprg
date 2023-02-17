var tbl_tasiento;

function listar_tipoAsiento() {
  tbl_tasiento = $("#tabla_tasiento").DataTable({
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
      url: "../controllers/tipo_asiento/controListarTipo.php",
      type: "POST",
    },
    columns: [
      { defaultContent: "" },
      { data: "ta_nombre" },
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
  tbl_tasiento.on("draw.dt", function () {
    var PageInfo = $("#tabla_tasiento").DataTable().page.info();
    tbl_tasiento
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

function registrarTipo() {
  let nombre = document.getElementById("txt_nombre").value;
  if (nombre.length == 0) {
    return Swal.fire(
      "<b style='color:red;'>Advertencia</b>",
      "<b>Llene todo los campos.</b>"
    );
  }
  $.ajax({
    url: "../controllers/tipo_asiento/controRegisTipo.php",
    type: "POST",
    data: {
      nombre: nombre,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        return Swal.fire(
          "<b style='color:green;'>Confirmación</b>",
          "Tipo de Asiento registrado correctamente."
        ).then((value) => {
          document.getElementById("txt_nombre").value = "";
          $("#modalRegistrar").modal("hide");
          tbl_tasiento.ajax.reload();
        });
      }
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "Este tipo de asiento ya está registrado."
      );
    } else {
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "No se pudo registrar este tipo de asiento."
      );
    }
  });
}

/* EDITAR TIPO DE ASIENTO */
$("#tabla_tasiento").on("click", ".editar", function () {
  var data = tbl_tasiento.row($(this).parents("tr")).data();
  if (tbl_tasiento.row(this).child.isShown()) {
    var data = tbl_tasiento.row(this).data();
  }
  $("#modalModificar").modal({ backdrop: "static", keyboard: false });
  $("#modalModificar").modal("show");
  $("#id_tipo").val(data.ta_id);
  $("#txt_nombreE").val(data.ta_nombre);
});

function modificarTipo() {
  let id = document.getElementById("id_tipo").value;
  let nombre = document.getElementById("txt_nombreE").value;
  if (nombre.length == 0 || id.length == 0) {
    return Swal.fire(
      "<b style='color:red;'>Advertencia</b>",
      "<b>Llene todo los campos.</b>"
    );
  }
  $.ajax({
    url: "../controllers/tipo_asiento/controEditarTipo.php",
    type: "POST",
    data: {
      id: id,
      nombre: nombre,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        return Swal.fire(
          "<b style='color:green;'>Confirmación</b>",
          "Tipo de asiento editado correctamente."
        ).then((value) => {
          $("#modalModificar").modal("hide");
          tbl_tasiento.ajax.reload();
        });
      }
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "Esta Tipo de asiento ya está editado."
      );
    } else {
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "No se pudo editar el tipo de asiento"
      );
    }
  });
}
