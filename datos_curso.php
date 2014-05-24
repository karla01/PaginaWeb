<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
	<body>
		<div class="container">
			<div class="row-fluid">
	            <div class="span12">
	                <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	                    <div class="navbar-inner">
	                        <div class="container">
	                            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	                                <span class="icon-bar"></span>
	                                <span class="icon-bar"></span>
	                                <span class="icon-bar"></span>
	                            </button>
	                            <div class="nav-collapse">
	                                <ul class="nav pull-right">
	                                    <li class="divider-vertical"></li>
	                                    <li class="active"><a href="">Employee</a></li>
	                                    <li class="divider-vertical"></li>
	                                    <li><a href="time.php">Time Tracking</a></li>
	                                    <li class="divider-vertical"></li>
	                                    <li><a href="./include/logout.php">Log Out</a></li>
	                                    <li class="divider-vertical"></li>
	                                </ul>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <br><br>
			<div class="row-fluid">
				<div class="span12 well">
					<h2 class="text-center text-info" >Registro de Capacitación</h2>
				</div>
			</div>
			<br>
			<!-- Registro del curso-->
			<div class="row-fluid">
				<div class="span12">
					<h5 class="text-info">Registro de Curso</h5>
					<hr>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="span4">
						N° Ctrl.&nbsp;&nbsp;
						<input type="text" name="control" id="control" placeholder="N° Ctrl." required="required">
					</div>
					<div class="span8">
						Nombre Curso/PNO/ATR:&nbsp;&nbsp;
						<input type="text" placeholder="PNO" name="pno" id="pno" required="required">
						<button class="btn btn-primary fa fa-search" id="buscar"></button>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="span8">
						Nombre:&nbsp;&nbsp;
						<input type="text" class="span6" name="nombre" id="nombre" placeholder="Nombre curso" required="required">
					</div>
					<div class="span4">
						Versión:&nbsp;&nbsp;
						<input type="text" placeholder="version" id="version" name="version" required="required">
					</div>
				</div>
			</div>
			<!-- Datos del agente -->
			<div class="row-fluid">
				<div class="span12">
					<h5 class="text-info">Datos del Agente Capacitador</h5>
						<hr>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="span3">
						<select name="tipo" id="tipo" required="required">
							<option value="-1">Tipo Capacitador</option>
							<option value="0">Interno</option>
							<option value="1">Externo</option>
						</select>
					</div>
					<div class="span3">
						<input type="text" id="reg" name="reg" placeholder="No.Registro" onkeypress="validarNumeros();">&nbsp;
						<button class="btn fa fa-search" id="busca_reg" name="busca_reg"></button>
					</div>
					<div class="span3">
						<input type="text" placeholder="Nombre" maxlenght="50" name="nombre_capa" id="nombre_capa" required="required">
					</div>
					<div class="span3">
						<input type="email" placeholder="Compañia" name="compania" id="compania" required="required">
					</div>
				</div>
			</div>
		</div> <!-- Fin del contenedor -->

		<div class="row-fluid">
        <div class="span12">
            <div class="modal hide fade" id="generar">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h3>Generar N° Control</h3>
                </div>
                <div class="modal-body">
                    <div class="span12 text-center" id="mensaje">
                        <select class="span2" name="inicial" id="inicial">
                        	<option value="">Inicial</option>
                        	<option value="D">D</option>
                        	<option value="P">P</option>
                        	<option value="Q">Q</option>
                        </select>
                        <select name="anio" class="span2" id="anio">
                        	<option value="">Año</option>
                        </select>
                        <select name="mes" class="span2" id="mes">
                        	<option value="">Mes</option>
                        	<option value="01">01</option>
                        	<option value="02">02</option>
                        	<option value="03">03</option>
                        	<option value="04">04</option>
                        	<option value="05">05</option>
                        	<option value="06">06</option>
                        	<option value="07">07</option>
                        	<option value="08">08</option>
                        	<option value="09">09</option>
                        	<option value="10">10</option>
                        	<option value="11">11</option>
                        	<option value="12">12</option>
                        </select>
                        <button class="btn btn-danger fa fa-eraser" type="button" id="limpiar"> Limpiar</button>
                        <button class="btn btn-success fa fa-eraser" type="button" id="guardar"> Guardar</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="close" type="button" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
	</body>
	<script src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#nombre_capa').attr('readonly', true);
			$('#compania').attr('readonly', true);
			$('#busca_reg').attr('disabled', true);
			$('#reg').attr('readonly', true);

			$('#control').focus(function(event) {
				$('#generar').modal('show');
			});

			// Cargar años
			var opciones = "",
				anio = 14,
				limite = anio + 30;

			for (var i = anio; i <= limite; i++) {
				opciones += '<option value="'+i+'">'+i+'</option>';
			}
			$('#anio').append(opciones);

			// Desactivar campos
			$('#tipo').on('change', function() {
				event.preventDefault();
				var tipo = $(this).val();
				if (tipo==0) {
					$('#nombre_capa').attr('readonly', true);
					$('#compania').attr('readonly', true);
					$('#busca_reg').removeAttr('disabled');
					$('#reg').removeAttr('disabled');
					$('#reg').removeAttr('readonly');
				}
				else if(tipo==1){
					$('#busca_reg').attr('disabled', true);
					$('#reg').attr('readonly', true);
					$('#nombre_capa').removeAttr('readonly');
					$('#compania').removeAttr('readonly');
				}else if(tipo==-1){
					$('#nombre_capa').attr('readonly', true);
					$('#compania').attr('readonly', true);
					$('#busca_reg').attr('disabled', true);
					$('#reg').attr('readonly', true);
					$('#nombre_capa').val('');
					$('#compania').val('');
					$('#reg').val('');
				}
			});

			// Buscar registro
			$('#busca_reg').on('click', function(event) {
				event.preventDefault();
				var num_reg = $('#reg').val(),
					operacion = 'buscar_reg';
				$.ajax({
					url: '/path/to/file',
					type: 'POST',
					dataType: 'json',
					data: {num_reg:num_reg, operacion:operacion},
					success: function(data){
						$.each(data, function(index, val) {
							$('#nombre_capa').val(val[0]);
							$('#compania').val(val[1]);
						});
					},
					error: function(data){
						console.log('Error en la consulta');
					}
				});
			});
		});
		
		// Validar números
		function validarNumeros(e) {
			
		}
	</script>
</html>