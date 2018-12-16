/*
*calcule le chiffre d affaire et presente sous forme de graphe sur un intervalle de temps donne
 */
class GraphTownTurnoverController {
    constructor(API,_,$q,moment){
        'ngInject';
        //
        this.API = API;
        this._ = _;
        this.$q = $q;
        this.moment = moment;

        this.summary = {};
        this.tag_key = 'code';

        this.barChartSeries=[];
        this.barChartLabels=[];
        this.barChartData=[];
        this.chart_loading = true;
        //this.barChartColours=[];
        //par defaut on affiche le chiffre d affaire du mois courant : oui
        let date = new Date(), y = date.getFullYear(), m = date.getMonth();

        this.from_date_def = this.moment(new Date(y, m , 1)).format('Y-M-D');
        this.to_date_def = this.moment(new Date(y, m+1 , 0)).format('Y-M-D');


       // this.getData()

    }


    getData(deb,fin){
        this.chart_loading = true;
        let date = new Date(), y = date.getFullYear(), m = date.getMonth();
        let firstDay = new Date(y, m, 1);
        let lastDay = new Date(y, m + 1, 1);

       // on convertir les borne en objet momment js
         deb = deb|| this.moment(firstDay);
         fin = fin|| this.moment(lastDay);

       // deb  = this.moment('2017-09-18');
       // fin  = this.moment('2017-09-25');

        // on recupere toutes les salles avec leurs programmation et tickets
        let tparams = {
            should_paginate:false
        };

        this.date_format = 'Y-M-D';

        this.API.all('point_of_sales').getList(tparams).then((data)=>{
            // on recupere toute les salles
            this.point_of_sales=data;
            let objt = {};
            let tprom = [];
            this.barChartSeries=[];


            angular.forEach(data.plain(),(point_of_sale)=>{

                let tmp = {};
                tmp.name = point_of_sale.name;
                //alert("kjl")
                this.barChartSeries.push(point_of_sale.name);
                //tmp.depot_ids = this._.map(town.depots,'id');
                //tin =this._.union(tin,tmp.depot_ids);
                objt[point_of_sale.id] = tmp;
                let bparams = {
                    should_paginate:false,
                   // 'status-in':'2,3',
                    'point_of_sale_service-fk' :'point_of_sale_id='+point_of_sale.id ,
                    'start_at-get':deb.format(this.date_format),
                    'start_at-lt':fin.format(this.date_format),
                     _includes:'point_of_sale_service'
                   // '_agg':'sum|amount'

                }
                let p =this.API.all('transactions').getList(bparams).then((data2)=>{
                    objt[point_of_sale.id].result = data2.plain();
                });
                tprom.push(p);
            })

            this.$q.all(tprom).then(()=>{
                this.fill(deb,fin,objt)
                this.chart_loading = false;
            });

        });

    }
    refreshchart(tag,is_added){

        if(is_added>0){
            this.barChartSeries.push(tag.name)
            this.barChartData.push(this.summary[tag.name])
        }else {
            let ind = this.barChartSeries.indexOf(tag.name);
            this.barChartSeries.splice(ind,1);
            this.barChartData.splice(ind,1);
        }
    }


    loadPointOfSales (query) {
        let p = {
            should_paginate : false,
            'name-lk' : query
        };
        return this.API.all('point_of_sales').getList(p);
    }

    dateChange(){
        let d =this.moment(this.from_date)
        let f= this.moment(this.to_date)
        this.getData(d,f)
    }

    fill(deb,fin,data){
        this.barChartLabels=[];
        this.barChartData=[];
        if(fin.isBefore(deb)){
            let t = deb;
            deb = fin;
            fin = t;
        }
        let ffin = fin.format(this.date_format);
        let cd = deb;
        let fdf = 'Y-M-D';

        while (cd.format(this.date_format)!== ffin){
            this.barChartLabels.push(cd.format(fdf));
            cd.add(1,'days')
        }

        angular.forEach(data,(val,key)=>{
            let d = this._.fill(new Array(this.barChartLabels.length),0);
            angular.forEach(val.result,(obj)=>{
                let j  = this.moment(obj.updated_at);
                let ind = this.barChartLabels.indexOf(j.format(fdf));
                if(ind>-1)
                    d[ind]+=obj.amount;

            });
            this.summary[key] = d;
            this.barChartData.push(d)
        })

    }
    $onInit(){

    }
}

export const GraphTownTurnoverComponent = {
    templateUrl: './views/app/components/graph-town-turnover/graph-town-turnover.component.html',
    controller: GraphTownTurnoverController,
    controllerAs: 'vm',
    bindings: {}
};
