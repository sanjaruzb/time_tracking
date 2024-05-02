<?php

namespace App\Console\Commands;

use App\Models\ChangeHours;
use App\Models\User;
use Illuminate\Console\Command;

class ChangeHourCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'changehour {arg}';

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
        $method = $this->argument('arg');
        if (method_exists($this, $method)) {
            $this->$method();
        }
        return 0;
    }

    public function employee()
    {
        $hours = ChangeHours::where('status',1)->where('effective_date','<',date("Y-m-d"))->get();
        foreach ($hours as $hour){
            $hour->user->update(json_decode($hour->shift, true));
            $hour->update([
                'status' => 4
            ]);
        }
    }
}
