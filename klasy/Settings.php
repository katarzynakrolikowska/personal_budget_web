<?php

class Settings
{
    private $dbo = null;
    private $user = null;
    private $incomeQueryGenerator = null;

    public function __construct($dbo, $user)
    {
        $this -> dbo = $dbo;
        $this -> user = new User($user -> getId(), $user -> getName(), $user -> getLogin());
        $this -> incomeQueryGenerator = new IncomeQueryGenerator($this -> dbo, $this -> user);
    }

    public function editUserName()
    {
        $userDataEdition = new NameEdition($_POST['username'], $this -> user, $this -> dbo);

        return $userDataEdition -> editUserData();
    }

    public function editUserLogin()
    {
        $userDataEdition = new LoginEdition($_POST['login'], $this -> user, $this -> dbo);

        return $userDataEdition -> editUserData();
    }

    public function editUserPassword()
    {
        $userDataEdition = new PasswordEdition($_POST, $this -> user, $this -> dbo);

        return $userDataEdition -> editUserData();
    }

    public function editIncomeCategory($optionsAssignedToUser)
    {
        $incomeCategoryEdition = new OptionEdition($_POST);

        return $incomeCategoryEdition -> editOption($optionsAssignedToUser, $this -> incomeQueryGenerator);
    }

    public function addIncomeCategory($optionsAssignedToUser)
    {  
        $incomeCategoryAddition = new OptionAddition($_POST);

        return $incomeCategoryAddition -> addOption($optionsAssignedToUser, $this -> incomeQueryGenerator);
    }
    
    public function deleteIncomeCategory($optionsAssignedToUser)
    {
        $incomeCategoryDeletion = new OptionDeletion($_POST);
        
        return $incomeCategoryDeletion -> deleteOption($optionsAssignedToUser, $this -> incomeQueryGenerator);
    }

    public function deleteIncomeCategoryWithoutValidation($optionIdToRemove)
    {
        $dataFromForm['selectedOption'] = $optionIdToRemove;
        $incomeCategoryDeletion = new OptionDeletion($dataFromForm);
        
        return $incomeCategoryDeletion -> deleteOptionWithoutValidation($this -> incomeQueryGenerator);
    }
}