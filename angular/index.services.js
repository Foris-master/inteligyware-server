import {GraphhelperService} from './services/graphhelper.service';
import {GoogleMapsWrapperService} from './services/GoogleMapsWrapper.service';
import { ContextService } from './services/context.service'
import { APIService } from './services/API.service'

angular.module('app.services')
	.service('GraphhelperService', GraphhelperService)
    .service('GoogleMapsWrapperService', GoogleMapsWrapperService)
  .service('ContextService', ContextService)
  .service('API', APIService)
