<?php
require 'flight/Flight.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=hr','root',''));

Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('/mysql-example', function () {
    $db = Flight::db();
    $statement = $db->query('SELECT * FROM employees;');
    $statement->setFetchMode(PDO::FETCH_OBJ);
    echo "employee_id,first_name,last_name<br>";
    while($row = $statement->fetch()) {
        echo "{$row->employee_id},{$row->first_name},{$row->last_name}<br>";
    }
});

Flight::start();
