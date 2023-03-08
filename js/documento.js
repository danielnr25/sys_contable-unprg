var tbl_documento;

function listar_documento() {
   tbl_documento = $("#tabla_documento").DataTable({
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
         url: "../controllers/documento/controListarDoc.php",
         type: "POST",
      },
      columns: [
         { defaultContent: "" },
         { data: "do_tipo" },
         { data: "do_numserie" },
         { data: "do_numcorrelativo" },
         { data: "do_femision" },
         { data: "do_concepto" },
         { data: "nauxiliar" },
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
   tbl_documento.on("draw.dt", function () {
      var PageInfo = $("#tabla_documento").DataTable().page.info();
      tbl_documento
         .column(0, { page: "current" })
         .nodes()
         .each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
         });
   });
}


function cargarDocumento() {
   $.ajax({
      url: "../controllers/documento/controCargarCuenta.php",
      type: "POST",
   }).done(function (resp) {
      let data = JSON.parse(resp);
      if (data.length > 0) {
         let cadena = "<option value=''>Seleccione cuenta auxiliar</option>";
         for (let i = 0; i < data.length; i++) {
            cadena +=
               "<option value='" + data[i][0] + "'>" + data[i][8] + "</option>";
         }
         document.getElementById("cbm_cuenta").innerHTML = cadena;
         document.getElementById("cbm_cuentaE").innerHTML = cadena; 
      } else {
         cadena = "<option value=''>No hay datos disponibles</option>";
         document.getElementById("cbm_cuenta").innerHTML = cadena;
         document.getElementById("cbm_cuentaE").innerHTML = cadena;
      }
   });
}


/* REGISTRAR TIPO DE ASIENTO */

function abrirModalRegistrar() {
   $(".form-control").removeClass("is-invalid").removeClass("is-valid");
   $("#modalRegistrar").modal({ backdrop: "static", keyboard: false });
   $("#modalRegistrar").modal("show");
}

function registrarDoc() {
   let tipo = document.getElementById("txt_tipo").value;
   let serie = document.getElementById("txt_serie").value;
   let correlativo = document.getElementById("txt_correlativo").value;
   let femision = document.getElementById("txt_femi").value;
   let concepto = document.getElementById("txt_concepto").value;
   let cuenta = document.getElementById("cbm_cuenta").value;
   if ((tipo.length == 0) | (serie.length == 0) | (correlativo.length == 0) | (femision.length == 0) | (concepto.length == 0) | (cuenta.length == 0)) {
      return Swal.fire(
         "<b style='color:red;'>Advertencia</b>",
         "<b>Llene todo los campos.</b>"
      );
   }
   $.ajax({
      url: "../controllers/documento/controRegisDoc.php",
      type: "POST",
      data: {
         tipo: tipo,
         serie: serie,
         correlativo: correlativo,
         femision: femision,
         concepto: concepto,
         cuenta: cuenta,
      },
   }).done(function (resp) {
      if (resp > 0) {
         if (resp == 1) {
            return Swal.fire(
               "<b style='color:green;'>Confirmación</b>",
               "Documento registrado correctamente."
            ).then((value) => {
               document.getElementById("txt_tipo").value = "";
               document.getElementById("txt_serie").value = "";
               document.getElementById("txt_correlativo").value = "";
               document.getElementById("txt_femi").value = "";
               document.getElementById("txt_concepto").value = "";
               document.getElementById("cbm_cuenta").value = "";
               $("#modalRegistrar").modal("hide");
               tbl_documento.ajax.reload();
            });
         }
         return Swal.fire(
            "<b style='color:red;'>Advertencia</b>",
            "Este Documento ya está registrada."
         );
      } else {
         return Swal.fire(
            "<b style='color:red;'>Advertencia</b>",
            "No se pudo registrar este Documento."
         );
      }
   });
}

/* EDITAR TIPO DE ASIENTO */
$("#tabla_documento").on("click", ".editar", function () {
   var data = tbl_documento.row($(this).parents("tr")).data();
   if (tbl_documento.row(this).child.isShown()) {
      var data = tbl_documento.row(this).data();
   }
   $("#modalModificar").modal({ backdrop: "static", keyboard: false });
   $("#modalModificar").modal("show");
   $("#id_tipo").val(data.do_id);
   $("#txt_tipoE").val(data.do_tipo);
   $("#txt_serieE").val(data.do_numserie);
   $("#txt_correlativoE").val(data.do_numcorrelativo);
   $("#txt_femiE").val(data.do_femision);
   $("#txt_conceptoE").val(data.do_concepto);
   $("#cbm_cuentaE").val(data.cx_id);
});

function modificarDoc() {
   let id = document.getElementById("id_tipo").value;
   let tipo = document.getElementById("txt_tipoE").value;
   let serie = document.getElementById("txt_serieE").value;
   let correlativo = document.getElementById("txt_correlativoE").value;
   let femision = document.getElementById("txt_femiE").value;
   let concepto = document.getElementById("txt_conceptoE").value;
   let cuenta = document.getElementById("cbm_cuentaE").value;
   if (
      (id == 0) |  
      (tipo.length == 0) |
      (serie.length == 0) |
      (correlativo.length == 0) |
      (femision.length == 0) |
      (concepto.length == 0) |
      (cuenta.length == 0)
   ) {
      return Swal.fire(
         "<b style='color:red;'>Advertencia</b>",
         "<b>Llene todo los campos.</b>"
      );
   }
   $.ajax({
      url: "../controllers/documento/controEditarDoc.php",
      type: "POST",
      data: {
         id: id,
         tipo: tipo,
         serie: serie,
         correlativo: correlativo,
         femision: femision,
         concepto: concepto,
         cuenta: cuenta,
      },
   }).done(function (resp) {
      if (resp > 0) {
         if (resp == 1) {
            return Swal.fire(
               "<b style='color:green;'>Confirmación</b>",
               "Documento editado correctamente."
            ).then((value) => {
               $("#modalModificar").modal("hide");
               tbl_documento.ajax.reload();
            });
         }
         return Swal.fire(
            "<b style='color:red;'>Advertencia</b>",
            "Esta Documento ya está editado."
         );
      } else {
         return Swal.fire(
            "<b style='color:red;'>Advertencia</b>",
            "No se pudo editar el Documento"
         );
      }
   });
}
