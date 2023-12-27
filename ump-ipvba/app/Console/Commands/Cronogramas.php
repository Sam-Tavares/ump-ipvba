<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cronograma;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\CronogramaEmail;

class Cronogramas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'envio:cronogramas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia alertas por e-mail com as programações cadastradas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $crono = Cronograma::all();
        foreach($crono as $c){
            if(date('d/m/Y') == date('d/m/Y', strtotime('-5 days', strtotime($c->data)))){
                $users = User::all();
                foreach($users as $u){
                    Mail::to($u->email )->send(new CronogramaEmail($c));
                }
            }
        }
    }
}
