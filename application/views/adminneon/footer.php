
            <!-- Footer -->
            <footer class="main">

                &copy; 2015 <strong>Neon</strong> Admin Theme by <a href="http://laborator.co" target="_blank">Laborator</a>

            </footer>
        </div>


    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/rickshaw/rickshaw.min.css">

    <!-- Bottom scripts (common) -->
    <script src="<?php echo base_url(); ?>assets/js/gsap/TweenMax.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/joinable.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/resizeable.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/neon-api.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>


    <!-- Imported scripts on this page -->
    <script src="<?php echo base_url(); ?>assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/rickshaw/vendor/d3.v3.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/rickshaw/rickshaw.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/raphael-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/neon-chat.js"></script>


    <!-- JavaScripts initializations and stuff -->
    <script src="<?php echo base_url(); ?>assets/js/neon-custom.js"></script>


    <!-- Demo Settings -->
    <script src="<?php echo base_url(); ?>assets/js/neon-demo.js"></script>
     <script type="text/javascript">
                jQuery(document).ready(function ($)
                {
                    // Sample Toastr Notification
                    setTimeout(function ()
                    {
                        var opts = {
                            "closeButton": true,
                            "debug": false,
                            "positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-top-left" : "toast-top-right",
                            "toastClass": "black",
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };

                        toastr.success("You have been awarded with 1 year free subscription. Enjoy it!", "Account Subcription Updated", opts);
                    }, 3000);


                    // Sparkline Charts
                    $('.inlinebar').sparkline('html', {type: 'bar', barColor: '#ff6264'});
                    $('.inlinebar-2').sparkline('html', {type: 'bar', barColor: '#445982'});
                    $('.inlinebar-3').sparkline('html', {type: 'bar', barColor: '#00b19d'});
                    $('.bar').sparkline([[1, 4], [2, 3], [3, 2], [4, 1]], {type: 'bar'});
                    $('.pie').sparkline('html', {type: 'pie', borderWidth: 0, sliceColors: ['#3d4554', '#ee4749', '#00b19d']});
                    $('.linechart').sparkline();
                    $('.pageviews').sparkline('html', {type: 'bar', height: '30px', barColor: '#ff6264'});
                    $('.uniquevisitors').sparkline('html', {type: 'bar', height: '30px', barColor: '#00b19d'});


                    $(".monthly-sales").sparkline([1, 2, 3, 5, 6, 7, 2, 3, 3, 4, 3, 5, 7, 2, 4, 3, 5, 4, 5, 6, 3, 2], {
                        type: 'bar',
                        barColor: '#485671',
                        height: '80px',
                        barWidth: 10,
                        barSpacing: 2
                    });


                    // JVector Maps
                    var map = $("#map");

                    map.vectorMap({
                        map: 'europe_merc_en',
                        zoomMin: '3',
                        backgroundColor: '#383f47',
                        focusOn: {x: 0.5, y: 0.8, scale: 3}
                    });



                    // Line Charts
                    var line_chart_demo = $("#line-chart-demo");

                    var line_chart = Morris.Line({
                        element: 'line-chart-demo',
                        data: [
                            {y: '2006', a: 100, b: 90},
                            {y: '2007', a: 75, b: 65},
                            {y: '2008', a: 50, b: 40},
                            {y: '2009', a: 75, b: 65},
                            {y: '2010', a: 50, b: 40},
                            {y: '2011', a: 75, b: 65},
                            {y: '2012', a: 100, b: 90}
                        ],
                        xkey: 'y',
                        ykeys: ['a', 'b'],
                        labels: ['October 2013', 'November 2013'],
                        redraw: true
                    });

                    line_chart_demo.parent().attr('style', '');

                    var donut_chart_demo = $("#donut-chart-demo");

                    donut_chart_demo.parent().show();

                    var donut_chart = Morris.Donut({
                        element: 'donut-chart-demo',
                        data: [
                            {label: "Download Sales", value: getRandomInt(10, 50)},
                            {label: "In-Store Sales", value: getRandomInt(10, 50)},
                            {label: "Mail-Order Sales", value: getRandomInt(10, 50)}
                        ],
                        colors: ['#707f9b', '#455064', '#242d3c']
                    });

                    donut_chart_demo.parent().attr('style', '');


                    // Area Chart
                    var area_chart_demo = $("#area-chart-demo");

                    area_chart_demo.parent().show();

                    var area_chart = Morris.Area({
                        element: 'area-chart-demo',
                        data: [
                            {y: '2006', a: 100, b: 90},
                            {y: '2007', a: 75, b: 65},
                            {y: '2008', a: 50, b: 40},
                            {y: '2009', a: 75, b: 65},
                            {y: '2010', a: 50, b: 40},
                            {y: '2011', a: 75, b: 65},
                            {y: '2012', a: 100, b: 90}
                        ],
                        xkey: 'y',
                        ykeys: ['a', 'b'],
                        labels: ['Series A', 'Series B'],
                        lineColors: ['#303641', '#576277']
                    });

                    area_chart_demo.parent().attr('style', '');

                    // Rickshaw
                    var seriesData = [[], []];

                    var random = new Rickshaw.Fixtures.RandomData(50);

                    for (var i = 0; i < 50; i++)
                    {
                        random.addData(seriesData);
                    }

                    var graph = new Rickshaw.Graph({
                        element: document.getElementById("rickshaw-chart-demo"),
                        height: 193,
                        renderer: 'area',
                        stroke: false,
                        preserve: true,
                        series: [{
                                color: '#73c8ff',
                                data: seriesData[0],
                                name: 'Upload'
                            }, {
                                color: '#e0f2ff',
                                data: seriesData[1],
                                name: 'Download'
                            }
                        ]
                    });

                    graph.render();

                    var hoverDetail = new Rickshaw.Graph.HoverDetail({
                        graph: graph,
                        xFormatter: function (x) {
                            return new Date(x * 1000).toString();
                        }
                    });

                    var legend = new Rickshaw.Graph.Legend({
                        graph: graph,
                        element: document.getElementById('rickshaw-legend')
                    });

                    var highlighter = new Rickshaw.Graph.Behavior.Series.Highlight({
                        graph: graph,
                        legend: legend
                    });

                    setInterval(function () {
                        random.removeData(seriesData);
                        random.addData(seriesData);
                        graph.update();

                    }, 500);
                });


                function getRandomInt(min, max)
                {
                    return Math.floor(Math.random() * (max - min + 1)) + min;
                }
            </script>
            
            <script type="text/javascript">
                // Code used to add Todo Tasks
                jQuery(document).ready(function ($)
                {
                    var $todo_tasks = $("#todo_tasks");

                    $todo_tasks.find('input[type="text"]').on('keydown', function (ev)
                    {
                        if (ev.keyCode == 13)
                        {
                            ev.preventDefault();

                            if ($.trim($(this).val()).length)
                            {
                                var $todo_entry = $('<li><div class="checkbox checkbox-replace color-white"><input type="checkbox" /><label>' + $(this).val() + '</label></div></li>');
                                $(this).val('');

                                $todo_entry.appendTo($todo_tasks.find('.todo-list'));
                                $todo_entry.hide().slideDown('fast');
                                replaceCheckboxes();
                            }
                        }
                    });
                });
            </script>
            	<script type="text/javascript">
		jQuery( window ).load( function() {
			var $table2 = jQuery( "#table-2" );
			
			// Initialize DataTable
			$table2.DataTable( {
				"sDom": "tip",
				"bStateSave": false,
				"iDisplayLength": 8,
				"aoColumns": [
					{ "bSortable": false },
					null,
					null,
					null,
					null
				],
				"bStateSave": true
			});
			
			// Highlighted rows
			$table2.find( "tbody input[type=checkbox]" ).each(function(i, el) {
				var $this = $(el),
					$p = $this.closest('tr');
				
				$( el ).on( 'change', function() {
					var is_checked = $this.is(':checked');
					
					$p[is_checked ? 'addClass' : 'removeClass']( 'highlight' );
				} );
			} );
			
			// Replace Checboxes
			$table2.find( ".pagination a" ).click( function( ev ) {
				replaceCheckboxes();
			} );
		} );
			
		// Sample Function to add new row
		var giCount = 1;
		
		function fnClickAddRow() {
			jQuery('#table-2').dataTable().fnAddData( [ '<div class="checkbox checkbox-replace"><input type="checkbox" /></div>', giCount + ".1", giCount + ".2", giCount + ".3", giCount + ".4" ] );
			replaceCheckboxes(); // because there is checkbox, replace it
			giCount++;
		}
		</script>


