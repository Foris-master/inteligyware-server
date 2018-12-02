<html   >
<head>

    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bill.css') }}" />

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script>
        function subst() {
            var vars={};
            var x=document.location.search.substring(1).split('&');
            for (var i in x) {var z=x[i].split('=',2);vars[z[0]] = decodeURI(z[1]);}
            var x=["topage","page","frompage","webpage","section","subsection","subsubsection"];
            for (var i in x) {
                var y = document.getElementsByClassName(x[i]);
                for (var j=0; j<y.length; ++j){
                    y[j].textContent =vars[x[i]] ;
                }
            }
        }
    </script>

</head>
<body class="border:0; margin: 0;  "  onload="subst()" >
<div class="row header footerp" >
    <div  class="col col-xs-3  ">
        <img style="padding-left: 30px;height: 25px;" src={{url("img/logo.png")}} alt="">
    </div>
    <div  class="col col-xs-6 title">
       <strong class="tchombe-color">Facture  </strong> imprimé le : {{$creation_date}}
    </div>
    <div class="col col-xs-3 ">
       <div class="row">
           <span class="col col-xs-3 col-xs-offset-2">Page</span>
           <span class="col col-xs-2"  >
               <span class="page" style=""></span>
           </span>
           <span class="col col-xs-2">sur</span>
           <span class="col col-xs-2" >
               <span class="topage"></span>
           </span>
       </div>
    </div>
</div>

</body>
</html>


