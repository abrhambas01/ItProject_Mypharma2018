<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Core\Queries\SMSQueries  ;

use App\Core\Services\SMSSender  ;


class SendsReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mypharma:send-sms';

    /**
     * The console command description.
     *
     * @var stringe
     */
    protected $description = 'Send SMS Reminders to every senior citizens every night monthly only.' ; 
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(SMSSender $send)
    {
        //Get all the mobile numbers and senior citizens information for SMS 
        $parcels = Parcel::with('owner')
        ->join('parcel_medicines','parcels.id','=','parcel_medicines.parcel_id')
        ->join('medicines','medicines.id','=','parcel_medicines.medicine_id')
        ->where('delivery_date','=',Carbon::tomorrow())
        ->get();

        
        $value =  $parcels->each( function($parcel ) {

          $owners_name = $item->owner->first_name .' ' .$item->owner->last_name ; 

          $mobile_number =  $item->owner->mobile ; 

          $parcel_items= $item->name .' - ' .$item->qty .' pcs' ; 

          return ['items' => $parcel_items, 'mobile_number'=> $mobile_number] ; 

          Nexmo::message()->send([
            'to'   => $mobile_number , 
            'from'   => '639058185519',
            'text' => 'Dear '.$owners_name.' Please be advised that you will receive your parcel tomorrow which will have the following :'
            ]);

      });
         //Filter all the SMS Recipients and send
        $send->toAllRecipients(recipients) ; 

    }








}
