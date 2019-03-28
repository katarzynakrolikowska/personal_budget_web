<div id="containerMyIncomes">
    <div class="row headerMyIncomes mx-0 py-2">
        <div class="col" >
            <header>Ustawienia przychodów</header>
        </div>
    </div>
    
    <div class="row mx-0 pr-4 mb-5">
        <div class="col-12 ">
            
            <div class="row incomeUser mt-5 ">
            
                <label for="settingsLastIncomeSelect" class="col-sm-2 col-md-3 col-lg-2">Ostatnie przychody</label>
                <div class="col-10 col-sm-8 col-md-7 col-lg-8">	
                    <select class="custom-select" id="settingsLastIncomeSelect">
                        <option value="1">data przychód</option>
                        <option value="2">data przychód</option>
                        <option value="3">data przychód</option>
                        <option value="4">data przychód</option>
                    </select>
                </div>
                <div class="col-1 pl-1 pl-sm-3">
                    <a href="#" id="editLastIncomeLink" title="Edytuj"><i class="fas fa-edit"></i></a>
                </div>
                <div class="col-1">
                    <a href="#" id="deleteLastIncomeLink" title="Usuń" class="linkDelete" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
            
            <form class="row incomeUser mt-3 hideItem" id="editDataIncome">
            
                <div class="col-12 col-sm-8 mb-2 input-group">
                    <input type="number" class="form-control" placeholder="Podaj nową kwotę">
                    <div class="input-group-prepend ">
                    <span class="input-group-text " id="amountIncome"><i class="fas fa-pen-alt"></i></span>
                    </div>
                </div>
                
                        
                        
                <div class="col-12 col-sm-8 mb-2 input-group ">	
                    <input type="date" class="form-control" id="date" placeholder="Data">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
                    </div>
                </div>
                
    
                <div class="col-12 col-sm-8 mb-2 input-group ">
                    <select class="custom-select setIncomeCategories" id="category">
                    </select>
                    <div class="input-group-prepend ">
                        <span class="input-group-text " id="categoriesIncome"><i class="fas fa-pen-alt "></i></span>
                    </div>
                </div>
                
                <div class=" col-12 col-sm-8 mb-2 input-group">
                    <input type="text" class="form-control" placeholder="Komentarz (opcjonalnie)">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
                    </div>
                </div>
                <div class="col-6 offset-3 mt-2 mt-sm-0 col-sm-4 offset-sm-0">
                    <button type="submit" class="btn text-white btnChangeIncome btnSave" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-plus"></i> Zapisz</button>
                </div>
                
                
            </form>
            
            <div class="row incomeUser mt-4 mb-3">	
                <label for="settingsIncomeCategorySelect" class="col-sm-2 col-md-3 col-lg-2">Kategorie</label>
                <div class="col-10 col-sm-8 col-md-7 col-lg-8">	
                    <select class="custom-select setIncomeCategories" id="settingsIncomeCategorySelect">
                        
                    </select>
                </div>
                
                <div class="col-1 pl-1 pl-sm-3">
                    <a href="#" id="addCategoryIncomeLink" title="Dodaj"><i class="fas fa-plus"></i></a>
                </div>
                <div class="col-1">
                    <a href="#" id="deleteCategoryIncomeLink" title="Usuń" class="linkDelete" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
            <form class="row incomeUser hideItem" id="addCategoryIncome">
                <div class=" col-12 col-sm-8 mb-2 input-group">
                    <input type="text" class="form-control" placeholder="Podaj nową kategorię">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
                    </div>
                </div>
                <div class="col-6 offset-3 mt-2 mt-sm-0 col-sm-4 offset-sm-0">
                    <button type="submit" class="btn text-white btnAddCategoryIncome btnSave" data-toggle="modal" data-target="#settingsModal"><i class="fas fa-plus"></i> Zapisz</button>
                </div>
            </form>
            
        </div>
    </div>
</div>