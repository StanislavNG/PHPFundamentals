<?php
	//Declare calendar year
	$start_year = 2017;
	$dates_arr = array();	//Array containing all the information needed for calendar print
	for ($m=1; $m<=12; $m++) {
		$month_timestamp = mktime(0,0,0,$m, 1, $start_year);
		$month = date('F', $month_timestamp);
		$dates_arr[$m] = array('month' => $month,'days_in_month' => date('t',$month_timestamp));
		for ($d=1; $d<=date('t',strtotime($dates_arr[$m]['month']));$d++){
			$current_day = mktime(0,0,0,$m, $d, $start_year);
			//Populate day array with the number of the date, the name of the day and whether that day is today. The last one is initialized to false, can change in the upcoming conditional.
			$dates_arr[$m]['dates'][$d] = array(
					'date_num' => $d, 
					'day' => date('D',$current_day), 
					'day_num' => date('N',$current_day),
					'is_today' => false);
			//Check if today is the day!
			if(time()>=$current_day && time()<$current_day+86400){
				$dates_arr[$m]['dates'][$d]['is_today'] = true;
			}
		}
	}

	// echo "<pre>";
	// echo print_r($dates_arr);
	// exit;
	function printCalendar($dates_arr,$year){
		$calendar_html = "<div class='calendar_container'>";
		$calendar_html .= "<h2>". $year . "</h2>";
		
		foreach($dates_arr as $month){
			$calendar_html .= printMonth($month);
		}
		$calendar_html .= "</div>";
		print $calendar_html;
	}

	function printMonth($month_arr){
		$month_string = "<div class='month_container'>";
		$month_string .= "<h3>" . $month_arr['month'] . "</h3>";
		$month_string .= 
"
<table>
	<tr>
		<td>Monday</td>
		<td>Tuesday</td>
		<td>Wednesday</td>
		<td>Thursday</td>
		<td>Friday</td>
		<td>Saturday</td>
		<td>Sunday</td>
	</tr>
";
		$number_of_weeks = ceil($month_arr['days_in_month']/7);
		$start_day = $month_arr['dates'][1]['day_num'];
		$end_day = end($month_arr['dates'])['day_num'];

		exit;
		//ei tuk
		for($week = 1; $week <= $number_of_weeks; $week++){
			$start_day = $end_day = 0;
			if($week==1){
				$start_day = $month_arr['dates'][1]['day_num']; 
				$week_days = array_slice($month_arr,7-$start_day,7);
			}else if($week == $number_of_weeks){
				$end_day = end($month_arr['dates'])['day_num'];
			}else{
				$week_days = array_slice($month_arr,,7)
			}
			printWeek($week_days,$start_day,$end_day);
		}
		$month_string .= "</table></div>";
		return $month_string;
	}

	function printWeek($days_arr){
		$week_html = "<tr>";
		for($day = 1; $day <= 7; $day++){
			$week_html .= "<td>";
			if($day == $days_arr['day_num']){
				$week_html .= $day['date_num'];
			}
			$week_html .= "</td>";
		}
		$week_html .= "</tr>";
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<style>
		.calendar_container h2{
			text-align: center;		
		}

		.month_container{
			float:left;
			width: 25%;
		}

		.month_container h3{
			text-align: center;
		}
	</style>
	<meta charset="UTF-8">
	<title>MyAwesomeCalendar</title>
</head>
<body>
	<?php printCalendar($dates_arr,$start_year); ?>
</body>
</html>