	</div>


<script>
// on attend que la page est fini de se charger
var t = setInterval(function(){

	if(document.querySelector && document.addEventListener){
		// page prête
		<?php if($_GET['page'] == 'index'): ?>
		onReady();
		<?php endif; ?>
		clearInterval(t);
	}

}, 10);

</script>

<div class="white_space"></div>
</body>
</html>