<?php

namespace App\Console\Commands;

use App\Models\Tt;
use App\Models\User;
use Illuminate\Console\Command;

class TtGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tt-generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('max_execution_time', 600);
        $users = User::select(['number', 'fio'])->get();

        foreach ($users as $u){
            if($u->number){
                Tt::firstOrCreate([
                    'number' => $u->number,
                    'auth_date' => date('Y-m-d'),
                    'track' => Tt::$kirish,
                ],[
                    'name' => $u->fio,
                    'status' => 0,
                    'arrival_status' => 1,
                ]);

                Tt::firstOrCreate([
                    'number' => $u->number,
                    'auth_date' => date('Y-m-d'),
                    'track' => Tt::$chiqish,
                ],[
                    'name' => $u->fio,
                    'status' => 0,
                    'arrival_status' => -1,
                ]);
            }
        }

    }
}
