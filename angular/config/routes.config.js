export function RoutesConfig($stateProvider, $urlRouterProvider,$locationProvider) {
    'ngInject'

    var getView = (viewName) => {
        return `./views/app/pages/${viewName}/${viewName}.page.html`
    }
    var getMenuView = (tree,viewName) => {
        return `./views/app/pages/${tree}/${viewName}/${viewName}.page.html`
    }

    var getLayout = (layout) => {
        return `./views/app/pages/layout/${layout}.page.html`
    }

    var trees = {
        admin:{
            categories:"adminviews/categories",
            film:"adminviews/film",
            movietheaters:"adminviews/movietheaters",
            participants:"adminviews/participants",
            paymentmethods:"adminviews/paymentmethods",
            permission:"adminviews/permission",
            role_permission:"adminviews/role_permission",
            user_role:"adminviews/user_role",
            role:"adminviews/role",
            schedules:"adminviews/schedules",
            towns:"adminviews/towns",
            users:"adminviews/users"
        }
    };

    $urlRouterProvider.otherwise('/');
    $locationProvider.html5Mode(true);

    $stateProvider
        .state('app', {
            abstract: true,
            views: {
                'layout': {
                    templateUrl: getLayout('layout')
                },
                'header@app': {
                    templateUrl: getView('header')
                },
                'footer@app': {
                    templateUrl: getView('footer')
                },
                main: {}
            },
            data: {
                bodyClass: 'hold-transition skin-blue sidebar-mini'
            }
        })

        .state('app.landing', {
            url: '/',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    templateUrl: getView('landing')
                }
            }
        })


        .state('app.best_seller', {
            url: '/best_seller',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<best-seller></best-seller>'
                }
            }
        })


        .state('app.best_customer', {
            url: '/best-customer',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<best-customer></best-customer>'
                }
            }
        })

        .state('app.best_movies', {
            url: '/best-movies',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<best-movies></best-movies>'
                }
            }
        })

        .state('app.best_movietheaters', {
            url: '/best-movietheaters',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<best-movietheaters></best-movietheaters>'
                }
            }
        })

        .state('app.best_paymentmethods', {
            url: '/best-paymentmethods',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<best-paymentmethods></best-paymentmethods>'
                }
            }
        })

        .state('app.best_family', {
            url: '/best-categoryfamily',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<best-categoryfamily></best-categoryfamily>'
                }
            }
        })

        .state('app.best_category', {
            url: '/best-category',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template:'<best-category></best-category>'
                }
            }
        })

        .state('app.best_customer_type', {
            url: '/best-customer_type',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<best-customer_type></best-customer_type>',
                }
            }
        })





        .state('app.tablessimple', {
            url: '/tables-simple',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<tables-simple></tables-simple>'
                }
            }
        })
        .state('app.uiicons', {
            url: '/ui-icons',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<ui-icons></ui-icons>'
                }
            }
        })
        .state('app.uimodal', {
            url: '/ui-modal',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<ui-modal></ui-modal>'
                }
            }
        })
        .state('app.uitimeline', {
            url: '/ui-timeline',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<ui-timeline></ui-timeline>'
                }
            }
        })
        .state('app.uibuttons', {
            url: '/ui-buttons',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<ui-buttons></ui-buttons>'
                }
            }
        })
        .state('app.uigeneral', {
            url: '/ui-general',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<ui-general></ui-general>'
                }
            }
        })
        .state('app.formsgeneral', {
            url: '/forms-general',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<forms-general></forms-general>'
                }
            }
        })
        .state('app.chartjs', {
            url: '/charts-chartjs',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<charts-chartjs></charts-chartjs>'
                }
            }
        })
        .state('app.comingsoon', {
            url: '/comingsoon',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<coming-soon></coming-soon>'
                }
            }
        })
        .state('app.profile', {
            url: '/profile',
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: '<user-profile></user-profile>'
                }
            },
            params: {
                alerts: null
            }
        })


        .state('login', {
            url: '/login',
            views: {
                'layout': {
                    templateUrl: getView('login')
                },
                'header@app': {},
                'footer@app': {}
            },
            data: {
                bodyClass: 'hold-transition login-page'
            },
            params: {
                registerSuccess: null,
                successMsg: null
            }
        })
        .state('loginloader', {
            url: '/login-loader',
            views: {
                'layout': {
                    templateUrl: getView('login-loader')
                },
                'header@app': {},
                'footer@app': {}
            },
            data: {
                bodyClass: 'hold-transition login-page'
            }
        })
        .state('register', {
            url: '/register',
            views: {
                'layout': {
                    templateUrl: getView('register')
                },
                'header@app': {},
                'footer@app': {}
            },
            data: {
                bodyClass: 'hold-transition register-page'
            }
        })
        .state('userverification', {
            url: '/userverification/:status',
            views: {
                'layout': {
                    templateUrl: getView('user-verification')
                }
            },
            data: {
                bodyClass: 'hold-transition login-page'
            },
            params: {
                status: null
            }
        })
        .state('forgot_password', {
            url: '/forgot-password',
            views: {
                'layout': {
                    templateUrl: getView('forgot-password')
                },
                'header@app': {},
                'footer@app': {}
            },
            data: {
                bodyClass: 'hold-transition login-page'
            }
        })
        .state('reset_password', {
            url: '/reset-password/:email/:token',
            views: {
                'layout': {
                    templateUrl: getView('reset-password')
                },
                'header@app': {},
                'footer@app': {}
            },
            data: {
                bodyClass: 'hold-transition login-page'
            }
        })
        .state('app.logout', {
            url: '/logout',
            views: {
                'main@app': {
                    controller: function ($rootScope, $scope, $auth, $state, AclService) {
                        $auth.logout().then(function () {
                            delete $rootScope.me
                            AclService.flushRoles()
                            AclService.setAbilities({})
                            $state.go('login')
                        })
                    }
                }
            }
        })
		
		/*
                 =======================================================================================================================
                                    transaction of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.transaction_list', {
        url: '/transaction-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/stations/transaction/transaction.list.html'
            }
        }
        })
		.state('app.transaction_edit', {
        url: '/transaction-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/stations/transaction/transaction.edit.html'
            }
        }
        })
		.state('app.transaction_details', {
        url: '/transaction-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/stations/transaction/transaction.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  transaction  resource states definition
                 =======================================================================================================================
                
          */
		
		/*
                 =======================================================================================================================
                                    client of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.client_list', {
        url: '/client-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/accounts/client/client.list.html'
            }
        }
        })
		.state('app.client_edit', {
        url: '/client-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/accounts/client/client.edit.html'
            }
        }
        })
		.state('app.client_details', {
        url: '/client-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/accounts/client/client.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  client  resource states definition
                 =======================================================================================================================
                
          */
		
		/*
                 =======================================================================================================================
                                    patner of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.patner_list', {
        url: '/patner-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/authorizations/patner/patner.list.html'
            }
        }
        })
		.state('app.patner_edit', {
        url: '/patner-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/authorizations/patner/patner.edit.html'
            }
        }
        })
		.state('app.patner_details', {
        url: '/patner-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/authorizations/patner/patner.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  patner  resource states definition
                 =======================================================================================================================
                
          */
		
		/*
                 =======================================================================================================================
                                    role of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.role_list', {
        url: '/role-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/authorizations/role/role.list.html'
            }
        }
        })
		.state('app.role_edit', {
        url: '/role-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/authorizations/role/role.edit.html'
            }
        }
        })
		.state('app.role_details', {
        url: '/role-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/authorizations/role/role.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  role  resource states definition
                 =======================================================================================================================
                
          */
		
		/*
                 =======================================================================================================================
                                    permission of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.permission_list', {
        url: '/permission-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/authorizations/permission/permission.list.html'
            }
        }
        })
		.state('app.permission_edit', {
        url: '/permission-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/authorizations/permission/permission.edit.html'
            }
        }
        })
		.state('app.permission_details', {
        url: '/permission-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/authorizations/permission/permission.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  permission  resource states definition
                 =======================================================================================================================
                
          */
		
		/*
                 =======================================================================================================================
                                    bill of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.bill_list', {
        url: '/bill-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/billings/bill/bill.list.html'
            }
        }
        })
		.state('app.bill_edit', {
        url: '/bill-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/billings/bill/bill.edit.html'
            }
        }
        })
		.state('app.bill_details', {
        url: '/bill-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/billings/bill/bill.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  bill  resource states definition
                 =======================================================================================================================
                
          */
		
		/*
                 =======================================================================================================================
                                    address of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.address_list', {
        url: '/address-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/others/address/address.list.html'
            }
        }
        })
		.state('app.address_edit', {
        url: '/address-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/others/address/address.edit.html'
            }
        }
        })
		.state('app.address_details', {
        url: '/address-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/others/address/address.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  address  resource states definition
                 =======================================================================================================================
                
          */
		
		/*
                 =======================================================================================================================
                                    currency of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.currency_list', {
        url: '/currency-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/others/currency/currency.list.html'
            }
        }
        })
		.state('app.currency_edit', {
        url: '/currency-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/others/currency/currency.edit.html'
            }
        }
        })
		.state('app.currency_details', {
        url: '/currency-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/others/currency/currency.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  currency  resource states definition
                 =======================================================================================================================
                
          */
		
		/*
                 =======================================================================================================================
                                    country of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.country_list', {
        url: '/country-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/others/country/country.list.html'
            }
        }
        })
		.state('app.country_edit', {
        url: '/country-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/others/country/country.edit.html'
            }
        }
        })
		.state('app.country_details', {
        url: '/country-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/others/country/country.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  country  resource states definition
                 =======================================================================================================================
                
          */
		
		/*
                 =======================================================================================================================
                                    town of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.town_list', {
        url: '/town-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/others/town/town.list.html'
            }
        }
        })
		.state('app.town_edit', {
        url: '/town-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/others/town/town.edit.html'
            }
        }
        })
		.state('app.town_details', {
        url: '/town-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/others/town/town.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  town  resource states definition
                 =======================================================================================================================
                
          */
		
		/*
                 =======================================================================================================================
                                    service of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.service_list', {
        url: '/service-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/services/service/service.list.html'
            }
        }
        })
		.state('app.service_edit', {
        url: '/service-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/services/service/service.edit.html'
            }
        }
        })
		.state('app.service_details', {
        url: '/service-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/services/service/service.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  service  resource states definition
                 =======================================================================================================================
                
          */
		
		/*
                 =======================================================================================================================
                                    offer of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.offer_list', {
        url: '/offer-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/services/offer/offer.list.html'
            }
        }
        })
		.state('app.offer_edit', {
        url: '/offer-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/services/offer/offer.edit.html'
            }
        }
        })
		.state('app.offer_details', {
        url: '/offer-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/services/offer/offer.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  offer  resource states definition
                 =======================================================================================================================
                
          */
		
		/*
                 =======================================================================================================================
                                    point_of_sale of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.point_of_sale_list', {
        url: '/point-of-sale-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/stations/point_of_sale/point_of_sale.list.html'
            }
        }
        })
		.state('app.point_of_sale_edit', {
        url: '/point-of-sale-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/stations/point_of_sale/point_of_sale.edit.html'
            }
        }
        })
		.state('app.point_of_sale_details', {
        url: '/point-of-sale-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/stations/point_of_sale/point_of_sale.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  point_of_sale  resource states definition
                 =======================================================================================================================
                
          */
		
		/*
                 =======================================================================================================================
                                    station of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.station_list', {
        url: '/station-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/stations/station/station.list.html'
            }
        }
        })
		.state('app.station_edit', {
        url: '/station-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/stations/station/station.edit.html'
            }
        }
        })
		.state('app.station_details', {
        url: '/station-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/stations/station/station.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  station  resource states definition
                 =======================================================================================================================
                
          */
		
		/*
                 =======================================================================================================================
                                    payment of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.payment_list', {
        url: '/payment-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/billings/payment/payment.list.html'
            }
        }
        })
		.state('app.payment_edit', {
        url: '/payment-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/billings/payment/payment.edit.html'
            }
        }
        })
		.state('app.payment_details', {
        url: '/payment-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/billings/payment/payment.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  payment  resource states definition
                 =======================================================================================================================
                
          */
		
		/*
                 =======================================================================================================================
                                    user of resource states definition
                 =======================================================================================================================
                
                */
		.state('app.user_list', {
        url: '/user-list',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/accounts/user/user.list.html'
            }
        }
        })
		.state('app.user_edit', {
        url: '/user-edit/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/accounts/user/user.edit.html'
            }
        }
        })
		.state('app.user_details', {
        url: '/user-details/{resource_id}',
        data: {
            auth: true
        },
        params: {
            resource_id: null
        },
        views: {
            'main@app': {
                templateUrl: './views/app/pages/admins/accounts/user/user.detail.html'
            }
        }
        })
		
			/*
                 =======================================================================================================================
                                  End  user  resource states definition
                 =======================================================================================================================
                
          */
		}