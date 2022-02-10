<?php
include 'sessionAndConnection.php';

if(!$czyZalogowany || $_SESSION["seeLog"] != 1){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SecuritySystem - Log book</title>
    <meta name="description" content="Simple system for Security Company">
    <meta property="og:image" content="">
    <link rel="icon" type="image/png" sizes="64x64" href="assets/img/securitySystemIcon.png">
    <link rel="icon" type="image/png" sizes="64x64" href="assets/img/securitySystemIcon.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">

    <script>
        function show(a){
            document.getElementById(a).style.display = "block";
        }

        function close(a){
            document.getElementById(a).style.display = "none";
        }

        function edit(a){
            document.getElementById("editForm").style.display = "block";
            document.getElementById("ide").value = a;
            document.getElementById("Editwho").innerText = document.getElementById(a + "who").value;
            document.getElementById("Editwhen").value = document.getElementById(a + "when").value;
            document.getElementById("Editwhere").innerText = document.getElementById(a + "where").value;
            document.getElementById("Editlog").value = document.getElementById(a + "log").value;
        }
    </script>
</head>

<?php
            if(isset($_GET["remove"])){
                $RemId = $_GET["id"];
                
                $sql = "DELETE FROM `logBook` WHERE `id` = $RemId";
                $query = mysqli_query($connect, $sql);
                $url = strtok($_SERVER['REQUEST_URI'], '?');
                header("LOCATION: $url");
                echo '<script>alert("log removed!")</script>';            }

            if(isset($_POST["editSub"])){
                
                
                $id = $_POST["id"];
                $who = $_POST["who"];
                $where = $_POST["where"];
                $date = $_POST["date"];
                $log = str_replace(chr(13), "<br>", $_POST["log"]);

                $sql = "UPDATE `logBook` SET `who` = '$who', `where` = $where, `when` = '$date', `log` = '$log' WHERE `id` = $id";
                echo $sql;
                $query = mysqli_query($connect, $sql);
            }

            if(isset($_POST["createSub"])){
                
                
                $who = $_POST["who"];
                $where = $_POST["where"];
                $date = $_POST["date"];
                $log = str_replace(chr(13), "<br>", $_POST["log"]);

                $sql = "INSERT INTO `logBook` (`id`, `who`, `where`, `when`, `log`) VALUES (NULL, '$who', '$where', '$date', '$log');";
                echo $sql;
                $query = mysqli_query($connect, $sql);
            }
        ?>

<body style="background: rgb(25,38,52);">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar gradient">
        <div class="container"><a class="navbar-brand logo" href="#" style="width: 257.2px;">Security System</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarNav"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse text-center" id="navbarNav" style="height: 70px;text-align: center;width: auto;">
                <ul class="navbar-nav text-center">
                    <li class="nav-item"><a class="nav-link" href="notifications.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Notifications</a></li>
                    <li class="nav-item"><a class="nav-link" href="schedule.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Schedule</a></li>
                    <li class="nav-item"><a class="nav-link" href="accounts.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Account management</a></li>
                    <li class="nav-item"><a class="nav-link" href="receptions.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Receptions managment</a></li>
                    <li class="nav-item"><a class="nav-link active" href="logbook.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Log book</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php" style="border-radius: 11px;border: 2px solid var(--bs-red) ;">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="login-dark" style="min-height: 600px;height: auto;">
        <div style="background: rgb(30,40,51);padding: 40px;height: auto;width: 90%;margin: 5%;">
            <div class="illustration" style="height: 114px;justify-content: center;margin-top: 47px;">
                <h1 style="/*float: right;*//*margin-top: 54px;*/">Log book</h1>
            </div>
            <div class="illustration" style="height: 145px;justify-content: center;">
                <form class="shadow-none" method="post" style="width: 100%;margin: 0px;height: 114px;position: relative;">
                <input class="form-control" type="month" name="filterMonth" style="margin-top: -18px;padding-top: 0px;padding-right: 0px;padding-bottom: 0px;padding-left: 0px;">
                <select name="filterPlace" class="form-select form-control" style="color: rgb(129,129,129);">
                <?php
                        
                        $sql = "SELECT * FROM `receptions`";
                
                        $query = mysqli_query($connect, $sql);
        
                        while($row = $query->fetch_assoc()) {
                            echo ' <option value="'.$row["id"].'">'.$row["Name"].'</option>';
                        }
                ?>
                    </select><button class="btn btn-primary" type="submit" style="margin-top: -115px;padding: 11px;padding-top: 11px;width: 100%;">Filter</button></form>
            </div>
            <div>
            <?php
            if($_SESSION["manLog"] == 1){
                echo '<a href="#" onclick="show(`createForm`)"><i class="fa fa-plus" style="font-size: 24px;"></i>create new</a>';
            }
            ?>    
            

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr style="color: rgb(197,197,197);">
                                <td>Date</td>
                                <td>Where</td>
                                <td>Actions</td>
                            </tr>

                            <?php
                                
                                $sql = "SELECT `logBook`.*, `receptions`.`Name` FROM `logBook` INNER JOIN `receptions` ON `receptions`.`id` = `logBook`.`where`";
                        
                                if(isset($_POST["filterPlace"])){
                                    $sql = "SELECT `logBook`.*, `receptions`.`Name` FROM `logBook` INNER JOIN `receptions` ON `receptions`.`id` = `logBook`.`where` WHERE `where` = ". $_POST["filterPlace"];
                                }

                                if(isset($_POST["filterMonth"])){
                                    $lastMonthDay = date("Y-m-t", strtotime($_POST["filterMonth"]."-01"));

                                    $sql = $sql . " AND `when` >= '". $_POST["filterMonth"]. "-00' AND `when` <= '".$lastMonthDay."'";
                                }

                                $query = mysqli_query($connect, $sql);
                
                                while($row = $query->fetch_assoc()) {
                                    echo '<tr style="color: rgb(197,197,197);">
                                    <td>'.$row["when"].'</td>
                                    <td>'.$row["Name"].'</td>
                                    <td>';

                                    if($_SESSION["manLog"] == 1){
                                        echo '<a href="logbook.php?remove=1&id='.$row["id"].'" style="font-size: 24px;margin-right: 10px;"><i class="fa fa-remove"></i></a>
                                        <a href="#" onclick="edit('.$row["id"].')" style="font-size: 24px;margin-right: 10px;"><i class="fa fa-edit"></i></a>';
                                    }
                                    echo '<a href="log.php?id='.$row["id"].'" target="_blank" style="font-size: 24px;"><i class="fa fa-eye"></i></a></td>
                                    </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form class="shadow-lg" id="editForm" method="post" style="height: auto;width: 90%;max-width: 90%;/*float: left;*/background: #4a0025; display: none;">
            <div class="illustration" style="height: 111px;justify-content: center;">
                <h1 style="/*float: right;*//*margin-top: 54px;*/">Edit log</h1>
            </div>
            <div><input class="form-control" id="ide" name="id" type="text" placeholder="Id" readonly="">
            <label class="form-label" style="width: 100%;color: rgb(167,167,167);">Shift manager:<a id="Editwho" style="font-style: italic; font-size: 80%; color:white;margin-left:20px;">()</a>
                <select class="form-select form-control" name="who" style="color: rgb(115,115,115);">
                    <?php
                        
                        $sql = "SELECT * FROM `users`";
                
                        $query = mysqli_query($connect, $sql);
        
                        while($row = $query->fetch_assoc()) {
                            echo ' <option value="'.$row["id"].'">'.$row["name"].'</option>';
                        }
                    ?>
                    </select></label><label class="form-label" style="width: 100%;color: rgb(167,167,167);">Where:<a id="Editwhere" style="font-style: italic; font-size: 80%; color:white;margin-left:20px;">()</a><select class="form-select form-control" style="color: rgb(115,115,115);" name="where">
                    <?php
                        
                        $sql = "SELECT * FROM `receptions`";
                
                        $query = mysqli_query($connect, $sql);
        
                        while($row = $query->fetch_assoc()) {
                            echo ' <option value="'.$row["id"].'">'.$row["Name"].'</option>';
                        }
                    ?>
                    </select></label><label class="form-label" style="width: 100%;color: rgb(167,167,167);">
                    When:<input class="form-control" id="Editwhen" type="date" name="date"></label><label class="form-label" style="width: 100%;color: rgb(167,167,167);">Log:
                    <textarea class="form-control" placeholder="Log" name="log" id="Editlog"></textarea></label>
                    <button class="btn btn-primary" type="submit" name="editSub" style="margin-right: 23px;">Save</button><button class="btn btn-primary" onclick="close('editForm')">Cancel</button></div>
        </form>
        <form class="shadow-lg" id="createForm" method="post" style="height: auto;width: 90%;max-width: 90%;/*float: left;*/background: #4a0025; display: none;">
            <div class="illustration" style="height: 111px;justify-content: center;">
                <h1 style="/*float: right;*//*margin-top: 54px;*/">Create log</h1>
            </div>
            <div><label class="form-label" style="width: 100%;color: rgb(167,167,167);">Shift manager:<select class="form-select form-control" name="who" style="color: rgb(115,115,115);">
                    <?php
                        
                        $sql = "SELECT * FROM `users`";
                
                        $query = mysqli_query($connect, $sql);
        
                        while($row = $query->fetch_assoc()) {
                            echo ' <option value="'.$row["id"].'">'.$row["name"].'</option>';
                        }
                    ?>
                    </select></label><label class="form-label" style="width: 100%;color: rgb(167,167,167);">Where:<select class="form-select form-control" name="where" style="color: rgb(115,115,115);">
                    <?php
                        
                        $sql = "SELECT * FROM `receptions`";
                
                        $query = mysqli_query($connect, $sql);
        
                        while($row = $query->fetch_assoc()) {
                            echo ' <option value="'.$row["id"].'">'.$row["Name"].'</option>';
                        }
                    ?>
                    </select></label><label class="form-label" style="width: 100%;color: rgb(167,167,167);">When:<input class="form-control" name="date" type="date"></label><label class="form-label" style="width: 100%;color: rgb(167,167,167);">Log:<textarea class="form-control" name="log" placeholder="Log"></textarea></label><button class="btn btn-primary" type="submit" name="createSub" style="margin-right: 23px;">Save</button><button class="btn btn-primary" onclick="close('createForm')">Cancel</button></div>
        </form>
    </section>
    <footer class="page-footer" style="background: linear-gradient(#192734, #1e2244);color: rgb(255,255,255);">
        <div class="container">
            <div class="links"><a href="https://blazejczyk.net/" style="color: rgb(255,255,255);">My portfolio</a><a href="https://yellowsink.pl/privacypolicy.html" style="color: rgb(255,255,255);">Privacy Policy</a><a href="https://gubru.blazejczyk.net/CookiePolicy.pdf" style="color: rgb(255,255,255);">Cookie policy</a></div>
        </div>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/theme.js"></script>

    <div style="display: none;">
    <?php
        
        $sql = "SELECT `logBook`.*, `users`.`name`, `receptions`.`Name` FROM `logBook` INNER JOIN `users` ON `users`.`id` = `logBook`.`who` INNER JOIN `receptions` ON `receptions`.`id` = `logBook`.`where`";

        if(isset($_POST["filterPlace"])){
            $sql = "SELECT `logBook`.*, `users`.`name`, `receptions`.`Name` FROM `logBook` INNER JOIN `users` ON `users`.`id` = `logBook`.`who` INNER JOIN `receptions` ON `receptions`.`id` = `logBook`.`where` WHERE `where` = ". $_POST["filterPlace"];
        }

        if(isset($_POST["filterMonth"])){
            $lastMonthDay = date("Y-m-t", strtotime($_POST["filterMonth"]."-01"));

            $sql = $sql . " AND `when` >= '". $_POST["filterMonth"]. "-00' AND `when` <= '".$lastMonthDay."'";
        }

        $query = mysqli_query($connect, $sql);

        while($row = $query->fetch_assoc()) {
            echo '
            <input type="text" id="'.$row["id"].'who" value="(Previously: '.$row["name"].')">
            <input type="text" id="'.$row["id"].'where" value="(Previously: '.$row["Name"].')">
            <input type="text" id="'.$row["id"].'when" value="'.$row["when"].'">
            <textarea id="'.$row["id"].'log">'.str_replace("<br>", "", $row["log"]).'</textarea>
            ';
        }
    ?>
    </div>
</body>

</html>