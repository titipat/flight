<?php
require 'flight/Flight.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=hr','root',''));

Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('/mysql-example', function () {
    $statement = Flight::db()->query('SELECT * FROM employees;');
    $statement->setFetchMode(PDO::FETCH_OBJ);
    echo "employee_id,first_name,last_name<br>";
    while($row = $statement->fetch()) {
        echo "{$row->employee_id},{$row->first_name},{$row->last_name}<br>";
    }
});

Flight::route('GET /example', function () {
    $username = Flight::request()->query->username;
    echo "Hi, this is a GET method. You have sent a request as {$username}.";
});

Flight::route('GET /example/@username', function ($username) {
    echo "Hi, this is a GET method. You have sent a request as {$username}.";
});

Flight::route('POST /example', function () {
    $username = Flight::request()->data->username;
    echo "Hi, this is a POST method. You have sent a request as {$username}.";
});

Flight::start();
