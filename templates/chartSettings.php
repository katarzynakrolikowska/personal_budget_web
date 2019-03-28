<script type="text/javascript">
	
	$(document).ready(function () {
		var chart = new CanvasJS.Chart("chartPieContainer", {
			legend:{
				
				fontSize: 13
				
			},
			animationEnabled: true,
			
			data: [{
				type: "pie",
				showInLegend: true,
				legendText: "{label} {y}",
				startAngle: 300,
				yValueFormatString: "##0.##\"%\"",
				indexLabel: "{label} {y}",
				toolTipContent: "{label}",
				indexLabelFontSize: 15,
				
				indexLabelWrap: false,
				dataPoints: <?php echo json_encode($portal -> getDataPointsForExpensesChart(), JSON_NUMERIC_CHECK); ?>
			}]
			
		});

		chart.render();
   });

	
</script>