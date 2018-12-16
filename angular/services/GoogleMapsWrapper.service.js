export class GoogleMapsWrapperService{
    constructor(){
        'ngInject';
        this.baseUrl = "https://maps.googleapis.com/maps/api/js";
        this.APIKey = "AIzaSyADb59G_av6VvpBoJHoiNFCRukK5m5t7qM";
        this.zoom = 14;

        //
    }

    lazyLoadUrl() {
        return "https://maps.google.com/maps/api/js"
    }

    lazyLoadParams() {
        return this.baseUrl + "?key=" + this.APIKey;
    }

    defaultZoom() {
        return this.zoom;
    }
}

