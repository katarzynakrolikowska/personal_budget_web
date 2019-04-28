<script type="text/javascript">
	
	$(document).ready(function () {
		var pieChart = $('#chartPieContainer');
		
		var myPieChart = new Chart(pieChart, {
			type: 'pie',
			data: {
				labels: <?php echo json_encode($portal -> getLabelsOfExpensesChart(), JSON_NUMERIC_CHECK); ?>,
				datasets: [{
					data: <?php echo json_encode($portal -> getDataOfExpensesChart(), JSON_NUMERIC_CHECK); ?>
				}]
			},
			options: {
				plugins: {
					colorschemes: {
						scheme: 'tableau.ClassicBlueRed12'
					}
				},
				maintainAspectRatio: false,
				tooltips: {
					callbacks: {
						label: function(tooltipItem, data) {
							return data.labels[tooltipItem.index];
						}
					}
				}
			}
		});
	});
</script>