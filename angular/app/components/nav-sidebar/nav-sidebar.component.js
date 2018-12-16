class NavSidebarController {
    constructor(AclService, ContextService, _, $translate,AppTheme) {
        'ngInject'

        let navSideBar = this;
        this.can = AclService.can;
        this.hasAnyRole = AclService.hasAnyRole;
        this._ = _;
        this.$translate = $translate;

        ContextService.me(function (data) {
            navSideBar.userData = data;
            let color = AppTheme.primary.split("#").join("");
            if(data && data.user){
                if(data.user.picture&&(data.user.picture.split('default/img').length==1)){
                    navSideBar.img_link=data.user.picture;
                }else {
                    navSideBar.img_link='//placeholdit.imgix.net/~text?txtfont=monospace,bold&bg='+color+'&txtclr=ffffff&txt='+data.user.first_name.substring(0,1)+''+data.user.last_name.substring(0,1)+'&w=45&h=45&txtsize=16';
                }
            }
        });
        this.menu_bool_tree = {};
        this.menu_tree = {

            home: {
                dashboard: null
            },

            state: {
                best_movies: null,
                best_product: null,
                best_customer: null,
                best_movietheaters: null,
                best_paymentmethods: null,
                best_category: null,
                best_seller: null
            },

            stat: {
                stat_product: null,
                stat_seller: null
            },

            admin: {
                categories: [
                    'categories',
                    'categories_details',
                    'categories_edit'
                ],
                others: [
                    'saletargets'
                ]
            }
            ,

            customers: {
                customers: [
                    'customers',
                    'customer_types',
                    'compagnies'
                ]
            }

            ,

            depot_and_products: {
                categories: [
                    'categories',
                    'families'
                ],
                products: [
                    'products',
                    'product_saletypes '
                ],
                depots: [
                    'depots',
                    'depot_saletypes',
                    'stocts'
                ]
            }

            ,

            data: {
                users: [
                    'managers',
                    'cashiers',
                    'sellers',
                    'warehousemen'
                ],
                profiles: [
                    'user_profiles',
                    'roles'
                ],
                customers: [
                    'cashiers',
                    'people',
                    'customer_type_sellers'
                ],
                locations: [
                    'countries',
                    'regions',
                    'towns'
                ],
                others: [
                    'suggestions',
                    'saletypes',
                    'paiement_methods'
                ]
            }


        };
        this.show_menus();
    }

    $onInit() {
    }

    cover(tree, txt) {


        let trans_name = 'comp_nav_sidebar.';
        let result = {};
        if (tree == null) {
            if (this._.trim(txt) !== '')
                return false;
            return true;
        } else if (this._.isString(tree)) {
            let tree_temp = this.$translate.instant(trans_name + tree);
            tree_temp = tree_temp.toLowerCase();
            let k = (angular.isDefined(txt) || this._.trim(txt) !== '') ? tree_temp.includes(txt) : true;
            let result0 = {};
            result0[tree] = k;
            return result0;

        } else if (this._.isArray(tree)) {
            let result2 = {};
            let k1 = false;
            for (let i = 0; i < tree.length; i++) {
                let m = this.cover(tree[i], txt);
                k1 = k1 || m[tree[i]];
                result2[tree[i]] = m[tree[i]];
                // result2.push(m);
            }
            //result2.push({cumul: k1});
            return result2;
        } else if (this._.isObject(tree)) {
            let that = this;
            let k2 = false;
            this._.forEach(tree, function (value, key) {
                result[key] = that.cover(value, txt);
                let m = result[key];

                if (that._.isArray(m)) {
                    k2 = k2 || m[m.length - 1].cumul;
                } else if (that._.isObject(m)) {
                    angular.forEach(m, function (val2) {

                        if (that._.isBoolean(val2)) {
                            k2 = k2 || val2;
                        }
                    })


                } else if (that._.isBoolean(m)) {
                    let ot = that.$translate.instant(trans_name+key).toLowerCase();
                    if (!m)
                        m = ot.includes(txt.toLowerCase());
                    k2 = k2 || m;
                }

                result[key + '_cumul'] = k2;
                k2 = false;

            });
            return result;
        }
    }

    show_menus(txt) {
        txt = angular.isUndefined(txt) ? undefined : txt.toLowerCase();
        this.menu_bool_tree = this.cover(this.menu_tree, txt);
    }
}

export const NavSidebarComponent = {
    templateUrl: './views/app/components/nav-sidebar/nav-sidebar.component.html',
    controller: NavSidebarController,
    controllerAs: 'vm',
    bindings: {}
}
