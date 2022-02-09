<?php

session_start();
if(isset($_POST["icon"]) && isset($_POST["price"]) && isset($_POST["date"])){
    $IconName = $_POST["icon"];
    $ExpensePrice = $_POST["price"];
    $dateLogged = $_POST["date"];
    $userId = $_SESSION["LoggedidNum"];

    include "../appHomePage/modifyExpenses/addNewExpenseController.php";
    $newExpense = new addNewExpenseController($IconName, $ExpensePrice, $dateLogged, $userId);
    $newExpense->addingNewExpense();
}
else if(isset($_POST["budget"]) && isset($_POST["moneyleft"])){
    $budget = $_POST["budget"];
    $moneyleft = $_POST["moneyleft"];

    include "../appHomePage/modifyExpenses/modifyBudgetController.php";
    $newBudget = new modifyBudgetController($budget);
    $newBudget->addingNewBudget();
}
else if(isset($_POST["icondelete"]) && isset($_POST["pricedelete"]) && isset($_POST["datedelete"])){
    $iconToDelete = $_POST["icondelete"];
    $priceCheck = $_POST["pricedelete"];
    $datecheck = $_POST["datedelete"];

    include "../appHomePage/modifyExpenses/deleteExpenseController.php";
    $deleteExpense = new deleteExpenseController($iconToDelete, $priceCheck, $datecheck);
    $deleteExpense->deletingExpense();
}