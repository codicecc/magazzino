<div class="jumbotron">
	<h1>Benvenuto <?php echo $current_user->username ?>!</h1>
	<p>Questa è la nuova piattaforma a te dedicata</p>
	
	<p>
	<a class="btn btn-info btn-lg" href="/admin/quantities">Consulta le quantità disponibli on line</a>
	</p>
		<p>
			<a class="btn btn-primary btn-lg" href="/admin/quantities/getcsv/2">Scarica il file CSV - Prodotto Finito</a>
		</p>
		<p>
			<a class="btn btn-primary btn-lg" href="/admin/quantities/getcsv/1">Scarica il file CSV - Carcasse</a>
		</p>
</div>
