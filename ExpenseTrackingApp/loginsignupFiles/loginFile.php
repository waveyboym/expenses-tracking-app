<?php

if(isset($_POST["submit"]) == true){

    //getting user date from the website
    $Userid = $_POST["Userid"];
    $Userpwd = $_POST["Userpwd"];

    //instantiate logincontr class
    include "../controllerFiles/maindatabase.php";
    include "../controllerFiles/login.php";
    include "../controllerFiles/loginController.php";

    $newLogin = new loginController($Userid, $Userpwd);

    //running error handlers and user signup
    $newLogin->loginUser();
    //going to the home page
    header("location: ../appHomePage/setUp.php?successlogin");
}