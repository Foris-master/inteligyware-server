angular.module('app', [
  'app.run',
  'app.filters',
  'app.services',
  'app.components',
  'app.routes',
  'app.config',
  'app.partials'
])


angular.module('app.run', [])
angular.module('app.routes', [])
angular.module('app.filters', [])
angular.module('app.services', [])
angular.module('app.config', [])
angular.module('app.components', [
  'ui.router', 'angular-loading-bar',
  'restangular', 'ngStorage', 'satellizer',
  'ui.bootstrap', 'chart.js', 'mm.acl', 'datatables','angularMoment','ngTagsInput',
  'datatables.bootstrap', 'checklist-model','pascalprecht.translate', '720kb.datepicker','angucomplete-alt',
    'ngMap','moment-picker','ngFileUpload','uiCropper'
])
