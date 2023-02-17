function signup() {
  rememberPass();
  let usuario = document.getElementById("txt_usuario").value;
  let contra = document.getElementById("txt_contra").value;

  if (usuario.length == 0 || contra.length == 0) {
    validarInputUsuario("txt_usuario", "txt_contra");
    return Swal.fire({
      title: '<b style="color:red">Advertencia</b>',
      text: "Ingrese sus datos...por favor!",
    });
  }

  $.ajax({
    url: "controllers/usuario/iniciarSesion.php",
    type: "POST",
    data: {
      usuario: usuario,
      contra: contra,
    },
  }).done(function (resp) {
    let data = JSON.parse(resp);
    if (data.length > 0) {
      if (data[0]["usu_estado"] == "INACTIVO") {
        return Swal.fire(
          '<b style="color:red;">Advertencia</b>',
          'Lo sentimos <b style="color:#000006;">' +
            data[0][8] +
            "</b> usted se encuentra <b style='color:red;' >" +
            data[0]["usu_estado"] +
            "</b>, comuniquese con el administrador.",
          "warning"
        );
      }
      $.ajax({
        url: "controllers/usuario/validarSesion.php",
        type: "POST",
        data: {
          id_usu: data[0][0],
          usuario: data[0][1],
          rol: data[0][6],
          apepat: data[0][2],
          apemat: data[0][3],
          nombre: data[0][4],
          pass: data[0][5],
          nusuario: data[0][8],
        },
      }).done(function (r) {
        let timerInterval;
        Swal.fire({
          title: "<b>BIENVENIDO AL SISTEMA</b>",
          html: "Sera redireccionado en <b></b> milliseconds.",
          timer: 800,
          heightAuto: false, // para que el login no se mueva hacia arriba
          timerProgressBar: false,
          didOpen: () => {
            Swal.showLoading();
            const b = Swal.getHtmlContainer().querySelector("b");
            timerInterval = setInterval(() => {
              b.textContent = Swal.getTimerLeft();
            }, 100);
          },
          willClose: () => {
            clearInterval(timerInterval);
          },
        }).then((result) => {
          if (result.dismiss === Swal.DismissReason.timer) {
            location.reload();
          }
        });
      });
    } else {
      Swal.fire(
        '<b style="color:red;">Advertencia</b>',
        "Usuario o Contraseña incorrectos."
      );
    }
  });
}

function validarInputUsuario(usuario, contra) {
  if (usuario != "") {
    Boolean(document.getElementById(usuario).value.length > 0)
      ? $("#" + usuario)
          .removeClass("is-invalid")
          .addClass("is-valid")
      : $("#" + usuario)
          .removeClass("is-valid")
          .addClass("is-invalid");
  }
  if (contra != "") {
    Boolean(document.getElementById(contra).value.length > 0)
      ? $("#" + contra)
          .removeClass("is-invalid")
          .addClass("is-valid")
      : $("#" + contra)
          .removeClass("is-valid")
          .addClass("is-invalid");
  }
}

function rememberPass() {
  if (rmcheck.checked && usuarioinput.value !== "" && passinput.value !== "") {
    localStorage.usuario = usuarioinput.value;
    localStorage.pass = passinput.value;
    localStorage.checkbox = rmcheck.value;
  } else {
    localStorage.usuario = "";
    localStorage.pass = "";
    localStorage.checkbox = "";
  }
}

var tbl_usuario_simple;
function listarUsuario() {
  tbl_usuario_simple = $("#tabla_usuario_simple").DataTable({
    ordering: false,
    bLengthChange: true,
    seaching: { regex: false },
    lengthMenu: [
      [5, 10, 15, 20, -1],
      [5, 10, 15, 20, "Todos"],
    ],
    pageLength: 5,
    destroy: true,
    async: false,
    processing: true,
    ajax: {
      url: "../controllers/usuario/controListarUsua.php",
      type: "POST",
    },
    columns: [
      { defaultContent: "" },
      { data: "usu_codigo" },
      { data: "usu_apepat" },
      { data: "usu_apemat" },
      { data: "usu_nombre" },
      { data: "usu_nivel" },
      {
        data: "usu_estado",
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
            return (
              "<button class='editar btn btn-outline-success btn-sm'><i class='fas fa-edit'></i></button>&nbsp;" +
              "<button class = 'btn btn-outline-primary btn-sm' disabled><i class = 'fa-solid fa-circle-check'></i></button>&nbsp;" +
              "<button class = 'desactivar btn btn-outline-danger btn-sm'><i class = 'fa-solid fa-ban'></i></button>"
            );
          } else {
            return (
              "<button class='editar btn btn-outline-success btn-sm'><i class='fa fa-edit'></i></button>&nbsp;" +
              "<button class = 'activar btn btn-outline-primary btn-sm' ><i class = 'fa-solid fa-circle-check'></i></button>&nbsp;" +
              "<button class = 'desactivar btn btn-outline-danger btn-sm' disabled><i class = 'fa-solid fa-ban'></i></button>"
            );
          }
        },
      },
    ],
    language: idioma_espanol,
    select: true,
  });
  tbl_usuario_simple.on("draw.td", function () {
    var PageInfo = $("#tabla_usuario_simple").DataTable().page.info();
    tbl_usuario_simple
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
  });
}

/* REGISTRAR USUARIO */

function abrirModalRegistrar() {
  $(".form-control").removeClass("is-invalid").removeClass("is-valid");
  $("#modalRegistrar").modal({ backdrop: "static", keyboard: false });
  $("#modalRegistrar").modal("show");
}

function registrarUsuario() {
  let codigo = document.getElementById("txt_dni").value;
  let apepat = document.getElementById("txt_apepat").value;
  let apemat = document.getElementById("txt_apemat").value;
  let nombre = document.getElementById("txt_nombre").value;
  let contra = document.getElementById("txt_contra").value;
  let rol = document.getElementById("cbm_rol").value;

  if (
    codigo.length == 0 ||
    codigo.length > 8 ||
    apepat.length == 0 ||
    apemat.length == 0 ||
    nombre.length == 0 ||
    contra.length == 0 ||
    rol.length == 0
  ) {
    return Swal.fire(
      '<b style="color:red;">Advertencia</b>',
      "<b>Debe llenar todos los campos.</b>"
    );
  }
  $.ajax({
    url: "../controllers/usuario/controRegisUsua.php",
    type: "POST",
    data: {
      codigo: codigo,
      apepat: apepat,
      apemat: apemat,
      nombre: nombre,
      rol: rol,
      contra: contra,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        return Swal.fire(
          '<b style="color:green;">Éxito</b>',
          "<b>Usuario registrado correctamente.</b>"
        ).then((value) => {
          document.getElementById("txt_dni").value = "";
          document.getElementById("txt_apepat").value = "";
          document.getElementById("txt_apemat").value = "";
          document.getElementById("txt_nombre").value = "";
          document.getElementById("txt_contra").value = "";
          document.getElementById("cbm_rol").value = "";
          $("#modalRegistrar").modal("hide");
          tbl_usuario_simple.ajax.reload();
        });
      }
      return Swal.fire(
        '<b style="color:red;">Advertencia</b>',
        "<b>El usuario ya existe.</b>"
      );
    } else {
      return Swal.fire(
        '<b style="color:red;">Advertencia</b>',
        "<b>No se pudo registrar este usuario.</b>"
      );
    }
  });
}

/* EDITAR USUARIO */

$("#tabla_usuario_simple").on("click", ".editar", function () {
  var data = tbl_usuario_simple.row($(this).parents("tr")).data();
  if (tbl_usuario_simple.row(this).child.isShown()) {
    var data = tbl_usuario_simple.row(this).data();
  }
  $("#modalModificar").modal("show");
  document.getElementById("id_usuario").value = data.usu_id;
  document.getElementById("txt_dniE").value = data.usu_codigo;
  document.getElementById("txt_apepatE").value = data.usu_apepat;
  document.getElementById("txt_apematE").value = data.usu_apemat;
  document.getElementById("txt_nombreE").value = data.usu_nombre;
  document.getElementById("txt_contraE").value = data.usu_contra;
  $("#cbm_rolE").select2().val(data.usu_nivel).trigger("change.select2");
});

function modificarUsuario() {
  let idUsu = document.getElementById("id_usuario").value;
  let codigoE = document.getElementById("txt_dniE").value;
  let apepatE = document.getElementById("txt_apepatE").value;
  let apematE = document.getElementById("txt_apematE").value;
  let nombreE = document.getElementById("txt_nombreE").value;
  let rolE = document.getElementById("cbm_rolE").value;

  if (
    idUsu.length == 0 ||
    codigoE.length == 0 ||
    codigoE.length > 8 ||
    apepatE.length == 0 ||
    apematE.length == 0 ||
    nombreE.length == 0 ||
    rolE.length == 0
  ) {
    return Swal.fire(
      '<b style="color:red;">Advertencia</b>',
      "<b>Debe llenar todos los campos.</b>"
    );
  }
  $.ajax({
    url: "../controllers/usuario/controEditarUsua.php",
    type: "POST",
    data: {
      idUsu: idUsu,
      codigoE: codigoE,
      apepatE: apepatE,
      apematE: apematE,
      nombreE: nombreE,
      rolE: rolE,
    },
  }).done(function (resp) {
    if (resp > 0) {
      return Swal.fire(
        '<b style="color:green;">Éxito</b>',
        "<b>Usuario modificado correctamente.</b>"
      ).then((value) => {
        $("#modalModificar").modal("hide");
        tbl_usuario_simple.ajax.reload();
      });
    } else {
      return Swal.fire(
        '<b style="color:red;">Advertencia</b>',
        "<b>No se pudo modificar este usuario.</b>"
      );
    }
  });
}

/* MODIFICAR ESTADO DE USUARIO */

$("#tabla_usuario_simple").on("click", ".activar", function () {
  var data = tbl_usuario_simple.row($(this).parents("tr")).data();
  if (tbl_usuario_simple.row(this).child.isShown()) {
    var data = tbl_usuario_simple.row(this).data();
  }
  Swal.fire({
    title:
      '<b style="color:#000006">¿Seguro de cambiar el estado a <b style ="color:green;">ACTIVO<b>?</b>',
    text: "Una vez realizado el cambio el usuario tendrá acceso al sistema!",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Confirmar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      modificarEstado(data.usu_id, "ACTIVO");
    }
  });
});

$("#tabla_usuario_simple").on("click", ".desactivar", function () {
  var data = tbl_usuario_simple.row($(this).parents("tr")).data();
  if (tbl_usuario_simple.row(this).child.isShown()) {
    var data = tbl_usuario_simple.row(this).data();
  }
  Swal.fire({
    title:
      '<b style="color:#000006">¿Seguro de cambiar el estado a <b style="color:red;">INACTIVO</b>?</b>',
    text: "Una vez realizado el cambio el usuario NO tendrá acceso al sistema!",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Confirmar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      modificarEstado(data.usu_id, "INACTIVO");
    }
  });
});

function modificarEstado(id, estado) {
  $.ajax({
    url: "../controllers/usuario/controCambiarEstado.php",
    type: "POST",
    data: {
      id: id,
      estado: estado,
    },
  }).done(function (resp) {
    if (resp > 0) {
      Swal.fire(
        '<b style="color:green;">Éxito</b>',
        "<b>Estado modificado correctamente.</b>"
      ).then((value) => {
        tbl_usuario_simple.ajax.reload();
      });
    } else {
      Swal.fire(
        '<b style="color:red;">Advertencia</b>',
        "<b>No se pudo modificar el estado.</b>"
      );
    }
  });
}

/* MODIFICAR CONTRASEÑA */
function abrirEditarContra() {
  $(".form-control").removeClass("is-invalid").removeClass("is-valid");
  $("#modalEditarContraUsua").modal({ backdrop: "static", keyboard: false }); //cuando de clip al costado no se cierra
  $("#modalEditarContraUsua").modal("show");
}

function cambiarContra() {
  let id_usu = document.getElementById("id_usuap_edit").value;
  let dni_usu = document.getElementById("id_dni_validar").value;
  let contraa = document.getElementById("txtContraAc").value;
  let contran = document.getElementById("txtContraNu").value;
  let contrar = document.getElementById("txtContraRe").value;

  if (contraa.length == 0 || contran.length == 0 || contrar.length == 0) {
    inputValidarContra("txtContraAc", "txtContraNu", "txtContraRe", "");
    return Swal.fire(
      "<b style='color:red;'>Advertencia</b>",
      "Llene todos los campos."
    );
  }
  $.ajax({
    url: "../controllers/usuario/iniciarSesion.php",
    type: "POST",
    data: {
      usuario: dni_usu,
      contra: contraa,
    },
  }).done(function (resp) {
    if (resp == 0) {
      inputValidarContra("txtContraa", "txtContran", "txtContrar", resp);
      return Swal.fire(
        "<b style='color:red'Advertencia</b>",
        "Contraseña actual incorrecta."
      );
    } else {
      $.ajax({
        url: "../controllers/usuario/controContraUsua.php",
        type: "POST",
        data: {
          idusu: id_usu,
          contran: contran,
        },
      }).done(function (resp) {
        if (resp > 0) {
          if (resp == 1) {
            limpiarModalContra();
            return Swal.fire(
              "<b style='color:green'>Confirmación</b>",
              "Contraseña cambiada exitosamente."
            ).then((value) => {
              $("#modalEditarContraUsua").modal("hide");
            });
          }
          return Swal.fire(
            "<b style='color:red'>Advertencia</b>",
            "Verificar contraseña."
          );
        } else {
          return Swal.fire(
            "<b style='color:red'>Advertencia</b>",
            "No se pudo cambiar la contraseña."
          );
        }
      });
    }
  });
}

function limpiarModalContra() {
  document.getElementById("txtContraAc").value = "";
  document.getElementById("txtContraNu").value = "";
  document.getElementById("txtContraRe").value = "";
}
