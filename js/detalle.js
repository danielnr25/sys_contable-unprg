var tbl_detalle;

function listarDetalle() {
  tbl_detalle = $("#tabla_detalle").DataTable({
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
      url: "../controllers/detalle/controListarDetalle.php",
      type: "POST",
    },
    columns: [
      { defaultContent: "" },
      { data: "ccontable" },
      { data: "ca_pcompra" },
      { data: "da_debe" },
      { data: "da_haber" },
      { data: "da_importesol" },
      { data: "da_importedol" },
      {
        "data": "da_estado",
        render: function (data, type, row) {

            if (data == "BALANCEADO") {
                return "<span class='badge bg-success'>" + data + "</span>";
            } else  {
                return "<span class='badge bg-danger'>" + data + "</span>";
            }
        }

    },
      /*{
        "defaultContent":
            "<button class='editar btn btn-outline-success btn-sm'><i class='fa fa-edit'></i></button>&nbsp&nbsp;" 
    },*/
    ],
    language: idioma_espanol,
    select: true,
  });
  tbl_detalle.on("draw.dt", function () {
    var PageInfo = $("#tabla_detalle").DataTable().page.info();
    tbl_detalle
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
  });
}


function abrirModalRegistrar() {
  $(".form-control").removeClass("is-invalid").removeClass("is-valid");
  //$("#modalRegistrarDetalle").modal({ backdrop: "static", keyboard: false });
  //$("#modalRegistrarDetalle").modal("show");
  $("#modal_tabla_Detalle").modal({ backdrop: "static", keyboard: false });
  $("#modal_tabla_Detalle").modal('show');
  limpiar_modalDetalle();
}

function abrirModalRegistro() {
  $(".form-control").removeClass("is-invalid").removeClass("is-valid");
  $("#modalRegistrarDetalle").modal({ backdrop: "static", keyboard: false });
  $("#modalRegistrarDetalle").modal("show");
}


function registrardetalle() {
  let debe = document.getElementById("txt_debe").value;
  let haber = document.getElementById("txt_haber").value;
  //let sol = document.getElementById("txt_sol").value;
  //let dol = document.getElementById("txt_dol").value;
  //let moneda = document.getElementById("txt_moneda").value;
  let asiento = document.getElementById("select_asiento").value;
  let doc = document.getElementById("select_doc").value;
  let cuenta = document.getElementById("select_cuenta").value;
  //let tipo = document.getElementById("select_tipo").value;

  
  if (debe.length == 0 || haber.length == 0) {
    return Swal.fire("!Mensaje de Advertencia!", "<b>Llene todo los campos</b>", "warning");
}

  $.ajax({
    url: "../controllers/detalle/controRegisdetalle.php",
    type: "POST",
    data: {
      debe: debe,
      haber: haber,
      //sol: sol,
      //dol: dol,
      //moneda: moneda,
      asiento: asiento,
      doc: doc,
      cuenta: cuenta,
      //tipo: tipo
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        limpiar_modalDetalle();
        return Swal.fire("Mensaje de Confirmacion", "Detalle de Asiento Registrado", "success").then((value) => {
          $("#modalRegistrarDetalle").modal('hide');
          tbl_detalle.ajax.reload();

      });
  }
  return Swal.fire("Mensaje de Advertencia", "La Cuenta Contable ya se encuentra Registrada", "warning");

} else {
  return Swal.fire("Mensaje de Advertencia", "No se pudo registrar el Detalle de Asiento", "error");

}
  });
}

function limpiar_modalDetalle() {
  document.getElementById("txt_debe").value = '';
  document.getElementById("txt_haber").value = '';
  //document.getElementById("txt_sol").value = "";
  //document.getElementById("txt_dol").value = '';
  //document.getElementById("txt_moneda").value = '';
  document.getElementById("select_asiento").value = '';
  document.getElementById("select_doc").value = '';
  document.getElementById("select_cuenta").value = "";
  //document.getElementById("select_tipo").value = "";
}



function cargarAsiento() {
  $.ajax({
      url: '../controllers/asiento/controCargarTipoAsiento.php',
      type: 'POST',

  }).done(function (resp) {
      let data = JSON.parse(resp);
      let llenarData = "<option value=''>Selecionar Tipo Asiento </option>";

      if (data.length > 0) {
          for (let i = 0; i < data.length; i++) {
              llenarData += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
          }
          document.getElementById('select_asiento').innerHTML = llenarData;
          
      } else {
          llenarData += "<option value=''> no se encontraron datos en la bd </option>";
          document.getElementById('select_asiento').innerHTML = llenarData;
          
      }
  })
}


function cargarDocumento() {
  $.ajax({
      url: '../controllers/detalle/controCargarDoc.php',
      type: 'POST',

  }).done(function (resp) {
      let data = JSON.parse(resp);
      let llenarData = "<option value=''>Selecionar Documento </option>";

      if (data.length > 0) {
          for (let i = 0; i < data.length; i++) {
              llenarData += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
          }
          document.getElementById('select_doc').innerHTML = llenarData;
          
      } else {
          llenarData += "<option value=''> no se encontraron datos en la bd </option>";
          document.getElementById('select_doc').innerHTML = llenarData;
          
      }
  })
}

function cargarCuenta() {
  $.ajax({
      url: '../controllers/detalle/controCargarCuenta.php',
      type: 'POST',

  }).done(function (resp) {
      let data = JSON.parse(resp);
      let llenarData = "<option value=''>Selecionar Cuenta Contable </option>";

      if (data.length > 0) {
          for (let i = 0; i < data.length; i++) {
              llenarData += "<option value='" + data[i][0] + "'>" + data[i][1] + " - " + data[i][2]+ "</option>";
          }
          document.getElementById('select_cuenta').innerHTML = llenarData;
          
      } else {
          llenarData += "<option value=''> no se encontraron datos en la bd </option>";
          document.getElementById('select_cuenta').innerHTML = llenarData;
          
      }
  })
}

/*
function cargarTipo() {
  $.ajax({
      url: '../controllers/detalle/controTipoCambio.php',
      type: 'POST',

  }).done(function (resp) {
      let data = JSON.parse(resp);
      let llenarData = "<option value=''>Selecionar Tipo de Cambio </option>";

      if (data.length > 0) {
          for (let i = 0; i < data.length; i++) {
              llenarData += "<option value='" + data[i][0] + "'>" + data[i][2] + "</option>";
          }
          document.getElementById('select_tipo').innerHTML = llenarData;
          
      } else {
          llenarData += "<option value=''> no se encontraron datos en la bd </option>";
          document.getElementById('select_tipo').innerHTML = llenarData;
          
      }
  })
}
*/




/* EDITAR TIPO DE ASIENTO */
$("#tabla_detalle").on("click", ".editar", function () {
  var data = tbl_detalle.row($(this).parents("tr")).data();
  if (tbl_detalle.row(this).child.isShown()) {
    var data = tbl_detalle.row(this).data();
  }
  $("#modalModificar").modal({ backdrop: "static", keyboard: false });
  $("#modalModificar").modal("show");
  $("#id_detalle").val(data.cc_id);
  $("#txt_numeroE").val(data.cc_num);
  $("#txt_nombreE").val(data.cc_nombre);
  $("#txt_monedaE").val(data.cc_moneda);
});

function modificardetalle() {
  let id = document.getElementById("id_detalle").value;
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
    url: "../controllers/detalle/controEditardetalle.php",
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
          "Cuenta detalle editada correctamente."
        ).then((value) => {
          $("#modalModificar").modal("hide");
          tbl_detalle.ajax.reload();
        });
      }
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "Esta Cuenta detalle ya está editada."
      );
    } else {
      return Swal.fire(
        "<b style='color:red;'>Advertencia</b>",
        "No se pudo editar el Cuenta detalle"
      );
    }
  });
}


function calcular() {
  var numDebe = document.getElementById('txt_debe').value;
  var numHaber = document.getElementById('txt_haber').value;


  var resultado = numDebe - numHaber ;

  if (numDebe < numHaber) {
    var resultado1 = numHaber - numDebe;
    document.getElementById('txt_sol').value = resultado1
  } else {
    document.getElementById('txt_sol').value = resultado
  }
}

function GenerarPDFDetalle() {
  window.open("../report/reportDetaFiltro.php");
}

