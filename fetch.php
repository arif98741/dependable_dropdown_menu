<?php

if (file_exists('function.php')) {
    include_once 'function.php';
}
$con = connection();
if (isset($_GET['action']) && $_GET['action'] == 'getcities') {
    $countryid = mysqli_real_escape_string($con, $_GET['countryid']);
    $q = "select * from city where country='$countryid' order by name asc";
    $stmt = $con->query($q);
    $val = "";
    if ($stmt) {
        if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
                $val .= "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
        }
    } else {
        $val = "<option>Select</select>";
    }
    echo $val;
}