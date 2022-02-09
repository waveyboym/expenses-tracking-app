<?php

include "changeUserData.php";

class modifyBudgetController extends changeUserData {
    private $newBudget;

    public function __construct($budget){
        $this->newBudget = $budget;
    }

    public function addingNewBudget(){
        $this->changeBudget($this->newBudget);
        $this->changeSessionData();
    }
}