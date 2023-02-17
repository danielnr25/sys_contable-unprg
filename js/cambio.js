var tbl_cambio;

function listar_cambio() {
  tbl_cambio = $("#tabla_cambio").DataTable({
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
      url: "../controllers/cambio/controListarCambio.php",
      type: "POST",
    },
    columns: [
      { defaultContent: "" },
      { data: "ca_fecha" },
      { data: "ca_pcompra" },
      { data: "ca_pventa" },
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
  tbl_cambio.on("draw.dt", function () {
    var PageInfo = $("#tabla_cambio").DataTable().page.info();
    tbl_cambio
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

function registrarCambio() {
  let fecha = document.getElementById("txt_fecha").value;
  let compra = document.getElementById("txt_compra").value;
  let venta = document.getElementById("txt_venta").value;
  if ((fecha.length == 0, compra.length == 0, venta.length == 0)) {
    return Swal.fire(
      "<b style='color:red;'>Advertencia</b>",
      "<b>Llene todo los campos.</b>"
    );
  }
  $.ajax({
    url: "../controllers/cambio/controRegisCambio.php",
    type: "POST",
    data: {
      fecha: fecha,
      compra: compra,
      venta: venta,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        return Swal.fire(
          "<b style='color:green;'>Confirmación</b>",
          "Tipo de Cambio registrado correctamente."
        ).then((value) => {
          document.getElementById("txt_fecha").value = "";
          document.getElementById("txt_compra").value = "";
          document.getElementById("txt_venta").value = "";
          $("#modalRegistrar").modal("hide");
          tbl_cambio.ajax.reload();
        });
      }
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "Este Tipo de Cambio ya está registrada."
      );
    } else {
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "No se pudo registrar este Tipo de Cambio."
      );
    }
  });
}

/* EDITAR TIPO DE ASIENTO */
$("#tabla_cambio").on("click", ".editar", function () {
  var data = tbl_cambio.row($(this).parents("tr")).data();
  if (tbl_cambio.row(this).child.isShown()) {
    var data = tbl_cambio.row(this).data();
  }
  $("#modalModificar").modal({ backdrop: "static", keyboard: false });
  $("#modalModificar").modal("show");
  $("#id_tipo").val(data.ca_id);
  $("#txt_fechaE").val(data.ca_fecha);
  $("#txt_compraE").val(data.ca_pcompra);
  $("#txt_ventaE").val(data.ca_pventa);
});

function modificarCambio() {
  let id = document.getElementById("id_tipo").value;
  let fecha = document.getElementById("txt_fechaE").value;
  let compra = document.getElementById("txt_compraE").value;
  let venta = document.getElementById("txt_ventaE").value;
  if (
    compra.length == 0 ||
    id.length == 0 ||
    fecha.length == 0 ||
    venta.length == 0
  ) {
    return Swal.fire(
      "<b style='color:red;'>Advertencia</b>",
      "<b>Llene todo los campos.</b>"
    );
  }
  $.ajax({
    url: "../controllers/cambio/controEditarCambio.php",
    type: "POST",
    data: {
      id: id,
      fecha: fecha,
      compra: compra,
      venta: venta,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        return Swal.fire(
          "<b style='color:green;'>Confirmación</b>",
          "Periodo Contable editado correctamente."
        ).then((value) => {
          $("#modalModificar").modal("hide");
          tbl_cambio.ajax.reload();
        });
      }
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "Esta Periodo Contable ya está editado."
      );
    } else {
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "No se pudo editar el Periodo Contable"
      );
    }
  });
}
