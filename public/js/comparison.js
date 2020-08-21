
//select element to display tables and button to start comparison are stored as variables
table_select_element = document.getElementById('table-to-work-select');
compare_button_element = document.getElementById('comparison-button');

data_to_filter = {};

//takes the current <option> selected when comparison-button is clicked 
function callComparison(){
    var table_to_work_with = $('#table-to-work-select').find(":selected").text();

    changeElementsStatus(true);
    callHashComparators(table_to_work_with);
}

//While the client is waiting to get a response from the comparison asked, table-to-work-select and
//comparison-button get blocked so user can not perform another request. Also a loading... class is
//implementd to warn the user of what it is happening.
function changeElementsStatus(status){
    if (status){
        table_select_element.disabled = true;
        compare_button_element.disabled = true;
        $("#comparison-button").empty();
        $('#comparison-button').append(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);
    }else{
        table_select_element.disabled = false;
        compare_button_element.disabled = false;
        $("#comparison-button").empty();
        $('#comparison-button').append(`Compare Table`);
    }
}

//Ajax request is performed, for asking differences between local and external data from the table selected  
function callHashComparators(table_to_work_with){
    $.ajax({
        type:'POST',
        headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content')},
        url:'/callHashComparators',
        data:{"_token": $('meta[name="csrf-token"]').attr('content'), "table": table_to_work_with},
        success:function(request_response){
            changeElementsStatus(false);
            renderResponseData(request_response);
        }
    });
}

//the asked request always returns an object with data from both sides. When there is at least one missmathed row,
//the row appears on both sides. We just need one side for checking what to render; If the the taken side contains nothing,
//an "Everything Fine" element is rendered on both table constainers, if not, the failed rows are shown on the containers.
function renderResponseData(tables_differences){

    $('#local-table-container').empty();
    $('#external-table-container').empty();
    $('#columns_buttons').empty();

    if(tables_differences['local-table'].length == 0){
        $('#local-table-container').append('<div id="local-table-status" class="d-flex justify-content-center align-items-center" style="width: 100%; height: 678px;"></div>');
        $('#external-table-container').append('<div id="external-table-status" class="d-flex justify-content-center align-items-center" style="width: 100%; height: 678px;"></div>');
        $('#local-table-status').append(`<h1>Everything Fine</h1>`);
        $('#external-table-status').append(`<h1>Everything Fine</h1>`);
    }
    else{
        data_to_filter = tables_differences;
        generateResponseTable(tables_differences, 'local-table');
        generateResponseTable(tables_differences, 'external-table');
        
        columns_names = Object.keys(tables_differences["external-table"][0]);
        columns_names.forEach(function (column, i) {
            $('#columns_buttons').append(`<button type="button" id="${i+1}" onclick="showHideColumns(this.id)" class="btn btn-light column-button-margin">${ column }</button>`)}
        );

    }
}

function showHideColumns(column_position){
    if($(`th:nth-child(${column_position})`)[0].style.display == 'none'){
        $(`th:nth-child(${column_position})`).css("display", "");
        $(`td:nth-child(${column_position})`).css("display", "");
        $( `#${column_position}`).removeClass( "active" )
    }
    else{
        $(`th:nth-child(${column_position})`).css("display", "none");
        $(`td:nth-child(${column_position})`).css("display", "none");
        $(`#${column_position}`).addClass("active");
    }
}

//This function generates dynamically a table with all the missmatched data returned from the functions above. Then,
//each table is loaded in its specific container(local-table-container and external-table-container).
function generateResponseTable(tables_differences, table_side){
    
    table_data = tables_differences[table_side];
    column_names = Object.keys(table_data[0]);

    $("#"+table_side+"-container").empty();
    
    var table = document.createElement('table');
    var thead = document.createElement('thead');
    var tbdy = document.createElement('tbody');
    var tr = document.createElement('tr');

    table.setAttribute('class', 'table table-striped table-bordered');
    thead.style.background = 'white';
    
    //Thead
    for (let column in column_names) {
        var th = document.createElement('th');
        th.appendChild(document.createTextNode(column_names[column]));
        tr.appendChild(th);
    }

    thead.appendChild(tr);
    table.appendChild(thead);

    //Tbody
    for (var row = 0; row < table_data.length; row++) {
        var tr_tbody = document.createElement('tr');
        for(const column in table_data[row]){
            var td = document.createElement('td');
            td.appendChild(document.createTextNode(table_data[row][column]));
            tr_tbody.appendChild(td);
            tbdy.appendChild(tr_tbody);
        }
    }

    table.appendChild(tbdy);
    $('#'+table_side+"-container").append(table);
}

