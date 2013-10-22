<?php
        echo getEvents('schedule');

        function getEvents($table_name) {
            
            $config=parse_ini_file("config.ini.php");
            $connector = mysqli_connect($config['host'], 
                    $config['user'], 
                    $config['password'], 
                    $config['schema']);
            
            if (mysqli_connect_errno($connector)) {
                    die( mysqli_connect_error());
            }
            $sql = "SELECT employee, position, start, end FROM " . $table_name;
            $result = mysqli_query($connector, $sql);
            $data = array();
            while ($row = mysqli_fetch_array($result)) {
                $php_date_start=  strtotime($row['start']);
                $php_date_end=  strtotime($row['end']);
                $start_array=getdate($php_date_start);
                $end_array=getdate($php_date_end);
                $event = array('title' => $row['employee'].
                    ' - '.$row['position'].
                    ' '.convertHoursTo12($start_array['hours']).
                    '-'.convertHoursTo12($end_array['hours']),
                    'start' => $row['start'],
                    'end' => $row['end']);
                $data[] = $event;
            }
            return json_encode($data);
        }
        
        function convertHoursTo12($hour)
        {
            if($hour>12)
            {
                return ($hour-12).' p.m.';
            }
            return ($hour).' a.m.';
        }
?>
