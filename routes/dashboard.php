<?php
    session_start();
    if(isset($_SESSION['userdata'])){
        header("location: ../");
    }
?>


<html>
    <head>
        <title>Voting System - dashboard</title>
    </head>
    <body>
        <button>Back</button>
        <button>Logout</button>
        <h1>Voting System</h1>
        <hr>
        <div id="profile">Profile</div>
        <div id="groups">Groups</div>
    </body>
</html>