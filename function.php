<?php

//connection for project. this connection will be used in whole project
function connection() {
    $con = new mysqli('localhost', 'root', '', 'country_city');
    return $con;
}
