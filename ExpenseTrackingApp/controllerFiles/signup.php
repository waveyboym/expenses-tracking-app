<?php

class signup extends maindatabase{

    //check if user already exists in database
    protected function checkifUserExists($Userid, $Useremail){
        $databaseAccess = $this->connect()->prepare('SELECT USERS_UID FROM expensetrackingusers WHERE USERS_UID = ? OR USERS_EMAIL = ?;');

        if($databaseAccess->execute(array($Userid, $Useremail)) != true){
            $databaseAccess = null;
            header("location: ../index.php?error=cannotAccessDatabase");
            exit();
        }

        if($databaseAccess->rowCount() > 0){
            return false;
        }
        else{
            return true;
        }
    }

    protected function createNewUser($Userid, $Userpwd, $Useremail){
        $databaseAccess = $this->connect()->prepare('INSERT INTO expensetrackingusers (USERS_UID, USERS_PWD, USERS_EMAIL, USERS_BUDGET) VALUES (?, ?, ?, ?);');

        $hashedPWD = password_hash($Userpwd, PASSWORD_DEFAULT);
        $newUserBudget = 0;

        if($databaseAccess->execute(array($Userid, $hashedPWD, $Useremail, $newUserBudget)) != true){
            $databaseAccess = null;
            header("location: ../index.php?error=createnewUserfailed");
            exit();
        }

        $databaseAccess = null;
    }

    protected function retrieveUserID($Userid, $Useremail){
        $databaseAccess = $this->connect()->prepare('SELECT USER_ID, USERS_UID, USERS_EMAIL FROM expensetrackingusers;');
        $databaseAccess->execute();
        
        if($databaseAccess->rowCount() > 0){
            $result = $databaseAccess->fetchAll();
            foreach($result as $valuesToOutput){
                if($valuesToOutput['USERS_UID'] == $Userid && $valuesToOutput['USERS_EMAIL'] == $Useremail){
                    return $valuesToOutput['USER_ID'];
                }
            }
        }
        else{
            header("location: ../index.php?error=idCannotBeFound");
            exit();
        }
    }
}