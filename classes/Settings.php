<?php

class Settings
{
    private $userDataQueryGenerator = null;
    private $incomeCategoryQueryGenerator = null;
    private $paymentMethodQueryGenerator = null;
    private $expenseCategoryQueryGenerator = null;

    public function __construct($dbo, $user)
    {
        $this -> userDataQueryGenerator = new UserDataQueryGenerator($dbo, $user);
        $this -> incomeCategoryQueryGenerator = new IncomeCategoryQueryGenerator($dbo, $user);
        $this -> paymentMethodQueryGenerator = new PaymentMethodQueryGenerator($dbo, $user);
        $this -> expenseCategoryQueryGenerator = new ExpenseCategoryQueryGenerator($dbo, $user);
    }

    public function editUserName()
    {
        $userDataEdition = new NameEdition($_POST['username']);

        return $userDataEdition -> editUserData($this -> userDataQueryGenerator);
    }

    public function editUserLogin()
    {
        $userDataEdition = new LoginEdition($_POST['login']);

        return $userDataEdition -> editUserData($this -> userDataQueryGenerator);
    }

    public function editUserPassword()
    {
        $userDataEdition = new PasswordEdition($_POST);

        return $userDataEdition -> editUserData($this -> userDataQueryGenerator);
    }

    public function editIncomeCategory($optionsAssignedToUser)
    {
        $incomeCategoryEdition = new OptionEdition($_POST);

        return $incomeCategoryEdition -> editOption($optionsAssignedToUser, $this -> incomeCategoryQueryGenerator);
    }

    public function addIncomeCategory($optionsAssignedToUser)
    {  
        $incomeCategoryAddition = new OptionAddition($_POST);

        return $incomeCategoryAddition -> addOption($optionsAssignedToUser, $this -> incomeCategoryQueryGenerator);
    }

    public function isIncomeCategoryUsed($optionId)
    {
        return OptionFormValidation::isOptionUsed($optionId, $this -> incomeCategoryQueryGenerator);
    }
    
    public function deleteIncomeCategory($optionsAssignedToUser)
    {
        $incomeCategoryDeletion = new OptionDeletion($_POST);
        
        return $incomeCategoryDeletion -> deleteOption($optionsAssignedToUser, $this -> incomeCategoryQueryGenerator);
    }

    public function editPaymentMethod($optionsAssignedToUser)
    {
        $paymentMethodEdition = new OptionEdition($_POST);

        return $paymentMethodEdition -> editOption($optionsAssignedToUser, $this -> paymentMethodQueryGenerator);
    }

    public function addPaymentMethod($optionsAssignedToUser)
    {  
        $paymentMethodAddition = new OptionAddition($_POST);

        return $paymentMethodAddition -> addOption($optionsAssignedToUser, $this -> paymentMethodQueryGenerator);
    }

    public function isPaymentMethodUsed($optionId)
    {
        return OptionFormValidation::isOptionUsed($optionId, $this -> paymentMethodQueryGenerator);
    }

    public function deletePaymentMethod($optionsAssignedToUser)
    {
        $paymentMethodDeletion = new OptionDeletion($_POST);
        
        return $paymentMethodDeletion -> deleteOption($optionsAssignedToUser, $this -> paymentMethodQueryGenerator);
    }

    public function editExpenseCategory($optionsAssignedToUser)
    {
        $expenseCategoryEdition = new OptionEdition($_POST);

        return $expenseCategoryEdition -> editOption($optionsAssignedToUser, $this -> expenseCategoryQueryGenerator);
    }

    public function addExpenseCategory($optionsAssignedToUser)
    {  
        $expenseCategoryAddition = new OptionAddition($_POST);

        return $expenseCategoryAddition -> addOption($optionsAssignedToUser, $this -> expenseCategoryQueryGenerator);
    }
    
    public function deleteExpenseCategory($optionsAssignedToUser)
    {
        $expenseCategoryDeletion = new OptionDeletion($_POST);
        
        return $expenseCategoryDeletion -> deleteOption($optionsAssignedToUser, $this -> expenseCategoryQueryGenerator);
    }

    public function isExpenseCategoryUsed($optionId)
    {
        return OptionFormValidation::isOptionUsed($optionId, $this -> expenseCategoryQueryGenerator);
    }

    public function setLimitOfExpenseCategory($optionsAssignedToUser)
    {
        $expenseCategoryEdition = new OptionEdition($_POST);

        return $expenseCategoryEdition -> setLimitOfCategory($optionsAssignedToUser, $this -> expenseCategoryQueryGenerator);
    }
}