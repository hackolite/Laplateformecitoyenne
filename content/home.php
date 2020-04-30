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
			margin: 0;
		}
		#info h2:hover span{
			color: #000;
			transition: all 300ms ease;
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
			margin-top: 190px;
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
		}
	</style>
	<p>
	<?php
		echo search("LPC(.+).</span>", null, false);
	?>
	</p>

	<div class="container">
		<h2><span class="green" data-click="signin"><?php echo ucfirst(search("connectons-nous")); ?></span></h2>
		<div id="anim" data-click="signin">
			<img src="img/logo/anim1.png" >
		</div>
		<img src="img/home.png" >
	</div>

</div>