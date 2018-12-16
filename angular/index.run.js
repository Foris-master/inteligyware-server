import { RoutesRun } from './run/routes.run'

angular.module('app.run')
    .constant('AppTheme',{primary:'#3c8dbc',danger:'#bc3438'})
    .constant('API_URL','/api/')
    // .constant('API_URL','http://co.local/api/')
    .constant('_', window._)
  .run(RoutesRun)
