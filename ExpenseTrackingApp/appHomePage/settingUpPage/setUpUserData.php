<?php
session_start();
include "../appHomePage/databaseClass/accessmaindatabase.php";

class setUpUserData extends accessmaindatabase{

    protected function getDataAndInitilise(){
        $databaseAccess = $this->connect()->prepare('SELECT EXPENSE_ID, expenses_icon_name, expenses_price, date_logged, EXPENSES_ID FROM expenses;');
        $databaseAccess->execute();
        
        $objectArray = array();
        if($databaseAccess->rowCount() > 0){
            $result = $databaseAccess->fetchAll();
            foreach($result as $valuesToOutput){
                if($valuesToOutput['EXPENSES_ID'] == $_SESSION["LoggedidNum"]){
                    $ExpensesObject = new stdClass();

                    $ExpensesObject->ExpenseID = $valuesToOutput['EXPENSE_ID'];
                    $ExpensesObject->ExpenseIconName = $valuesToOutput['expenses_icon_name'];
                    $ExpensesObject->Price = $valuesToOutput['expenses_price'];
                    $ExpensesObject->Date = $valuesToOutput['date_logged'];    
                    
                    array_push($objectArray, $ExpensesObject);
                }
             }
        }
        $_SESSION["ExpensesReport"] = json_encode($objectArray);
    }

    protected function getUserBudgetAndInitiliseSessionVariables(){
        $databaseAccess = $this->connect()->prepare('SELECT USER_ID, USERS_BUDGET FROM expensetrackingusers;');
        $databaseAccess->execute();

        if($databaseAccess->rowCount() > 0){
            $result = $databaseAccess->fetchAll();
            foreach($result as $valuesToOutput){
                if($valuesToOutput['USER_ID'] == $_SESSION["LoggedidNum"]){

                    $totalMoneySpent = 0;
                    $ExpenseReportArray =  json_decode($_SESSION["ExpensesReport"]);
                    for($i = 0; $i < count($ExpenseReportArray); ++$i){
                        $totalMoneySpent = $totalMoneySpent + $ExpenseReportArray[$i]->Price;
                    }
                    $_SESSION["ExpensesReport"] = json_encode($ExpenseReportArray);
                    $Budget = $valuesToOutput['USERS_BUDGET'];
                    $MoneyLeft = $Budget - $totalMoneySpent;

                    if($Budget > 0){
                        $percentageMoneyLeft = ($MoneyLeft/$Budget)*100;
                        $percentageMoneySpent = ($totalMoneySpent/$Budget)*100;
                    }
                    else{
                        $percentageMoneyLeft = 0;
                        $percentageMoneySpent = 0;
                    }

                    $_SESSION["UserBudget"] = $Budget;
                    $_SESSION["MoneySpent"] = $totalMoneySpent;
                    $_SESSION["MoneyLeft"] = $MoneyLeft;
                    $_SESSION["MoneySpentPercentage"] = $percentageMoneySpent;
                    $_SESSION["MoneyLeftPercentage"] = $percentageMoneyLeft;
                    break;
                }
            }
        }   
    }
}