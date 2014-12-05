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
	      
	      // Sets sql charset to utf-8
	      $mysqli->set_charset("utf8");
	      
	      // Pie: HostType
	      // Bar: CPUs
	      // Pie: OS
	      
	      $i = 0;
	      
	      $hostType = array();
		
	      $result = mysqli_query($mysqli, 'SELECT COUNT(HostType) AS "Num" FROM serverlist GROUP BY HostType;');
         while($row = mysqli_fetch_row($result)){
            // puts the value for COUNT(HostType) into $num{i}, so $num0, $num1, $num2, etc.
            $hostType[$i] = $row[0];
            $i = $i + 1;
         }
         
         $i = 0;
	      
	      $CPUamout = array();
		
	      $result = mysqli_query($mysqli, 'SELECT COUNT(CPUamount) AS "Num" FROM serverlist GROUP BY CPUamount;');
         while($row = mysqli_fetch_row($result)){
            $CPUamount[$i] = $row[0];
            $i = $i + 1;
         }
         
         $i = 0;
	      
	      $OS = array();
		
	      $result = mysqli_query($mysqli, 'SELECT COUNT(OS) AS "Num" FROM serverlist GROUP BY OS;');
         while($row = mysqli_fetch_row($result)){
            $OS[$i] = $row[0];
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
            var hostTypeData = new google.visualization.DataTable();
            hostTypeData.addColumn('string', 'hostType');
            hostTypeData.addColumn('number', 'hostTypeCount');
            hostTypeData.addRows([
               ['CIT', <?php echo $hostType[0]; ?>],
               ['DEV', <?php echo $hostType[1]; ?>],
               ['DR', <?php echo $hostType[2]; ?>],
               ['OAT', <?php echo $hostType[3]; ?>],
               ['PROD', <?php echo $hostType[4]; ?>],
               ['SIT', <?php echo $hostType[5]; ?>],
               ['UAT', <?php echo $hostType[6]; ?>],
               ['UNCLASSIFIED', <?php echo $hostType[7]; ?>]
            ]); 
            var CPUamountData = new google.visualization.DataTable();
            CPUamountData.addColumn('string', 'coreNum');
            CPUamountData.addColumn('number', 'coreNumNum');
            CPUamountData.addRows([
               ['1', <?php echo $CPUamount[0]; ?>],
               ['2', <?php echo $CPUamount[1]; ?>],
               ['4', <?php echo $CPUamount[2]; ?>],
               ['8', <?php echo $CPUamount[3]; ?>],
               ['10', <?php echo $CPUamount[4]; ?>],
               ['12', <?php echo $CPUamount[5]; ?>],
               ['13', <?php echo $CPUamount[6]; ?>],
               ['15', <?php echo $CPUamount[7]; ?>],
               ['16', <?php echo $CPUamount[8]; ?>],
               ['24', <?php echo $CPUamount[9]; ?>],
               ['32', <?php echo $CPUamount[10]; ?>],
               ['34', <?php echo $CPUamount[11]; ?>],
               ['40', <?php echo $CPUamount[12]; ?>],
               ['54', <?php echo $CPUamount[13]; ?>],
               ['63', <?php echo $CPUamount[14]; ?>],
               ['64', <?php echo $CPUamount[15]; ?>],
               ['80', <?php echo $CPUamount[16]; ?>]
            ]);
            var OSData = new google.visualization.DataTable();
            OSData.addColumn('string', 'OS');
            OSData.addColumn('number', 'OSCount');
            OSData.addRows([
               ['AIX', <?php echo $OS[0]; ?>],
               ['Linux', <?php echo $OS[1]; ?>],
               ['Windows', <?php echo $OS[2]; ?>]
            ]);
            
            // Set chart options
            var hostTypeOptions = {'title':'Types of Servers',
                           'width':400,
                           'height':300};
            var CPUsOptions = {'title':'Number of Cores',
                           'width':500,
                           'height':300};
            var OSOptions = {'title':'OS',
                           'width':400,
                           'height':300};
                           
            // Instantiate and draw our chart, passing in some options.
            var pie_chart1 = new google.visualization.PieChart(document.getElementById('pie_chart1'));
            // Instantiate and draw our chart, passing in some options.
            var bar_chart = new google.visualization.BarChart(document.getElementById('bar_chart')); 
            // Instantiate and draw our chart, passing in some options.
            var pie_chart2 = new google.visualization.PieChart(document.getElementById('pie_chart2'));
            
            /*
            // The select handler. Call the chart's getSelection() method
            function selectHandler() {
               var selectedItem = pie_chart.getSelection()[0];
               if (selectedItem) {e
                  var hostType = data.getValue(selectedItem.row, 1);
                  var hostTypeNum = data.getValue(selectedItem.row, 0);
                  alert('There are ' + hostType + ' machines running as ' + hostTypeNum);
               }
            }
            // Listen for the 'select' event, and call my function selectHandler() when
            // the user selects something on the chart.
            google.visualization.events.addListener(pie_chart, 'select', selectHandler);
            */
            
            pie_chart1.draw(hostTypeData, hostTypeOptions);
            bar_chart.draw(CPUamountData, CPUsOptions);
            pie_chart2.draw(OSData, OSOptions);
         }
      </script>
   </head>

   <body>
      <!--Div that will hold the pie chart-->
      <div id="pie_chart1" style="display: inline; float: left;"></div>
      <!--Div that will hold the bar chart-->
      <div id="bar_chart" style="display: inline; float: left;"></div>
      <!--Div that will hold the pie chart-->
      <div id="pie_chart2" style="display: inline; float: left;"></div>
   </body>
</html>
