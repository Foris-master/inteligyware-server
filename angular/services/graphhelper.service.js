export class GraphhelperService{

    constructor(moment){
        'ngInject';

        //
        this.moment=moment;
        this.date_format = 'Y-M-D';

    }

    getDateFormat(){
        return this.date_format
    }
    getDefaultDates(){
        let date = new Date(), y = date.getFullYear(), m = date.getMonth();
        let firstDay = new Date(y, m, 1);
        let lastDay = new Date(y, m + 1, 1);
        return {
            deb : this.moment(firstDay),
            fin : this.moment(lastDay)
        }
    }
    fill(deb,fin){

        let dd = this.getDefaultDates();


        deb = deb?this.moment(deb): dd.deb;
        fin = fin? this.moment(fin): dd.fin;

        let res = [];
        if(fin.isBefore(deb)){
            let t = deb;
            deb = fin;
            fin = t;
        }
        let ffin = fin.format(this.date_format);
        let cd = deb;
        while (cd.format(this.date_format)!== ffin){
            res.push(cd.format(this.date_format));
            cd.add(1,'days')
        }

        return res

    }
}

