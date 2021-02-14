var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	//Cargamos los items al select categoria
	$.post("../ajax/persona.php?op=selectPaciente", function(r){
	            $("#idpersona").html(r);
	            $('#idpersona').selectpicker('refresh');

	});
	/*$.post("../ajax/area_medica.php?op=selectArea_medica", function(r){
		$("#idarea_medica").html(r);
		$('#idarea_medica').selectpicker('refresh');

});*/
	
}

//Función limpiar
function limpiar()
{
	/*$("#").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
	$("#stock").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#print").hide();
	$("#idarticulo").val("");*/
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
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

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/ficha.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/ficha.php?op=guardaryeditar",
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

function mostrar(idficha)
{
	$.post("../ajax/ficha.php?op=mostrar",{idficha : idficha}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idpersona").val(data.idpersona);
		$('#idpersona').selectpicker('refresh');
		$("#idarea_medica").val(data.idarea_medica);
		$('#idarea_medica').selectpicker('refresh');
		$("#nroficha").val(data.nroficha);
		$("#turno").val(data.turno);
		$("#fecha").val(data.fecha);
		$("#tipo_comprobante").val(data.tipo_comprobante);
 		$("#idficha").val(data.idficha);
 		generarbarcode();

 	})
}

//Función para desactivar registros
function desactivar(idficha)
{
	bootbox.confirm("¿Está Seguro de desactivar el ficha?", function(result){
		if(result)
        {
        	$.post("../ajax/ficha.php?op=desactivar", {idficha : idficha}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idficha)
{
	bootbox.confirm("¿Está Seguro de activar el Ficha?", function(result){
		if(result)
        {
        	$.post("../ajax/ficha.php?op=activar", {idficha : idficha}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}



init();