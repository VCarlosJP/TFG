<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class fillBaseTableJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $inicio;

    protected $fin;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($inicio, $fin)
    {
        $this->inicio = $inicio;
        $this->fin = $fin;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        for($i=$this->inicio; $i<$this->fin; $i++){
            DB::table('example')->insert([
                [
                    'col1' => 'exampleTest123',
                    'col2' => 'exampleTest123', 
                    'col3' => 'exampleTest123',  
                    'col4' => 'exampleTest123', 
                    'col5' => 'exampleTest123', 
                    'col6' => 'exampleTest123', 
                    'col7' => 'exampleTest123', 
                    'col8' => 'exampleTest123', 
                    'col9' => 'exampleTest123', 
                    'col10' => 'exampleTest123', 
                    'col11' => 'exampleTest123', 
                    'col12' => 'exampleTest123', 
                    'col13' => 'exampleTest123', 
                    'col14' => 'exampleTest123',
                    
                ],[
                    'col1' => 'exampleTest123',
                    'col2' => 'exampleTest123', 
                    'col3' => 'exampleTest123',  
                    'col4' => 'exampleTest123', 
                    'col5' => 'exampleTest123', 
                    'col6' => 'exampleTest123', 
                    'col7' => 'exampleTest123', 
                    'col8' => 'exampleTest123', 
                    'col9' => 'exampleTest123', 
                    'col10' => 'exampleTest123', 
                    'col11' => 'exampleTest123', 
                    'col12' => 'exampleTest123', 
                    'col13' => 'exampleTest123', 
                    'col14' => 'exampleTest123',
                    
                ],[
                    'col1' => 'exampleTest123',
                    'col2' => 'exampleTest123', 
                    'col3' => 'exampleTest123',  
                    'col4' => 'exampleTest123', 
                    'col5' => 'exampleTest123', 
                    'col6' => 'exampleTest123', 
                    'col7' => 'exampleTest123', 
                    'col8' => 'exampleTest123', 
                    'col9' => 'exampleTest123', 
                    'col10' => 'exampleTest123', 
                    'col11' => 'exampleTest123', 
                    'col12' => 'exampleTest123', 
                    'col13' => 'exampleTest123', 
                    'col14' => 'exampleTest123',
                    
                ],[
                    'col1' => 'exampleTest123',
                    'col2' => 'exampleTest123', 
                    'col3' => 'exampleTest123',  
                    'col4' => 'exampleTest123', 
                    'col5' => 'exampleTest123', 
                    'col6' => 'exampleTest123', 
                    'col7' => 'exampleTest123', 
                    'col8' => 'exampleTest123', 
                    'col9' => 'exampleTest123', 
                    'col10' => 'exampleTest123', 
                    'col11' => 'exampleTest123', 
                    'col12' => 'exampleTest123', 
                    'col13' => 'exampleTest123', 
                    'col14' => 'exampleTest123',
                    
                ],[
                    'col1' => 'exampleTest123',
                    'col2' => 'exampleTest123', 
                    'col3' => 'exampleTest123',  
                    'col4' => 'exampleTest123', 
                    'col5' => 'exampleTest123', 
                    'col6' => 'exampleTest123', 
                    'col7' => 'exampleTest123', 
                    'col8' => 'exampleTest123', 
                    'col9' => 'exampleTest123', 
                    'col10' => 'exampleTest123', 
                    'col11' => 'exampleTest123', 
                    'col12' => 'exampleTest123', 
                    'col13' => 'exampleTest123', 
                    'col14' => 'exampleTest123',
                    
                ]]
            );
    }
}
}