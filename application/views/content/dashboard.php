<script type="text/javascript">
$(function () {
    $('#pie-chart').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Rencana Anggaran Tahun <?php echo date("Y"); ?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Anggaran',
            data: <?php echo $pie; ?>
        }]
    });
	
	$('#area-chart').highcharts({
        chart: {
            type: 'area'
        },
        title: {
            text: 'Serapan Anggaran Tahun <?php echo date("Y"); ?>'
        },
        subtitle: {
            text: 'Data hingga bulan <?php echo date("F"); ?>'
        },
        xAxis: {
            categories: <?php echo $category; ?>,
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: 'Juta'
            },
            labels: {
                formatter: function () {
                    //return this.value / 1000000;
                    return this.value;
                }
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' juta'
        },
        plotOptions: {
            area: {
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: <?php echo $area; ?>
    });
});
</script>
<div class="row">
	<div class="col-md-6">
		<!-- AREA CHART -->
		<div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title"><!-- Pie Chart --></h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		  </div>
		</div>
		<div class="box-body">
		  <div class="chart">
			<div id="pie-chart"></div>
		  </div>
		</div><!-- /.box-body -->
		</div><!-- /.box -->
		</div><!-- /.col (LEFT) -->
		<div class="col-md-6">
              <!-- LINE CHART -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><!-- Area Chart --></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <div id="area-chart"></div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col (RIGHT) -->
</div>
<!-- HighChart -->
    <script src='<?php echo base_url('assets/js/highchart/highcharts.js'); ?>'></script>
    <script src='<?php echo base_url('assets/js/highchart/highcharts-3d.js'); ?>'></script>