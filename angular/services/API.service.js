export class APIService {
  constructor (Restangular, $window,_,API_URL) {
    'ngInject'
    // content negotiation
    var headers = {
      'Content-Type': 'application/json',
      'Accept': 'application/x.laravel.v1+json'
    }
    return Restangular.withConfig(function (RestangularConfigurer) {
      RestangularConfigurer
        .setBaseUrl(API_URL)
        .setDefaultHeaders(headers)
        .setErrorInterceptor(function (response) {
          if (response.status === 422) {
            // for (var error in response.data.errors) {
            // return ToastService.error(response.data.errors[error][0])
            // }
          }
        })
        .addFullRequestInterceptor(function (element, operation, what, url, headers) {
          var token = $window.localStorage.satellizer_token
          if (token) {
            headers.Authorization = 'Bearer ' + token
          }
        })
        .addResponseInterceptor(function (response, operation, what) {
          if (operation === 'getList') {

              var newResponse = what;
              if (angular.isUndefined(response.per_page)) {

                 // newResponse = response.data[what]
                  // newResponse.error = response.error
                  return response
              }
              newResponse = response.data
              newResponse.metadata = _.omit(response, 'data');

              return newResponse

          }

          return response
        })
    })
  }
}
