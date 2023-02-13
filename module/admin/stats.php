<?php 
Head('Чат');
?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php AdminMenu();
MessageShow() 
?>
<div class="Page">

<?php
$Metrica = json_decode(file_get_contents('https://api-metrika.yandex.ru/stat/traffic/summary.json?id='.YANDEX_ID.'&oauth_token='.YANDEX_TOKEN.'&date1='.date('Ymd', strtotime('-4 days')).'&date2='.date('Ymd')));
for($i = 3; $i >= 0; $i--) {
$Visits .= $Metrica->data[$i]->visits.',';
$PageViews .= $Metrica->data[$i]->page_views.',';
$Visitors .= $Metrica->data[$i]->visitors.',';
}

?>

<script src="/resource/Chart.js"></script>

<div>
<canvas id="canvas" height="436" width="950"></canvas>
</div>

<script>
		var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
		var lineChartData = {
			labels : [<?php echo '"'.date('d.m').'", "'.date('d.m', strtotime('-1 days')).'", "'.date('d.m', strtotime('-2 days')).'", "'.date('d.m', strtotime('-3 days')).'"'?>],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [<?php echo substr($Visits, 0, -1) ?>]
				},
				{
					label: "My Second dataset",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [<?php echo substr($PageViews, 0, -1) ?>]
				},
				
					{
					label: "My Second dataset",
					fillColor : "rgba(176,92,145,0.2)",
					strokeColor : "rgba(176,92,145,1)",
					pointColor : "rgba(176,92,145,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(176,92,145,1)",
					data : [<?php echo substr($Visitors, 0, -1) ?>]
				}
			
			
			
			
			]

		}

		

	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
	}

</script>
	
	
	
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>