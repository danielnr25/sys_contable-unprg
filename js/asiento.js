var tbl_asiento;

function listarAsiento() {
   tbl_asiento = $("#tabla_asiento").DataTable({
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
         url: "../controllers/asiento/controListarAsiento.php",
         type: "POST",
      },
      columns: [
         { defaultContent: "" },
         { data: "ac_num" },
         { data: "ac_fecha" },
         { data: "ac_glosa" },
         { data: "ac_estado" },
         { data: "ta_nombre" },
         { data: "nusuario"},
         { data: "operacion"},
         { data: "periodo"},
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
   tbl_asiento.on("draw.dt", function () {
      var PageInfo = $("#tabla_asiento").DataTable().page.info();
      tbl_asiento
         .column(0, { page: "current" })
         .nodes()
         .each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
         });
   });
}

function cargarTipoAsiento() {
   $.ajax({
      url: "../controllers/asiento/controCargarTipoAsiento.php",
      type: "POST",
   }).done(function (resp) {
      let data = JSON.parse(resp);
      if (data.length > 0) {
         let cadena = "<option value=''>Seleccione Tipo de Asiento</option>";
         for (let i = 0; i < data.length; i++) {
            cadena +=
               "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
         }
         document.getElementById("cbm_tipo").innerHTML = cadena;
         document.getElementById("cbm_tipoE").innerHTML = cadena; 
      } else {
         cadena = "<option value=''>No hay datos disponibles</option>";
         document.getElementById("cbm_tipo").innerHTML = cadena;
         document.getElementById("cbm_tipoE").innerHTML = cadena;
      }
   });
}

function cargarContador() {
   $.ajax({
      url: "../controllers/asiento/controCargarContador.php",
      type: "POST",
   }).done(function (resp) {
      let data = JSON.parse(resp);
      if (data.length > 0) {
         let cadena = "<option value=''>Seleccione el Contador</option>";
         for (let i = 0; i < data.length; i++) {
            cadena +=
               "<option value='" + data[i][0] + "'>" + data[i]["nusuario"] + "</option>";
         }
         document.getElementById("cbm_contador").innerHTML = cadena;
         document.getElementById("cbm_contadorE").innerHTML = cadena; 
      } else {
         cadena = "<option value=''>No hay datos disponibles</option>";
         document.getElementById("cbm_contador").innerHTML = cadena;
         document.getElementById("cbm_contadorE").innerHTML = cadena;
      }
   });
}

function cargarOperacion() {
   $.ajax({
      url: "../controllers/asiento/controCargarOperacion.php",
      type: "POST",
   }).done(function (resp) {
      let data = JSON.parse(resp);
      if (data.length > 0) {
         let cadena = "<option value=''>Seleccione el Tipo de Operación</option>";
         for (let i = 0; i < data.length; i++) {
            cadena +=
               "<option value='" + data[i][0] + "'>" + data[i]["operacion"] + "</option>";
         }
         document.getElementById("cbm_operacion").innerHTML = cadena;
         document.getElementById("cbm_operacionE").innerHTML = cadena; 
      } else {
         cadena = "<option value=''>No hay datos disponibles</option>";
         document.getElementById("cbm_operacion").innerHTML = cadena;
         document.getElementById("cbm_operacionE").innerHTML = cadena;
      }
   });
}

function cargarPeriodo() {
   $.ajax({
      url: "../controllers/asiento/controCargarPeriodo.php",
      type: "POST",
   }).done(function (resp) {
      let data = JSON.parse(resp);
      if (data.length > 0) {
         let cadena = "<option value=''>Seleccione el Periodo Contable</option>";
         for (let i = 0; i < data.length; i++) {
            cadena +=
               "<option value='" + data[i][0] + "'>" + data[i]["periodo"] + "</option>";
         }
         document.getElementById("cbm_periodo").innerHTML = cadena;
         document.getElementById("cbm_periodoE").innerHTML = cadena; 
      } else {
         cadena = "<option value=''>No hay datos disponibles</option>";
         document.getElementById("cbm_periodo").innerHTML = cadena;
         document.getElementById("cbm_periodoE").innerHTML = cadena;
      }
   });
}

/* REGISTRAR ASIENTO CONTABLE */

function abrirModalRegistrar() {
   $(".form-control").removeClass("is-invalid").removeClass("is-valid");
   $("#modalRegistrar").modal({ backdrop: "static", keyboard: false });
   $("#modalRegistrar").modal("show");
}

function registrarAsiento() {
   let numero = document.getElementById("txt_numero").value;
   let fecha = document.getElementById("txt_fecha").value;
   let glosa = document.getElementById("txt_glosa").value;
   let estado = document.getElementById("txtEstado").value;
   let tipo = document.getElementById("cbm_tipo").value;
   let contador = document.getElementById("cbm_contador").value;
   let operacion = document.getElementById("cbm_operacion").value;
   let periodo = document.getElementById("cbm_periodo").value;

   if (numero == "" || fecha == "" || glosa == "" || estado == "" || tipo == "" || contador == "" || operacion == "" || periodo == "" ) {
      return Swal.fire(
         "<b style='color:red;'>Advertencia</b>",
         "<b>Llene todo los campos.</b>"
      );
   }
   $.ajax({
      url: "../controllers/asiento/controRegisAsiento.php",
      type: "POST",
      data: {
         numero: numero,
         fecha: fecha,
         glosa: glosa,
         estado: estado,
         tipo: tipo,
         contador: contador,
         operacion: operacion,
         periodo: periodo,
      },
   }).done(function (resp) {
      if (resp > 0) {
         if (resp == 1) {
            return Swal.fire(
               "<b style='color:green;'>Confirmación</b>",
               "Asiento Contable registrado correctamente."
            ).then((value) => {
               document.getElementById("txt_numero").value = "";
               document.getElementById("txt_fecha").value = "";
               document.getElementById("txt_glosa").value = "";
               document.getElementById("txtEstado").value = "";
               document.getElementById("cbm_tipo").value = "";
               document.getElementById("cbm_contador").value = "";
               document.getElementById("cbm_operacion").value = "";
               document.getElementById("cbm_periodo").value = "";
               $("#modalRegistrar").modal("hide");
               tbl_asiento.ajax.reload();
            });
         }
         return Swal.fire(
            "<b style='color:red;'>Advertencia</b>",
            "Este Asiento ya está registrada."
         );
      } else {
         return Swal.fire(
            "<b style='color:red;'>Advertencia</b>",
            "No se pudo registrar este Asiento."
         );
      }
   });
}


/* MODIFICAR ASIENTO CONTABLE */

$("#tabla_asiento").on("click", ".editar", function () {
   var data = tbl_asiento.row($(this).parents("tr")).data();
   if (tbl_asiento.row(this).child.isShown()) {
      var data = tbl_asiento.row(this).data();
   }
   $("#modalModificar").modal({ backdrop: "static", keyboard: false });
   $("#modalModificar").modal("show");
   $("#id").val(data.ac_id);
   $("#txt_numeroE").val(data.ac_num);
   $("#txt_fechaE").val(data.ac_fecha);
   $("#txt_glosaE").val(data.ac_glosa);
   $("#txtEstadoE").val(data.ac_estado);
   $("#cbm_tipoE").select2().val(data.ta_id).trigger("change.select2");
   $("#cbm_contadorE").select2().val(data.usu_id).trigger("change.select2");
   $("#cbm_operacionE").select2().val(data.tc_id).trigger("change.select2");
   $("#cbm_periodoE").select2().val(data.pc_id).trigger("change.select2");
});


function modificarAsiento() {
   let id = document.getElementById("id").value;
   let numero = document.getElementById("txt_numeroE").value;
   let fecha = document.getElementById("txt_fechaE").value;
   let glosa = document.getElementById("txt_glosaE").value;
   let estado = document.getElementById("txtEstadoE").value;
   let tipo = document.getElementById("cbm_tipoE").value;
   let contador = document.getElementById("cbm_contadorE").value;
   let operacion = document.getElementById("cbm_operacionE").value;
   let periodo = document.getElementById("cbm_periodoE").value;

   if (
      id == "" ||
      numero == "" ||
      fecha == "" ||
      glosa == "" ||
      estado == "" ||
      tipo == "" ||
      contador == "" ||
      operacion == "" ||
      periodo == ""
   ) {
      return Swal.fire(
         "<b style='color:red;'>Advertencia</b>",
         "<b>Llene todo los campos.</b>"
      );
   }
   $.ajax({
      url: "../controllers/asiento/controEditarAsiento.php",
      type: "POST",
      data: {
         id: id,
         numero: numero,
         fecha: fecha,
         glosa: glosa,
         estado: estado,
         tipo: tipo,
         contador: contador,
         operacion: operacion,
         periodo: periodo,
      },
   }).done(function (resp) {
      if (resp > 0) {
         if (resp == 1) {
            return Swal.fire(
               "<b style='color:green;'>Confirmación</b>",
               "Asiento editado correctamente."
            ).then((value) => {
               $("#modalModificar").modal("hide");
               tbl_asiento.ajax.reload();
            });
         }
         return Swal.fire(
            "<b style='color:red;'>Advertencia</b>",
            "Esta Asiento ya está editado."
         );
      } else {
         return Swal.fire(
            "<b style='color:red;'>Advertencia</b>",
            "No se pudo editar el Asiento"
         );
      }
   });
}
