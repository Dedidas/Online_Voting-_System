<?php
session_start();
if (!isset($_SESSION['userdata'])) {
    header("location: ../");
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if( $userdata ['status']==0){
    $status = '<b style="color:red">Not Voted</b>';
}
else{
    $status = '<b style="color:green">Voted</b>';
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Page</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>

<body>

    <style>
        #backbtn {
            padding: 6px;
            border-radius: 5px;
            width: 5%;
            background-color: #485460;
            color: azure;
            font-size: 15px;
            float: left;
            margin: 10px;
            border-radius: 5px;
        }

        #logoutbtn {
            padding: 6px;
            border-radius: 5px;
            width: 5%;
            background-color: #485460;
            color: azure;
            font-size: 15px;
            float: right;
            margin: 10px;
            border-radius: 5px;
        }

        #Profile {
            background-color: white;
            width: 30%;
            padding: 20px;
            float: left;
        }

        #Group {
            background-color: white;
            width: 60%;
            padding: 20px;
            float: right;
        }

        #votebtn {
            padding: 6px;
            border-radius: 5px;
            width: 5%;
            background-color: #485460;
            color: azure;
            font-size: 15px;
            float: left;
            border-radius: 5px;
        }
        #mainpanel{
            padding: 10px;
        }
        #voted{
            padding: 5px;
            font-size: 15px;
            background-color: greenyellow;
            color: white;
            border-radius: 5px;
        }
    </style>

    <div id="mainsection">
        <center>
            <div id="headersection">
            <a href="../"><button id="backbtn">Back</button></a>
            <a href="logout.php"><button id="logoutbtn">Logout</button></a>
                <h1>Online Voting System</h1>
            </div>
        </center>
        <hr>
         <div id="mainpanel">
         <div id="Profile">
            <center><img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100"></center><br><br>
            <b>Name:</b><?php echo $userdata['name'] ?><br><br>
            <b>Mobile:</b><?php echo $userdata['mobile'] ?><br><br>
            <b>Address:</b><?php echo $userdata['address'] ?><br><br>
            <b>Status:</b><?php echo $status?><br><br>

        </div>
        <div id="Group">
         <?php
            if ($_SESSION['groupsdata']) {
                for ($i = 0; $i < count($groupsdata); $i++){
                     ?>
                    <div>
                        <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="100"><br><br>
                        <b>Group Name:</b><?php echo $groupsdata[$i]['name'] ?><br><br>
                        <b>Votes:</b><?php echo $groupsdata[$i]['votes'] ?><br><br>
                        <form action="../api/vote.php" method="POST">
                            <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
                            <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                            <?php
                            if($_SESSION['userdata']['status']==0){
                                ?>
                                <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                <?php
                            }
                            else{
                                ?>
                                <button disabled type="button" name="votebtn" value="Vote" id="voted">voted</button>
                                <?php
                            }
                            ?>
                        </form>
                    </div>
                    <br><br><br>
                   <hr>
                   <?php
                }
            } 
            else {

            }
            ?>
        </div>
         </div>
    </div>
</body>

</html>