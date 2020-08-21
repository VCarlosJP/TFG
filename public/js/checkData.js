        
        var selected_table = '';
        var current_column = '';
        var current_rule = '';

        var request_data = [0,0,[],[],[]];

        var active_rules = [];
        var column_type = '';


        //This function renders all the columns corresponding to the selected table by the user
        function displayColumnsFromClickedTable(clicked_table_name){
            resetData();
            selected_table = clicked_table_name;
            tables[selected_table].forEach(function(column_name){
                $('#columns-container').append(`<button class="list-group-item list-group-item-action selectColumn" id="${column_name}" onclick="getRulesFromClickedColumn(this.id)" >${column_name}</button>`);
            });
        }

        //This function renders all the columns corresponding to the selected table by the user
        function getRulesFromClickedColumn(column_name){

            current_column = column_name;
            ColumnsAndRulesAvailability();
            document.getElementById(column_name).classList.add("active");
            getColumnType();

        }

        /**
         * This function calls a route for checking the datatype of the column selected by the user.
         * Depending on the type received, it calls renderRules with the parameters needed for each type.
         * 
         * The boolean parameter indicates wether is neccesary to use a checkbox or not.
         */
        function getColumnType(){
            $.ajax({ url: `/getColumnType`,
                type: 'get',
                contentType: 'application/json',
                data: JSON.stringify({ "columnName": current_column, "tableName": selected_table } ),
                processData: false,
                success: function( data, textStatus, jQxhr ){ 

                    if (data.match(/varchar.*/)) {
                        renderRules(ruleOptionsVarchar, symbolsVarchar, true)
                        column_type = "varchar";
                    }
                    else if (data.match(/int.*/)) {
                        renderRules(ruleOptionsInt, symbolsInt, false)
                        column_type = "int";
                    }
                },
                error: function( jqXhr, textStatus, errorThrown ){ console.log( errorThrown ); } 
          });
        }

        //The function loads all the rules available for the column.
        function renderRules(rules, operator, checkbox_marked){
            rules.forEach(function(rule_option, i){
                $('#rule-options').append(`<button data-toggle="modal" data-target="#exampleModal" class="list-group-item list-group-item-action rules" id="${operator[i]}" onclick="getRuleOperatorName(this.id)">${rule_option}</button>`);
            });

            if(checkbox_marked){
                $('#mayus').append(`<div class="form-check"><input type="checkbox" class="form-check-input" id="exampleCheck1"><label class="form-check-label" for="exampleCheck1">Mayus Sensitive</label></div>`);
            }
        }

        //It gets the id of the clicked rule, for knowing the name of the current rule.
        function getRuleOperatorName(operator_name){
            current_rule = operator_name;
        }

        //User ends with a modal, filling all the inputs for filtering the data. This function fills an array with all that data for send it when user is ready.
        function applyRule(){

            var value_to_validate = $('#input-to-operate').val();

            request_data[0] = selected_table;
            request_data[1] = current_column;
            request_data[2].push(value_to_validate);
            request_data[3].push(current_rule);

            if(column_type == "varchar"){
                if (document.getElementById('exampleCheck1').checked == true){
                    request_data[4].push(true);
                  } else {
                    request_data[4].push(false);
                  }
            }

            active_rules.push(current_rule);
            
            document.getElementById(current_rule).classList.add("active");
            document.getElementById(current_rule).disabled = true;
            document.getElementById("request-selected-rules-button").disabled = false;

        }

        //Depending on the previous column type, performs a certain action on a hidden form for retrieve the filtered data.
        function sendRules(){
                
                data = request_data;
                if(column_type == "varchar")
                    document.getElementById('post-rules').action = '/postCheckDataVarchar';
                else
                    document.getElementById('post-rules').action = '/postCheckData';

                $('#post-rules [name="Data"]').val(JSON.stringify(data));
                $('#post-rules').submit();
  
        }

        //Disables the columns and enables the rules, each time a user clicks on a new table
        function ColumnsAndRulesAvailability(){
            var columns_to_disable = document.getElementsByClassName("selectColumn");
            for(var i =0; i<columns_to_disable.length; i++){
                columns_to_disable[i].disabled = true;
            }

            var activate_rules = document.getElementsByClassName("rules");
            for(var i =0; i<activate_rules.length; i++){
                activate_rules[i].disabled = false;
            }
        }

        //clears the request_data array and the GUI each time a user clicks on a new table
        function resetData(){
            document.getElementById("request-selected-rules-button").disabled = true;

            current_column = '';
            current_rule = '';

            $("#columns-container").empty();
            $("#selected-table-heading").empty();
            $("#rule-options").empty();
            $('#mayus').empty();

            request_data[0] = 0;
            request_data[1] = 0;
            request_data[2] = [];
            request_data[3] = [];
            request_data[4] = [];

            // if(active_rules.length!=null){
            //     active_rules.forEach(activeRule =>
            //         document.getElementById(activeRule).classList.remove("active"));
            // }
        }