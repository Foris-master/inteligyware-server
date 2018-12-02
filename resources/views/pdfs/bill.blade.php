<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Factures</title>

    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bill.css') }}" />

</head>
<body>
<div>
    <div class="row-fluid">
        <div class="col-lg-12 col-xs-12 col-sm-12 col-xs-12">
            <div class="col-lg-3 col-sm-3 col-xs-3 col-xs-3">
                <img class="logo" src={{url("img/logo.png")}} alt="">
            </div>
            <div class="col-lg-4 col-sm-4 col-xs-4  col-sm-5 col-lg-offset-4 col-xs-offset-4 col-xs-offset-4 col-xs-offset-4">
                <fieldset class="entete">
                    <legend>CLIENT</legend>
                    <div class="row-fliud clearfix">
                        <div class="col-lg-9 col-sm-9 col-xs-9">{{$user->full_name}}</div>
                    </div>
                    <div class="row-fliud clearfix">
                        <div class="col-lg-9 col-sm-9 col-xs-9">{{$user->phone_number}}</div>
                    </div>
                    <div class="row-fliud clearfix">
                        <div class="col-lg-9 col-sm-9 col-xs-9">{{$user->person->primary_address->name}}</div>
                    </div>
                    <div class="row-fliud clearfix">
                        <div class="col-lg-9 col-sm-9 col-xs-9">{{$user->person->primary_address->town->name}}</div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <h3>Factures</h3>
    <div class="row-fluid" style="margin-top: 10px;">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="col-lg-4 col-sm-4 col-xs-4" >
                <fieldset>
                    <legend>Informations</legend>
                    <div class="row-fliud clearfix">
                        <div class="col-lg-4 col-sm-4 col-xs-4">N°</div>
                        <div class="col-lg-8 col-sm-8 col-xs-8">{{$bill->id}}</div>
                    </div>
                    <div class="row-fliud clearfix">
                        <div class="col-lg-4 col-sm-4 col-xs-4">Date</div>
                        <div class="col-lg-8 col-sm-8 col-xs-8">{{$bill->created_at}}</div>
                    </div>
                    <div class="row-fliud clearfix">
                        <div class="col-lg-4 col-sm-4 col-xs-4">Offer Reference</div>
                        <div class="col-lg-8 col-sm-8 col-xs-8">{{$bill->offer->tag}}</div>
                    </div>

                    <div class="row-fliud clearfix">
                        <div class="col-lg-4 col-sm-4 col-xs-4">Mountant</div>
                        <div class="col-lg-8 col-sm-8 col-xs-8">{{$bill->offer->amount}}</div>
                    </div>
                    <div class="row-fliud clearfix">
                        <div class="col-lg-4 col-sm-4 col-xs-4">Monnaie</div>
                        <div class="col-lg-8 col-sm-8 col-xs-8">{{$bill->offer->from_currency->code .'->'.$bill->offer->to_currency->code}}</div>
                    </div>
                    <div class="row-fliud clearfix">
                        <div class="col-lg-4 col-sm-4 col-xs-4">Beneficier</div>
                        <div class="col-lg-8 col-sm-8 col-xs-8">{{$bill->offer->beneficiary->first_name.' '.$bill->offer->beneficiary->last_name}}</div>
                    </div>
                </fieldset>
            </div>
            <div class="col-lg-8 col-sm-8 col-xs-8">
                <fieldset>
                    <legend>Produits</legend>
                    <div class="scroll-categorie scroll-produit">
                        <div class="row-fluid clearfix" style="border-bottom:1px solid #997f51;">
                            <div class="col-lg-6 col-sm-6 col-xs-6 bold">Libellé</div>
                            <div class="col-lg-1 col-sm-1 col-xs-1 bold text-center">U</div>
                            <div class="col-lg-1 col-sm-1 col-xs-1 bold text-center">Qte</div>
                            <div class="col-lg-4 col-sm-4 col-xs-4 bold text-right">Prix TTC</div>
                        </div>
                        <div class="clearfix"></div>
                        @foreach($bill->bill_items as $bill_item)
                        <div class=" row-fluid clearfix">
                            <div class="col-lg-6 col-sm-6 col-xs-6">{{$bill_item->name}}</div>
                            <div class="col-lg-1 col-sm-1 col-xs-1 text-center">{{$bill_item->amount_oos}}</div>
                            <div class="col-lg-1 col-sm-1 col-xs-1 text-center">{{$bill_item->total_amount}}</div>
                            {{--<div class="col-lg-4 col-sm-4 col-xs-4 text-right">
                                {{ceil($ps->pivot->quantity*$ps->pivot->product_price_was)}} Fcfa
                            </div>--}}
                        </div>
                        @endforeach

                        <div class="produit row-fluid clearfix">
                            <div class="col-lg-6 col-sm-6 col-xs-6 bold">TOTAL HT</div>
                            <div class="col-lg-6 col-sm-6 col-xs-6 text-right">
                                {{($bill->amount-(($bill->amount)*0.1925))}}
                            </div>
                        </div>
                        <div class="row-fluid clearfix">
                            <div class="col-lg-6 col-sm-6 col-xs-6 bold">TVA (19,25%)</div>
                            <div class="col-lg-6 col-sm-6 col-xs-6 text-right">
                                {{($bill->amount/(1-$bill->discount))*0.1925}} Fcfa
                            </div>
                        </div>
                        <div class="row-fluid clearfix">
                            <div class="col-lg-6 col-sm-6 col-xs-6 bold">REMISE ({{$bill->discount*100}}%)</div>
                            <div class="col-lg-6 col-sm-6 col-xs-6 text-right">
                                {{ceil(($bill->amount/(1-$bill->discount))*$bill->discount)}}  Fcfa
                            </div>
                        </div>
                        <div class="row-fluid clearfix">
                            <div class="col-lg-6 col-sm-6 col-xs-6 bold">NET A PAYER</div>
                            <div class="col-lg-6 col-sm-6 col-xs-6 text-right bold">
                                {{ceil($bill->amount)}} Fcfa
                            </div>
                        </div>

                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row-fluid" style="margin-top: 50px;text-align: center;">
        <div class="col-lg-3 col-sm-3 col-xs-3 col-lg-offset-1 col-sm-offset-1 col-xs-offset-1">
            <div class="signature">
                <h5>LA CAISSE</h5>
                @if ($bill->cashier_id)
                    <img class="signature-img" src="{{url($bill->cashier->signature)}}" alt="">
                @endif
            </div>
        </div>

        <div class="col-lg-3 col-sm-3 col-xs-3 col-lg-offset-3 col-sm-offset-3 col-xs-offset-3">
            <div class="signature">
                <h5>LE CLIENT</h5>
                @if ($bill->status=='paided' || $bill->status=='waiting_cashier_approval')
                    <div class="customer-approved-text">
                        <br>
                        <h6>Approuve par le client le :</h6>
                        <span class="approved-date">{{$bill->customer_approved_at}}</span>
                    </div>
                @endif
            </div>
        </div>



    </div>

</div>

</body>
</html>