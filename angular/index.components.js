import {BestPaymentmethodsComponent} from './app/components/best-paymentmethods/best-paymentmethods.component';
import {BestMovietheatersComponent} from './app/components/best-movietheaters/best-movietheaters.component';
import {BestMoviesComponent} from './app/components/best-movies/best-movies.component';
import {BestCategoryfamilyComponent} from './app/components/best-categoryfamily/best-categoryfamily.component';
import {BestCustomerTypeComponent} from './app/components/best-customer_type/best-customer_type.component';
import {BestCustomerComponent} from './app/components/best-customer/best-customer.component';
import {BestProductComponent} from './app/components/best-product/best-product.component';
import {BestSellerComponent} from './app/components/best-seller/best-seller.component';
import {BestCategoryComponent} from './app/components/best-category/best-category.component';
import {ResourceEditComponent} from './app/components/resource-edit/resource-edit.component';
import {GraphTownTurnoverComponent} from './app/components/graph-town-turnover/graph-town-turnover.component';
import {StatisticComponent} from './app/components/statistic/statistic.component';
import {BestResourceComponent} from './app/components/best-resource/best-resource.component';
import {HitParadeComponent} from './app/components/hit-parade/hit-parade.component';
import {ResourceDetailsComponent} from './app/components/resource-details/resource-details.component';
import {BillValidateComponent} from './app/components/bill-validate/bill-validate.component';
import {ResourceComponent} from './app/components/resource/resource.component';
import {ChartsChartjsComponent} from "./app/components/charts-chartjs/charts-chartjs.component";
import { UserVerificationComponent } from './app/components/user-verification/user-verification.component'
import { DashboardComponent } from './app/components/dashboard/dashboard.component'
import { NavSidebarComponent } from './app/components/nav-sidebar/nav-sidebar.component'
import { NavHeaderComponent } from './app/components/nav-header/nav-header.component'
import { LoginLoaderComponent } from './app/components/login-loader/login-loader.component'
import { ResetPasswordComponent } from './app/components/reset-password/reset-password.component'
import { ForgotPasswordComponent } from './app/components/forgot-password/forgot-password.component'
import { LoginFormComponent } from './app/components/login-form/login-form.component'
import { RegisterFormComponent } from './app/components/register-form/register-form.component'

angular.module('app.components')
	.component('bestPaymentmethods', BestPaymentmethodsComponent)
	.component('bestMovietheaters', BestMovietheatersComponent)
	.component('bestMovies', BestMoviesComponent)
	.component('bestCategoryfamily', BestCategoryfamilyComponent)
	.component('bestCustomerType', BestCustomerTypeComponent)
	.component('bestCustomer', BestCustomerComponent)
	.component('bestProduct', BestProductComponent)
	.component('bestSeller', BestSellerComponent)
	.component('bestCategory', BestCategoryComponent)
	.component('resourceEdit', ResourceEditComponent)
	.component('graphTownTurnover', GraphTownTurnoverComponent)
	.component('statistic', StatisticComponent)
	.component('bestResource', BestResourceComponent)
	.component('hitParade', HitParadeComponent)
	.component('resourceDetails', ResourceDetailsComponent)
	.component('billValidate', BillValidateComponent)
	.component('resource', ResourceComponent)

  .component('chartsChartjs', ChartsChartjsComponent)

  .component('userVerification', UserVerificationComponent)

  .component('dashboard', DashboardComponent)
  .component('navSidebar', NavSidebarComponent)
  .component('navHeader', NavHeaderComponent)
  .component('loginLoader', LoginLoaderComponent)
  .component('resetPassword', ResetPasswordComponent)
  .component('forgotPassword', ForgotPasswordComponent)
  .component('loginForm', LoginFormComponent)
  .component('registerForm', RegisterFormComponent)
