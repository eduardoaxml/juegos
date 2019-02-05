<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport"
	content="width=device-width, initial-scale=1, user-scalable=yes">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
</head>
<body>
	<div class="container-fluid" style="margin-top: 100px">
		@yield('content')
	</div>
	<style type="text/css">
		.table {
			border-top: 2px solid #ccc;
		}
	</style>
	<script>
		$(document).ready(function() {
			$('#jugadores').DataTable();
		} );
	</script>
</body>
</html>