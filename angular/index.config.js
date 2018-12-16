import {MomentPickerConfig} from './config/moment_picker.config';
import {TranslateConfig} from './config/translate.config';
import { AclConfig } from './config/acl.config'
import { RoutesConfig } from './config/routes.config'
import { LoadingBarConfig } from './config/loading_bar.config'
import { SatellizerConfig } from './config/satellizer.config'

angular.module('app.config')
	.config(MomentPickerConfig)
	.config(TranslateConfig)
  .config(AclConfig)
  .config(RoutesConfig)
  .config(LoadingBarConfig)
  .config(SatellizerConfig)
