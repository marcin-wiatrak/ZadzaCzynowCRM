<div class="new-task-box">
    <h3>Nowe zadanie</h3>
    <form method="POST" id="add-new-task-form" autocomplete="off">

        <input type="text" name="new-task-name" id="new-task-name" placeholder="Nazwa zadania" class="width-full"
            required>

        <input type="text" name="new-task-client-select" list="new-task-client-select-list" id="new-task-client-select"
            placeholder="Wybierz klienta" class="width-full">
        <datalist id="new-task-client-select-list">
            
        </datalist>

        <input type="text" name="new-task-orderedby" id="new-task-orderedby" placeholder="Zamawiający (opcjonalnie)" class="width-full">

        <div class="new-task-assigned-staff"></div>

        <div class="row">
            <input type="text" name="new-task-payment" id="new-task-payment" list="new-task-payment-list"
                placeholder="Płatność" class="width-40">
            <datalist id="new-task-payment-list">
                
            </datalist>

            <input type="text" name="new-task-finalize" id="new-task-finalize" list="new-task-finalize-list"
                placeholder="Finalizacja" class="width-40">
            <datalist id="new-task-finalize-list">
                
            </datalist>
        </div>

        
        <textarea name="new-task-note" id="new-task-note" placeholder="NOTATKI" rows="3" class="width-full"></textarea>
        <div class="row">
            
            <input type="date" name="new-task-realisation-date" id="new-task-realisation-date" value="date.now()" class="width-40">
            <label class="checkbox path width-40">
                <input type="checkbox" name="new-task-priority" id="new-task-priority">
                Oznacz jako pilne
                <svg viewBox="0 0 21 21">
                    <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186">
                    </path>
                </svg>
            </label>
    </div>
        <button type="submit" class="btn btn-primary btn-block">Utwórz zadanie</button>

    </form>
</div>

<div class="new-client-box">
    <h3>Nowy klient</h3>
    <form method="POST" id="add-new-client-form" autocomplete="off">

    <div class="row">
        <input type="text" name="new-client-company-name" id="new-client-company-name" placeholder="Nazwa firmy"
        class="form-control form-control-lg">
        
        <input type="text" name="new-client-nip" id="new-client-nip" placeholder="NIP"
        class="form-control form-control-lg">
    </div>
    <div class="row">
        <input type="text" name="new-client-first-name" id="new-client-first-name" placeholder="Imię"
            class="form-control form-control-lg">

        <input type="text" name="new-client-last-name" id="new-client-last-name" placeholder="Nazwisko"
            class="form-control form-control-lg">
    </div>
    <div class="row">
        <input type="text" name="new-client-email" id="new-client-email" placeholder="E-mail" class="form-control">

        <input type="text" name="new-client-phone-number" id="new-client-phone-number" placeholder="Telefon"
            class="form-control">
    </div>
        <input type="text" name="new-client-allegro-nickname" id="new-client-allegro-nickname"
            placeholder="Nick allegro (opcjonalnie)" class="form-control">

        <button type="submit" class="btn btn-primary btn-block">Utwórz klienta</button>
    </form>

</div>