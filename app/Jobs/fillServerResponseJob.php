<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class fillServerResponseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    // protected $inicio;
    // protected $fin;

    
    protected $data;
    protected $dbName;
    protected $tables;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    // public function __construct($inicio, $fin, $tables, $columnNames)
    // {
    //     $this->inicio = $inicio;
    //     $this->fin = $fin;
    //     $this->tables = $tables;
    //     $this->columnNames = $columnNames;

    // }

        public function __construct($data, $dbName, $tables)
    {
        $this->data = $data;
        $this->dbName = $dbName;
        $this->tables = $tables;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //$this->generateTestData($this->data, $this->dbName, $this->tables);

        $Objects = $this->data[$this->dbName[0]][$this->tables[0]];

            for($i=1; $i<=1000; $i+=5){
                DB::table('example_test')
                    ->insert([$Objects['obj'.$i], $Objects['obj'.($i+1)], $Objects['obj'.($i+2)], $Objects['obj'.($i+3)], $Objects['obj'.($i+4)]]  
                );
            }
    }


}