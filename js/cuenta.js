var tbl_auxiliar;

function listar_cuenta() {
   tbl_auxiliar = $("#tabla_auxiliar").DataTable({
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
         url: "../controllers/cuenta/controListarCuenta.php",
         type: "POST",
      },
      columns: [
         { defaultContent: "" },
         { data: "td_nombre" },
         { data: "cx_dni" },
         { data: "nauxiliar" },
         { data: "cx_denominacion" },
         { data: "cx_direccion" },
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
   tbl_auxiliar.on("draw.dt", function () {
      var PageInfo = $("#tabla_auxiliar").DataTable().page.info();
      tbl_auxiliar
         .column(0, { page: "current" })
         .nodes()
         .each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
         });
   });
}

function cargarIdentidad() {
   $.ajax({
      url: "../controllers/cuenta/controCargarIdentidad.php",
      type: "POST",
   }).done(function (resp) {
      let data = JSON.parse(resp);
      if (data.length > 0) {
         let cadena = "<option value=''>Seleccione Tipo de Identidad</option>";
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

/* REGISTRAR CUENTA AUXILIAR */

function abrirModalRegistrar() {
   $(".form-control").removeClass("is-invalid").removeClass("is-valid");
   $("#modalRegistrar").modal({ backdrop: "static", keyboard: false });
   $("#modalRegistrar").modal("show");
}

function registrarCuenta() {
   let tipo = document.getElementById("cbm_tipo").value;
   let identidad = document.getElementById("txt_identidad").value;
   let apepat = document.getElementById("txt_apepat").value;
   let apemat = document.getElementById("txt_apemat").value;
   let nombre = document.getElementById("txt_nombre").value;
   let razon = document.getElementById("txt_razon").value;
   let direccion = document.getElementById("txt_direccion").value;
   if ((tipo.length == 0, identidad == 0, identidad <= 12, apepat.length == 0, apemat.length == 0, nombre.length == 0, razon.length == 0, direccion.length == 0)) {
      return Swal.fire(
         "<b style='color:red;'>Advertencia</b>",
         "<b>Llene todo los campos.</b>"
      );
   }
   $.ajax({
      url: "../controllers/cuenta/controRegisCuenta.php",
      type: "POST",
      data: {
         identidad: identidad,
         apepat: apepat,
         apemat: apemat,
         nombre: nombre,
         razon: razon,
         direccion: direccion,
         tipo: tipo
      },
   }).done(function (resp) {
      if (resp > 0) {
         if (resp == 1) {
            return Swal.fire(
               "<b style='color:green;'>Confirmación</b>",
               "Cuenta Auxiliar registrada correctamente."
            ).then((value) => {
               document.getElementById("cbm_tipo").value = "";
               document.getElementById("txt_identidad").value = "";
               document.getElementById("txt_apepat").value = "";
               document.getElementById("txt_apemat").value = "";
               document.getElementById("txt_nombre").value = "";
               document.getElementById("txt_razon").value = "";
               document.getElementById("txt_direccion").value = "";
               $("#modalRegistrar").modal("hide");
               tbl_auxiliar.ajax.reload();
            });
         }
         return Swal.fire(
            "<b style='color:red;'>Advertencia</b>",
            "Este Cuenta Auxiliar ya está registrada."
         );
      } else {
         return Swal.fire(
            "<b style='color:red;'>Advertencia</b>",
            "No se pudo registrar esta Cuenta Auxiliar."
         );
      }
   });
}


/* EDITAR CUENTA AUXILIAR */
$("#tabla_auxiliar").on("click", ".editar", function () {
   var data = tbl_auxiliar.row($(this).parents("tr")).data();
   if (tbl_auxiliar.row(this).child.isShown()) {
      var data = tbl_auxiliar.row(this).data();
   }
   $("#modalModificar").modal({ backdrop: "static", keyboard: false });
   $("#modalModificar").modal("show");
   $("#id_tipo").val(data.cx_id);
   $("#txt_identidadE").val(data.cx_dni);
   $("#txt_apepatE").val(data.cx_apepat);
   $("#txt_apematE").val(data.cx_apemat);
   $("#txt_nombreE").val(data.cx_nombre);
   $("#txt_razonE").val(data.cx_denominacion);
   $("#txt_direccionE").val(data.cx_direccion);
   $("#cbm_tipoE").select2().val(data.td_id).trigger("change.select2");

});

function editarCuenta() {
   let id = document.getElementById("id_tipo").value;
   let tipo = document.getElementById("cbm_tipoE").value;
   let identidad = document.getElementById("txt_identidadE").value;
   let apepat = document.getElementById("txt_apepatE").value;
   let apemat = document.getElementById("txt_apematE").value;
   let nombre = document.getElementById("txt_nombreE").value;
   let razon = document.getElementById("txt_razonE").value;
   let direccion = document.getElementById("txt_direccionE").value;
   if ((id ==0, tipo.length == 0, identidad == 0, identidad <= 12, apepat.length == 0, apemat.length == 0, nombre.length == 0, razon.length == 0, direccion.length == 0)) {
      return Swal.fire(
         "<b style='color:red;'>Advertencia</b>",
         "<b>Llene todo los campos.</b>"
      );
   }
   $.ajax({
      url: "../controllers/cuenta/controEditarCuenta.php",
      type: "POST",
      data: {
         id: id,
         identidad: identidad,
         apepat: apepat,
         apemat: apemat,
         nombre: nombre,
         razon: razon,
         direccion: direccion,
         tipo: tipo,
      },
   }).done(function (resp) {
      if (resp > 0) {
         if (resp == 1) {
            return Swal.fire(
               "<b style='color:green;'>Confirmación</b>",
               "Cuenta Auxiliar modificada correctamente."
            ).then((value) => {
               document.getElementById("cbm_tipoE").value = "";
               document.getElementById("txt_identidadE").value = "";
               document.getElementById("txt_apepatE").value = "";
               document.getElementById("txt_apematE").value = "";
               document.getElementById("txt_nombreE").value = "";
               document.getElementById("txt_razonE").value = "";
               document.getElementById("txt_direccionE").value = "";
               $("#modalModificar").modal("hide");
               tbl_auxiliar.ajax.reload();
            });
         }
         return Swal.fire(
            "<b style='color:red;'>Advertencia</b>",
            "Este Cuenta Auxiliar ya está registrada."
         );
      } else {
         return Swal.fire(
            "<b style='color:red;'>Advertencia</b>",
            "No se pudo modificar esta Cuenta Auxiliar."
         );
      }
   });
}