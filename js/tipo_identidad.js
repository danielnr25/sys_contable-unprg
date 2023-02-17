var tbl_identi;

function listar_identidad() {
  tbl_identi = $("#tabla_identidad").DataTable({
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
      url: "../controllers/tipo_docs/controListarTipo.php",
      type: "POST",
    },
    columns: [
      { defaultContent: "" },
      { data: "td_nombre" },
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
  tbl_identi.on("draw.dt", function () {
    var PageInfo = $("#tabla_identidad").DataTable().page.info();
    tbl_identi
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

function registrarIdentidad() {
  let nombre = document.getElementById("txt_nombre").value;
  if (nombre.length == 0) {
    return Swal.fire(
      "<b style='color:red;'>Advertencia</b>",
      "<b>Llene todo los campos.</b>"
    );
  }
  $.ajax({
    url: "../controllers/tipo_docs/controRegisTipo.php",
    type: "POST",
    data: {
      nombre: nombre,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        return Swal.fire(
          "<b style='color:green;'>Confirmación</b>",
          "Tipo de documento de identidad registrado correctamente."
        ).then((value) => {
          document.getElementById("txt_nombre").value = "";
          $("#modalRegistrar").modal("hide");
          tbl_identi.ajax.reload();
        });
      }
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "Este tipo de documento de identidad ya está registrado."
      );
    } else {
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "No se pudo registrar este tipo de documento de identidad."
      );
    }
  });
}

/* EDITAR TIPO DE ASIENTO */
$("#tabla_identidad").on("click", ".editar", function () {
  var data = tbl_identi.row($(this).parents("tr")).data();
  if (tbl_identi.row(this).child.isShown()) {
    var data = tbl_identi.row(this).data();
  }
  $("#modalModificar").modal({ backdrop: "static", keyboard: false });
  $("#modalModificar").modal("show");
  $("#id_tipo").val(data.td_id);
  $("#txt_nombreE").val(data.td_nombre);
});

function modificarIdentidad() {
  let id = document.getElementById("id_tipo").value;
  let nombre = document.getElementById("txt_nombreE").value;
  if (nombre.length == 0 || id.length == 0) {
    return Swal.fire(
      "<b style='color:red;'>Advertencia</b>",
      "<b>Llene todo los campos.</b>"
    );
  }
  $.ajax({
    url: "../controllers/tipo_docs/controEditarTipo.php",
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
          "Tipo de documento de identidad editado correctamente."
        ).then((value) => {
          $("#modalModificar").modal("hide");
          tbl_identi.ajax.reload();
        });
      }
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "Esta Tipo de documento de identidad ya está editado."
      );
    } else {
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "No se pudo editar el tipo de documento de identidad"
      );
    }
  });
}
