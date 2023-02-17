var tbl_contable;

function listarContable() {
  tbl_contable = $("#tabla_contable").DataTable({
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
      url: "../controllers/contable/controListarContable.php",
      type: "POST",
    },
    columns: [
      { defaultContent: "" },
      { data: "cc_num" },
      { data: "cc_nombre" },
      { data: "cc_moneda" },
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
  tbl_contable.on("draw.dt", function () {
    var PageInfo = $("#tabla_contable").DataTable().page.info();
    tbl_contable
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

function registrarContable() {
  let numero = document.getElementById("txt_numero").value;
  let nombre = document.getElementById("txt_nombre").value;
  let moneda = document.getElementById("txt_moneda").value;
  if ((numero.length == 0, nombre.length == 0, moneda.length == 0)) {
    return Swal.fire(
      "<b style='color:red;'>Advertencia</b>",
      "<b>Llene todo los campos.</b>"
    );
  }
  $.ajax({
    url: "../controllers/contable/controRegisContable.php",
    type: "POST",
    data: {
      numero: numero,
      nombre: nombre,
      moneda: moneda,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        return Swal.fire(
          "<b style='color:green;'>Confirmación</b>",
          "Cuenta Contable registrada correctamente."
        ).then((value) => {
          document.getElementById("txt_numero").value = "";
          document.getElementById("txt_nombre").value = "";
          document.getElementById("txt_moneda").value = "";
          $("#modalRegistrar").modal("hide");
          tbl_contable.ajax.reload();
        });
      }
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "Este Cuenta Contable ya está registrada."
      );
    } else {
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "No se pudo registrar esta Cuenta Contable."
      );
    }
  });
}

/* EDITAR TIPO DE ASIENTO */
$("#tabla_contable").on("click", ".editar", function () {
  var data = tbl_contable.row($(this).parents("tr")).data();
  if (tbl_contable.row(this).child.isShown()) {
    var data = tbl_contable.row(this).data();
  }
  $("#modalModificar").modal({ backdrop: "static", keyboard: false });
  $("#modalModificar").modal("show");
  $("#id_contable").val(data.cc_id);
  $("#txt_numeroE").val(data.cc_num);
  $("#txt_nombreE").val(data.cc_nombre);
  $("#txt_monedaE").val(data.cc_moneda);
});

function modificarContable() {
  let id = document.getElementById("id_contable").value;
  let numero = document.getElementById("txt_numeroE").value;
  let nombre = document.getElementById("txt_nombreE").value;
  let moneda = document.getElementById("txt_monedaE").value;
  if (
    numero.length == 0 ||
    id.length == 0 ||
    nombre.length == 0 ||
    moneda.length == 0
  ) {
    return Swal.fire(
      "<b style='color:red;'>Advertencia</b>",
      "<b>Llene todo los campos.</b>"
    );
  }
  $.ajax({
    url: "../controllers/contable/controEditarContable.php",
    type: "POST",
    data: {
      id: id,
      numero: numero,
      nombre: nombre,
      moneda: moneda,

    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        return Swal.fire(
          "<b style='color:green;'>Confirmación</b>",
          "Cuenta Contable editada correctamente."
        ).then((value) => {
          $("#modalModificar").modal("hide");
          tbl_contable.ajax.reload();
        });
      }
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "Esta Cuenta Contable ya está editada."
      );
    } else {
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "No se pudo editar el Cuenta Contable"
      );
    }
  });
}
