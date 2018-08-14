		<script src="../js/materialize.min.js" type="text/javascript"></script>
		<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
		<script src="../js/jquery.jCombo.min.js" type="text/javascript"></script>
		
		<script src="../js/lugares.js" type="text/javascript"></script>
		
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				var elems = document.querySelectorAll('select');
				var instances = M.FormSelect.init(elems, {});
			});

			document.addEventListener('DOMContentLoaded', function() {
				var elems = document.querySelectorAll('.datepicker');
				var options = {format: 'dd/mm/yyyy'};
				var instances = M.Datepicker.init(elems, options);
			});

		</script>
	</body>
</html>
	