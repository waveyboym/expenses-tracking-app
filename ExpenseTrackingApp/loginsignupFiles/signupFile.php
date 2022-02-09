<?php

if(isset($_POST["submit"]) == true){

    //getting user data from login form
    session_start();
    $_SESSION["LoggedUserid"] = $_POST["Userid"];
    $Userid = $_POST["Userid"];
    $Userpwd = $_POST["Userpwd"];
    $Userpwdrepeat = $_POST["Userpwdrpt"];
    $Useremail = $_POST["Usereml"];

    //instantiate signupcontr class
    include "../controllerFiles/maindatabase.php";
    include "../controllerFiles/signup.php";
    include "../controllerFiles/signupController.php";

    $newSignUp = new signupcontroller($Userid, $Userpwd, $Userpwdrepeat, $Useremail);

    //running error handlers and user signup
    $newSignUp->signUpNewUser();
    $newIdValue = $newSignUp->getUserID();
    $_SESSION["LoggedidNum"] = $newIdValue;
    //going to the home page
    header("location: ../appHomePage/setUp.php?successlogin");
}