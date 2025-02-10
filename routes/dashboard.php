<?php
    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location: ../");
    }

    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];

    if($_SESSION['userdata']['status']==0){
        $status = '<b style="color:red">Not Voted</b>';
    }
    else{
        $status = '<b style="color:green">Voted</b>';
    }
?> 

<html>
    <head>
        <title>Voting System - dashboard</title>
        <link rel="stylesheet" href="../css/styles.css"> 
    </head>
    <body>
        <style>
            #backbtn{
                padding: 5px;
                font-size: 15px;
                border-radius: 5px;
                background-color: green;
                float: left;
            }

            #loginbtn{
                padding: 5px;
                font-size: 15px;
                border-radius: 5px;
                background-color: green;
                float: right;
            }

            #profile{
                background-color: white;
                width: 32%;
                padding: 20px;
                float: left;
            }

            #group{
                background-color: white;
                width: 60%;
                padding: 20px;
                float: right;
            }

            #votebtn{
                padding: 5px;
                font-size: 15px;
                border-radius: 5px;
                background-color: green;
            }

            .mainpanel{
                padding: 10px;
            }

            .headersection{
                padding: 5px;
            }

            #voted{
                padding: 5px;
                font-size: 15px;
                border-radius: 5px;
                background-color: green;
            }
        </style>

        <div class="mainsection">
            <center>
            <div class="headersection">
                <a href="../"><button id="backbtn">Back</button></a>
                <a href="logout.php"><button id="loginbtn">Logout</button></a>
                <h1>Voting System</h1>
            </div>
            </center>
            <hr>

            <div class="mainpanel">
                <div id="profile">
                    <center><img src="../uploads/<?php echo $userdata['photo']?>" height="100" width="100"></center><br><br>
                    <b>Name : </b><?php echo $userdata['name']?><br><br>
                    <b>Mobile : </b><?php echo $userdata['mobile']?><br><br>
                    <b>Address : </b><?php echo $userdata['address']?><br><br>
                    <b>Status : </b><?php echo $status ?><br>
                </div>

                <div id="group">
                    <?php
                        if($_SESSION['groupsdata']){
                            for($i=0; $i<count($groupsdata); $i++){
                                ?>
                                <div>
                                    <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo']?>" height="100" width="100">
                                    <b>Group Name : </b> <?php echo $groupsdata[$i]['name']?> <br><br>
                                    <b>Votes : </b> <?php echo $groupsdata[$i]['voters']?><br><br>
                                    <form action="../api/vote.php" method="POST">
                                        <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['voters'] ?>">
                                        <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
                                        <?php
                                            if($_SESSION['userdata']['status']==0){
                                                ?>
                                                <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button>
                                                <?php
                                            }
                                        ?>
                                    </form> 
                                    <hr>  
                                </div>    
                                <?php                         
                            }
                        }
                        else{
                        
                        }

                    ?>
                </div>
            </div>

        </div>

    </body>
</html>