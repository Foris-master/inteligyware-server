export function SatellizerConfig ($authProvider,API_URL) {
  'ngInject'

  $authProvider.httpInterceptor = function () {
    return true
  }

    $authProvider.loginUrl = API_URL + 'auth/signin';
    $authProvider.signupUrl = API_URL + 'auth/signup';
    $authProvider.tokenRoot = 'data'; // compensates success response macro
}
