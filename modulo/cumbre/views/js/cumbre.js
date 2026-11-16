/* Cumbre: buscador de zapatillas y animaciones de la portada. */
(function () {
	var reducir = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	// Aparición suave al hacer scroll.
	var revela = document.querySelectorAll('.cum-revela');
	if (reducir || !('IntersectionObserver' in window)) {
		revela.forEach(function (el) { el.classList.add('visto'); });
	} else {
		var obs = new IntersectionObserver(function (es) {
			es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('visto'); obs.unobserve(e.target); } });
		}, { rootMargin: '0px 0px -8% 0px' });
		revela.forEach(function (el, i) { el.style.transitionDelay = (i % 4) * 90 + 'ms'; obs.observe(el); });
	}

	// Buscador de zapatillas.
	var form = document.querySelector('[data-cumbre-buscador]');
	var caja = document.querySelector('[data-cumbre-resultado]');
	var fuente = document.querySelector('[data-cumbre-datos]');
	if (form && caja && fuente) {
		var zapas = [];
		try { zapas = JSON.parse(fuente.textContent) || []; } catch (e) {}
		var esc = function (s) { return String(s).replace(/[&<>"]/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]; }); };
		var valor = function (n) { var r = form.querySelector('[name=' + n + ']:checked'); return r ? r.value : ''; };

		function calcular() {
			var t = valor('terreno'), d = valor('distancia'), p = valor('pisada');
			var talla = form.querySelector('[name=talla]').value;
			var pesoPisada = p === 'pronadora' ? 1.5 : (p === 'nose' ? 0.5 : 0);
			var max = 3 * 2 + 3 * 1.5 + 3 * pesoPisada;
			var lista = zapas.map(function (z) {
				var s = (z.terreno[t] || 0) * 2 + (z.distancia[d] || 0) * 1.5 + z.estabilidad * pesoPisada;
				return { z: z, pct: Math.round(s / max * 100) };
			}).sort(function (a, b) { return b.pct - a.pct; });
			if (!lista.length) { caja.innerHTML = ''; return; }

			// Talla: en ultra, una más (el pie se hincha tras muchas horas).
			var tallas = Object.keys(lista[0].z.tallas);
			var pedir = talla, consejo = 'Pide tu talla de siempre: horman como una zapatilla de asfalto.';
			if (d === 'ultra') {
				var mas = String(parseInt(talla, 10) + 1);
				if (tallas.indexOf(mas) !== -1) { pedir = mas; consejo = 'Para ultras te recomendamos una talla más (' + mas + '): el pie se hincha tras muchas horas y las bajadas castigan los dedos.'; }
			}
			var g = lista[0], z = g.z;
			var urlTalla = z.tallas[pedir] || z.url;
			var ficha = Object.keys(z.ficha || {}).filter(function (k) { return k !== 'Terreno'; }).map(function (k) { return '<li><small>' + esc(k) + '</small><b>' + esc(z.ficha[k]) + '</b></li>'; }).join('');
			var claves = z.claves.map(function (c) { return '<li>' + esc(c) + '</li>'; }).join('');
			var nota = p === 'nose' ? '<p class="cum-res__nota">¿No sabes cómo pisas? Mira la suela de unas zapatillas viejas: si se gastan más por dentro del talón, tu pisada es pronadora.</p>' : '';
			var otras = lista.slice(1).map(function (o) {
				return '<a class="cum-res__otra" href="' + esc(o.z.tallas[pedir] || o.z.url) + '"><img src="' + esc(o.z.img) + '" alt="" width="64" height="64" loading="lazy"><span><b>' + esc(o.z.nombre) + '</b><small>' + o.pct + ' % de coincidencia</small></span><em>' + esc(o.z.precio) + '</em></a>';
			}).join('');

			caja.innerHTML =
				'<article class="cum-res">' +
					'<div class="cum-res__foto"><img src="' + esc(z.img) + '" alt="' + esc(z.nombre) + '" width="400" height="400"><span class="cum-res__pct"><b>' + g.pct + '</b> %<small>de coincidencia</small></span></div>' +
					'<div class="cum-res__info">' +
						'<p class="cum-res__eti">Tu zapatilla</p>' +
						'<h3>' + esc(z.nombre) + '</h3>' +
						'<div class="cum-res__barra" aria-hidden="true"><span style="width:' + g.pct + '%"></span></div>' +
						'<ul class="cum-res__claves">' + claves + '</ul>' +
						'<ul class="cum-res__ficha">' + ficha + '</ul>' +
						'<p class="cum-res__talla"><b>Talla ' + esc(pedir) + '.</b> ' + esc(consejo) + '</p>' + nota +
						'<div class="cum-res__pie"><span class="cum-res__precio">' + (z.antes ? '<del>' + esc(z.antes) + '</del> ' : '') + esc(z.precio) + '</span>' +
						'<a class="cum-btn" href="' + esc(urlTalla) + '">Ver en talla ' + esc(pedir) + '</a></div>' +
					'</div>' +
				'</article>' +
				(otras ? '<div class="cum-res__otras"><p>También te pueden valer</p>' + otras + '</div>' : '');
			caja.classList.remove('entra'); void caja.offsetWidth; caja.classList.add('entra');
		}
		form.addEventListener('change', calcular);
		calcular();
	}

	// Textos que la traducción de PrestaShop deja en inglés o suenan raros.
	var CAMBIOS = [
		['Back to ', 'Volver a '], ['Continue to ', 'Continuar a '], ['Next: ', 'Siguiente: '], ['Ahorre un ', 'Ahorras '],
		['The personal data you provide is used to answer queries, process orders or allow access to specific information. You have the right to modify and delete all the personal information found in the "My Account" page.',
			'Usamos tus datos para responder a tus consultas, gestionar tus pedidos o darte acceso a información concreta. Puedes modificarlos o borrarlos cuando quieras desde "Mi cuenta".']
	];
	function traducir(raiz) {
		var it = document.createTreeWalker(raiz || document.body, NodeFilter.SHOW_TEXT);
		var n;
		while ((n = it.nextNode())) {
			var t = n.nodeValue, nuevo = t;
			CAMBIOS.forEach(function (c) { if (nuevo.indexOf(c[0]) !== -1) nuevo = nuevo.split(c[0]).join(c[1]); });
			if (nuevo !== t) n.nodeValue = nuevo;
		}
	}
	traducir();
	new MutationObserver(function (cambios) {
		cambios.forEach(function (c) { c.addedNodes.forEach(function (nodo) { if (nodo.nodeType === 1) traducir(nodo); else if (nodo.nodeType === 3 && nodo.parentNode) traducir(nodo.parentNode); }); });
	}).observe(document.body, { childList: true, subtree: true });
})();
