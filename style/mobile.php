<?php
	header('content-type: text/css');
	require "../serveur/versioning.php";
	// nous utilisons php pour appliquer le versioning des images
?>

@charset 'utf-8';

*{
	transition: all 220ms ease;
}

#_box{
    z-index: 5000;
    width: 98%;
    padding: 47px 72px;
    box-sizing: border-box;
}

#_box.on{
	top: 30px;
}


#_box p.mssg{
	font-size: 40px
}

.close_btt{
    font-size: 120px;
    top: 15px;
    left: 25px;
    position: absolute;
}



header{
	height: 150px;
}
#bouton{
	background: #fff;
	box-shadow: 0px 4px 8px #dfebff;
	width: 100%;
	right: -110%;
	top: 148px;
	box-sizing: border-box;
	transition: right 500ms ease;
}
#bouton.on{
	right: 0;
}


#bouton > .btt{
	background-image: url("/img/menu<?php echo $version["image_css"];?>.png");
    content: '';
    position: fixed;
    background-repeat: no-repeat;
    background-size: contain;
    width: 85px;
    height: 85px;
    right: 32px;
    top: 32px;
    border-radius: 50%;
    background-color: #fff;
}
#bouton > .btt:hover{
	background-color: #e6e6e6;
}


#bouton li{
	display: block;
	font-size: 50px;
	margin: 45px 25px;
	width: 450px;
	box-sizing: border-box;
	padding: 55px 0px;
	line-height: 0px;
	width: 90%
}
#bouton ul > .btt{
	border-bottom: 1px solid;
}

#bouton .btt_submit.green{
	background: #00d08f;
	color: #fff;
}
#bouton .btt_submit.black{
	background: #111111;
	color: #fff;
}

#logo img{
	width: 150px;
	height: 150px;
}
#logo #title{
	left: 50%;
	font-size: 61px;
	top: 48px;
	transform: translate(-50%);
	min-width: 650px;
	text-align: center;
	line-height: 1;
}

#lang{
	display: none;
}


#map nav{
	width: 100%;
	top: 170px;
}
#search{
	position: absolute;
	width: 100%;
	border-radius: 0;
	top: 0;
	font-size: 50px;
	height: 100px;
	overflow: visible;
}
#search input{
	margin-left: 0;
	text-align: center;
	width: 40%;
	padding: 28px 20px;
	position: relative;
	bottom: 38px;
	font-size: 35px;
	font-weight: normal;
	font-family: 'Avenir';
	line-height: 0;
	height: 99%;
}


#search input[name='pays']{
	margin-left: 0;
}
#search .img_search{
	width: 80px;
	height: 80px;
	top: 10px;
	right: 38px;
}
#search .img_info{
	width: 50px;
	height: 50px;
	top: 20px;
	left: 1px;
}


#info{
	width: 95%;
	font-size: 32px;
	padding: 18px 32px;
	top: 112px;

}
nav.on_info #info{
	border-left-width: 12px;
}
nav.off_info #info{
	left: -920px;
	border-right-width: 12px;
}

#map bottom .btt_submit{
	width: 250px;
	height: 250px;
    border-radius: 50%;
    padding: 92px 8px;
    font-size: 38px;
    display: block;
    float: none;
    position: absolute;
	right: -34px;
}


#map bottom .btt_submit:hover{
	font-size: 45px;
	transform: rotate(-45deg);
}

#map bottom .btt_submit:nth-child(2){
	bottom: 240px;
}
#map bottom .btt_submit:last-child{
	bottom: 30px;
}

#map .legend{
	bottom: 130px;
	height: 300px;
	min-width: 500px;
	padding-top: 30px;
	padding-left: 120px;
	left: 0;
}
#map .legend:hover{
	left: 0;
}

#map .legend p{
	font-size: 50px;
	text-transform: uppercase;
	color: black;
}

#map .legend .text{
	font-size: 45px;
	text-transform: lowercase;
}

#map .legend .checkbox{
	width: 50px;
	height: 50px;
	border-radius: 50%;
}

#map .checkbox::before{
	width: 50px;
	height: 50px;
}

#map .checkbox.on::before{
	left: 60px;
}




#bottom{
	min-height: 60%;
	bottom: -60%;
}
#bottom.on #btt_bottom{
	bottom: 60%;
}

#btt_bottom{
	font-size: 39px;
	width: 510px;
	text-align: center;
}

#bottom h3{
	font-size: 56px;
	margin: 12px -30px;
}
#bottom *{
	font-size: 35px;
	font-weight: normal;
}

.formulaire .close_btt {
    top: -10px;
}

.formulaire{
	top: 150px;
    width: 100%;
    max-width: unset;
}

.formulaire.hidden{
	right: -100%;
}

.formulaire .bottom{
	width: 100%;
	height: 195px;
}

.formulaire .btt_submit.submit {
    right: 50px;
}
.formulaire .btt_submit.next {
    left: 35px;
}
.formulaire .btt_submit {
    font-size: 52px;
    height: 140px;
    line-height: 132px;
    border-radius: 70px;
    bottom: 32px;
    width: 415px;
}

.formulaire .info label{
	font-size: 55px;
}

.formulaire form input {
    font-size: 60px;
    padding: 30px 50px;
    border-radius: 70px;
    width: 90%;
    text-align: center;
    margin-top: 52px;
}

.formulaire input {
    font-size: 60px;
    padding: 30px 50px;
    border-radius: 70px;
    width: 90%;
    text-align: center;
    margin-top: 52px;
}

.formulaire input::placeholder{
	font-size: 60px;
}

.formulaire span, .formulaire p {
    font-size: 50px!important;
    text-align: center;
}

.formulaire form .title .img{
	width: 210px;
    height: 210px;
    margin-bottom: 42px;
}

span.mdp{
	display: none;
}

.checkbox{
	width: 300px;
    height: 110px;
    border-radius: 70px;
}

.checkbox::before, .checkbox:hover::before {
    width: 102px;
    height: 102px;
}

.checkbox.on::before {
    left: 192px;
}


.formulaire form{
	width: 100%;
}

.section, .section label{
	width: 100%;
	transform: translateY(0);
}

.section .img, .section img{
	width: 210px;
}

.section .img{
	height: 210px;
}

.section .text{
	width: unset;
	font-size: 54px;
}

.section label > div{
	width: 100%!important;
}

.section .label {
    font-size: 60px;
    position: relative;
    bottom: -55px;
    left: 0;
    text-align: center;
    color: #32b2d8;
}

.white_space{
	height: 150px;
}

.formulaire .title{
    width: 208px;
    border-bottom: 8px solid #32b2d8;
}



.formulaire.black{
	border-top: 30px solid #2e2e2e;
	border-left: 0px;
}
.formulaire.green{
	border-top: 30px solid #00D08F;
	border-left: 0px;
}
.formulaire.blue{
	border-top: 30px solid #005DEE;
	border-left: 0px;
}
.formulaire.red{
	border-top: 30px solid #ee0042;
	border-left: 0px;
}

.btt_submit{
	border-width: 9px;
}


#page div.paragraphe, #page > .center{
	width: 100%;
	max-width: unset;
}

iframe{
	height: 982px;
}
iframe.center{
	margin-top: 0px!important;
}

#page .paragraphe p{
	font-size: 20px;
}
#page .paragraphe h4{
	font-size: 35px;
}

#lang_menu a{
	padding: 2px 90px;
    font-size: 60px;
}
#lang_menu{
    width: 525px;
    margin: auto;
    display: block;
}



#search .option{
    left: 74px;
    top: 85px;
    width: 374px;
    max-height: 600px;
}
#search .option div{
	font-size: 40px;
	text-align: center;
}
