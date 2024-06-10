<?php

namespace App\Console\Commands;

use App\Models\Tt;
use App\Models\User;
use Illuminate\Console\Command;

class TtGenerate2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tt-generate2 {count?} {date?}';

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
        $date = $this->argument('date');
        $count = $this->argument('count');
        if (!$count){
            $count = 20;
        }
        ini_set('max_execution_time', 600);
        $users = User::select(['number', 'fio'])->get();

        if (!$date){
            $start = date("Y-m-d");
            $end = date("Y-m-d", strtotime("+$count days"));
            $diff = (int)(strtotime($end) - strtotime($start)) / (60 * 60 * 24);
            for($i = 0; $i < $diff; $i++) {
                $date = date("Y-m-d", strtotime("$start + $i days"));
                // shanba yakshanba bo'lsa continue
                if(date('w', strtotime($date)) % 6 == 0){
                    continue;
                }
                foreach ($users as $u) {
                    if ($u->number) {
                        Tt::firstOrCreate([
                            'number' => $u->number,
                            'auth_date' => $date,
                            'track' => Tt::$kirish,
                        ], [
                            'name' => $u->fio,
                            'status' => 0,
                            'arrival_status' => 1,
                        ]);

                        Tt::firstOrCreate([
                            'number' => $u->number,
                            'auth_date' => $date,
                            'track' => Tt::$chiqish,
                        ], [
                            'name' => $u->fio,
                            'status' => 0,
                            'arrival_status' => -1,
                        ]);
                    }
                }
            }
        } else if(!checkdate(substr($date, 5, 2), substr($date, 8, 2), substr($date, 0, 4))) {
            dump("Noto'g'ri sana kiritilgan");
            return 0;
        }
        elseif(date('w', strtotime($date)) % 6 == 0){
            dump("Shanba yoki Yakshanba");
            return 0;
        }

        foreach ($users as $u){
            if($u->number){
                Tt::firstOrCreate([
                    'number' => $u->number,
                    'auth_date' => $date,
                    'track' => Tt::$kirish,
                ],[
                    'name' => $u->fio,
                    'status' => 0,
                    'arrival_status' => 1,
                ]);

                Tt::firstOrCreate([
                    'number' => $u->number,
                    'auth_date' => $date,
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
