<div class="modal fade " id="selectPeriodModal" tabindex="-1" role="dialog" aria-labelledby="selectPeriodModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title ml-4" id="selectPeriodModalLabel">Wybierz zakres 
                    <a data-toggle="popover" data-content="Wpisz daty z przedziału od <?=START_DATE?> do końca bieżącego miesiąca.">
                        <i class="fas fa-info-circle"></i>
                    </a>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index.php?action=setBalance&period=customPeriod" method="post"> 
                    <div class="form-group row pr-5">
                        <label class="col-form-label col-4 text-center" for="dateStart">Od dnia</label>
                        <input type="date" class="form-control col-8" id="dateStart" name="startDate">
                    </div>
                    
                    <div class="form-group row pr-5">	
                        <label class="col-form-label col-4 text-center" for="dateEnd">Do dnia</label>
                        <input type="date" class="form-control col-8" id="dateEnd" placeholder="Data końcowa" name="endDate">
                    </div>
                    
                    <div class="row justify-content-around">
                        <a href="#" class="btn btn-primary col-4" data-dismiss="modal">Anuluj</a>
                        <button type="submit" class="btn btn-primary col-4" id="btnOK" >OK</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>