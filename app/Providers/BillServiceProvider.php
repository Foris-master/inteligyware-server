<?php

namespace App\Providers;

use App\Bill;
use App\Helpers\RestHelper;
use App\Jobs\SendBillPaidedMail;
use App\Jobs\SendPreOrderMail;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class BillServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    private $delay = 2;
    public function boot()
    {
        //
        //$this->inform(Event::with((new Event)->getForeign())->first());

        Bill::created(function (Bill $b){
            $this->send_order($b);
        });
        Bill::updated(function (Bill $b){
            $this->send_order($b);

            if(strcmp(strtolower($b->paymentmethod->title),"en compte")==0)
            {
                dd(strtolower($b->paymentmethod->title));
                $this->sync_customer_amount($b);
            }
        });

        Bill::updating(function (Bill $b){
            if($b->status==='waiting_cashier_approval'){
                $b->customer_approved_at = Carbon::now();
            }elseif($b->status==='paided'){
                if($b->customer_approved_at==null){
                    $b->customer_approved_at = Carbon::now();
                }
                if($b->cashier_id==null){
                    if(Auth::check()){
                        $user = Auth::user();
                        $b->cashier_id =$user->cashier->id;
                    }
                }
            }
        });




        /*Bill::creating(function (Bill $b){
            if($b->status==='waiting_customer_approval')
                $this->generatePdf($b);
        });
        Bill::updating(function (Bill $b){
            if($b->status==='waiting_customer_approval')
                $this->generatePdf($b);

        });*/

    }


    private  function send_order(Bill $b){
        if($b->getShouldFireEvent()){
            if($b->status=='waiting_customer_approval'){
                dispatch((new SendPreOrderMail($b))->delay($this->delay));
            }elseif($b->status=='paided'){
                dispatch((new SendBillPaidedMail($b))->delay($this->delay));
            }elseif($b->status=='canceled'){
                $b->bill_product_saletypes()->delete();
            }
        }
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function sync_customer_amount(Bill $b)
    {
        $inds= [
            array_search('paided', Bill::$Status),
            array_search('canceled', Bill::$Status)
        ];
        $c = $b->customer()->first();
        $c->amount = Bill::whereCustomerId($c->id)->whereNotIn('status',$inds)->pluck('amount')->sum();
        $c->save();
    }
}
