class ResourceDetailsController{
    constructor(API,$stateParams,$window,_){
        'ngInject';

        //
        this.conventionCompletion();
        this.API = API;
        this.$stateParams = $stateParams;
        this._=_;

        let params = {
            _includes : this.includes
        };
        let that = this;
        this.API.one(this.api,this.$stateParams.resource_id).get(params).then((data)=>{
            this.details = data;
            this.main = [];
            this.foreign_data = [];
            this.related_data = [];
            this.relatedthrough_data = [];
            _.forEach(data.plain(),(val,key)=>{
                if(_.isArray(val)){
                    if(_.has(this.relatedconf,key)){
                        that.related_data.push({
                            name : key,
                            values : val,
                            conf : this.relatedconf[key]
                        })
                    }else if(_.has(this.relatedthroughconf,key)) {
                        that.relatedthrough_data.push({
                            name : key,
                            values : val,
                            conf : this.relatedthroughconf[key]
                        })
                    }

                }
                else if(_.isObject(val)){
                    this.foreign_data.push(val)
                }
                else{
                    let ism = false;
                    if(this.images)
                     ism = this.images.indexOf(key)>-1;

                    let isf= false;
                    //let isfil= false;
                    let f = null;
                    if(_.has(that.foreignconf,key)){
                        isf = true;
                        f = that.foreignconf[key];
                        f.objet= data[f.objet];

                    }
                    if(_.has(that.filesconf,key)){
                       // isfil = true;
                        that.files.push({
                            name : key,
                            conf: that.filesconf[key],
                            value : val
                        });
                        f.objet= data[f.objet];

                    }
                    //key = that.translateroot!==undefined?key: that.translateroot+'.'+key;
                    that.main.push({
                        name: key,
                        value: val,
                        isImage: ism,
                        isForeign: isf,
                        foreign: f
                    })
                }
            })
        });

    }

    conventionCompletion(){
        this.api = this.api ? this.api : this.name+'s';
        this.label = this.label ? this.label : this.name;
        this.state = this.state ? this.state : 'app.'+this.name+'_details';
        this.liststate = this.liststate ? this.liststate : 'app.'+this.name;
        this.editstate = this.editstate ? this.editstate : 'app.'+this.name+'_edit';

    }

    $onInit(){
    }
}

export const ResourceDetailsComponent = {
    templateUrl: './views/app/components/resource-details/resource-details.component.html',
    controller: ResourceDetailsController,
    controllerAs: 'vm',
    bindings: {
        api : '<',
        label : '<',
        state : '<',
        liststate : '<',
        editstate : '<',
        name : '<',
        includes: '<',
        foreignconf: '<',
        translateroot: '<',
        relatedconf: '<',
        relatedthroughconf: '<',
        morphconf: '<',
        images: '<',
        filesconf: '<'

    }
};
