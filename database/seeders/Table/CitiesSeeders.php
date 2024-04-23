<?php

namespace Database\Seeders\Table;

use App\Models\Cities;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Laravel\Prompts\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\ProgressBar;
use function Laravel\Prompts\error;

class CitiesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = Storage::disk('import')->path('elenco_comuni.csv');
        $dati = explode("\n",file_get_contents($file));
        $console = new ConsoleOutput();
        $progressBar = new ProgressBar($console,count($dati));
        foreach ($dati as $value){
            if(strcmp($value,"") !== 0){
                $row = explode(";",$value) ;
                try{
                    Cities::create([
                        "denominazione" => $row[0],
                        "regione" => $row[1],
                        "provinicia" => $row[2],
                        "codice_catastale" => $row[3]
                    ]);
                }catch (\Exception $e) {
                    error("\n".$e->getMessage());
                }
            }


            $progressBar->advance();
        }
        $progressBar->finish();
    }
}
