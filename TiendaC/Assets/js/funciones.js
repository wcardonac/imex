
let tblusuarios, tblclientes, tblProducto, historial_C;
document.addEventListener("DOMContentLoaded", function () {
    $('#cliente').select2();
    tblusuarios = $('#tblusuarios').DataTable( {
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [
            {
            'data': 'id',
            },
            {
            'data': 'usuario'
            },
            {
            'data': 'nombre'
            },
            // {
            // 'data': 'caja'
            // },
            {
            'data': 'estado'
            },
            {
            'data': 'acciones'
            }


        ]
    } );
    //fin de la tala usuarios
    tblclientes = $('#tblclientes').DataTable( {
        ajax: {
            url: base_url + "Clientes/listar",
            dataSrc: ''
        },
        columns: [
            {'data': 'id'},
            {'data': 'cedula'},
            {'data': 'nombre'},
            {'data': 'apellido'},
            {'data': 'f_nacimiento'},
            {'data': 'edad'},
            {'data': 'correo'},
            {'data': 'ciudad'},
            {'data': 'acciones'},

            
        ]
    } );
    //fin de la tabla clientes
    tblProducto = $('#tblProducto').DataTable( {
        ajax: {
            url: base_url + "Productos/listar",
            dataSrc: ''
        },
        columns: [
            {'data': 'id'},
            {'data': 'codigo'},
            {'data': 'descripcion'},
            {'data': 'precio_venta'},
            {'data': 'cantidad'},
            {'data': 'acciones'}
        ]
    } );

    ///tblhistorial
     historial_C = $('#tblhistorialCompras').DataTable( {
        ajax: {
            url: base_url + "Compras/listar_historial",
            dataSrc: ''
        },
        columns: [
            {'data': 'id'},
            {'data': 'total'},
            {'data': 'fecha'},
            {'data': 'estado'},
            {'data': 'acciones'}
        ]
    } );

    //tabla para los productos mas vendidos
    $('#tblProductosMasVendidos').DataTable( {
        ajax: {
            url: base_url + "ProductosMasVendidos/listarProMas",
            dataSrc: ''
        },
        columns: [
            {'data': 'id_producto'},
            {'data': 'total'},
            {'data': 'descripcion'},
            {'data': 'acciones'}
        ]
    } );



//Tabla con información de los 2 clientes que más productos han comprado,
     //clientes con mas productos comprados
     $('#tblClienteConMasCompras').DataTable( {
        ajax: {
            url: base_url + "ClienteConMasProducto/listarClienteConMas",
            dataSrc: ''
        },
        columns: [
            {'data': 'id'},
            {'data': 'nombre'},
            {'data': 'total'},
            {'data': 'acciones'}
        ]
    } );


})


    function frmLogin(e) {
        e.preventDefault();
        const usuario = document.getElementById("usuario");
        const clave = document.getElementById("clave");
        if (usuario.value == "") {
            clave.classList.remove("is-invalid");
            usuario.classList.add("is-invalid");
            usuario.focus();
        }else if (clave.value == "") {
            usuario.classList.remove("is-invalid");
            clave.classList.add("is-invalid");
            clave.focus();
        }else{
            const url = base_url + "Usuarios/validar";
            const frm = document.getElementById("frmLogin");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState ==4 && this.status == 200) {
                const res = JSON.parse(this.responseText)
                if (res == "ok") {
                    window.location = base_url + "Usuarios"
                }else{
                    document.getElementById("alerta").classList.remove("d-none");
                    document.getElementById("alerta").innerHTML = res;
                }
                }
            }

        }
    }

    function frmusuarios() {
        document.getElementById("title").innerHTML = "Nuevo Usuario"
        document.getElementById("registar").innerHTML = "Registar Usuario"
        document.getElementById("claves").classList.remove("d-none");
        document.getElementById("clav").classList.remove("d-none");
        document.getElementById("frmusuario").reset();
        $("#nuevo_usuario").modal("show");
        document.getElementById("id").value = "";

    }
    function Registraruser(e) {
        e.preventDefault();
        const usuario = document.getElementById("usuario");
        const nombre = document.getElementById("nombre");
        const clave = document.getElementById("clave");
        const confirmar = document.getElementById("confirmar");
        const caja = document.getElementById("caja");
    
        if (usuario.value == "" || nombre.value ==""|| caja.value =="") {
        //vamos a mostrar una alerta
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
        })
        }else{
            const url = base_url + "Usuarios/registrar";
            const frm = document.getElementById("frmusuario");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState ==4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
            if (res=="si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario registardo con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_usuario").modal("hide");
                    tblusuarios.ajax.reload();
                }else if (res =="modificado") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario Modificado con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $("#nuevo_usuario").modal("hide");
                    tblusuarios.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
                }
            }

        }
    }

    function Registraruser(e) {
        e.preventDefault();
        const nombre = document.getElementById("nombre");
        const nombree = document.getElementById("nombre");
        const clave = document.getElementById("clave");
        const confirmar = document.getElementById("confirmar");
        const caja = document.getElementById("caja");
    
        if (usuario.value == "" || nombre.value ==""|| caja.value =="") {
        //vamos a mostrar una alerta
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
        })
        }else{
            const url = base_url + "Usuarios/registrar";
            const frm = document.getElementById("frmusuario");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState ==4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
            if (res=="si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario registardo con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_usuario").modal("hide");
                    tblusuarios.ajax.reload();
                }else if (res =="modificado") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario Modificado con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $("#nuevo_usuario").modal("hide");
                    tblusuarios.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
                }
            }

        }
    }
    //dentro vamos a recuperar el id que capturamos en el formulario
    function editarusuario(id) {
    
    
    //ahora para modificar los datos del usuario necesitamos traer los id de la fila seleccionada
        document.getElementById("title").innerHTML = "Actualizar Usuario" //capturamos el id
        document.getElementById("registar").innerHTML = "Modificar usuario"
        const url = base_url + "Usuarios/editar/"+ id;
    
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState ==4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                //accedemo a los id de los input
                document.getElementById("id").value=res.id;
                document.getElementById("usuario").value = res.usuario;
                document.getElementById("nombre").value = res.nombre;
                document.getElementById("caja").value = res.id_caja;
                document.getElementById("claves").classList.add("d-none");
                document.getElementById("clav").classList.add("d-none");

                $("#nuevo_usuario").modal("show");
            }
        }

    
    }

    function eliminarUsuario(id) {
    
        Swal.fire({
            title: 'Esta seguro de eliminar?',
            text: "El usuario no se eliminara de forma permanente, solo cambiara el estado a inactivo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'si!',
            cancelButtonText: 'no',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("title").innerHTML = "Actualizar Usuario" //capturamos el id
                document.getElementById("registar").innerHTML = "Modificar usuario"
                const url = base_url + "Usuarios/eliminar/"+ id;
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
                http.onreadystatechange = function () {
                    if (this.readyState ==4 && this.status == 200) {    
                        const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'mensaje!',
                            'usuarioi eliminado con exito',
                            'success'
                        )
                        tblusuarios.ajax.reload();
                    }else{
                        Swal.fire(
                            'mensaje!',
                            res,
                            'error'
                        ) 
                    }
                    }
                }
            
            }
        })
    }

    function ReingresarUsuario(id) {
    
        Swal.fire({
            title: 'Esta seguro de reingresar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'si!',
            cancelButtonText: 'no',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("title").innerHTML = "Actualizar Usuario" //capturamos el id
                document.getElementById("registar").innerHTML = "Modificar usuario"
                const url = base_url + "Usuarios/reingresar/"+ id;
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
                http.onreadystatechange = function () {
                    if (this.readyState ==4 && this.status == 200) {    
                        const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'mensaje!',
                            'usuario reingresado con exito',
                            'success'
                        )
                        tblusuarios.ajax.reload();
                    }else{
                        Swal.fire(
                            'mensaje!',
                            res,
                            'error'
                        ) 
                    }
                    }
                }
            
            }
        })
    }

    //fin de las funciones del Usuario



    //aqui inician las funciones para los clientes ojooo

    function frmCliente() {
        document.getElementById("title").innerHTML = "Nuevo Cliente"
        document.getElementById("registar").innerHTML = "Registar Usuario"
        document.getElementById("frmCliente").reset();
        $("#nuevo_cliente").modal("show");
        document.getElementById("id").value = "";

    }

    function Registrarucli(e) {
        e.preventDefault();
        const usuario = document.getElementById("usuario");
        const nombre = document.getElementById("nombre");
        const clave = document.getElementById("clave");
        const confirmar = document.getElementById("confirmar");
        const caja = document.getElementById("caja");
    
        if (usuario.value == "" || nombre.value ==""|| caja.value =="") {
        //vamos a mostrar una alerta
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
        })
        }else{
            const url = base_url + "Usuarios/registrar";
            const frm = document.getElementById("frmusuario");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState ==4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
            if (res=="si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario registardo con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_usuario").modal("hide");
                    tblusuarios.ajax.reload();
                }else if (res =="modificado") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario Modificado con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $("#nuevo_usuario").modal("hide");
                    tblusuarios.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
                }
            }

        }
    }

    

    function RegistrarCliente(e){
       
            e.preventDefault();
            const cedula = document.getElementById("cedula");
            const nombre = document.getElementById("nombre");
            const apellido = document.getElementById("apellido");
            const nacimiento = document.getElementById("nacimiento");
            const edad = document.getElementById("edad");
            const correo = document.getElementById("correo");
   
            const ciudad = document.getElementById("ciudad");

            if (cedula.value ==""||nombre.value == ""|| apellido.value=="" || nacimiento.value=="" || edad.value=="" || correo.value=="" || ciudad.value=="" ) {
        
                correo.addEventListener("input", function (e) {
                    if (correo.validity.typeMismatch) {
                        correo.setCustomValidity("¡Se esperaba una dirección de correo electrónico!");
                    } else {
                        correo.setCustomValidity("");
                    }
                  });        //vamos a mostrar una alerta
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
        })
            }else{
            
            const url = base_url + "Clientes/registrar";
            const frm = document.getElementById("frmCliente");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState ==4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
            if (res=="si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Cliente registardo con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_cliente").modal("hide");
                    tblclientes.ajax.reload();
                }else if (res =="modificado") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Cliente Modificado con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $("#nuevo_cliente").modal("hide");
                    tblclientes.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
                }
            }

        }
    }
    //dentro vamos a recuperar el id que capturamos en el formulario
    function editarCliente(id) {
    
    
        //ahora para modificar los datos del usuario necesitamos traer los id de la fila seleccionada
        document.getElementById("title").innerHTML = "Actualizar cliente" //capturamos el id
        document.getElementById("registar").innerHTML = "Modificar usuario"
        const url = base_url + "Clientes/editar/"+ id;
    
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState ==4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                //accedemo a los id de los input
                document.getElementById("id").value=res.id;
                document.getElementById("cedula").value=res.cedula;
                document.getElementById("nombre").value=res.nombre;;
                document.getElementById("apellido").value=res.apellido;;
                document.getElementById("nacimiento").value=res.f_nacimiento;;
                document.getElementById("edad").value=res.edad;;
                document.getElementById("correo").value=res.correo;;
                document.getElementById("ciudad").value=res.ciudad;;
               
                $("#nuevo_cliente").modal("show");
                

            }
        }

    
    }

    function eliminarCliente(id) {
    
        Swal.fire({
            title: 'Esta seguro de eliminar?',
            text: "El usuario  se eliminara",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'si!',
            cancelButtonText: 'no',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("title").innerHTML = "Actualizar Usuario" //capturamos el id
                document.getElementById("registar").innerHTML = "Modificar usuario"
                const url = base_url + "Clientes/eliminarCliente/"+ id;
                const http = new XMLHttpRequest();
                http.open("DELETE", url, true);
                http.send();
                http.onreadystatechange = function () {
                    if (this.readyState ==4 && this.status == 200) {   
                        console.log(this.responseText); 
                        const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'mensaje!',
                            'Cliente eliminado con exito',
                            'success'
                        )
                        tblclientes.ajax.reload();
                    }else{
                        Swal.fire(
                            'mensaje!',
                            res,
                            'error'
                        ) 
                    }
                    }
                }
            
            }
        })
    }

    function ReingresarCliente(id) {
    
        Swal.fire({
            title: 'Esta seguro de reingresar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'si!',
            cancelButtonText: 'no',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("title").innerHTML = "Actualizar Usuario" //capturamos el id
                document.getElementById("registar").innerHTML = "Modificar usuario"
                const url = base_url + "Clientes/reingresar/"+ id;
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
                http.onreadystatechange = function () {
                    if (this.readyState ==4 && this.status == 200) {    
                        const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'mensaje!',
                            'Cliente reingresado con exito',
                            'success'
                        )
                        tblclientes.ajax.reload();
                    }else{
                        Swal.fire(
                            'mensaje!',
                            res,
                            'error'
                        ) 
                    }
                    }
                }
            
            }
        })
    }
   //fin de las funciones para clientes


    //inicio de las funciones para prodcutos
    function frmProducto() {
        document.getElementById("title").innerHTML = "Nuevo producto"
        document.getElementById("registar").innerHTML = "Registar Producto"
        document.getElementById("frmProducto").reset();
        $("#nuevo_producto").modal("show");
        document.getElementById("id").value = "";

    }
    function RegistrarProducto(e) {
        e.preventDefault();
        const codigo = document.getElementById("codigo");
        const nombre = document.getElementById("nombre");
        const precio = document.getElementById("precio");
        const cantidad = document.getElementById("cantidad");
    
    
        if (codigo.value == "" || nombre.value ==""|| precio.value =="") {
        //vamos a mostrar una alerta
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
        })
        }else{
            const url = base_url + "Productos/registrar";
            const frm = document.getElementById("frmProducto");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState ==4 && this.status == 200) {
                console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
            if (res=="si") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Producto registardo con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_producto").modal("hide");
                    tblProducto.ajax.reload();
                }else if (res =="modificado") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Producto Modificado con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $("#nuevo_producto").modal("hide");
                    tblProducto.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
                }
            }

        }
    }
    //dentro vamos a recuperar el id que capturamos en el formulario
    function editarProducto(id) {
        document.getElementById("title").innerHTML = "Actualizar Producto" //capturamos el id
        document.getElementById("registar").innerHTML = "Modificar Producto"
        const url = base_url + "Productos/editar/"+ id;
    
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState ==4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                //accedemo a los id de los input
                document.getElementById("id").value=res.id;
                document.getElementById("codigo").value = res.codigo;
                document.getElementById("nombre").value = res.descripcion;
                document.getElementById("precio").value = res.precio_venta;
                document.getElementById("cantidad").value = res.cantidad;
                $("#nuevo_producto").modal("show");
            }
        }

    
    }

    function eliminarProducto(id) {
    
        Swal.fire({
            title: 'Esta seguro el producto?',
            text: "El cliente se eliminara",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'si!',
            cancelButtonText: 'no',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("title").innerHTML = "Actualizar Usuario" //capturamos el id
                document.getElementById("registar").innerHTML = "Modificar usuario"
                const url = base_url + "Productos/eliminarPro/"+ id;
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
                http.onreadystatechange = function () {
                    if (this.readyState ==4 && this.status == 200) {    
                        const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire(
                            'mensaje!',
                            'Producto eliminado con exito',
                            'success'
                        )
                        tblProducto.ajax.reload();
                    }else{
                        Swal.fire(
                            'mensaje!',
                            res,
                            'error'
                        ) 
                    }
                    }
                }
            
            }
        })
    }

    // function ReingresarProducto(id) {
    
    //     Swal.fire({
    //         title: 'Esta seguro de reingresar?',
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'si!',
    //         cancelButtonText: 'no',
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             document.getElementById("title").innerHTML = "Actualizar Usuario" //capturamos el id
    //             document.getElementById("registar").innerHTML = "Modificar usuario"
    //             const url = base_url + "Productos/reingresar/"+ id;
    //             const http = new XMLHttpRequest();
    //             http.open("GET", url, true);
    //             http.send();
    //             http.onreadystatechange = function () {
    //                 if (this.readyState ==4 && this.status == 200) {    
    //                     const res = JSON.parse(this.responseText);
    //                 if (res == "ok") {
    //                     Swal.fire(
    //                         'mensaje!',
    //                         'Producto reingresado con exito',
    //                         'success'
    //                     )
    //                     tblProducto.ajax.reload();
    //                 }else{
    //                     Swal.fire(
    //                         'mensaje!',
    //                         res,
    //                         'error'
    //                     ) 
    //                 }
    //                 }
    //             }
            
    //         }
    //     })
    // }

    function buscarCodigo(e) {
        e.preventDefault();
    if (e.which ==13) {
        const codigo= document.getElementById("codigo").value
        const url = base_url + "Compras/buscarCodigo/"+ codigo;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState ==4 && this.status == 200) {  
            
                const res = JSON.parse(this.responseText);
                    if (res) {
                        document.getElementById("nombre").value= res.descripcion
                        document.getElementById("precio").value= res.valor_compra
                        document.getElementById("id").value= res.id
                        document.getElementById("cantidad").focus();
                    
                    }else{
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'el producto no existe',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        document.getElementById("codigo").value= ""
                        document.getElementById("codigo").focus();
                    }
            }
        }
    }
    }

    function calcularPreciocopia(e) {
        e.preventDefault();
        const cantidad = document.getElementById("cantidad").value
        const precio = document.getElementById("precio").value
        document.getElementById("sub_total").value = precio * cantidad
        if (e.which==13) {
            if (cantidad>0) {
                
                const url = base_url + "Ventas/ingresar";
                const frm = document.getElementById("frmCompra");
                const http = new XMLHttpRequest();
                http.open("POST", url, true);
                http.send(new FormData(frm));
                http.onreadystatechange = function () {
                    if (this.readyState ==4 && this.status == 200) {  
                        console.log(this.responseText);
                        const res = JSON.parse(this.responseText);
                        if (res=="ok") {
                            frm.reset();
                            cargarDetalle();
                        }
                        
                    }
                }
            }
        }
    }
    function calcularPrecio(e) {
        e.preventDefault();
        const cantidad = document.getElementById("cantidad").value
        const precio = document.getElementById("precio").value
        document.getElementById("sub_total").value = precio * cantidad
        if (e.which==13) {
            if (cantidad>0) {
                
                const url = base_url + "Compras/ingresar";
                const frm = document.getElementById("frmCompra");
                const http = new XMLHttpRequest();
                http.open("POST", url, true);
                http.send(new FormData(frm));
                http.onreadystatechange = function () {
                    if (this.readyState ==4 && this.status == 200) {  
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            if (res=="ok") {
                frm.reset();
                cargarDetalle();
                }else if(res=="modificado"){}
                frm.reset();
                cargarDetalle();
            }
        }
    }
    }
    }
    if (document.getElementById('tbldetalle')) {
        cargarDetalle();
        
    }
    if (document.getElementById('tbldetalleVenta')) {
        cargarDetalleVenta();
        
    }

    function cargarDetalle() {
        const url = base_url + "Compras/listar/detalle";
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState ==4 && this.status == 200) {  
                const res = JSON.parse(this.responseText);
                let html = '';
                res['detalle'].forEach(row => {
                html +=`<tr>
                <td>${row['id']}</td>
                <td>${row['descripcion']}</td>
                <td>${row['cantidad']}</td>
                <td>${row['precio']}</td>
                <td>${row['sub_total']}</td>
                <td>
                <button  type="button" class="btn btn-danger " onclick="eliminardetalle(${row['id']},1);"><i>Eliminar producto</i></button>
                </td>
                
                </tr>`;
            });
            document.getElementById("tbldetalle").innerHTML=html;
            document.getElementById("total").value=res['sub_total'].total;
                
            }
        }
    }
        
    function eliminardetalle(id,accion) {
            let url;
            if (accion == 1) {
                url = base_url + "Compras/delete/"+id;
                
            } else {
                url = base_url + "Compras/deleteventa/"+id;
            }
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState ==4 && this.status == 200) {  
                    const res = JSON.parse(this.responseText);
                    if (res =="ok") {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Prodcuto eliminado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    
                    cargarDetalle();
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title:'no se pudo eliminar',
                        showConfirmButton: false,
                        timer: 3000
                    })
                
                }
                
            }
        }
    }
        
        
        
    // function eliminardetalle2(id) {
    //         const url = base_url + "Compras/delete/"+id;
    //         const http = new XMLHttpRequest();
    //         http.open("GET", url, true);
    //         http.send();
    //         http.onreadystatechange = function () {
    //             if (this.readyState ==4 && this.status == 200) {  
    //                 const res = JSON.parse(this.responseText);
    //                 if (res =="ok") {
    //                     Swal.fire({
    //                         position: 'top-end',
    //                         icon: 'success',
    //                         title: 'Prodcuto eliminado',
    //                         showConfirmButton: false,
    //                         timer: 1500
    //                     })
                        
    //                     cargarDetalle();
    //                 } else {
    //                     Swal.fire({
    //                     position: 'top-end',
    //                     icon: 'success',
    //                     title:'no se pudo eliminar',
    //                     showConfirmButton: false,
    //                     timer: 3000
    //                 })
                    
    //             }
                
    //         }
    //     }
    //     }
        
    function procesar(accion) {
        
            Swal.fire({
                title: 'Esta seguro de realizar la compra',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'si!',
                cancelButtonText: 'no',
            }).then((result) => {
                if (result.isConfirmed) {
                    // document.getElementById("title").innerHTML = "Actualizar Usuario" //capturamos el id
                // document.getElementById("registar").innerHTML = "Modificar usuario"
                let url;
                if (accion ==1) {
                    const id_cliente = document.getElementById('cliente').value;
                    url = base_url + "Compras/registarCompra/"+ id_cliente;
                    console.log(id_cliente);
                }else{
                    url = base_url + "Compras/registarVenta/"+ id_cliente;
                }
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
                http.onreadystatechange = function () {
                    if (this.readyState ==4 && this.status == 200) { 
                        console.log(this.responseText);
                        const res = JSON.parse(this.responseText);
                        if (res.msg == "ok") {
                            Swal.fire(
                                'mensaje!',
                                'venta generada con exito',
                                'success'
                                )
                                tblProducto.ajax.reload();
                                const ruta = base_url + 'Compras/generarPdf/'+ res.id_compra;
                                window.open(ruta);
                                setTimeout(() => {
                                    window.location.reload()
                                }, 1500);
                            }else{
                                Swal.fire(
                                    'mensaje!',
                                    res,
                                'error'
                                ) 
                            }
                        }
                    }
                    
                }
            })
        }
        
        // Funciones para las ventas
        
        
    function buscarCodigoVenta(e) {
            e.preventDefault();
        if (e.which ==13) {
            const codigo= document.getElementById("codigo").value
            const url = base_url + "Compras/buscarCodigoVenta/"+ codigo;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState ==4 && this.status == 200) {  
                
                    const res = JSON.parse(this.responseText);
                        if (res) {
                            document.getElementById("nombre").value= res.descripcion
                            document.getElementById("precio").value= res.precio_venta
                            document.getElementById("id").value= res.id
                            document.getElementById("cantidad").focus();
                        
                        }else{
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'el producto no existe',
                                showConfirmButton: false,
                                timer: 3000
                            })
                            document.getElementById("codigo").value= ""
                            document.getElementById("codigo").focus();
                        }
                }
            }
        }
        }

    function calcularPrecioVenta(e) {
            e.preventDefault();
            const cantidad = document.getElementById("cantidad").value
            const precio = document.getElementById("precio").value
            document.getElementById("sub_total").value = precio * cantidad
            if (e.which==13) {
                if (cantidad>0) {
                    
                    const url = base_url + "Compras/ingresarVenta";
                    const frm = document.getElementById("frmVenta");
                    const http = new XMLHttpRequest();
                    http.open("POST", url, true);
                    http.send(new FormData(frm));
                    http.onreadystatechange = function () {
                        if (this.readyState ==4 && this.status == 200) {  
                            console.log(this.responseText);
                            const res = JSON.parse(this.responseText);
                            if (res=="ok") {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title:'producto ingresado',
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                                frm.reset();
                                cargarDetalleVenta();
                            }else if(res=="modificado"){
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title:'producto modificado',
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                            }
                    frm.reset();
                    cargarDetalleVenta();
                    }
                }
            }
        }
        }

    function cargarDetalleVenta() {
            const url = base_url + "Compras/listar/detalle_temporal";
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState ==4 && this.status == 200) {  
                    const res = JSON.parse(this.responseText);
                    let html = '';
                    res['detalle'].forEach(row => {
                    html +=`<tr>
                    <td>${row['id']}</td>
                    <td>${row['descripcion']}</td>
                    <td>${row['cantidad']}</td>
                    <td>${row['precio']}</td>
                    <td>${row['sub_total']}</td>
                    <td>
                    <button  type="button" class="btn btn-danger " onclick="eliminardetalle(${row['id']},2);"><i>Eliminar producto</i></button>
                    </td>
                    
                    </tr>`;
                });
                document.getElementById("tbldetalleVenta").innerHTML=html;
                document.getElementById("total").value=res['sub_total'].total;
                    
                }
            }
            }
            reportestock();
            productosmasvendidos()
    function reportestock() {
        
            const url = base_url + "Compras/reporteStock";
            const http = new XMLHttpRequest();
            http.open("POST",url,true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState ==4 && this.status == 200) {
                    let nombre =[];
                    let cantidad = [];
                    
                    const res = JSON.parse(this.responseText);
                    for (let i = 0; i < res.length; i++) {
                        nombre.push(res[i]['descripcion']);
                        cantidad.push(res[i]['cantidad']);
                        
                    }
                    var ctx = document.getElementById("stockMinimo");
                    var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: nombre,
                        datasets: [{
                        data:cantidad,
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    }
                });
                }
            }
        }  

    function productosmasvendidos() {
        
            const url = base_url + "Compras/productosmasvendidos";
            const http = new XMLHttpRequest();
            http.open("POST",url,true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState ==4 && this.status == 200) {
                    let nombre =[];
                    let cantidad = [];
                    
                    const res = JSON.parse(this.responseText);
                    for (let i = 0; i < res.length; i++) {
                        nombre.push(res[i]['descripcion']);
                        cantidad.push(res[i]['total']);
                        
                    }
                    var ctx = document.getElementById("ProductosMasvendidos");
                    var myPieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: nombre,
                        datasets: [{
                        data: cantidad,
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    }
                
                    });
                }
            }
        }  

    function AnularCompra(id) {
        
                Swal.fire({
                    title: 'Esta seguro de anular la compra',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'si!',
                    cancelButtonText: 'no',
                }).then((result) => {
                    if (result.isConfirmed) {
                                
                const url = base_url + "Compras/AnularCompra/"+ id;
                
                    const http = new XMLHttpRequest();
                    http.open("GET", url, true);
                    http.send();
                    http.onreadystatechange = function () {
                        if (this.readyState ==4 && this.status == 200) { 
                            console.log(this.responseText);
                            const res = JSON.parse(this.responseText);
                            historial_C.ajax.reload();
                            if (res.msg == "ok") {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Venta Anulada',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                }else{
                                    Swal.fire(
                                        'mensaje!',
                                        res,
                                    'error'
                                    ) 
                                }
                            }
                        }
                        
                    }
                })
            }
            