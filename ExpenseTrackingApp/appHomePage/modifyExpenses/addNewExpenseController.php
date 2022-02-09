<?php

include "changeUserData.php";

class addNewExpenseController extends changeUserData {
    private $newIconName;
    private $newExpensePrice;
    private $newdateLogged;
    private $newuserId;

    public function __construct($IconName, $ExpensePrice, $dateLogged, $userId){
        $this->newIconName = $IconName;
        $this->newExpensePrice= $ExpensePrice;
        $this->newdateLogged = $dateLogged;
        $this->newuserId = $userId;
    }

    public function addingNewExpense(){
        $this->addData($this->newIconName, $this->newExpensePrice, $this->newdateLogged, $this->newuserId);
        $this->changeSessionData();
    }
}