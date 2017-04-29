<html>
	<head>
		<script src="../js/jquery.js"></script>
		<script>

			function imprimir(){
				$('html head').html('<link rel=alternate media=print href="documento.php?mensaje=holaMundoDeProgramadores">');
				print();
			}

		</script>
	</head>
	<body>
		<iframe src="documento.php?mensaje=hola" onload="window.print()">Imprimir</iframe>
	</body>
</html>