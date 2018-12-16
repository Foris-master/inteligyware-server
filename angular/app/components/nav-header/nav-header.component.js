class NavHeaderController {
  constructor ($rootScope,$translate ,ContextService,$timeout,AppTheme) {
    'ngInject'

    let navHeader = this;
    this.translate = $translate;

    ContextService.me(function (data) {
      navHeader.userData = data;
      let color = AppTheme.primary.split("#").join("");

      if(data && data.user){
          if(data.user.picture&&(data.user.picture.split('default/img').length==1)){
              navHeader.img_link=data.user.picture;
          }else {
              navHeader.img_link='//placeholdit.imgix.net/~text?txtfont=monospace,bold&bg='+color+'&txtclr=ffffff&txt='+data.user.first_name.substring(0,1)+''+data.user.last_name.substring(0,1)+'&w=45&h=45&txtsize=16';
          }
      }
    })
      this.Main = {};
    var that =this;
      $timeout(function () {
          that.Main.user_language = that.translate.use();
      }, 100);


    this.languages = [
        {
            name: "Francais",
            code: "fr"
        },
        {
            name: "English",
            code: "en"
        }
    ];
  }


  $onInit () {}
  change_language (lang) {
        this.Main.user_language =  lang;
        this.translate.use(this.Main.user_language);


    }
}

export const NavHeaderComponent = {
  templateUrl: './views/app/components/nav-header/nav-header.component.html',
  controller: NavHeaderController,
  controllerAs: 'vm',
  bindings: {}
}
