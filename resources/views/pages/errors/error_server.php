<?php
	$exception = $this->view_data;

?>
<div class="container">
	<div class="bg-light p-4">
		<h1 class="text-danger bold">Error 500</h1>
		<p class=" bold">Error del servidor</p>
	</div>
	<?php
		if(DEVELOPMENT_MODE){
	?>
		<div class="">
			<div class="py-4">
				<h3>Rastros de excepciones</h3>
                <small class="text-muted bold">Esto solo se mostrará en el MODO DE DESARROLLO.</small>
			</div>
			<table class="table table-striped table-bordered">
				<tr>
					<th style="width:20%">Mensaje de error</th>
					<td><?php echo $exception->getMessage(); ?></td>
				</tr>
				<tr>
					<th>File</th>
					<td><?php echo $exception->getFile(); ?> <strong>En la línea</strong> <?php echo $exception->getLine(); ?></td>
				</tr>
				<tr>
					<th>Stack Trace</th>
					<td>
						<?php

							$ret = "";
							 $count = 1;
							 foreach ($exception->getTrace() as $trace) {
								 $args = "";
								 if (isset($trace['args'])) {
									 $args = array();
									 foreach ($trace['args'] as $arg) {
										 if (is_string($arg)) {
											 $args[] = "'" . $arg . "'";
										 } elseif (is_array($arg)) {
											 $args[] = "Array";
										 } elseif (is_null($arg)) {
											 $args[] = 'NULL';
										 } elseif (is_bool($arg)) {
											 $args[] = $arg ? "true" : "false";
										 } elseif (is_object($arg)) {
											 $args[] = get_class($arg);
										 } elseif (is_resource($arg)) {
											 $args[] = get_resource_type($arg);
										 } else {
											 $args[] = $arg;
										 }
									 }
									 $args = join(", ", $args);
								 }
								 $ret .= sprintf("%s %s(%s): %s(%s)<hr />", $count, isset($trace['file']) ? $trace['file'] : 'unknown file', isset($trace['line']) ? $trace['line'] : 'unknown line', isset($trace['class']) ? $trace['class'] . $trace['type'] . $trace['function'] : $trace['function'], $args);
								 $count++;
							 }
							 echo $ret;
						?>
					</td>
				</tr>
			</table>
		</div>
	<?php
		}
	?>
	<div class="card card-body my-3">
		<p class="lead bold">Por favor, póngase en contacto con el administrador del sistema</p>

		<div>Tel:  <a href="tel:+233*********" class="bold">+502 *********</a></div>
		<div>Correo electrónico: <a href="mailto:support@<?php echo SITE_NAME ?>.com" class="bold">soporte@misitioweb.com</a></div>
	</div>

	<div class="text-center">
		<a href="<?php print_link(HOME_PAGE); ?>" class="btn btn-primary">Ir a la página de inicio</a>
	</div>
</div>
