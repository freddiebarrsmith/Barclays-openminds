<html>
   <head>
      <!--Connect to the database-->
      <?php
         // Database login details
	      $DB_NAME = 'cl51-openminds';
	      $DB_HOST = 'localhost';
	      $DB_USER = 'cl51-openminds';
	      $DB_PASS = 'hashtag';
	
	      // Connect to database server
	      $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	
	      if ($mysqli->connect_errno) {
		      printf("Connect failed: %s\n", $mysqli->connect_error);
		      exit();
	      }
	      
	      $i = 0;
	      
	      $hostTypes = array();
	
	      // Sets sql charset to utf-8
	      $mysqli->set_charset("utf8");
	      
	      $sql = "SELECT HostType, COUNT(HostType) AS "Num" FROM serverlist GROUP BY HostType";
		
	      $result = mysqli_query($mysqli, "SELECT HostType, COUNT(HostType) AS "Num" FROM serverlist GROUP BY HostType;");  
 
         while($row = mysqli_fetch_row($result)){
            // puts the value for COUNT(HostType) into $num{i}, so $num0, $num1, $num2, etc.
            $hostType[$i] = $row[1];
            $i = $i + 1;
         }
	   ?>
      <!--Load the AJAX API-->
      <script type="text/javascript" src="https://www.google.com/jsapi"></script>
      <script type="text/javascript">
         // Load the Visualization API and the piechart package.
         google.load('visualization', '1.0', {'packages':['corechart']});

         // Set a callback to run when the Google Visualization API is loaded.
         google.setOnLoadCallback(drawChart);

         // Callback that creates and populates a data table,
         // instantiates the pie chart, passes in the data and
         // draws it.
         function drawChart() {

         // Create the data table.
         var data = new google.visualization.DataTable();
         data.addColumn('string', 'hostType');
         data.addColumn('number', 'hostTypeCount');
         data.addRows([
            ['CIT', <?php echo $hostTypes[0]; ?>],
            ['DEV', <?php echo $hostTypes[1]; ?>],
            ['DR', <?php echo $hostTypes[2]; ?>],
            ['OAT', <?php echo $hostTypes[3]; ?>],
            ['PROD', <?php echo $hostTypes[4]; ?>],
            ['SIT', <?php echo $hostTypes[5]; ?>],
            ['UAT', <?php echo $hostTypes[6]; ?>],
            ['UNCLASSIFIED', <?php echo $hostTypes[7]; ?>];
         ]);

         // Set chart options
         var options = {'title':'Distro Proportions Among Servers',
                    'width':400,
                    'height':300};

         // Instantiate and draw our chart, passing in some options.
         var pie_chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
         var bar_chart = new google.visualization.BarChart(document.getElementById('bar_chart'));

         // The select handler. Call the chart's getSelection() method
         function selectHandler() {
            var selectedItem = pie_chart.getSelection()[0];
            if (selectedItem) {
	            var distro = data.getValue(selectedItem.row, 0);
	            alert('The user selected ' + hostType);
            }
         }

         // Listen for the 'select' event, and call my function selectHandler() when
         // the user selects something on the chart.
         google.visualization.events.addListener(pie_chart, 'select', selectHandler);

              pie_chart.draw(data, options);
         bar_chart.draw(data, options);
         }
      </script>
   </head>

   <body>
      <!--Div that will hold the pie chart-->
      <div id="pie_chart" style="display: inline; float: left;"></div>
      <!--Div that will hold the bar chart-->
      <div id="bar_chart" style="display: inline; float: left;"></div>
      <!--Div that will hold the Sankey chart-->
      <div id="Sankey_chart" style="display: inline; float: left;"></div>
   </body>
</html>
