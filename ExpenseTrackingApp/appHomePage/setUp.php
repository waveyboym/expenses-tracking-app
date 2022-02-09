<?php

include "settingUpPage/setUpController.php";

$newSetup = new setUpController();
$newSetup->beginSetUp();

header("location: homeDashboard.php?successfullogin");