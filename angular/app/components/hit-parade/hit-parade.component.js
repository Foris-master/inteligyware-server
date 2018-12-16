class HitParadeController{
    constructor(API,_,$q,moment,$log,AclService){
        'ngInject';

        //
        this.API = API;
        this.moment = moment;
        this.date_format = 'Y-M-D';
        this.can=AclService.can;
        let j=new Date().getDate();
        let deb =  this.moment(new Date()).add(-j+1, 'days');
        let fin=  this.moment(new Date()).add(1, 'days');
        $log.log(deb.format(this.date_format),fin.format(this.date_format));
        /*:let tparams = {
            'status-in':'2,3',
            'seller_id-gb' : 'sum(amount) as total_amount',
            '_sortDir':'desc',
            'updated_at-get':deb.format(this.date_format),
            'updated_at-lt':fin.format(this.date_format),
            '_includes':'schedules'

        };
        this.API.all('tickets').getList(tparams).then((data)=>{
            this.best = data[0];
            $log.log(data);
        },(q)=>{
            $log.log(q);
        });*/

        // recuperation de la meilleure salle
        let tparams2 = {
            'should_paginate':false,
            'point_of_sale_service-gb':'sum(amount) as amount',
            'updated_at-get':deb.format(this.date_format),
            'updated_at-lt':fin.format(this.date_format),
            '_includes':'point_of_sale_service.point_of_sale'
        };
        this.API.all('transactions').getList(tparams2).then((data)=>{
            let tab=_.groupBy(data,"point_of_sale_service.point_of_sale.name");
            let tmp=[];
            angular.forEach(tab,function(v,k){
                let sum=0;
                angular.forEach(v,function(a,b){
                    sum+=a.amount;
                });
                tmp.push({name:k,sum:sum});
            });

            this.best_point_of_sale=_.max(tmp,'max');

        },(q)=>{
            $log.log(q);
        });

        // recupération du meilleur vendeur le plus vendu
        let tparams3 = {
            'should_paginate':false,
            'updated_at-get':deb.format(this.date_format),
            'updated_at-lt':fin.format(this.date_format),
            '_includes':'user'
        };
        this.API.all('transactions').getList(tparams3).then((data)=>{
            this.transaction_number=data.length;
            angular.forEach(data,function(v,k){
                v.user_name=v.user.full_name;
            });

            let tab=_.groupBy(data,"user_name");

            tab=_.sortBy(tab,"length");
            if(tab.length>0){
                this.best_users = tab[tab.length-1][0];
                // $log.log(this.best_users);
                this.best_users_number=tab[tab.length-1].length;
                /*angular.forEach(data,function(v,k){
                 $log.log(v.total_quantity,v.schedule.film.title);
                 });*/
            }
            else{
                this.best_movies="Aucune ventes pour le mois";
                this.best_movies_number="Aucune ventes pour le mois";
            }

        },(q)=>{
            $log.log(q);
        });

        // recupération du chiffre d'affaire
        let tparams4 = {
            //'status-in':'2,3',
            '_agg' : 'sum|amount',
            'should_paginate':false,
            'updated_at-get':deb.format(this.date_format),
            'updated_at-lt':fin.format(this.date_format)
        };
        this.API.one('transactions').get(tparams4).then((data)=>{
            //$log.log(data);
            this.turnover=data;
        },(q)=>{
            $log.log(q);
        });
    }

    $onInit(){
    }
}

export const HitParadeComponent = {
    templateUrl: './views/app/components/hit-parade/hit-parade.component.html',
    controller: HitParadeController,
    controllerAs: 'vm',
    bindings: {}
};
