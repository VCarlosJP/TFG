//This var will containt all the tables selected on the first(current) view
selectedTables = new Array();

$('.toast').toast('show');

//Get current database name to be loaded in a <select>
$.get( "/getDB", function( response ) {
    $('#database-names-select').append(`<option>${response}</option>`);
});

//This function makes two things when a user selects a database name:
//1. It changes the color of the "Choose Tables From Data Base" title to show to the user that now it is available
//2. It calls the the callForTables Function

$('#database-names-select').change(function() {
    dbName = $(this).val();
    $('#display-selected-table-name').css("color", "");
    callForTables();
});

//This function makes a request to get all the tables name from the selected database.
//Then it loads them in to a list.
function callForTables(){
    $.get( `/getTablesName`, function( tables_from_response ) {
        for(var currentTable=0; currentTable<tables_from_response.length; currentTable++){
            $('#tables-list-container').append(
                `
                <button class="list-group-item list-group-item-action" id="t${[currentTable]}" onclick="pushToResumeTable(this);">${tables_from_response[currentTable]}</button>
                `
            );
        }
    });
}

//This function adds the clicked table from the previous table list, into the resume table
//and removes the table if it is already placed on the resume.
//It also checks bootstrap´s active class to notice users when the table is in or out.  
function pushToResumeTable(selected_table_id){
    if($(selected_table_id).hasClass("active")){
        $(selected_table_id).removeClass( "active");
        selectedTables.splice($.inArray($(selected_table_id)[0]['innerText'], selectedTables),1);
        $("#table-body-of-resume-table").empty();
        insertIntoResumeTable();
    }
    else{
        $(selected_table_id).addClass("active");
        selectedTables.push($(selected_table_id)[0]['innerText']);
        $("#table-body-of-resume-table").empty();
        insertIntoResumeTable();
    }
}

//It renders all the data from selectedTables Array into the tableBody of the resume table
function insertIntoResumeTable(){
    selectedTables.forEach((table, tableNumber)=>{
        $('#table-body-of-resume-table').append(
            `
            <tr>
                <th>${tableNumber+1}</th>
                <td>${table}</td>
            </tr>
            `
        );
    });

    nextPageButtonStatus();
}

//This functions helps to denied the access of the next routes if the user has not mark any table
function nextPageButtonStatus(){
    if(selectedTables.length != 0)
        $('#nextPage').removeClass( "disabled");
    else
        $('#nextPage').addClass("disabled");
}

//When all the selection it is done, the function submits the data for creating the hashColumns and the Views
function postSelectedTables(){
    db = 'db1';
    tables = selectedTables;
    data = {db, tables};

    $('#post-tables-form [name="Data"]').val(JSON.stringify(data));
    $('#post-tables-form').submit();
}