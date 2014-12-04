				<?php
			$result = mysqli_query($conn, "SELECT concat(courseworkTitle, deadline) AS titledeadline, courseworkID  FROM Coursework;");
			?> 
				<?php
				while ($row = mysqli_fetch_array($result)) {
					echo $row;
					$row['whatyouwantintherow'] . $row['anotherfieldthing'];
				}
				
				?>
