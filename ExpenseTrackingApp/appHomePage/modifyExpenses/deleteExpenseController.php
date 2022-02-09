<?php

include "changeUserData.php";

class deleteExpenseController extends changeUserData {
    private $newIcon;
    private $pricecheck;
    private $dateCheck;

    public function __construct($iconToDelete, $priceCheck, $datecheck){
        $this->newIcon = $iconToDelete;
        $this->pricecheck = $priceCheck;
        $this->dateCheck = $datecheck;
    }

    public function deletingExpense(){
        $this->deleteExpense($this->newIcon, $this->pricecheck, $this->dateCheck);
        $this->changeSessionData();
    }
}