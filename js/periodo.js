var tbl_periodo;

function listar_periodo() {
  tbl_periodo = $("#tabla_periodo").DataTable({
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
      url: "../controllers/periodo/controListarPeriodo.php",
      type: "POST",
    },
    columns: [
      { defaultContent: "" },
      { data: "pc_year" },
      { data: "pc_finicio" },
      { data: "pc_ffin" },
      {
        data: "pc_estado",
        render: function (data, type, row) {
          if (data == "ACTIVO") {
            return "<span class='badge bg-success'>" + data + "</span>";
          } else {
            return '<span class="badge bg-danger">' + data + "</span>";
          }
        },
      },
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
  tbl_periodo.on("draw.dt", function () {
    var PageInfo = $("#tabla_periodo").DataTable().page.info();
    tbl_periodo
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
  let year = document.getElementById("txt_year").value;
  let finicio = document.getElementById("txt_finicio").value;
  let ffin = document.getElementById("txt_ftermino").value;
  if ((year.length == 0, finicio.length == 0, ffin.length == 0)) {
    return Swal.fire(
      "<b style='color:red;'>Advertencia</b>",
      "<b>Llene todo los campos.</b>"
    );
  }
  $.ajax({
    url: "../controllers/periodo/controRegisPeriodo.php",
    type: "POST",
    data: {
      year: year,
      finicio: finicio,
      ffin: ffin,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        return Swal.fire(
          "<b style='color:green;'>Confirmación</b>",
          "Periodo Contable registrado correctamente."
        ).then((value) => {
          document.getElementById("txt_year").value = "";
          document.getElementById("txt_finicio").value = "";
          document.getElementById("txt_ftermino").value = "";
          $("#modalRegistrar").modal("hide");
          tbl_periodo.ajax.reload();
        });
      }
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "Este Periodo Contable ya está registrada."
      );
    } else {
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "No se pudo registrar este Periodo Contable."
      );
    }
  });
}

/* EDITAR TIPO DE ASIENTO */
$("#tabla_periodo").on("click", ".editar", function () {
  var data = tbl_periodo.row($(this).parents("tr")).data();
  if (tbl_periodo.row(this).child.isShown()) {
    var data = tbl_periodo.row(this).data();
  }
  $("#modalModificar").modal({ backdrop: "static", keyboard: false });
  $("#modalModificar").modal("show");
  $("#id_tipo").val(data.pc_id);
  $("#txt_yearE").val(data.pc_year);
  $("#txt_finicioE").val(data.pc_finicio);
  $("#txt_fterminoE").val(data.pc_ffin);
  $("#txt_estadoE").val(data.pc_estado);
});

function modificarPeriodo() {
  let id = document.getElementById("id_tipo").value;
  let year = document.getElementById("txt_yearE").value;
  let finicio = document.getElementById("txt_finicioE").value;
  let ffin = document.getElementById("txt_fterminoE").value;
  let estado = document.getElementById("txtEstadoE").value;
  if (
    finicio.length == 0 ||
    id.length == 0 ||
    year.length == 0 ||
    year.length < 4 ||
    ffin.length == 0
  ) {
    return Swal.fire(
      "<b style='color:red;'>Advertencia</b>",
      "<b>Llene todo los campos.</b>"
    );
  }
  $.ajax({
    url: "../controllers/periodo/controEditarPeriodo.php",
    type: "POST",
    data: {
      id: id,
      year: year,
      finicio: finicio,
      ffin: ffin,
      estado: estado,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        return Swal.fire(
          "<b style='color:green;'>Confirmación</b>",
          "Periodo Contable editado correctamente."
        ).then((value) => {
          $("#modalModificar").modal("hide");
          tbl_periodo.ajax.reload();
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
