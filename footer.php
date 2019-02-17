	<div class="row mx-0">
		<footer class="col footer text-center py-2">
			<p class="text-muted">2018 &copy; fullWallet.pl</p>	
		</footer>	
	</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<?php
	if(!empty($_SESSION['expenses']) && isset($_SESSION['balance'])) {
		require_once('set_chart.php');
	}
?>

<script type="text/javascript" src="personalBudget.js"></script>