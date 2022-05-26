var tabla;//variable global

//Función que se ejecuta al inicio
function init()
{
	mostrarform(false);//occulta el formulario
	listar();//lista 
//al oprimir el boton del formulario
	$("#formEmpleado").on("submit",function(e)//e = variable que contiene el objeto
	{
		guardar(e);//guarda o edita el articulo
	})

    $("#sexoM").on("click",function(e)//e = variable que contiene el objeto
	{
		$("#sexoF").prop('checked', false)
	})

    $("#sexoF").on("click",function(e)//e = variable que contiene el objeto
	{
		$("#sexoM").prop('checked', false)
	})

    $("#rol1").on("click",function(e)//e = variable que contiene el objeto
	{
		$("#rol2").prop('checked', false)
		$("#rol3").prop('checked', false)
	})

    $("#rol2").on("click",function(e)//e = variable que contiene el objeto
	{
		$("#rol1").prop('checked', false)
		$("#rol3").prop('checked', false)
	})

    $("#rol3").on("click",function(e)//e = variable que contiene el objeto
	{
		$("#rol2").prop('checked', false)
		$("#rol1").prop('checked', false)
	})

}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();//limpia el formulario
	if (flag)
	{//partes de la pagina que se muestran o se ocultan
        $.post("../PruebaTecnica/Control/AreasControl.php?op=select", function (r) {
            //console.log(r)
            $("#area").html(r);
            $('#area').selectpicker('refresh');
        });
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{	$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}


//Función limpiar, pone el formulario en blanco
function limpiar()
{
	$("#id").val("");
	$("#nombre").val("");
	$("#email").val("");
	$("#sexo").val("");
	$("#area_id").val("");
	$("#boletin").val("");
	$("#descripcion").val("");
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(//Carga variable con datos datatable
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    "ajax"://metodo ajax
				{
					url: '../PruebaTecnica/Control/EmpleadoControl.php?op=listar',//pagina que realiza la operación
					type : "get",//tipo de envio de datos
					dataType : "json",//tipo de datos
					error: function(e){//si error muestra mensaje
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

//Función para guardar o editar

function guardar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formEstacion")[0]);
	$.ajax({
		url: "../Control/EmpleadoControl.php?op=guardar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,
	    success: function(datos)
	    {
          	bootbox.alert(datos);
          	mostrarform(false);
          	tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(id)
{
	$.post("../Control/EmpleadoControl.php?op=mostrar",{id : id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#id").val(data.id);
		$("#nombre").val(data.nombre);
		$("#email").val(data.email);
		$("#sexo").val(data.sexo);
		$("#area_id").val(data.area_id);
        $("#boletin").val(data.boletin);
        $("#descripcion").val(data.descrpcion);
 	})
}

//Función para desactivar registros
function borrar(id)
{
	bootbox.confirm("¿Está Seguro de borrar el empleado?", function(result){
		if(result)
        {
        	$.post("../Control/EmpleadoControl.php?op=borrar", {id : id}, function(e)
        	{
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

init();//ejecuta la función init