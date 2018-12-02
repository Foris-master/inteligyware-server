<?php
/**
 * Created by PhpStorm.
 * User: Ets Simon
 * Date: 08/04/2016
 * Time: 11:47
 */
?>

<head>
    <meta charset="UTF-8">
    <title>Anniversaire</title>

    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" />

    <style type="text/css">
        html{

        }

        p{
            color:#fff;
            font-size: 16px;
            padding: 15px;
            font-weight: normal;
            border-top:1px solid #debc6e;
            border-bottom:1px solid #debc6e;
        }
        p span{
            color:#f0ab3d ;
            font-weight: bold;
        }
        .value{
            color:#f0ab3d;
            font-weight: bold;
        }


    </style>
</head>
<body>

<div class="row-fluid ">
    <div class="col-lg-12 col-md-12 col-sm-12"
         style="position: relative;
         min-height: 1px;
         font-size:10px;
         background: #000;
         font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif ;
        line-height: 1.428571429;color: #333333;
         padding-right: 15px;padding-left: 15px;
         float: left;
         width: 100%;
         padding-top: 50px;
         box-sizing: border-box" >
        <div class="col-lg-5 col-sm-5 col-md-5"
             style="position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;float: left;width: 41%;">
            <img src="{{url("img/logo.png")}}" class="logo" style="width: 75px;vertical-align: middle;border: 0;box-sizing: border-box"  alt="logo Peex">
        </div>

        <div class="clearfix" style="clear: both;"></div>
        <div class="col-lg-5 col-sm-5 col-md-5"
             style="position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;float: left;width: 41%;">
            <p class="text-center"
               style="color:#fff;
    font-size: 16px;
    padding: 15px;
    font-weight: normal;
    text-align: center;
    border-top:1px solid #00CCB0;
    border-bottom:1px solid #00CCB0;">
                Chère <span class="value" style="color:#f0ab3d;font-weight: bold;">
                    {{$user->full_name}}</span>, Toute l'équipe
                <span style="color:#f0ab3d ;font-weight: bold;">Peex</span>
                vous souhaite un heureux anniversaire et vous remercie de votre fidélité.
                <br><a style="color: #00CCB0;text-decoration: none;" href="http://www.peexit.com"><span>Peex</span></a>
            </p>
        </div>

    </div>
</div>

</body>
