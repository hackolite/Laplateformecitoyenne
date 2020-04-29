<?php
	header('content-type: text/css');
	require "serveur/versioning.php";
	// nous utilisons php pour appliquer le versioning des images
?>

@charset 'utf-8';

@font-face{
	font-family: 'Avenir';
	src: url("font/avenir_next_regular<?php echo $version["font_family"];?>.ttf");
	font-weight: 300;
}
@font-face{
	font-family: 'Avenir';
	src: url("font/avenir_next_demi<?php echo $version["font_family"];?>.ttf");
	font-weight: normal;
}
@font-face{
	font-family: 'Avenir';
	src: url("font/avenir_next_bold<?php echo $version["font_family"];?>.ttf");
	font-weight: bold;
}
@font-face{
	font-family: 'Avenir Condensed';
	src: url("font/avenir_next__condensed_demi<?php echo $version["font_family"];?>.ttf");
	font-weight: normal;
}

*{
	font-family: 'Avenir';
}

body{
	margin: 0;
	line-height: 1.5;
}

#page > div{
	transition: right 1s ease;
}

.white_space{
	margin: 0;
	height: 70px;
}


p{
	margin-top: 10px!important;
	line-height: normal!important;
}

a{
	text-decoration: none;
}
a:focus, a:visited{
	color: #2c80ff;
}
a:active, a:hover{
	color: #d52cff;
}


#_box{
	position: fixed;
	top: -50%;
    left: 50%;
    transform: translateX(-50%);
    width: 500px;
    min-height: 60px;
    max-height: 350px;
    z-index: 1000;
    box-shadow: 0 0 10px #929292;
    border-radius: 3px;
    transition: all 800ms ease;
}
#_box.on{
	top: 82px;
}
#_box.off{
	top: -50%;
}

#_box p.mssg{
    color: white;
    font-weight: 300;
    text-align: center;
    font-size: 14px;
    padding: 10px 25px 4px 52px;
    cursor: default;
}

#_box.red{
	background: #ed1f0aeb;
	box-shadow: 0 0 10px #ce0000;
}
#_box.blue{
	background: #0a84edeb;
	box-shadow: 0 0 10px #1d8dee;
}

/* 
	###### HEADER #######
*/
header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;

    background: #fff;
  	box-shadow: 0 2px 6px 3px rgba(115,115,115,0.12);
    height: 70px;
    z-index: 2000;
}

#logo img{
	width: 70px;
    height: 70px;
    position: absolute;
    top: 2px;
    left: 8px;
    transition: transform 1.5s ease;
    transform: rotate(0deg);
    border-radius: 50%;
}

#logo:hover img{
	transform: rotate(720deg);
}

#logo .title {
	display: inline-block;
	position: absolute;
	top: 20px;
	left: 86px;
	margin: 0px;
	font-size: 25px;
	text-transform: uppercase;
	font-family: 'Avenir Condensed';
	font-weight: normal;
	color: #272727;
	transition: all 300ms ease-out;
}
/*
#logo:hover .title{
	animation: 5s linear infinite title;
}

@keyframes title{
	from{color: #272727;}
	33%{color: #005DEE;}
	66%{color: #00D08F;}
	to{color: #272727;}
}*/

/*
#logo span:hover{
	background: -webkit-linear-gradient(0deg, #00d08f, #005dee);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
*/

#lang{
	position: fixed;
    left: 356px;
    top: 23px;
    margin-bottom: 0px;
}

#lang a, #lang_menu a{
	color: #575757;
	background-color: transparent;
	text-decoration: none;
	padding: 2px 6px;
	font-size: 10px;
}
#lang a.on, #lang_menu a.on, #lang a:hover{
	background-color: #323232;
    color: white;
}

#lang_menu{
	display: none;
}

#bouton{
    position: absolute;
    right: 12px;
    top: 12px;
}

#bouton ul {
    list-style-type: none;
    margin: 0;
}
#bouton li {
    display: inline-block;
    font-size: 16.5px;
    margin: 0px 8px;
    font-weight: normal;

	height: 45px;
	line-height: 45px;
}

#bouton li, .btt_submit{
	text-align: center;
	cursor: pointer;
    transition: all ease 200ms;
    text-transform: uppercase;
	box-sizing: border-box;
}

a.btt{
	min-width: 75px;
	max-width: 124px;
	color: #000;
	text-decoration: none!important;
	transition: all 200ms ease;
}
.btt:hover{
	color: #e42b2b;	
}



.btt_submit{
	width: 143px;
	border: 2px solid;
	border-radius: 42px;
}
.btt_submit.empty.green, .btt_submit.fill.green:hover{
	color: #00D08F;
	border-color: #00D08F;
	background: #fff;
}
.btt_submit.empty.blue, .btt_submit.fill.blue:hover{
	color: #005DEE;
	border-color: #005DEE;
	background: #fff;
}
.btt_submit.empty.red, .btt_submit.fill.red:hover{
    color: #ee0042;
    border-color: #ee0042;
    background: #fff;
}
.btt_submit.empty.black, .btt_submit.fill.black:hover{
    color: #111111;
    border-color: #111111;
    background: #fff;
}

.btt_submit.fill.green, 
.btt_submit.empty.green:hover, .btt_submit.empty.green.on{
	color: #fff;
	border-color: #00D08F;
	background: #00D08F;
}
.btt_submit.fill.blue, 
.btt_submit.empty.blue:hover, .btt_submit.empty.blue.on{
	color: #fff;
	border-color: #005DEE;
	background: #005DEE;
}
.btt_submit.fill.red, 
.btt_submit.empty.red:hover, .btt_submit.empty.red.on{
    color: #fff;
    border-color: #ee0042;
    background: #ee0042;
}
.btt_submit.fill.black, 
.btt_submit.empty.black:hover, .btt_submit.empty.black.on{
    color: #fff;
    border-color: #111111;
    background: #111111;
}








/*
	######## MAP ########
*/

#mapid {
  z-index: 0;
  height:100%;
  min-height: 400px;
}


#map {
    position: absolute;
    top: 70px;
    bottom: 0;
    width: 100%;
    height: auto;
    min-height: 200px;
    /*background: url('img/carte_test.jpg');*/
    overflow: auto;
}


#map bottom{
	position: fixed;
	bottom: 0px;
	width: 100%;
	transition: bottom 1s ease;
}

#map bottom.shown{
	bottom: 0px;
}
#map bottom.hidden{
	bottom: -50%;
}

#map bottom .btt_submit{
	display: inline-block;
	float: right;
	position: relative;
	bottom: 33px;
	box-sizing: border-box;
	width: 200px;
	height: 60px;
	line-height: 62px;
	font-size: 22px;
	margin: 0px 10px;
	right: 4px;
	transition: all 300ms ease;
}

#map bottom .btt_submit:hover{
	font-size: 26px;
}

#map .legend {
box-sizing: border-box;
    border-radius: 3px;
    background-color: #ffffff;
    position: absolute;
    bottom: 36px;
    left: 12px;
    padding: 13px 10px 15px 62px;
    min-height: 120px;
    min-width: 260px;
    transition: all 600ms ease;
    cursor: pointer;
    max-width: 340px;
    opacity: 0.8;
    box-shadow: 0px 0px 5px #a2a2a2;
}
#map .legend:hover{
	opacity: 1;
	box-shadow: 0px 0px 10px #a2a2a2;
	left: 25px;
}

#map .legend p{
	color: #2F2F2F;
    text-transform: capitalize;
    font-size: 22px;
    margin: 0 0px 20px -15px;
}

#map .legend ul{
	list-style-type: none;
	margin: 0;
	padding: 0;
	margin-top: 6px;
	position: relative;
	left: -12px;
	transition: all 800ms ease;
}

#map .legend:hover ul{
	left: 18px;
}

#map .legend .checkbox{
	width: 23px;
	height: 23px;
	background-size: contain;
	background-repeat: no-repeat;
	display: inline-block;
	filter: grayscale(0%);
	transition: all 200ms ease;
	margin: 0;
}

#map .legend .checkbox:hover{
	box-shadow: 0px 0px 6px #14d08f;
}

#map .checkbox.on{
	opacity: 1;
	filter:  grayscale(0%); 
}
#map .checkbox.off{
	opacity: 0.5;
	filter:  grayscale(100%);
}


#map .legend li .green{
	background-image: url('img/puce_vert<?php echo $version["image_css"];?>.png');
}
#map .legend li .blue{
	background-image: url('img/puce_bleu<?php echo $version["image_css"];?>.png');
}

#map .legend .text{
	position: relative;
	left: 8px;
	bottom: 5px;
	font-size: 16px;
	text-transform: capitalize;
	color: #2F2F2F;
}


#map nav{
	position: fixed;
	z-index: 300;
	top: 142px;
}
#search{
	background: #fff;
	top: 95px;
	left: 0px;
	border-radius: 0px 24px 24px 0px;
	overflow: hidden;
	box-shadow: 0px 1px 6px #949494;
	height: 46px;
	width: 500px;
}

#search input{
	width: 190px;
	box-sizing: border-box;
	outline: none;
	padding: 2px 20px;
	font-size: 16px;
	border: 0px;
	font-weight: 300;
	transform: translateY(40%);
	text-transform: capitalize;
}


#search input[name='pays']{
	border-right: 1px solid #cecece;
	margin-left: 20px;
}
#search .img{
	background-size: contain;
	display: inline-block;
	position: relative;
	background-repeat: no-repeat;
}
#search .img_search{
	background-image: url('img/search<?php echo $version["image_css"];?>.png');
	float: right;
	right: 12px;
	top: 5px;
	width: 32px;
	height: 32px;
}
#search .img_info{
	float: left;
	top: 5px;
	left: 0px;
	background-image: url('img/info_blue<?php echo $version["image_css"];?>.png');
	width: 24px;
	height: 24px;
	margin-left: 10px;
	transform: translateY(5px);
	cursor: pointer;
}

nav.off_info .img_info{
	filter: grayscale(100%);
}
nav.on_info .img_info, .img_info:hover{
	filter: grayscale(0%)!important;
}

#info{
	width: 470px;
	background: #fff;
	font-size: 13px;
	font-weight: 300;
	padding: 6px 22px;
	box-sizing: border-box;
	position: absolute;
	top: 52px;
	border-radius: 0 7px 7px 0px;
	box-shadow: 0px 0px 6px #656565;
	border-left: 0px solid #005dee;
	border-right: 0px solid #005dee;
	transition: all 600ms ease;
}
nav.on_info #info{
	border-left-width: 7px;
	left: 10px;
}
nav.off_info #info{
	border-right-width: 7px;
	left: -464px;
}

#info .green{
	color: #00d08f;
}
#info .blue{
	color: #005dee;
}

/*
	##### FORMULAIRE ####
*/

.formulaire {
    background: #fff;
    min-width: 550px;
    width: 30%;
    max-width: 800px;
    height: 100%;
    top: 70px;
    position: fixed;
    box-sizing: border-box;
    z-index: 500;
    padding-bottom: 150px;
    overflow-x: hidden;
    overflow-y: auto;
    box-shadow: 6px 0px 20px #0000006b;
}
.formulaire.shown{
	right: 0px;
}
.formulaire.hidden{
	right: -800px;
}
.formulaire form{
	position: relative;
	top: 39px;
	margin: auto;
	width: 92%;
	overflow-x: hidden;

}

.formulaire.black{
	border-left: 8px solid #2e2e2e;
}
.formulaire.green{
	border-left: 8px solid #00D08F;
}
.formulaire.blue{
	border-left: 8px solid #005DEE;
}
.formulaire.red{
	border-left: 8px solid #ee0042;
}

.formulaire .title{
	margin: auto;
	display: block;
	width: 268px;
}
.formulaire .title span{
	display: inline-block;
}

.formulaire .title .img.donner{
	background-image: url('img/materiel/donner<?php echo $version["image_css"];?>.png');
}
.formulaire .title .img.recevoir{
	background-image: url('img/materiel/recevoir<?php echo $version["image_css"];?>.png');
}
.formulaire .title .img.signin{
	background-image: url('img/connexion<?php echo $version["image_css"];?>.png');
}
.formulaire .title .img.signup{
	background-image: url('img/signup<?php echo $version["image_css"];?>.png');
}

.formulaire .title .img{
	background-size: contain;
	background-repeat: no-repeat;
	width: 90px;
	height: 90px;
}
.formulaire .title .text{
	text-transform: uppercase;
	font-size: 20px;
	font-family: 'Avenir Condensed';
	color: #232323;
	position: relative;
	font-weight: bold;
	left: 16px;
	width: 170px;
	text-align: center;
	top: -36px;
}


.form{
	margin-top: 54px;
}

.section, .section label{
	width: 92%;
	display: inline-block;
	cursor: pointer;
	transition: all 300ms ease;
	margin: auto;
	transform: translateX(6%);
}
.section label:hover input, .formulaire form input:hover{
	background-color: #ededed!important;
}

.section label > div{
	display: inline-block;
}

.section .left, .section .img{
	width: 27%;
}
.section .text{
	width: 89px;
	text-align: center;
	font-size: 14px;
	text-transform: uppercase;
	vertical-align: middle;
	margin: auto;
}

.section .img{
	overflow: hidden;
	height: 80px;
}
.section .img,.section img{
	width: 80px;
	margin: auto;
}
.section img{
	/*(120px + 80px)/2*/
	transform: translateY(20px);
}

.section .right{
	position: relative;
	vertical-align: middle;
	width: 72%;
	bottom: 26px;
}

.section .label{
 	font-size: 14px;
 	text-transform: capitalize;
 	position: relative;
 	bottom: 15px;
 	left: 12%;
}

.formulaire input{
  	border: 1px solid #979797;
  	border-radius: 34px;
  	background-color: #fff;
  	color: #005dee;
  	padding: 10px 32px 9px 32px;
  	width: 80%;
  	outline: none;
  	box-sizing: border-box;
  	margin: auto;
  	display: block;
  	font-size: 20px;
}

.formulaire input::placeholder{
	font-size: 20px;
	color: #7E7E7E;
	font-weight: 300;
	text-transform: capitalize;
}

.formulaire .btt_submit{ 
	height: 56px;
	font-size: 20px;
	line-height: 52px; 
	width: 200px; 
	position: absolute; 
	bottom: 6px;
}

.close_btt{
	transform: rotate(45deg);
	font-family: "Avenir";
	color: #000000;
	font-size: 36.99px;
	font-weight: bold;
	position: fixed;
	cursor: pointer;
	transition: all 200ms ease;
	z-index: 999;
	margin-left: 15px;
	text-shadow: 0px 0px 0px #4a4a4a;
}
.close_btt:hover{
	text-shadow: 0px 0px 6px #4a4a4a;
}

.formulaire .close_btt{
	top: 70px;
}

.formulaire form > div{
	position: relative;
}

.formulaire form > div.shown{
	animation: 400ms linear forwards form_visible;
}
.formulaire form > div.hidden{
	animation: 400ms linear forwards form_hide;
}

@keyframes form_visible{
	from{visibility: hidden; opacity: 0;left: 100%;}
	50%{visibility: visible; opacity: 0;left: 100%;}
	to{visibility: visible; opacity: 1;left: 0%;}
}
@keyframes form_hide{
	from{visibility: visible; opacity: 1;left: 0%;}
	50%{visibility: visible; opacity: 0;left: 100%;}
	to{visibility: hidden; opacity: 0;left: 100%;}
}

.formulaire form input{
	width: 70%;
	margin-top: 20px;
	margin-bottom: 36px;
	font-weight: normal;
	font-size: 17px;
	box-sizing: border-box;
	transition: all 200ms ease;
}

.formulaire input.empty{
	border: 1px solid #ff6c6c;
    box-shadow: inset 0 0 2px #ff0000de;
    color: black;
    border-radius: 4px;
}

.formulaire form input:focus{
	border-radius: 2px;
	width: 78%;
}

.formulaire form input:disabled {
    cursor: no-drop;
    background: #e0e0e0;
}

.formulaire .btt_submit.next{
	left: 6%;
}
.formulaire .btt_submit.submit{
	right: 6%;
}

.formulaire .bottom{
	bottom: 0;
	background: #ffffff;
	width: 518px;
	box-sizing: border-box;
	height: 75px;
	border-top: 1px solid grey;
	position: fixed;

}

.formulaire .form.right{
	position: relative;
	bottom: 1002px;
}

.checkbox{
	width: 70px;
	height: 32px;
	display: block;
	border-radius: 20px;
	cursor: pointer;
	transition: all 300ms ease;
	margin: auto;
	/*box-shadow: inset 0px 0px 4px #00000082;*/
}

.checkbox::before{
	content: '';
	width: 22px;
	height: 22px;
	background: #fff;
	display: block;
	border-radius: 50%;
	position: relative;
	transition: all 300ms ease;
	top: 5px;
	opacity: 0.8;
	/*box-shadow: 0px 0px 7px #464646;*/
}
.checkbox.on{
	background: #00d08f;
}
.checkbox.on::before{
	left: 38px;
	animation: 300ms linear checkboxSwitch;
}
.checkbox.off{
	background: #ee0042;
}
.checkbox.off::before{
	left: 4px;
	animation: 300ms linear checkboxSwitch;
}

.checkbox:hover::before{
	width: 26px;
	height: 26px;
	top: 3px;
	opacity: 1;
}

.checkbox input[type='checkbox']{
	opacity: 0;
	display: none;
}


.formulaire .form.right p{
	text-align: center;
	font-size: 14px;
	font-weight: 300;
	width: 410px;
	margin: auto;
	background: #ee0042;
	color: white;
	padding: 12px 6px;
	box-sizing: border-box;
	margin-top: 20px;
}

.formulaire img.account{
    width: 150px;
    height: 150px;
    margin: auto;
    display: block;
}

.formulaire .info input{
	margin-bottom: 10px;
}

.formulaire .info label {
	display: block;
    text-align: left;
    position: relative;
    top: 8px;
    left: 105px;
    font-size: 21px;
    text-transform: capitalize;
    font-weight: normal;
}

/*
#### AUTRES FICHIERS #####
*/

#page div.paragraphe{
    position: relative;
    top: 50px;
    text-align: justify;
    font-size: 17px;
    font-weight: 300;
    line-height: 25px;
	background: #fff;
	box-shadow: 0px 0px 5px #424242;
	padding: 30px 80px;
    box-sizing: border-box;
}
#page div.paragraphe, #page > .center{
	width: 80%;
    min-width: 600px;
    max-width: 800px;
    margin: auto;
    display: block;
}

iframe.center{
	margin-top: 80px!important;

}

.article label.mdp{
	width: 100%;
}

.article label.mdp .mdp{
	content: 'Afficher';
	position: relative;
	bottom: 77px;
	float: right;
	right: 85px;
	font-size: 17px;
	cursor: pointer;
	border-left: 1px solid #c2c2c2;
	padding: 6px 13px;
}



/*
	###### BOTTOM #######
*/

#btt_bottom{
	position: fixed;
    bottom: 0;
    left: 50%;
    transform: translate(-50%);
    padding: 4px 30px;
    font-size: 12px;
    border-radius: 18px 18px 0px 0px;
    cursor: pointer;
    background: #fff;
    color: #000!important;
    box-shadow: 0px 2px 3px #2e2e30;
    transition: background 300ms ease, bottom 600ms ease-in-out;
}
#btt_bottom:hover{
	background: #ff3b3b;
	color: white!important;
}

#bottom{
    position: fixed;
    bottom: -300px;
    background: #2e2e30;
    width: 100%;
    height: 300px;
    padding: 25px 50px;
    box-sizing: border-box;
    transition: bottom 600ms ease-in-out;
    box-shadow: inset 0 2px 23px #252525;
    overflow-y: auto;
    z-index: 300;
}
#bottom.on{
	bottom: 0px;
}

#bottom.on > div{
	bottom: 300px;
}

#bottom * {
    color: #b1b1b1;
    font-family: 'Consolas',monospace;
    font-size: 14px;
    font-weight: bold;
}

#bottom a{
	text-decoration: none;
}

#bottom a:hover{
	color: #dadada;
	text-decoration: underline;
}

#bottom ul {
    display: inline-grid;
    border-left: 1px solid #656565;
    padding: 2px 64px 5px 64px;
}

#bottom ul li{

}

#bottom h3{
    font-size: 18px;
    color: #ededed;
}



@media (orientation: landscape) and (max-width: 1060px){
	/*
		lorsque l'écran est en mode paysage
	*/
	#bouton li{
	    font-size: 14.5px;
	    margin: 0px 4px;
	    height: 40px;
	    line-height: 40px;
		margin-top: 4px;
	}

	#map nav{
		top: 80px;
	}
}



/*
 FORMULAIRE MAP RECHERCHE
*/


#search .option{
	position: absolute;
    left: 45px;
    top: 42px;
    background: white;
    width: 196px;
    box-sizing: border-box;
    z-index: 50;
    border: 1px solid #d0d0d0;
    font-weight: 300;
    max-height: 252px;
    overflow: auto;
    opacity: 0;
}

#search input[name="pays"]:focus + .option{
	opacity: 1;
}

#search .option div {
    background: #fff;
    padding: 8px 28px;
    border-bottom: 1px solid #8b8b8b;
}
#search .option div:hover{
	background: #e1e1e1;
}