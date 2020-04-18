var f = {};
var o = {};


/*
###### FONCTION DE BASE ####
*/

f.query = function(elmt, all=false){
	if(all == true){
		return document.querySelectorAll(elmt);
	}
	return document.querySelector(elmt);
}

var onReady = function(){

/*
##### VARIABLE ####
*/

o.carte = {};
o.carte.box = {
	maker: f.query('.checkbox.makers'),
	medical: f.query('.checkbox.medicals')
};

/*
##### FONCTION EVENT #####
*/

f.clickEvent = function(e, v = null){

	// fonction déclenchée par un clique
	// permettant de restribuer vers les fonctions associées

	if(v == null){
		v = e.target.getAttribute('data-click');
	}

	try{
		f.page.load[v](e);

	}catch(err){
		//console.error(err);
	}

};

f.page = {};
f.page.load = {};

f.page.load.action = function(e, action){

	// affichage de la popup de droite
	var page = f.query('.formulaire', true);

	var bottom = f.query("#map bottom");
	var btt = f.query('header .'+action);
	var p = [];

	for(var i = 0; i < page.length; i++){

		if(page[i].id == action){
			// si la page correspond à l'action
			if(/hide/.test(page[i].className)){
				// on affiche l'onglet et on cache le bottom de la map, et on 'allume' le bouton
				p = ['visible', 'hide', 'on', 'off'];
			}else{
				p = ['hide', 'visible', 'off', 'on'];
			}

			page[i].classList.add(p[0]);
			page[i].classList.remove(p[1]);

		}else if(/visible/.test(page[i].className)){
			// on chache toutes les autres fenêtre non caché
			page[i].classList.add('hide');
			page[i].classList.remove('visible');
			let _btt = f.query('header .' + page[i].id);
			_btt.classList.add('off');
			_btt.classList.remove('on');
		}


		// peut importe les cas, on mettra la première page de chaque formulaire
		let left = page[i].querySelector('.form.left');
		let right = page[i].querySelector('.form.right');

		if(!/visible/.test(left.className)){
			// si le left n'est pas affiché par défault
			left.classList.add('visible');
			left.classList.remove('hide');

			right.classList.add('hide');
			right.classList.remove('visible');
		}

	}


	bottom.classList.add(p[1]);
	bottom.classList.remove(p[0]);

	btt.classList.add(p[2]);
	btt.classList.remove(p[3]);

};

f.page.load.recevoir = f.page.load.donner = function(e){
	// on assigne les fonctions recevoir et donner à la même fonction
	f.page.load.action(e, e.target.getAttribute('data-click'));
};

f.page.load.next = function(e){

	// permet de switcher entre les éléments du formaulaire

	var bloc1 = e.target.parentNode.parentNode;


	if(/left/.test(bloc1.className)){
		var bloc2 = bloc1.parentNode.querySelector('.form.right');
	}else{
		var bloc2 = bloc1.parentNode.querySelector('.form.left');
	}

	// les div left ou right de chaque onglet respectif du bouton déclencheur
	var p = [];

	if(/hide/.test(bloc1.className)){
		p = ['visible', 'hide'];
	}else{
		p = ['hide', 'visible'];
	}

	bloc1.classList.add(p[0]);
	bloc1.classList.remove(p[1]);	

	bloc2.classList.add(p[1]);
	bloc2.classList.remove(p[0]);

	// on remonte le scroll en haut lors du changement de page du formulaire
	var y = bloc1.parentNode.parentNode.scrollTop
	var formulaire = bloc1.parentNode.parentNode
	var t = setInterval(function(){
		if(y > 0){
			formulaire.scrollTo(0, y);
			y-=10;
		}else{
			clearInterval(t);
		}
	}, 10);



};


f.page.load.submit = function(e){
	let inputs = f.query('#' + e.target.getAttribute('data-form') + 'input', true);

	alert("Oops, les données ne sont pas envoyées sur le serveur car nous sommes en phases de test !\n\nMerci d'avoir utilisé notre platforme :D");

};

f.page.load.map_info = function(e){

	let nav = e.target.parentNode.parentNode;
	let p = [];

	if(/off/.test(nav.className)){
		// si message d'info cacher, on l'affiche
		p = ['on', 'off'];
	}else{
		p = ['off', 'on'];
	}

	nav.classList.add(p[0] + "_info");
	nav.classList.remove(p[1] + "_info");

};



o.carte.box.checker = function(e){
	if(/on/.test(e.target.className)){
		var v = ['on','off'];
	}else{
		var v = ['off','on'];
	}
	console.log(v);
	e.target.classList.remove(v[0]);
	e.target.classList.add(v[1]);

};

/*
#### EVENT CALL ASSIGNEMENT ###
*/

o.carte.box.maker.addEventListener('click', o.carte.box.checker);
o.carte.box.medical.addEventListener('click', o.carte.box.checker);

document.addEventListener('click', function(e){

	let elmt = e.target;
	let attr = e.target.getAttribute('data-click');
// gestion des cliques
	if(attr){

		f.clickEvent(e, attr);

	}

});




};