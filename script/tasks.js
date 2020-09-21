$(".task-new-panel-toggler").on('click', function() {
    $('button.task-new-panel-toggler').toggleClass('task-panel-toggler-active');
    $('.task-new-panel-right').toggleClass('task-new-panel-right-active');

    // fetchPaymentMethod(".task-new-panel-right");
});

$("#add-new-client-form").submit(function(e) {
    e.preventDefault();
    let form = $(this);
    $.ajax({
        url: 'controllers/create_client.php',
        method: 'POST',
        data: form.serialize(),
        success: function(data) {
            console.log("Użytkownik dodany");
            $("#add-new-client-form").closest('form').find("input[type=text], textarea").val("");
        },
        error: function(data) {
            console.log("error");
            console.log(data);
        } 
    })
});
$("#add-new-task-form").submit(function(e) {
    e.preventDefault();
    let form = $(this);
    let prepareData = form.serializeArray()

    let dataClientValue = $('#new-task-client-select').val();
    let dataClientId = $("datalist#new-task-client-select-list").find('[value="'+dataClientValue+'"]').data('client-id');
    let dataPaymentValue = $('#new-task-payment').val();
    let dataPaymentId = $("datalist#new-task-payment-list").find('[value="'+dataPaymentValue+'"]').data('payment-id');
    let dataFinalizationValue = $('#new-task-finalize').val();
    let dataFinalizationId = $("datalist#new-task-finalize-list").find('[value="'+dataFinalizationValue+'"]').data('finalization-id');
    
    // prepareData.push({clientId: dataClientId, paymentMethod: dataPaymentId, finalization: dataFinalizationId});
    prepareData.push({name: 'clientId', value: dataClientId},{name: 'paymentMethod', value: dataPaymentId},{name: 'finalization', value: dataFinalizationId});

    console.log(dataClientId);
    console.log(dataPaymentId);
    console.log(dataPaymentValue);
    console.log(dataFinalizationId);
    console.log(dataFinalizationValue);
    

    $.ajax({
        url: 'controllers/create_task.php',
        method: 'POST',
        data: prepareData,
        success: function(back) {
            // console.log("Zadanie dodane");
            console.log(back);
            // $("#add-new-task-form").closest('form').find("input[type=checkbox]").prop('checked', false).prop('selected', false);
            // $("#add-new-task-form").closest('form').find("input[type=text], textarea").val("");

            // fetchTasks();
        },
        error: function(data) {
            console.log("error");
            console.log(data);
        } 
    })
});




const fetchPaymentMethod = (placeWhereToGetValues) => {
    $.ajax({
        url: "controllers/fetch_payment_method.php",
        method: "POST",
        dataType: "json",
        success: function (payment) {
            let pmPatern = ""
            // console.log(placeWhereToGetValues);
            payment.forEach(paymentMethod => {
                pmId = paymentMethod.id;
                pmName = paymentMethod.payment_method_name;

                const pmOption = $(`<option data-payment-id="${pmId}" value="${pmName}">`);

                pmPatern += pmName + "|";

                $('#new-task-payment-list').append(pmOption);

            })
            $('#new-task-payment').attr('pattern', pmPatern);
        }
    })
}
const fetchPassMethod = (placeWhereToGetValues) => {
    $.ajax({
        url: "controllers/fetch_pass_method.php",
        method: "POST",
        dataType: "json",
        success: function (finalize) {
            let finalizePatern = ""
            finalize.forEach(finalizeMethod => {
                finalizeId = finalizeMethod.id;
                finalizeName = finalizeMethod.pass_method_name;

                const finalizeOption = $(`<option data-finalization-id="${finalizeId}" value="${finalizeName}">`);

                finalizePatern += finalizeName + "|";

                $('#new-task-finalize-list').append(finalizeOption);

            })
            $('#new-task-finalize').attr('pattern', finalizePatern);
        }
    })
}

const fetchStaff = () => {
    $.ajax({
        url: "controllers/fetch_staff.php",
        method: "POST",
        dataType: "json",
        success: function (staff) {

            staff.forEach(person => {

                staffId = person.id;
                staffFirstName = person.first_name;
                staffLastName = person.last_name;
                staffInitials = person.user_initials;

                createLabel = $(`
                <label class="checkbox path">
                    <input type="checkbox" name="new-task-assigned_staff[]" id="new-task-assigned_staff-${staffId}" value="${staffId}">
                    ${staffFirstName} ${staffLastName}
                        <svg viewBox="0 0 21 21">
                            <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186">
                            </path>
                        </svg>
                </label>`
                );
                $('.new-task-assigned-staff').append(createLabel)

            })
            
        }
    })
}
const fetchClients = (placeWhereToGetValues) => {
    $.ajax({
        url: "controllers/fetch_clients.php",
        method: "POST",
        dataType: "json",
        success: function (clients) {

            clients.forEach(client => {

                clientId = client.id;
                clientFirstName = client.first_name;
                clientLastName = client.last_name;
                clientCompany = client.company_name;

                clientListOption = $(`<option data-client-id="${clientId}" value="${clientFirstName !== ''? clientFirstName:''} ${clientLastName !== ''? clientLastName : ''} ${clientCompany !== ''? clientCompany : ''}"></option>`)

                $("#new-task-client-select-list").append(clientListOption);

            })
            
        }
    })
}
fetchClients();

const taskStatusUpdate = (taskId, taskStatusId) => {
    $.ajax({
        url: "controllers/task_status_update.php",
        method: "POST",
        dataType: "json",
        data: {task_id: taskId, new_status_id: taskStatusId},
    })
}

const fetchTasks = () => {
    $.ajax({
        url: "controllers/fetch_tasks.php",
        method: "POST",
        dataType: "json",
        success: function (tasks) {
            console.log(tasks);
            
            tasks[0].forEach(task => {
                
                const taskId = task.id;
                // const taskAction = ;
                const taskName = task.task_name;
                const taskClient = task.task_client;
                const taskCreateDate = task.task_create_date;
                const taskRealisationDate = task.task_realisation_date;
                const taskAssignedEmployee = task.assigned_staff;
                const taskStatusName = task.status_name;
                const taskStatusColor = task.status_color;
                let taskNotes = task.task_note;
                
                
                let staff_array = taskAssignedEmployee.split(',');
                
                let thisTaskStaff = ""
                staff_array.forEach(employee => {
                    if(employee) {
                        thisTaskStaff += `<span class="assigned-staff-person">${tasks[1][employee-1].pic ? '<img src="'+tasks[1][employee-1].pic+'">' : tasks[1][employee-1].user_initials}</span> `; 
                    }
                    
                })
                if (taskAssignedEmployee.length < 5) {
                    thisTaskStaff += `<span class="assigned-staff-person"><i class="material-icons">add_circle_outline</i></span>`;
                }
                
                let assignStaffList = ``;
                tasks[1].forEach(staff => {
                    assignStaffList += `<span class="assigned-staff-person">${staff.pic ? '<img src="'+staff.pic+'">' : staff.user_initials}</span>`;
                })
                
                let taskNotesShort = "";
                
                if (taskNotes.length > 39) {
                    taskNotesShort = taskNotes.substring(0,40) + "...";
                } else {
                    taskNotesShort = taskNotes;
                }
                
                const tableObject = $('#task-list-table');

                const createTr = $(`<tr data-task-id="${taskId}"></tr>`).addClass('task-row');
                
                tableObject.append(createTr);

                let statusList = '';

                tasks[2].forEach(status => {
                    statusList += `<a style="color: #${status.status_color};" data-task-status-id="${status.id}">${status.status_name}</a>`;
                })

                const thisTr =  $(`tr[data-task-id='${taskId}']`);
                thisTr.append(`<td class="action-column">
                                    <i class="material-icons task-edit-button" data-task-id="${taskId}">edit</i>
                                    <i class="material-icons task-delete-button" data-task-id="${taskId}">delete_forever</i>
                                    <i class="material-icons task-info-button" data-task-id="${taskId}">info</i>
                                </td>`);
                thisTr.append(`<td class="table-cell-task-name">
                                    <span class="task-name">${taskName}</span>
                                    <span class="task-client-name">
                                        <a href="client.php?client_id=${taskClient}">${task.first_name} ${task.last_name && task.company_name ? task.last_name + ' - ' : task.last_name} ${task.company_name}
                                    </span>
                                </td>`);
                thisTr.append(`<td>${taskCreateDate}</td>`);
                thisTr.append(`<td>${taskRealisationDate}</td>`);
                
                thisTr.append(`<td class="assigned-staff">${thisTaskStaff}<div class="assign-staff-box">${assignStaffList}</div></td>`);
                thisTr.append(`<td class="task-status">
                                <div class="dropdown-status">
                                    <button style="color: #${taskStatusColor};">
                                        ${taskStatusName}
                                    </button>
                                    <div class="dropdown-list">
                                      ${statusList}
                                    </div>
                                  </div>
                                </td>`);
                thisTr.append(`<td class="task-note">${taskNotes ? '<div class="long-note-box">'+taskNotes+'</div>':'<div class="note-no-data">(Brak notatki)</div>'}${taskNotesShort}</td>`);
            });
            paginate.init('#task-list-table', options, filterOptions);
        }
    })
};

fetchStaff();
fetchPaymentMethod();
fetchPassMethod();
fetchTasks();


$("table").on('click', '.task-delete-button', function() {
    taskId = $(this).data('task-id');
    if(confirm(`Jesteś pewien, że chcesz usunąć zadanie numer ${taskId}`)) {
        $.ajax({
            url: 'controllers/delete_task.php',
            method: 'POST',
            data: {task_id:taskId},
            success: function () {
                $(`tr[data-task-id=${taskId}]`).remove();
            }
        })
    }
});

$("table").on('click', '.task-edit-button', function() {
    taskId = $(this).data('task-id');

        $.ajax({
            url: 'controllers/edit_task.php',
            method: 'POST',
            data: {taskToEdit:taskId},
            success: function (data) {
                // $(`tr[data-task-id=${taskId}]`).
                console.log(data);

            }
        })
});

$("table").on('click', '.dropdown-list > a', function() {
    taskId = $(this).closest("tr").data('task-id');
    taskStatusId = $(this).data('task-status-id');

    const statusName = $(this).text();
    const statusColor = $(this).css('color');

    console.log(statusColor);

    $(this).parent().siblings('button').css('color', statusColor).text(statusName);

    
    $(this).parent().slideToggle('fast');
    taskStatusUpdate(taskId, taskStatusId);

});

$("table").on('click', '.task-status > .dropdown-status > button', function() {

    $(this).siblings('.dropdown-list').slideToggle('fast');

});




let options = {
    numberPerPage:15,
    constNumberPerPage:10,
    numberOfPages:0,
    goBar:false,
    pageCounter:true,
    hasPagination:true,
};

let filterOptions = {
    el:'#searchBox'
};

window.onscroll = function() {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        $(".task-new-panel-toggler").css('opacity', 0.1);
    } else {
        $(".task-new-panel-toggler").css('opacity', 1);
    }
};
