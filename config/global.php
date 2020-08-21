<?php
   
return [
    'test_table_standard' => "_test",
    'view_table_standard' => "_view",
    'view_test_table_standard' => "_test_view",
    'hash_satandard' => "HASH_SAT",
    'hash_count_standard' => "HASH_SAT_COUNT",
    'int_rules' => [
    			0=>["mayor que",">"],
    			1=>["menor que","<"],
    			2=>["igual que","="],
    			3=>["diferente de","<>"]

	],
    'varchar_rules' => [
    			0=>["Equal text","0"],
    			1=>["Diferent text","1"],
    			2=>["Include text","2"]

    ]

]	/*
	*
	*	Forma de acceder a las variables globales en cualquier controlador 
	*	config('global.NOMBRE_DE_LA_VARIABLE');
	*
	*/
?>