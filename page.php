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
	      
	      $hostType = array();
	
	      // Sets sql charset to utf-8
	      $mysqli->set_charset("utf8");
		
	      $result = mysqli_query($mysqli, 'SELECT COUNT(HostType) AS "Num" FROM serverlist GROUP BY HostType;');
         while($row = mysqli_fetch_row($result)){
            // puts the value for COUNT(HostType) into $num{i}, so $num0, $num1, $num2, etc.
            $hostType[$i] = $row[0];
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
         
         /* THE ISSUE IS SOMEWHERE BETWEEN HERE...
         
         // Callback that creates and populates a data table,
         // instantiates the pie chart, passes in the data and
         // draws it.
         function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'hostType');
            data.addColumn('number', 'hostTypeCount');
            data.addRows([
               ['CIT', <?php echo $hostType[0]; ?>],
               ['DEV', <?php echo $hostType[1]; ?>],
               ['DR', <?php echo $hostType[2]; ?>],
               ['OAT', <?php echo $hostType[3]; ?>],
               ['PROD', <?php echo $hostType[4]; ?>],
               ['SIT', <?php echo $hostType[5]; ?>],
               ['UAT', <?php echo $hostType[6]; ?>],
               ['UNCLASSIFIED', <?php echo $hostType[7]; ?>];
            ]);

            // Set chart options
            var options = {'title':'Types of Servers',
                           'width':400,
                           'height':300};

            // Instantiate and draw our chart, passing in some options.
            var pie_chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
            var bar_chart = new google.visualization.BarChart(document.getElementById('bar_chart'));

            pie_chart.draw(data, options);
            bar_chart.draw(data, options);
         }
         
         ...AND HERE */
      </script>
   </head>

   <body>
      <!--Div that will hold the pie chart-->
      <div id="pie_chart" style="display: inline; float: left;"></div>
      <!--Div that will hold the bar chart-->
      <div id="bar_chart" style="display: inline; float: left;"></div>
   </body>
</html>
