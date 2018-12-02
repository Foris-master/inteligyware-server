<?php

namespace App\Jobs;

use App\Bill;
use App\Helpers\RestHelper;
use App\Notifications\OfferNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class GenerateBill implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $bill;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($b)
    {
        //
        $this->bill=$b;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
//        $this->generatePdf($this->bill);
//        Notification::send($this->bill->user,new OfferNotification('offer_closed',$this->bill->offer));
    }


    private function generatePdf(Bill $bill){



        $creation_date = $bill->updated_at;

//        dd($query);
        $user= $bill->offer->user;
        $snappy = App::make('snappy.pdf');
        $html = View::make("pdfs.bill",compact('bill','user'))->render();
        $snappy->setOption('margin-left', 2);
        $snappy->setOption('margin-top', 10);
        $snappy->setOption('margin-right', 2);
        $snappy->setOption('margin-bottom', 10);
        $snappy->setOption('encoding', 'UTF-8');
        $footer = View::make("pdfs.bill_footer",compact('creation_date'))->render();
        $snappy ->setOption('footer-html',$footer);

        $snappy->setOption('encoding', 'UTF-8');

//        $fb = $snappy->generateFromHtml($html,$fname);
//        $fb =  file_get_contents($fname);
        $snappy->setOption('orientation','portrait');
        $fb = $snappy->getOutputFromHtml($html);

        $t=$bill->unique_name();
        $fname2='pdf/bill/'.$t.'.pdf';
        Storage::put(
            $fname2,
            $fb
        );

        $bill->pdf = $fname2;
        $bill->setShouldFireEvent(false);
        $bill->save();
        $bill->setShouldFireEvent(true);

        RestHelper::loge("bill pdf generated for bill ".$bill->getLabel());
    }
}
