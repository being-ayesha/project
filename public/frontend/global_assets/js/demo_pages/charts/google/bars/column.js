/* ------------------------------------------------------------------------------
 *
 *  # Google Visualization - columns
 *
 *  Google Visualization column chart demonstration
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var GoogleColumnBasic = function() {


    //
    // Setup module components
    //

    // Column chart
    var _googleColumnBasic = function() {
        if (typeof google == 'undefined') {
            console.warn('Warning - Google Charts library is not loaded.');
            return;
        }


        // Initialize chart
        google.charts.load('current', {
            callback: function () {

                // Draw chart
                if(checkData()==true){
                drawColumn();
                }

                // Resize on sidebar width change
                $(document).on('click', '.sidebar-control', drawColumn);

                // Resize on window resize
                var resizeColumn;
                $(window).on('resize', function() {
                    clearTimeout(resizeColumn);
                    resizeColumn = setTimeout(function () {
                        drawColumn();
                    }, 200);
                });
            },
            packages: ['corechart']
        });

        function checkData(){
            if(document.getElementById('google-column-value').value!=''){
                return true;
            }else{
                
                return false;
            }
        }

        // Chart settings
        function drawColumn() {

            // Define charts element
            var line_chart_element = document.getElementById('google-column');
            var line_chart_element_values = document.getElementById('google-column-value').value;
            // Data
            
            var data = google.visualization.arrayToDataTable( $.parseJSON(line_chart_element_values)); 
            // Options
            var options_column = {
                fontName: 'Roboto',
                height: 300,
                fontSize: 12,
                chartArea: {
                    left: '5%',
                    width: '94%',
                    height: 250
                },
                tooltip: {
                    textStyle: {
                        fontName: 'Roboto',
                        fontSize: 13
                    }
                },
                vAxis: {
                    title: 'Sales',
                    titleTextStyle: {
                        fontSize: 13,
                        italic: false
                    },
                    gridlines:{
                        color: '#e5e5e5',
                        count: 10
                    },
                    minValue: 0
                },
                legend: {
                    position: 'top',
                    alignment: 'center',
                    textStyle: {
                        fontSize: 12
                    }
                }
            };

            // Draw chart
            var column = new google.visualization.ColumnChart(line_chart_element);
            column.draw(data, options_column);
        }
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _googleColumnBasic();
        }
    }
}();


// Initialize module
// ------------------------------

GoogleColumnBasic.init();
