/* eslint-disable no-unused-vars */
class ResourceEditController{
    constructor(API,$stateParams,$window,GoogleMapsWrapperService,$log,$uibModal,$timeout,
                $scope,moment,_,$state,$q,$sce){
        'ngInject';

        //
        this.API = API;
        this.log = $log;
        this.window = $window;
        this.$uibModal = $uibModal;
        this.$state=$state;
        this.$scope = $scope;
        this.$sce =  $sce;
        this.$timeout=$timeout;
        this.$q =  $q;
        this.moment = moment;
        this._ = _;
        this.$stateParams = $stateParams;
        this.GoogleMapsWrapperService =GoogleMapsWrapperService;



        this.conventionCompletion();

        let params = {
            _includes : this.includes
        };
        var that = this;
        this.resource = {};
        this.related_data = {};
        this.related_data_save = {};
        this.resource_loaded = false;
        this.action_label = 'create';
        this.is_create = true;
        if(this.$stateParams.resource_id){
            this.action_label = 'update';
            this.is_create = false;
            this.API.one(this.api,this.$stateParams.resource_id).get(params).then((data)=>{
                this.resource = data;
                this.resource_save = this._.clone(data.plain());
                this.resource_loaded = true;
                this.main = [];
                this.foreign_data = [];
                this.relatedthrough_data = [];

                this._.forEach(data.plain(),(val,key)=>{
                    if(this._.has(this.mainconf,key)&& this.mainconf[key].type==='checkbox'){
                        this.resource[key] = this.resource[key] == 1 ? 1 : 0;
                    }else if(this._.has(this.mainconf,key)&& this.mainconf[key].type==='time'){
                        this.resource[key] =  this.moment(this.resource[key].date);
                    }else if(this._.has(this.mainconf,key)&& this.mainconf[key].type==='pdf'){
                        this.trustSrc(this.resource[key],key);
                    }
                    if(this._.isArray(val)){
                        if(this._.has(this.relatedconf,key)){

                            this.related_data[key] = [];

                            this._.forEach(val,(v)=>{
                                if(this.relatedconf[key].key&&this.relatedconf[key].key.split('.').length>1){
                                    v[this.relatedconf[key].key]= that.resolve(v,that.relatedconf[key].key);
                                }
                                if(this.relatedconf[key].display_key&&this.relatedconf[key].display_key.split('.').length>1){
                                    v[this.relatedconf[key].display_key]= that.resolve(v,that.relatedconf[key].display_key);
                                }
                                v[that.relatedconf[key].label] = that.resolve(v,that.relatedconf[key].label);
                                that.related_data[key].push(v);
                            })

                        }

                    }
                    else if(this._.isObject(val)){
                        if(this._.has(this.foreignconf,key)){
                            this.foreignconf[key].objet = val;
                        }
                        this.foreign_data.push(val)
                    }
                    else{
                        let ism = false;
                        if(this.images)
                            ism = this.images.indexOf(key)>-1;

                        let isf= false;
                        //let isfil= false;
                        let f = null;
                        if(this._.has(that.foreignconf,key)){
                            isf = true;
                            f = that.foreignconf[key];
                            f.objet= data[f.objet];

                        }
                        if(this._.has(that.filesconf,key)){
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

                this.resource_save = this._.clone(data.plain());
                this.related_data_save = this._.cloneDeep(this.related_data);


            });

        }else{
            this.resource_loaded = true;

        }
    }

    $onInit(){
    }
    conventionCompletion(){
        this.api = this.api ? this.api : this.name+'s';
        this.label = this.label ? this.label : this.name;
        this.state = this.state ? this.state : 'app.'+this.name+'_details';
        this.detailstate = this.detailstate ? this.detailstate : 'app.'+this.name+'_details';
        this.liststate = this.liststate ? this.liststate : 'app.'+this.name;
        this.addstate = this.addstate ? this.addstate : this.$state.current.name;

        // map config
        this.lazyLoadUrl = this.GoogleMapsWrapperService.lazyLoadUrl();
        this.lazyLoadParams = this.GoogleMapsWrapperService.lazyLoadParams();
        this.mapZoom = this.GoogleMapsWrapperService.defaultZoom();

    }

     pinClicked(event,lat_lab,lng_lab,that) {

        //HOW CAN I GET THE MARKER OBJECT (The one that was clicked) HERE?
       //  if(event.latLng){

             let $log = that.log;
             let map = this;

            // $log.info(this)
             var modalInstance = that.$uibModal.open({
                 animation: true,
                 templateUrl: 'mapPositionModalContent.html',
                 controller: that.modalcontroller,
                 controllerAs: 'mvm',
                 size: 'md',
                 resolve: {
                     pos: () => {
                         return  {
                             new :{
                                 lat :event.latLng.lat(),
                                 lng :event.latLng.lng()
                             },
                             old : {
                                 lat :that.resource[lat_lab],
                                 lng :that.resource[lng_lab]
                             }
                         }
                     }
                 }
             })

             modalInstance.result.then((ans) => {
                 if(ans==='ok'){
                     that.resource[lat_lab] = event.latLng.lat();
                     that.resource[lng_lab] = event.latLng.lng();

                 }
             }, () => {
                 $log.info('Modal dismissed at: ' + new Date())
             })

        // }

    }

    foreign_handler (typstr){

        let foreignconf = this.$parent.field_conf;
        let params = {
            should_paginate : false
        };

        let fof = foreignconf.search_field.split('.');
        if(fof.length===2){
            params[fof[0]+'-fk']=fof[1]+'-lk='+typstr;
        }else{
            params[foreignconf.search_field+'-lk']=typstr;
        }
        if(foreignconf.api_includes)
            params['_includes']=foreignconf.api_includes;
        let that = this.$parent.$parent.vm;

         return that.API.all(foreignconf.api).getList(params);
    }

    selecteObject(obj, conf){
        let that = this.$parent.$parent.vm;
        if(obj)
        that.resource[conf.model]= obj.originalObject[conf.key];
    }
    modalcontroller ($scope, $uibModalInstance, pos) {
        'ngInject';

        this.pos = pos;


        this.ok = () => {
            $uibModalInstance.close('ok')
        }

        this.cancel = () => {
            $uibModalInstance.dismiss('cancel')
        }
    }

    save(){
        let that = this;
        if(this.is_create){
            this.resource = this.cleanResource(this.resource);
            if(this.hasFile(this.resource)){
                let fd = new FormData();

                let headers = {
                    'Content-Type': undefined,
                    'Accept': 'application/x.laravel.v1+json'
                }


                this.API.setDefaultHeaders(headers)
                this._.forEach(this.resource,(val,key)=>{
                    if(this.mainconf[key]&&this.mainconf[key].type=='image'){
                        fd.append(key, this.base64toBlob(val),key+'.png');
                    }else{
                        fd.append(key, val);
                    }
                });
                this.API.one(this.api)
                    .withHttpConfig({transformRequest: angular.identity})
                    .customPOST(fd, '', undefined, headers).then( (data)=> {
                    that.resource.id = data.id

                    let tp = that.syncRelated();
                    this.$q.all(tp).then(()=>{
                        that.$state.go(that.detailstate,{resource_id : that.resource.id});
                    })

                },(err)=>{
                    let data = err.data;
                    if(data.errors)
                        this.errors = data.errors;
                });
            }
            else{
                let headers = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/x.laravel.v1+json'
                };
                this.API.setDefaultHeaders(headers)
                this.API.all(this.api).post(this.resource).then( (data)=> {
                    that.resource.id = data.id
                    let tp = that.syncRelated();
                    this.$q.all(tp).then(()=>{
                        that.$state.go(that.detailstate,{resource_id : that.resource.id});
                    })

                },(err)=>{
                    let data = err.data;
                    if(data.errors)
                        this.errors = data.errors;
                });
            }
        }
        else {
            let diff = this._.reduce(this.mainconf, function(result, value, key) {
                if(value.type==='coordonate'){
                    if(!that._.isEqual(that.resource_save[value.latitude_field], that.resource[value.latitude_field])) {
                        result[value.latitude_field] = that.resource[value.latitude_field];
                    }
                    if(!that._.isEqual(that.resource_save[value.longitude_field], that.resource[value.longitude_field])) {
                        result[value.longitude_field] = that.resource[value.longitude_field];
                    }
                }else{
                    if(!that._.isEqual(that.resource_save[key], that.resource[key])) {
                        result[key] = that.resource[key];
                    }
                }

                return result ;
            }, {});

            if(this.hasFile(diff)){
                let fd = new FormData();
                let headers = {
                    'Content-Type': undefined,
                    'Accept': 'application/x.laravel.v1+json'
                }
                this.API.setDefaultHeaders(headers)
                fd.append('_method', 'PUT');
                this._.forEach(diff,(val,key)=>{
                    if(this.mainconf[key]&&this.mainconf[key].type=='image'){
                        fd.append(key, this.base64toBlob(val),key+'.png');
                    }else {
                        fd.append(key, val);
                    }
                });

                this.API.one(this.api,this.resource.id)
                    .withHttpConfig({transformRequest: angular.identity})
                    .customPOST(fd, '', undefined, headers).then(()=>{
                    let tp = that.syncRelated();
                    this.$q.all(tp).then(()=>{
                        that.$state.go(that.detailstate,{resource_id : that.resource.id});
                    })

                });

            }
            else{
                // this.resource.put()
                let headers = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/x.laravel.v1+json'
                }
                this.API.setDefaultHeaders(headers)
                this.API.one(this.api,this.resource.id)
                    .customPUT(diff)
                    .then((data)=>{
                    //this.log.info(data)
                    let tp = that.syncRelated();
                    this.$q.all(tp).then(()=>{
                        that.$state.go(that.detailstate,{resource_id : that.resource.id});
                    })

                    },(err)=>{
                    let data = err.data;
                    if(data.errors)
                        this.errors = data.errors;
                });
            }
        }

    }

    syncRelated(){
        let rel_diff = {};
        let proms = [];
        let that = this;
        let headers = {
            'Content-Type': 'application/json',
            'Accept': 'application/x.laravel.v1+json'
        }
        this.API.setDefaultHeaders(headers)
        that._.forEach(this.related_data,(val,key)=>{
            rel_diff[key] = {};
            rel_diff[key].added = that._.differenceWith(this.related_data[key],
                this.related_data_save[key],(a,b)=>{
                    return a.id === b.id;
                });
            rel_diff[key].removed = that._.differenceWith(this.related_data_save[key],
                this.related_data[key],(a,b)=>{
                    return a.id === b.id;
                });

        });
        this._.forEach(rel_diff,(val,key)=>{

            that._.forEach(val.added,(v)=>{
                let p = {};

                p[that.relatedconf[key].pivot_model] = v.id;
                p[that.relatedconf[key].this_pivot_model] = that.resource.id;
               let p1 = that.API.all(that.relatedconf[key].pivot_api).post(p).then((data)=>{
                  // that.log.info(data)
               });
               proms.push(p);
            });
            that._.forEach(val.removed,(v)=>{
                let p = {
                    should_paginate:false
                };


                p[that.relatedconf[key].pivot_model] = v.id;
                p[that.relatedconf[key].this_pivot_model] = that.resource.id;
               /*let p2 =that.API.all(that.relatedconf[key].pivot_api).getList(p).then((data)=>{
                  let p3= data[0].delete().then((data)=>{
                      // that.log.info(data)
                   });
                  proms.push(p3)
               })*/
                let p2 =that.API.one(that.relatedconf[key].pivot_api).remove(p).then((data)=>{

               })

                proms.push(p2);
            });
        });
        return proms;
    }

    cancel(){
        if(this.is_create){
            this.resource = {}
        }else {
            this.resource = this.resource_save;
            this.cancelSync();
        }
    }

    cancelSync(){
        this.related_data = this._.cloneDeep(this.related_data_save);
    }

    loadLoadRelated(query,conf){
        let param = {
            should_paginate:false,
            _includes : conf.api_includes
        };
        let that = this;

        let rof = conf.searched_key.split('.');
        if(rof.length===2){
            param[rof[0]+'-fk']=rof[1]+'-lk='+query;
        }else{
            param[conf.searched_key+'-lk']= query;
        }
        if(conf.display_key.split('.').length>1){
            return this.API.withConfig(function(RestangularConfigurer) {
               RestangularConfigurer.addResponseInterceptor((data,operation, what, url, response, deferred)=>{
                   that._.forEach(data,(d)=>{
                           d[conf.display_key]= that.resolve(d,conf.display_key);
                   })
                   return data;
               })

            }).all(conf.api).getList(param)
        }else{
            return this.API.all(conf.api).getList(param);
        }
    }

    refreshRelated(tag,is_added,key,label){

        /*this.log.info(tag,is_added,key,label,this.related_data)
        if(is_added>0){
            /!*if(this._.isArray(this.related_data[key])){
                this.related_data[key].push(tag)
            }else {
                this.related_data[key]=[tag]
            }*!/
            this.log.info(this.related_data)
        }else {
          /!*  let ind = this._.findIndex(this.related_data[key], { id: tag.id});
            if(ind>-1)
             this.related_data[key].splice(ind,1);*!/
        }*/
    }

    cleanResource(obj){
        this._.forEach(obj,(val,key)=>{

            if(this.mainconf[key]&&this.mainconf[key].type ){
                if(this.mainconf[key].type == 'image'){
                    if(obj[key]==''){
                        delete obj[key];
                    }
                }
            }

        });
       return obj
    }
    hasFile(obj){
        let res = false;
        this._.forEach(obj,(val,key)=>{

           if(this.mainconf[key]&&this.mainconf[key].type ){
               res = res|| this.mainconf[key].type == 'image';
           }

        });
        return res;
    }

    resolve(obj, path) {
        return path.split('.').reduce(function(prev, curr) {
            return prev ? prev[curr] : null
        }, obj || self)
    }

    base64toBlob(base64Data) {
        base64Data = base64Data.split(';')

        let contentType =  '';
        if(base64Data.length>1){
            contentType = base64Data[0].split('data:').join('') || '';
            base64Data = base64Data[1].split('base64,').join('')
        }else {
            base64Data = base64Data[0].split('base64,').join('');
        }


        var sliceSize = 1024;
        var byteCharacters = atob(base64Data);
        var bytesLength = byteCharacters.length;
        var slicesCount = Math.ceil(bytesLength / sliceSize);
        var byteArrays = new Array(slicesCount);

        for (var sliceIndex = 0; sliceIndex < slicesCount; ++sliceIndex) {
            var begin = sliceIndex * sliceSize;
            var end = Math.min(begin + sliceSize, bytesLength);

            var bytes = new Array(end - begin);
            for (var offset = begin, i = 0 ; offset < end; ++i, ++offset) {
                bytes[i] = byteCharacters[offset].charCodeAt(0);
            }
            byteArrays[sliceIndex] = new Uint8Array(bytes);
        }
        let blob = new Blob(byteArrays, { type: contentType });
        blob.name = '';
        return blob;
    }

    onChildrenClicked($event){
        $event.stopPropagation();
    }

    trustSrc(src,key) {

        let that = this;
        if(this._.isObject(src)){
            let p =this.$timeout(()=>{
                // the code you want to run in the next digest
                src = URL.createObjectURL(src);
            }).then(()=>{
                that.resource[key] = that.$sce.trustAsResourceUrl(src);
            });

        }else{
            that.resource[key] = this.$sce.trustAsResourceUrl(src);
        }
    }
}

export const ResourceEditComponent = {
    templateUrl: './views/app/components/resource-edit/resource-edit.component.html',
    controller: ResourceEditController,
    controllerAs: 'vm',
    bindings: {
        api : '<',
        label : '<',
        state : '<',
        addstate : '<',
        detailstate : '<',
        liststate : '<',
        name : '<',
        includes: '<',
        mainconf: '<',
        foreignconf: '<',
        translateroot: '<',
        relatedconf: '<'
    }
};
