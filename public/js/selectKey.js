$("#step1").addClass("active");
$("#step2").addClass( "active");
$("#step3").addClass( "active");
$("#step4").removeClass( "active");
        
        // clicked tables from the UI
        var selected_table = '';
        //columns to ignore will be stored here
        var columns_to_ignore = {};
        var checkbox_status = {};

        var table_header = document.getElementById('selected-table-heading');

        fillColumnsToIgnore();
     

        //It fills the object "columns_to_ignore" with the tables name as properties 
        function fillColumnsToIgnore(){
            for(var table=0; table<tables_name.length; table++){
                columns_to_ignore[tables_name[table]] = [];
                checkbox_status[tables_name[table]] = false;
            }
        }



        //When the user clicks on a table, all the columns are appended to the columns_container element as checked.
        //If there were some columns loaded previosly, the function also cleans the container and the heading that displays
        //the name of the current table. 
        function displayColumnsFromClickedTable(clicked_table_name){
            selected_table = clicked_table_name;

            $("#columns-container").empty();
            $("#selected-table-heading").empty();

            table_header.appendChild(document.createTextNode('Columns from '+clicked_table_name));
            
            tables[selected_table].forEach(function(column_name){
                if(columns_to_ignore[selected_table].includes(column_name))
                    $('#columns-container').append(`<div class="inputGroup""><input id="${column_name}" name="column-from-table" type="checkbox" /><label for="${column_name}">${column_name}</label></div>`);
                else
                    $('#columns-container').append(`<div class="inputGroup""><input id="${column_name}" name="column-from-table" type="checkbox" checked /><label for="${column_name}">${column_name}</label></div>`);
            
            });
            
    
            document.getElementById("uncheck-all-columns").disabled = false;

            if(checkbox_status[selected_table]===true){
                $("#uncheck-all-columns").prop("checked", true);
                    
            }
            else
                $("#uncheck-all-columns").prop("checked", false);
            
        }

        //If a user clicks on a column checkbox, the function will add the columns name into the
        //columns_to_ignore object or it will delete it, depending on its current status
        $("#columns-container").on("click", "input", function(event){
            addColumns(this);
        });

        function addColumns(element){
            if(!element.checked)
                columns_to_ignore[selected_table].push(element.id);
            else{
                const index = columns_to_ignore[selected_table].indexOf(element.id);
                columns_to_ignore[selected_table].splice(index, 1);
            }
        }

        //When user clicks the Next Page Button, this function fires the submit of the hidden form from above.
        function postSelectedColumns(){
            console.log(columns_to_ignore);
            $('#post-ignored-tables-form [name="Data"]').val(JSON.stringify(columns_to_ignore));
            $('#post-ignored-tables-form').submit();
        }

        //Executed when a user clicks on "Uncheck all the columns" checkbox.
        $('#uncheck-all-columns').change(function(event) {
            
            if(checkbox_status[selected_table]===false){
                checkbox_status[selected_table]=true;
                uncheckAllColumns();
                addAllColumnsCheckbox();
            }
                
            else{
                checkbox_status[selected_table]=false;
                checkAllColumns();
                removeAllColumnsCheckbox();
            }
               
            
        });

        /**
         * This function it is in case a user only wants to keep a few columns. So, clicking the "Uncheck all the columns" checkbox
         * will uncheck all the columns displayed and it will be easier to the user check the ones that are needed.
         * */
        // function uncheckAllColumns(checkbox_element){
        //     checkboxes = document.getElementsByName("column-from-table");
        //     if(checkboxes.length != 0){
        //         if(checkbox_element.checked){
                    
        //             checkboxes.forEach(function(checkbox){
        //                 checkbox.checked = false;
        //                 if(!columns_to_ignore[selected_table].includes(checkbox.id))
        //                     columns_to_ignore[selected_table].push(checkbox.id);
        //                 });
                       
        //         }else{
        //             checkboxes.forEach(function(checkbox){
        //                 checkbox.checked = true;
        //                 const index = columns_to_ignore[selected_table].indexOf(checkbox.id);
        //                 columns_to_ignore[selected_table].splice(index, 1);
        //             });
        //         }
        //     }
        // }
        function uncheckAllColumns(){
            checkboxes = document.getElementsByName("column-from-table");
            checkboxes.forEach(function(checkbox){
                
                    checkbox.checked = false;
            });
        }

        function checkAllColumns(){
            checkboxes = document.getElementsByName("column-from-table");
            checkboxes.forEach(function(checkbox){
                checkbox.checked = true;
            });
        }

        function addAllColumnsCheckbox(){
            checkboxes = document.getElementsByName("column-from-table");
            columns_to_ignore[selected_table] = [];
            checkboxes.forEach(function(checkbox){
                columns_to_ignore[selected_table].push(checkbox.id);
            });
        }

        function removeAllColumnsCheckbox(){
            checkboxes = document.getElementsByName("column-from-table");
            columns_to_ignore[selected_table] = [];
        }
        

