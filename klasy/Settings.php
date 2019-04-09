<?php

class Settings
{
    private $dbo = null;
    private $user = null;
    private $userDataQueryGenerator = null;
    private $incomeQueryGenerator = null;
    private $paymentMethodQueryGenerator = null;
    private $expenseCategoryQueryGenerator = null;

    public function __construct($dbo, $user)
    {
        $this -> userDataQueryGenerator = new UserDataQueryGenerator($dbo, $user);
        $this -> incomeQueryGenerator = new IncomeQueryGenerator($dbo, $user);
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

    public function deletePaymentMethod($optionsAssignedToUser)
    {
        $paymentMethodDeletion = new OptionDeletion($_POST);
        
        return $paymentMethodDeletion -> deleteOption($optionsAssignedToUser, $this -> paymentMethodQueryGenerator);
    }

    public function deletePaymentMethodWithoutValidation($optionIdToRemove)
    {
        $dataFromForm['selectedOption'] = $optionIdToRemove;
        $paymentMethodDDeletion = new OptionDeletion($dataFromForm);
        
        return $paymentMethodDDeletion -> deleteOptionWithoutValidation($this -> paymentMethodQueryGenerator);
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

    public function deleteExpenseCategoryWithoutValidation($optionIdToRemove)
    {
        $dataFromForm['selectedOption'] = $optionIdToRemove;
        $expenseCategoryDeletion = new OptionDeletion($dataFromForm);
        
        return $expenseCategoryDeletion -> deleteOptionWithoutValidation($this -> expenseCategoryQueryGenerator);
    }


}