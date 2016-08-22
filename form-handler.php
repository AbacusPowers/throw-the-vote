<?php
/**
 * Created by: Justin Maurer of 360 Zen
 * Date: 8/21/16
 * Time: 4:14 PM
 * Version: 0.1
 */
ini_set('display_errors', 0);
error_reporting(0);

require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = test_input($_POST["first_name"]);
    $lastName = test_input($_POST["last_name"]);
    $email = test_input($_POST["email"]);
    $dob = test_input($_POST["dob"]);
    $race = test_input($_POST["race"]);
    $party = test_input($_POST["party"]);
    $city = test_input($_POST["city"]);
    $state = test_input($_POST["state"]);
    $candidate = test_input($_POST["candidate"]);
    $write_in = test_input($_POST["write_in"]);

    log_data($firstName, $lastName, $email, $dob, $race, $party, $city, $state, $candidate, $write_in);
    if ($firstName && $firstName !== '') {
        echo '<h1>' . $firstName . ', thanks for throwing away your vote for '.$candidate.'</h1>';
    } else {
        echo '<h1>Thanks for throwing away your vote for '.$candidate.'</h1>';
    }
    echo '<a href="img/ThrowTheVote2016.pdf" id="download-link">Download a printable PDF ballot</a>
            <br><iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fthrowthevote.com&layout=button_count&size=small&mobile_iframe=true&appId=114253528654462&width=69&height=20" width="69" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>';
} else {
    echo 'Error: wrong request method';
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function log_data($firstName, $lastName, $email, $dob, $race, $party, $city, $state, $candidate, $write_in){
    global $user, $password, $dbname, $server;
    $pdo = new PDO('mysql:host='.$server.';dbname='.$dbname.'', $user, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('INSERT INTO submissions (first_name, last_name, email, dob, race, party, city, state, candidate, write_in) 
                                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

    // use exec() because no results are returned
    $stmt->execute([$firstName, $lastName, $email, $dob, $race, $party, $city, $state, $candidate, $write_in]);
//    echo "New record created successfully";

    $pdo = null;
}