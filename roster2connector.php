<?php

// Create connection
$error = "";
$connector = "";

if (!connect( $_POST['user'], $_POST['password'])) {
    die($error);
}
echo "Connected.... Purging ....";
if (!purge("schedule")) {
    die($error);
}
echo "Purged!";
if (!insert("schedule", $_POST['data'])) {
    die($error);
}
echo ".... Inserted ....";
echo "Done!";

function connect($user, $password) {
    global $error, $connector;
    $config=parse_ini_file("config.ini.php");
    
    $connector = mysqli_connect($config['host'], $user, $password, $config['schema']);

    if (mysqli_connect_errno($connector)) {
        $error = mysqli_connect_error();
        $connector = null;
        return false;
    } else {
        return true;
    }
}

function purge($table_name) {
    global $error, $connector;
    if (isset($connector)) {
        $sql = "DELETE FROM " . $table_name;
        if (mysqli_query($connector, $sql)) {
            return true;
        } else {
            $error = mysqli_error($connector);
            return false;
        }
    }
}

function insert($table_name, $json) {
    global $error, $connector;
    echo ".... Inserting data ....";
    $rows = json_decode($json, true);
    foreach ($rows as $row) {
        $sql = "INSERT INTO " . $table_name . " (employee, position, start, end) " .
                "VALUES 
                ('" . $row['employee'] .
                "','" . $row['position'] .
                "','" . $row['start'] .
                "','" . $row['end'] .
                "')";
        if (!mysqli_query($connector, $sql)) {
           $error = mysqli_error($connector);
            return false;
        }
    }
    return true;
}

?>
