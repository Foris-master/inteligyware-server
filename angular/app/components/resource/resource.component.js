class ResourceController{

    /**
     * Creates the controller for read and delete operations of the vehicle resource.
     *  - Creates the data table
     *  - Creates the filters
     *  - Makes all the necessary api calls
     * @param API
     * @param DTOptionsBuilder
     * @param $log
     * @param _
     * @param $state
     */
    constructor(API, DTOptionsBuilder, DTColumnBuilder , $log, _, $state){
        'ngInject';

        //datatable="ng" dt-options="vm.dtOptions"
        this.API = API;
        this.log = $log;
        this.$state = $state;
        this._ = _;
        this.$log = $log;

        this.conventionCompletion();

        this.selectedPageIndex = 0;
        this.dtInstance = {};
        this.textMaxLength = 20;
        this.currentSearchRequest = {};
        this.currentSearchRequestParams = {};
        this.currentPageNumber = 1;
        this.nextPageNumber = 0;
        this.previousPageNumber = 0;
        this.pages = new Array(1);
        this.maxNumberOfButtons = 10;
        this.rangeForButtons = [];
        this.rangeForSelect = [];

        this.resourceName = this.api;
        this.columnsTitles = this.columnsheaders;
        this.columnsItems = this.columnsitems;
        this.allColumnsItems = this.columnsitems;
        this.filtersLabels = this.columnsfilters || this.columnsItems;
        this.theFilters = this.columnsTitles;


        this.isFilterValueInAnotherTable = {};
        for(let filter in this.columnsItems) {
            this.isFilterValueInAnotherTable[filter] = (filter.split('.')).length!= 1;
        }

        this.filtersToQueryParameter = {};

        this.filtersToLabelsMap = {};
        this.userFilter = {};


        for(let i = 0; i < this.filtersLabels.length; i++) {
            this.filtersToLabelsMap[this.theFilters[i]] = this.filtersLabels[i];
            this.filtersToQueryParameter[this.theFilters[i]] = this.theFilters[i] + "-lk";
            /*  this.log.log("hey");
              this.log.log(this.filtersLabels[i]);
              this.log.log(this.theFilters[i]);*/
            this.userFilter[this.theFilters[i]] = "";
        }


        this.filterCriteria = this.theFilters[0];
        this.possibleNumbersOfItemsToShow = [5, 10, 15, 20, 25, 50, 100];
        this.numberOfItemsToShow = this.possibleNumbersOfItemsToShow[1];
        this.currentSearchRequestParams.per_page = this.perpage||10;
        this.is_sort_asc = 0;
        this.currentSearchRequestParams._includes = this.foreign||undefined;
        this.currentSearchRequestParams._sort = this.orderby|| 'updated_at';
        this.currentSearchRequestParams._sortDir = this.orderdir|| 'asc';

        this.mappedVehicleTypes = {};


        this.currentSearchRequest = API.all(this.resourceName);

        this.doFinalRequest();

        this.dtOptions = DTOptionsBuilder.newOptions().withOption('paging', false)
            .withOption('info', false).withOption('searching', false);

    }

    /**
     * Updates the labels of the buttons below the datatable used to navigate through the different pages
     * when an api call (e.g when the user changes the page, uses a filter) is made
     * @param {Restangular} response - Restangular response of the api call
     */

    refreshPageNumbers(response) {
        this.currentPageNumber = response.metadata.current_page;
        // this.log.log("current page number : " + this.currentPageNumber)
        this.nextPageNumber = (this.currentPageNumber + 1 <= response.metadata.last_page) ? this.currentPageNumber + 1 : 0;
        this.previousPageNumber = (this.currentPageNumber - 1 > 0) ? this.currentPageNumber - 1 : 0;
    }

    /**
     * Load a specific page of request resource
     * @param {number} pageNumber - The page to load
     */

    loadPage(pageNumber) {
        if(angular.isDefined(pageNumber)) {
            this.log.log("Index n'est pas undefined");
            this.currentSearchRequestParams.page = pageNumber;
        }
        else {
            this.currentSearchRequestParams.page = this.currentPageNumber;
        }
        this.doFinalRequest();
    }

    $onInit(){

    }

    /**
     * It's the method that actually does the api call. After getting the response, it calculates the range for
     * navigation buttons and navigation combo box
     */

    doFinalRequest() {
        this.currentSearchRequest.getList(this.currentSearchRequestParams).then((response) => {
            this.items = response;
            this.pages = new Array(this.items.metadata.last_page);
            let indexToAdd = this.items.metadata.current_page % this.maxNumberOfButtons - 1;
            this.firstValueInRangeForButtons = this.items.metadata.current_page - indexToAdd;
            if(indexToAdd == -1) {
                this.firstValueInRangeForButtons-= this.maxNumberOfButtons;
            }
            this.lastValueInRangeForButtons = this.firstValueInRangeForButtons + this.maxNumberOfButtons - 1
            < this.items.metadata.last_page ? this.firstValueInRangeForButtons + this.maxNumberOfButtons - 1
                : this.items.metadata.last_page;
            this.rangeForButtons = new Array(this.lastValueInRangeForButtons - this.firstValueInRangeForButtons + 1);
            for(let j = 0; j < this.pages.length; j++) {
                this.pages[j] = j + 1;
            }
            this.rangeForSelect = this.pages;
            for(let i = 0; i < this.rangeForButtons.length; i++) {
                this.rangeForButtons[i] = this.firstValueInRangeForButtons + i;
                this.rangeForSelect = this.rangeForSelect.filter(e => e !== this.rangeForButtons[i]);
                // this.log.log(this.rangeForSelect);
            }
            this.pageInSelect = this.rangeForSelect[0];
            // this.log.log(this.rangeForButtons);
            this.refreshPageNumbers(response);
        })
    }

    orderBy(field){
        this.orderByField =field;
        if(this.is_sort_asc === 0){
            this.is_sort_asc = 1;
        }else if(this.is_sort_asc===1 ){
            this.is_sort_asc = 2;
        }else{
            this.is_sort_asc = 0;
            this.orderByField =null;
        }
        if(this.is_sort_asc!= 0){
            this.currentSearchRequestParams._sort = field;
            this.currentSearchRequestParams._sortDir = this.is_sort_asc===1 ? 'asc': 'desc';
        }else {
            delete this.currentSearchRequestParams._sort ;
        }
        this.doFinalRequest();
    }

    /**
     * The method called when the user change the number of items to show in the datatable
     */

    numberOfItemsToShowHasChanged() {
        this.currentSearchRequestParams.per_page = this.numberOfItemsToShow;
        this.doFinalRequest();
    }

    /**
     * The method called when the user clicks on the next page button
     */

    nextPage() {
        this.currentSearchRequestParams.page = this.nextPageNumber;
        this.doFinalRequest();
    }

    /**
     * The method called when the user clicks on the previous page button
     */

    previousPage() {
        this.currentSearchRequestParams.page = this.previousPageNumber;
        this.doFinalRequest();
    }

    /**
     * The method called when the user types something in the filtering search bar : after getting the filter
     * criteria, it does the appropriate api call to get the filtered requests
     */

    keyPressedOnSearchBar() {
        this.log.log(this.userFilter);
        if(this.userFilter[this.filterCriteria] == "") {
            this.currentSearchRequestParams = {};
            this.currentSearchRequestParams.per_page = this.numberOfItemsToShow;
            this.currentSearchRequestParams._includes = this.foreign;
            this.doFinalRequest();
            return;
        }
        this.log.log("trying to do the request");
        // alert("yagra");

        let firstQueryParam = this.filtersToQueryParameter[this.filterCriteria];
        let queryParam = {
            _includes:this.foreign
        };
        queryParam[firstQueryParam] = this.userFilter[this.filterCriteria];
        if(this.isFilterValueInAnotherTable[this.filterCriteria]) {
            this.log.log("choix :")
            if(this.filterCriteria == "type_vehicle_name")  {
                // this.log.log("i should be here")
                let vehicleTypesIds = [];
                for(let key in this.mappedVehicleTypes) {
                    if(key.toLowerCase().indexOf(this.userFilter[this.filterCriteria].toLowerCase()) > -1) {
                        vehicleTypesIds.push(this.mappedVehicleTypes[key]);
                    }
                }
                this.API.all('type_vehicle').getList({"tag-in": this._.join(vehicleTypesIds, ",")}).then((response) => {
                    this.selectedServiceTypes = this._.map(response, 'id');
                    this.API.all("type_service_type_vehicle").getList({"type_vehicle_id-in": this._.join(this.selectedServiceTypes, ",")}).then((response) => {
                        this.selectedSTVT = this._.map(response, 'id');
                        this.currentSearchRequest = this.API.all(this.resourceName);
                        this.currentSearchRequestParams = {"type_service_type_vehicle_id-in": this._.join(this.selectedSTVT, ",")}
                        this.currentSearchRequestParams.per_page = this.numberOfItemsToShow;
                        this.doFinalRequest();
                    })
                })
            }
            else {
                // this.log.log("choix : 3")
                let firstQueryParam = this.filtersToQueryParameter[this.filterCriteria];
                let queryParam = {};
                queryParam[firstQueryParam] = this.userFilter[this.filterCriteria];
                this.API.all(this.filtersToApiResource[this.filterCriteria]).getList(queryParam).then((response) => {
                    this.selectedStreets = this._.map(response, 'id');
                    this.log.log(response);
                    this.currentSearchRequest = this.API.all(this.resourceName);
                    let paramKey = this.filtersToApiResource[this.filterCriteria] + "_id-in";
                    let queryParam2 = {};
                    queryParam2[paramKey] = this._.join(this.selectedStreets, ",");
                    this.currentSearchRequestParams = queryParam2;
                    this.log.log("currentSearchRequestParams?");
                    this.log.log(this.currentSearchRequestParams);
                    this.currentSearchRequestParams.per_page = this.numberOfItemsToShow;
                    this.doFinalRequest();
                })
            }
        }
        else {
            // alert("haya");
            this.log.log("choix : 4")
            this.currentSearchRequestParams = queryParam;
            this.doFinalRequest();
        }
    }

    /**
     * This method deletes the user with the given id
     * @param {number} itemId - The user's id to delete
     */

    deleteResource(itemId) {

        swal({
            title: 'Voulez-vous supprimer cet élément?',
            text: '',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#be3235',
            confirmButtonText: 'OK',
            closeOnConfirm: true
        }, () => {
            this.API.one(this.resourceName, itemId).remove().then((response) => {
                this.log.log(this.resourceName + " successfully deleted");
                this.log.log(response);
                this.doFinalRequest();
            });
            swal('Supprimé!', '', 'success')
        })

    }


    /**
     * This method redirect the user to the update vehicle page (for the user with the given id)
     * @param {number} itemId - The user's id to modify
     */

    updateResource(itemId) {
        this.$state.go("app." + "update" + this.resourceName.charAt(0).toUpperCase() + this.resourceName.slice(1), {id: itemId})
    }

    /**
     * This method redirect the user to the vehicle details page (for the user with the given id)
     * @param {number} itemId - The user's id that we want to see the details
     */

    resourceDetails(itemId) {
        this.$state.go("app." + this.resourceName + "Details", {id: itemId});
    }


    /**
     * This method is call when the users clicks on the create button : it redirects him to the vehicle creation page
     */

    createResource() {
        this.$state.go("app." + "create" + this.resourceName.charAt(0).toUpperCase() + this.resourceName.slice(1))
    }

    /**
     * The method called when the value in the navigation combo box changes
     */

    pageInSelectHasChanged() {
        this.currentPageNumber = this.pageInSelect;
        this.loadPage();
    }

    /**
     * This method parse the string "theString" and return the corresponding object field of "theObject".
     * e.g : objectByString(item, "user.person.first_name") will return the object item.user.person.first_name
     * @param {Object} theObject
     * @param {String} theString
     */

    objectByString(theObject, theString) {
        return theString.split('.').reduce(function(prev, curr) {

            return prev ? prev[curr] : undefined
        }, theObject || self)
    }

    isImage(column) {
        if(this.images)
            return this.images.indexOf(column)>-1;
        return false;
    }

    conventionCompletion(){
        this.api = this.api ? this.api : this.name+'s';
        this.label = this.label ? this.label : this.name;
        this.detailstate = this.detailstate ? this.detailstate : this.name+'_details';
        this.editstate = this.editstate ? this.editstate : this.name+'_edit';
        this.orderByField = this.orderby|| 'updated_at';

    }

    download_excel(){
        let f = 'csv';
        let params = {
            should_paginate : false,
            _format : f
        }
        this.API.one(this.resourceName).get(params).then((data, status, headers, config)=> {
            var anchor = angular.element('<a/>');
            anchor.attr({
                href: 'data:attachment/'+f+';charset=utf-8,' + encodeURI(data),
                target: '_blank',
                download: 'filename.'+f
            })[0].click();

        });
    }
}

export const ResourceComponent = {
    templateUrl: './views/app/components/resource/resource.component.html',
    controller: ResourceController,
    controllerAs: 'vm',
    bindings: {
        api : '<',
        label : '<',
        name : '<',
        editstate : '<',
        detailstate : '<',
        translateroot: '<',
        columnsheaders: '<',
        columnsfilters: '<',
        columnsitems: '<',
        perpage: '<',
        foreign: '<',
        images: '<',
        orderdir: '<',
        orderby: '<'
    }
};
