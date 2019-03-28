<div id="containerMyExpenses">
    <div class="row headerMyExpenses mx-0 py-2">
        <div class="col" >
            <header>Ustawienia wydatków</header>
        </div>
    </div>
    
    <div class="row mx-0 pr-4 mb-5">
        <div class="col-12 ">
            
            <div class="row expenseUser mt-5">
            
                <label for="settingsLastExpenseSelect" class="col-sm-2 col-md-3 col-lg-2">Ostatnie wydatki</label>
                <div class="col-10 col-sm-8 col-md-7 col-lg-8">	
                    <select class="custom-select" id="settingsLastExpenseSelect">
                        <option value="1">data wydatek</option>
                        <option value="2">data wydatek</option>
                        <option value="3">data wydatek</option>
                        <option value="4">data wydatek</option>
                    </select>
                </div>
                <div class="col-1 pl-1 pl-sm-3">
                    <a href="#" id="editLastExpenseLink" title="Edytuj"><i class="fas fa-edit"></i></a>
                </div>
                <div class="col-1">
                    <a href="#" id="deleteLastExpenseLink" title="Usuń" class="linkDelete" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
            
            <form class="row expenseUser mt-3 hideItem" id="editDataExpense">
            
                <div class="col-12 col-sm-8 mb-2 input-group">
                    <input type="number" class="form-control" placeholder="Podaj nową kwotę">
                    <div class="input-group-prepend ">
                    <span class="input-group-text " id="amountExpense"><i class="fas fa-pen-alt"></i></span>
                    </div>
                </div>
                
                        
                        
                <div class="col-12 col-sm-8 mb-2 input-group ">	
                    <input type="date" class="form-control" id="date" placeholder="Data">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
                    </div>
                </div>
                
                
                <div class="col-12 col-sm-8 mb-2 input-group">	
                    <select class="custom-select setPaymentMethods" id="settingsExpensePaymentSelect">
                        
                    </select>
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
                    </div>
                </div>
    
                <div class="col-12 col-sm-8 mb-2 input-group ">
                    <select class="custom-select setExpenseCategories" id="category">
                        
                    </select>
                    <div class="input-group-prepend ">
                        <span class="input-group-text " id="categoriesExpense"><i class="fas fa-pen-alt "></i></span>
                    </div>
                </div>
                

                
                <div class=" col-12 col-sm-8 mb-2 input-group">
                    <input type="text" class="form-control" placeholder="Komentarz (opcjonalnie)">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
                    </div>
                </div>
                <div class="col-6 offset-3 mt-2 mt-sm-0 col-sm-4 offset-sm-0">
                    <button type="submit" class="btn text-white btnChangeExpense btnSave" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-plus"></i> Zapisz</button>
                </div>
                
                
            </form>
            
            <div class="row expenseUser mt-4 mb-3 mb-sm-0">	
                <label for="settingsExpensePaymentSelect" class="col-sm-2 col-md-3 col-lg-2">Metody płatności</label>
                <div class="col-10 col-sm-8 col-md-7 col-lg-8">	
                    <select class="custom-select setPaymentMethods" id="settingsExpensePaymentSelect">
                        
                    </select>
                </div>
                
                <div class="col-1 pl-1 pl-sm-3">
                    <a href="#" id="addPaymentExpenseLink" title="Dodaj"><i class="fas fa-plus"></i></a>
                </div>
                <div class="col-1">
                    <a href="#" id="deletePaymentExpenseLink" title="Usuń" class="linkDelete" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
            
            <form class="row expenseUser hideItem" id="addPaymentExpense">
                <div class=" col-12 col-sm-8 mb-2 input-group">
                    <input type="text" class="form-control" placeholder="Podaj nową metodę płatności">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
                    </div>
                </div>
                <div class="col-6 offset-3 mt-2 mt-sm-0 col-sm-4 offset-sm-0">
                    <button type="submit" class="btn text-white btnAddPaymentExpense btnSave" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-plus"></i> Zapisz</button>
                </div>
            </form>
            
            
            <div class="row expenseUser mt-4 mb-3">	
                <label for="settingsExpenseCategorySelect" class="col-sm-2 col-md-3 col-lg-2">Kategorie</label>
                <div class="col-10 col-sm-8 col-md-7 col-lg-8">	
                    <select class="custom-select setExpenseCategories" id="settingsIExpenseCategorySelect">
                        
                    </select>
                </div>
                
                <div class="col-1 pl-1 pl-sm-3">
                    <a href="#" id="addCategoryExpenseLink" title="Dodaj"><i class="fas fa-plus"></i></a>
                </div>
                <div class="col-1">
                    <a href="#" id="deleteCategoryExpenseLink" title="Usuń" class="linkDelete" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
            
            <form class="row expenseUser hideItem" id="addCategoryExpense">
                <div class=" col-12 col-sm-8 mb-2 input-group">
                    <input type="text" class="form-control" placeholder="Podaj nową kategorię">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
                    </div>
                </div>
                <div class="col-6 offset-3 mt-2 mt-sm-0 col-sm-4 offset-sm-0">
                    <button type="submit" class="btn text-white btnAddCategoryExpense btnSave" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-plus"></i> Zapisz</button>
                </div>
            </form>
            
        </div>
    </div>
</div>