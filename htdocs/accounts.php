<?php
include 'sessionAndConnection.php';

if(!$czyZalogowany || $_SESSION["manAcc"] != 1){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SecuritySystem - account management</title>
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
        }

        function lockPerm(){
            if(document.getElementById("doNotChange").checked){
                document.getElementById("mod1").disabled = true;
                document.getElementById("formCheck-9").disabled = true;
                document.getElementById("formCheck-10").disabled = true;
                document.getElementById("formCheck-11").disabled = true;
                document.getElementById("formCheck-12").disabled = true;
                document.getElementById("formCheck-13").disabled = true;
                document.getElementById("formCheck-14").disabled = true;
                document.getElementById("formCheck-15").disabled = true;
            }else{
                document.getElementById("mod1").disabled = false;
                document.getElementById("formCheck-9").disabled = false;
                document.getElementById("formCheck-10").disabled = false;
                document.getElementById("formCheck-11").disabled = false;
                document.getElementById("formCheck-12").disabled = false;
                document.getElementById("formCheck-13").disabled = false;
                document.getElementById("formCheck-14").disabled = false;
                document.getElementById("formCheck-15").disabled = false;
            }
        }
    </script>
</head>


<?php
            if(isset($_GET["remove"])){
                $RemId = $_GET["id"];
                
                $sql = "DELETE FROM `users` WHERE `users`.`id` = $RemId";
                $query = mysqli_query($connect, $sql);
                echo '<script>alert("Account removed!")</script>';
            }

            if(isset($_POST["subEdit"])){
                
                
                $id = $_POST["id"];
                $login = $_POST["login"];
                $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $name = $_POST["name"];
                $place = $_POST["place"];
                $seeNot = 0;
                $manNot = 0;
                $manAcc = 0;
                $manRec = 0;
                $manLog = 0;
                $schAcc = 0;
                $schMan = 0;
                $seeLog = 0;
                if(isset($_POST["seeNot"])){
                    $seeNot = 1;
                }
                if(isset($_POST["manNot"])){
                    $manNot = 1;
                }
                if(isset($_POST["manAcc"])){
                    $manAcc = 1;
                }
                if(isset($_POST["manRec"])){
                    $manRec = 1;
                }
                if(isset($_POST["manLog"])){
                    $manLog = 1;
                }
                if(isset($_POST["schAcc"])){
                    $schAcc = 1;
                }
                if(isset($_POST["schMan"])){
                    $schMan = 1;
                }
                if(isset($_POST["seeLog"])){
                    $seeLog = 1;
                }

                $sqlP1 = "UPDATE `users` SET `workPlace` = $place";
                
                $sqlP2 = "";
                if(!empty($name)){
                    $sqlP2 = $sqlP2 . ", `name` = '$name'";
                }
                if(!empty($login)){
                    $sqlP2 = $sqlP2 . ", `login` = '$login'";
                }
                if(!empty($_POST["password"])){
                    $sqlP2 = $sqlP2 . ", `password` = '$pass'";
                }
                $sqlP3 = ", `seeNot` = $seeNot, `manNot` = $manNot, `manAcc` = $manAcc, `manRec` = $manRec, `manLog` = $manLog, `schAcc` = $schAcc, `schMan` = $schMan, `seeLog` = $seeLog WHERE `id` = $id";

                if(isset($_POST["dontChangePerm"])){
                    $sqlP3 = " WHERE `id` = $id";
                }

                $sql = $sqlP1. $sqlP2. $sqlP3;
                $query = mysqli_query($connect, $sql);
            }

            if(isset($_POST["subCreate"])){
                
                
                $login = $_POST["login"];
                $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $name = $_POST["name"];
                $place = $_POST["place"];
                $seeNot = 0;
                $manNot = 0;
                $manAcc = 0;
                $manRec = 0;
                $manLog = 0;
                $schAcc = 0;
                $schMan = 0;
                $seeLog = 0;
                if(isset($_POST["seeNot"])){
                    $seeNot = 1;
                }
                if(isset($_POST["manNot"])){
                    $manNot = 1;
                }
                if(isset($_POST["manAcc"])){
                    $manAcc = 1;
                }
                if(isset($_POST["manRec"])){
                    $manRec = 1;
                }
                if(isset($_POST["manLog"])){
                    $manLog = 1;
                }
                if(isset($_POST["schAcc"])){
                    $schAcc = 1;
                }
                if(isset($_POST["schMan"])){
                    $schMan = 1;
                }
                if(isset($_POST["seeLog"])){
                    $seeLog = 1;
                }

                $sql = "INSERT INTO `users` (`id`, `login`, `password`, `name`, `workPlace`, `seeNot`, `manNot`, `manAcc`, `manRec`, `manLog`, `schAcc`, `schMan`, `seeLog`) VALUES (NULL, '$login', '$pass', '$name', '$place', '$seeNot', '$manNot', '$manAcc', '$manRec', '$manLog', '$schAcc', '$schMan', '$seeLog')";
                
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
                    <li class="nav-item"><a class="nav-link active" href="accounts.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Account management</a></li>
                    <li class="nav-item"><a class="nav-link" href="receptions.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Receptions managment</a></li>
                    <li class="nav-item"><a class="nav-link" href="logbook.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Log book</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php" style="border-radius: 11px;border: 2px solid var(--bs-red) ;">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="login-dark" style="min-height: 600px;height: auto;">
        <div style="background: rgb(30,40,51);padding: 40px;height: auto;width: 90%;margin: 5%;">
            <div class="illustration" style="height: 114px;justify-content: center;margin-top: 47px;">
                <h1 style="/*float: right;*//*margin-top: 54px;*/">Accounts</h1>
            </div>
            <div><a href="#" onclick="show('createForm')"><i class="fa fa-plus" style="font-size: 24px;"></i>create new</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr style="color: rgb(197,197,197);">
                                <td>Name</td>
                                <td>Actions</td>
                            </tr>


                            <?php
                                
                                $sql = "SELECT `name`, `id` FROM `users`";
                        
                                $query = mysqli_query($connect, $sql);
                
                                while($row = $query->fetch_assoc()) {
                                    echo '<tr style="color: rgb(197,197,197);">
                                        <td>'.$row["name"].'</td>
                                            <td>
                                                <a href="accounts.php?remove=1&id='.$row["id"].'" style="font-size: 24px;margin-right: 10px;"><i class="fa fa-remove"></i></a>
                                                <a href="#" onclick="edit('.$row["id"].')" style="font-size: 24px;"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>';
                                }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <form id="editForm" class="shadow-lg" action="accounts.php" method="post" style="height: auto;width: 90%;max-width: 90%;/*float: left;*/background: #4a0025; display: none;">
            <div class="illustration" style="height: 111px;justify-content: center;">
                <h1 style="/*float: right;*//*margin-top: 54px;*/">Edit account*</h1><p style="color:white;font-size:12px;">*you can leave login, name and / or password blank so they will not be changed</p>
            </div>
            <div>
                <input class="form-control" type="text" placeholder="Id" readonly="" name="id" id="ide">
                <input class="form-control" type="text" placeholder="Login*" name="login">
                <input class="form-control" type="text" placeholder="Name*" name="name">
                <input class="form-control" type="password" placeholder="Password*" name="password">
                <label class="form-label" style="width: 100%;color: rgb(145,145,145);padding-left: 12px;">
                Work place:<select class="form-select form-control" style="color: rgb(115,115,115);" name="place">
                <?php
                        
                        $sql = "SELECT * FROM `receptions`";
                
                        $query = mysqli_query($connect, $sql);
        
                        while($row = $query->fetch_assoc()) {
                            echo ' <option value="'.$row["id"].'">'.$row["Name"].'</option>';
                        }
                ?>
                    </select></label>
                <div class="container" style="color: rgb(157,157,157);">
                <p>Permissions:</p>
                    <div class="form-check" style="width:100%;color:red;"><input class="form-check-input" type="checkbox" id="doNotChange" onchange="lockPerm()" name="dontChangePerm"><label class="form-check-label" for="doNotChange">Do not change permissions</label></div>

                    <div class="form-check"><input class="form-check-input" type="checkbox" id="mod1" name="seeNot"><label class="form-check-label" for="mod1">See notifications</label></div>
                    <div class="form-check"><input  name="manNot" class="form-check-input" type="checkbox" id="formCheck-9"><label class="form-check-label" for="formCheck-9">Manage notifications</label></div>
                    <div class="form-check"><input name="manAcc" class="form-check-input" type="checkbox" id="formCheck-10"><label class="form-check-label" for="formCheck-10">Manage Accounts</label></div>
                    <div class="form-check"><input name="manRec" class="form-check-input" type="checkbox" id="formCheck-11"><label class="form-check-label" for="formCheck-11">Manage receptions</label></div>
                    <div class="form-check"><input name="manLog" class="form-check-input" type="checkbox" id="formCheck-12"><label class="form-check-label" for="formCheck-12">Manage logs in log book</label></div>
                    <div class="form-check"><input name="schAcc" class="form-check-input" type="checkbox" id="formCheck-13"><label class="form-check-label" for="formCheck-13">Schedule access</label></div>
                    <div class="form-check"><input name="schMan" class="form-check-input" type="checkbox" id="formCheck-14"><label class="form-check-label" for="formCheck-14">Edit schedule</label></div>
                    <div class="form-check"><input name="seeLog" class="form-check-input" type="checkbox" id="formCheck-15"><label class="form-check-label" for="formCheck-15">See Logs</label></div>
                </div>
                <div style="width: 100%;float: left;">
                <button class="btn btn-primary" type="submit" style="margin-right: 23px;" name="subEdit">Save</button>
                <button class="btn btn-primary" onclick="close('createForm')">Cancel</button></div>
            </div>
        </form>

        <form id="createForm" class="shadow-lg" action="accounts.php" method="post" style="height: auto;width: 90%;max-width: 90%;/*float: left;*/background: #4a0025; display: none;">
            <div class="illustration" style="height: 111px;justify-content: center;">
                <h1 style="/*float: right;*//*margin-top: 54px;*/">Create account</h1>
            </div>
            <div>
                <input class="form-control" type="text" placeholder="Login" name="login">
                <input class="form-control" type="text" placeholder="Name" name="name">
                <input class="form-control" type="password" placeholder="Password" name="password">
                <label class="form-label" style="width: 100%;color: rgb(145,145,145);padding-left: 12px;">
                Work place:<select class="form-select form-control" style="color: rgb(115,115,115);" name="place">

                <?php
                        
                        $sql = "SELECT * FROM `receptions`";
                
                        $query = mysqli_query($connect, $sql);
        
                        while($row = $query->fetch_assoc()) {
                            echo ' <option value="'.$row["id"].'">'.$row["Name"].'</option>';
                        }
                ?>
                    </select></label>
                <div class="container" style="color: rgb(157,157,157);">
                    <p>Permissions:</p>
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-8" name="seeNot"><label class="form-check-label" for="formCheck-8">See notifications</label></div>

                    <div class="form-check"><input  name="manNot" class="form-check-input" type="checkbox" id="formCheck-16"><label class="form-check-label" for="formCheck-16">Manage notifications</label></div>
                    <div class="form-check"><input name="manAcc" class="form-check-input" type="checkbox" id="formCheck-17"><label class="form-check-label" for="formCheck-17">Manage Accounts</label></div>
                    <div class="form-check"><input name="manRec" class="form-check-input" type="checkbox" id="formCheck-18"><label class="form-check-label" for="formCheck-18">Manage receptions</label></div>
                    <div class="form-check"><input name="manLog" class="form-check-input" type="checkbox" id="formCheck-19"><label class="form-check-label" for="formCheck-19">Manage logs in log book</label></div>
                    <div class="form-check"><input name="schAcc" class="form-check-input" type="checkbox" id="formCheck-20"><label class="form-check-label" for="formCheck-20">Schedule access</label></div>
                    <div class="form-check"><input name="schMan" class="form-check-input" type="checkbox" id="formCheck-21"><label class="form-check-label" for="formCheck-21">Edit schedule</label></div>
                    <div class="form-check"><input name="seeLog" class="form-check-input" type="checkbox" id="formCheck-22"><label class="form-check-label" for="formCheck-22">See Logs</label></div>
                </div>
                <div style="width: 100%;float: left;">
                    <button class="btn btn-primary" type="submit" name="subCreate" style="margin-right: 23px;">Save</button>
                    <button class="btn btn-primary" onclick="close('createForm')">Cancel</button>
                </div>
            </div>
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
</body>

</html>