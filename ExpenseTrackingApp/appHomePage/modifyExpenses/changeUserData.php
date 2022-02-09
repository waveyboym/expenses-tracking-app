<?php
session_start();
include "../appHomePage/databaseClass/addtodatabase.php";

class changeUserData extends addtodatabase{

    protected function addData($IconName, $ExpensePrice, $dateLogged , $userId){
        $databaseAccess = $this->connect()->prepare('INSERT INTO expenses (expenses_icon_name, expenses_price, date_logged, EXPENSES_ID) VALUES (?, ?, ?, ?);');
        $outcome = $databaseAccess->execute(array($IconName, $ExpensePrice, $dateLogged , $userId));
        
        if($outcome == true){
            $databaseAccess = $this->connect()->prepare('SELECT EXPENSE_ID, expenses_icon_name, expenses_price, date_logged FROM expenses;');
            $databaseAccess->execute();
            if($databaseAccess->rowCount() > 0){
                $result = $databaseAccess->fetchAll();
                foreach($result as $valuesToOutput){
                    if(($valuesToOutput['expenses_icon_name'] == $IconName) && ($valuesToOutput['expenses_price'] == $ExpensePrice) && ($valuesToOutput['date_logged'] == $dateLogged)){
                        $ExpensesObject = new stdClass();
                        $ExpensesObject->ExpenseID = $valuesToOutput['EXPENSE_ID'];
                        $ExpensesObject->ExpenseIconName = $IconName;
                        $ExpensesObject->Price = $ExpensePrice;
                        $ExpensesObject->Date = $dateLogged; 

                        $ExpenseReportArray =  json_decode($_SESSION["ExpensesReport"]);
                        array_push($ExpenseReportArray, $ExpensesObject);
                        $_SESSION["ExpensesReport"] = json_encode($ExpenseReportArray);
                        break;
                    }
                }
            }
        }
        else if($outcome != true){
            $databaseAccess = null;
            header("location: ../appHomePage/homeDashboard.php?error=couldnotaddnewexpense");
            exit();
        }      
    }

    protected function changeBudget($userBudget){
        $databaseAccess = $this->connect()->prepare('UPDATE expensetrackingusers SET USERS_BUDGET  = ? WHERE USER_ID = ?;');
        $outcome = $databaseAccess->execute(array($userBudget,$_SESSION["LoggedidNum"] ));

        if($outcome == true){
            return;
        }
        else if($outcome != true){
            $databaseAccess = null;
            header("location: ../appHomePage/homeDashboard.php?error=couldnotaddnewexpense");
            exit();
        }
    }

    protected function changeSessionData(){
        $databaseAccess = $this->connect()->prepare('SELECT USER_ID, USERS_BUDGET FROM expensetrackingusers;');
        $databaseAccess->execute();

        if($databaseAccess->rowCount() > 0){
            $result = $databaseAccess->fetchAll();
            foreach($result as $valuesToOutput){
                if($valuesToOutput['USER_ID'] == $_SESSION["LoggedidNum"]){
                    $Budget = $valuesToOutput['USERS_BUDGET'];

                    $ExpenseReportArray = json_decode($_SESSION["ExpensesReport"]);
                    $totalMoneySpent = 0;
                    for($i = 0; $i < count($ExpenseReportArray); ++$i){
                        $totalMoneySpent = $totalMoneySpent + $ExpenseReportArray[$i]->Price;
                    }
                    $_SESSION["ExpensesReport"] = json_encode($ExpenseReportArray);
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

    protected function deleteExpense($iconToDelete, $priceCheck, $datecheck){

        $ExpenseReportArray =  json_decode($_SESSION["ExpensesReport"]);
        $ExpenseReportArraySize = count($ExpenseReportArray);
        for($i = 0; $i < $ExpenseReportArraySize; ++$i){
            if($ExpenseReportArray[$i]->Price == $priceCheck && $ExpenseReportArray[$i]->ExpenseIconName = $iconToDelete && $ExpenseReportArray[$i]->Date = $datecheck){
                $expense_id = $ExpenseReportArray[$i]->ExpenseID;
                $databaseAccess = $this->connect()->prepare('DELETE FROM expenses WHERE EXPENSE_ID = ? AND expenses_icon_name = ? AND expenses_price = ? AND date_logged = ? AND EXPENSES_ID = ?;');
                $outcome = $databaseAccess->execute(array($expense_id, $iconToDelete , $priceCheck, $datecheck, $_SESSION["LoggedidNum"]));

                if($outcome == true){
                    unset($ExpenseReportArray[$i]);
                    break;
                }
                else if($outcome != true){
                    $databaseAccess = null;
                    header("location: ../mainApp/home.php?error=couldnotdeleteexpense`");
                    exit();
                }
            }
        }

        $totalMoneySpent = 0;
        $Budget = $_SESSION["UserBudget"];
        for($i = 0; $i < count($ExpenseReportArray); ++$i){
            $totalMoneySpent = $totalMoneySpent + $ExpenseReportArray[$i]->Price;
        }
        $_SESSION["ExpensesReport"] = json_encode($ExpenseReportArray);
        $MoneyLeft = $Budget - $totalMoneySpent;

        if($Budget > 0){
            $percentageMoneyLeft = ($MoneyLeft/$Budget)*100;
            $percentageMoneySpent = ($totalMoneySpent/$Budget)*100;
        }
        else{
            $percentageMoneyLeft = 0;
            $percentageMoneySpent = 0;
        }

        $_SESSION["MoneySpent"] = $totalMoneySpent;
        $_SESSION["MoneyLeft"] = $MoneyLeft;
        $_SESSION["MoneySpentPercentage"] = $percentageMoneySpent;
        $_SESSION["MoneyLeftPercentage"] = $percentageMoneyLeft;       
    }
}