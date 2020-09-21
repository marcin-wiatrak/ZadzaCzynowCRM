<div class="edit-task-box">
    <h3>Edytuj zadanie</h3>
    <form method="POST" id="edit-task-form" autocomplete="off">

        <input type="text" name="edit-task-name" id="edit-task-name" placeholder="Nazwa zadania" class="width-full"
            required>

        <input type="text" name="edit-task-client-select" list="new-task-client-select-list" id="edit-task-client-select"
            placeholder="Wybierz klienta" class="width-full">
        <datalist id="new-task-client-select-list">
            
        </datalist>

        <input type="text" name="edit-task-orderedby" id="edit-task-orderedby" placeholder="Zamawiający (opcjonalnie)" class="width-full">

        <div class="row">
            <input type="text" name="edit-task-payment" id="edit-task-payment" list="new-task-payment-list"
                placeholder="Płatność" class="width-40">
            <datalist id="new-task-payment-list">
                
            </datalist>

            <input type="text" name="edit-task-finalize" id="edit-task-finalize" list="new-task-finalize-list"
                placeholder="Finalizacja" class="width-40">
            <datalist id="new-task-finalize-list">
                
            </datalist>
        </div>

        
        <textarea name="edit-task-note" id="edit-task-note" placeholder="NOTATKI" rows="3" class="width-full"></textarea>
        <div class="row">
            
            <input type="date" name="edit-task-realisation-date" id="edit-task-realisation-date" value="date.now()" class="width-40">
        </div>
        <button type="submit">Edytuj zadanie</button>

    </form>
</div>