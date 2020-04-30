<div id="info">
<style>
#info{
    left: 50%;
    transform: translate(-50%);
    top: 112px;
    font-size: 18px;
    width: 80%;
    max-width: 800px;
    min-width: 300px;
    border-radius: 7px;
    text-align: center;
}
#info img{
	width: 80%;
}
#info h2{
	cursor: pointer;
	margin: auto;
	padding: 10px 40px;
	width: 756px;
	height: 60px;
	box-sizing: border-box;
}
#info h2 span{
	color: #fff;
	transition: all 300ms ease;
	background: transparent;
	padding: 10px 20px;
	border-radius: 3px;
	animation: 3s infinite btt_h2;
	font-size: 0.9em;
}
#info h2:hover span{
	background: #00d08f;
	font-size: 0.7em;
	padding: 10px 40px;
}

@keyframes btt_h2{
	from{background: #00d08f;}
	50%{background: #005dee;}
	to{background: #00d08f;}
}

#anim{
	width: 30%;
	min-width: 240px;
	position: absolute;
	left: 50%;
	transform: translate(-50%) rotate(0deg);
	transition: all 2s ease;
	cursor: pointer;
}
#anim img{
	width: 100%;
	transition: all 10s ease;
	animation: 5s infinite reverse anim;
}
#anim::before{
	content: '';
	background-image: url("img/logo/anim2.png");
	background-size: contain;
	background-repeat: no-repeat;
	width: 100%;
	height: 100%;
	position: absolute;
	top: 0;
	z-index: 10;
	animation: 5s infinite anim;
}


@keyframes anim{
	from{transform: rotate(0deg);}
	25%{transform: rotate(10deg);}
	50%{transform: rotate(-10deg);}
	75%{transform: rotate(10deg);}
	to{transform: rotate(0deg);}
}

#anim + img{
	margin-top: 200px;
}

@media (orientation: portrait) and (max-width: 1060px){
	#info{
		width: 100%;
		max-width: unset;
		font-size: 50px;
		top: 290px;
	}
	#info img{
		width: 100%;
	}
	#info h2{
		position: relative;
		bottom: 45px;
	}
}
</style>
	<p>
	<?php
		echo search("LPC(.+).</span>", null, false);
	?>
	</p>

	<div class="container">
		<h2><span data-click="signin"><?php echo ucfirst(search("connectons-nous")); ?></span></h2>
		<div id="anim" data-click="signin">
			<img src="img/logo/anim1.png" >
		</div>
		<img src="img/home.png" >
	</div>

</div>


<!--

		from{
		color: #00d08f;
		background: transparent;
		font-size: 1em;
		padding: 10px 20px;
	}
	10%{
		color: #fff;
		background: #00d08f;
		font-size: 0.8em;
		padding: 10px 40px;
	}
	40%{
		color: #fff;
		background: #00d08f;
		font-size: 0.8em;
		padding: 10px 40px;
	}
	50%{
		color: #fff;
		background: #005dee;
		font-size: 0.8em;
		padding: 10px 40px;
	}
	90%{
		color: #fff;
		background: #005dee;
		font-size: 0.8em;
		padding: 10px 40px;
	}
	to{
		color: #00d08f;
		background: transparent;
		font-size: 1em;
		padding: 10px 20px;
	}

	-->