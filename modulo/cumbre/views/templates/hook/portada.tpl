{**
 * Portada de la tienda de ejemplo Cumbre.
 *}
<div class="cumbre-portada">

  <section class="cum-hero" aria-labelledby="cum-hero-titulo">
    <img class="cum-hero__img" src="{$cumbre_ruta}views/img/portada.jpg" alt="Corredor de trail en una cresta de montaña al amanecer, sobre un mar de nubes" width="1920" height="1072" fetchpriority="high">
    <div class="cum-hero__velo" aria-hidden="true"></div>
    <div class="cum-hero__in">
      <p class="cum-ceja">Trail running y montaña · Murcia</p>
      <h1 id="cum-hero-titulo" class="cum-hero__titulo">Sube. <em>Corre.</em> Vuelve a subir.</h1>
      <p class="cum-hero__texto">Zapatillas, ropa técnica e hidratación para correr por montaña. Probamos todo en Sierra Espuña antes de venderlo, y te ayudamos a elegir tu zapatilla en un minuto.</p>
      <div class="cum-botones">
        <a class="cum-btn" href="#buscador">Encuentra tu zapatilla</a>
        <a class="cum-btn cum-btn--claro" href="{$cumbre_tienda}">Ver la tienda</a>
      </div>
      <ul class="cum-hero__datos">
        <li><b>3</b> zapatillas para 4 terrenos</li>
        <li><b>50 €</b> y el envío es gratis</li>
        <li><b>30</b> días para cambiar de talla</li>
      </ul>
    </div>
  </section>

  <section class="cum-ventajas">
    <div><b>Probado en la sierra</b><span>Cada producto ha hecho kilómetros en Espuña y Carrascoy</span></div>
    <div><b>Envío gratis desde 50 €</b><span>Estándar en 48-72 h o exprés en 24 h</span></div>
    <div><b>Cambio de talla gratis</b><span>30 días para que acierte a la primera</span></div>
    <div><b>Te asesoramos</b><span>Corredores de verdad al otro lado</span></div>
  </section>

  <section class="cum-buscador" id="buscador" aria-labelledby="cum-bus-titulo">
    <div class="cum-buscador__in">
      <div class="cum-buscador__cab">
        <p class="cum-ceja">Buscador de zapatillas</p>
        <h2 class="cum-titulo" id="cum-bus-titulo">Tu zapatilla, <em>en tres preguntas.</em></h2>
        <p>Dinos por dónde corres, cuánto y cómo pisas. Te decimos qué modelo encaja contigo y en qué talla pedirlo.</p>
      </div>
      <form class="cum-buscador__form" data-cumbre-buscador onsubmit="return false">
        <fieldset>
          <legend><span>1</span> ¿Por dónde corres?</legend>
          <div class="cum-opciones">
            <label><input type="radio" name="terreno" value="pistas" checked><span>Pistas y senderos</span><small>Caminos anchos y tierra</small></label>
            <label><input type="radio" name="terreno" value="mixto"><span>Un poco de todo</span><small>Senda, piedra y pista</small></label>
            <label><input type="radio" name="terreno" value="tecnico"><span>Técnico y roca</span><small>Pedreras y crestas</small></label>
            <label><input type="radio" name="terreno" value="barro"><span>Barro y mojado</span><small>Invierno y lluvia</small></label>
          </div>
        </fieldset>
        <fieldset>
          <legend><span>2</span> ¿Qué distancias haces?</legend>
          <div class="cum-opciones cum-opciones--3">
            <label><input type="radio" name="distancia" value="corta"><span>Hasta 21 km</span><small>Salidas y carreras cortas</small></label>
            <label><input type="radio" name="distancia" value="media" checked><span>Maratón de montaña</span><small>De 21 a 45 km</small></label>
            <label><input type="radio" name="distancia" value="ultra"><span>Ultra</span><small>Más de 45 km</small></label>
          </div>
        </fieldset>
        <fieldset class="cum-buscador__fila">
          <div>
            <legend><span>3</span> ¿Cómo pisas?</legend>
            <div class="cum-opciones cum-opciones--3">
              <label><input type="radio" name="pisada" value="neutra" checked><span>Neutra</span></label>
              <label><input type="radio" name="pisada" value="pronadora"><span>Se me va hacia dentro</span></label>
              <label><input type="radio" name="pisada" value="nose"><span>No lo sé</span></label>
            </div>
          </div>
          <div class="cum-talla">
            <label for="cum-talla">Tu talla habitual</label>
            <select id="cum-talla" name="talla">
              {foreach $cumbre_tallas as $t}<option value="{$t}"{if $t == '42'} selected{/if}>{$t}</option>{/foreach}
            </select>
          </div>
        </fieldset>
      </form>
      <div class="cum-resultado" aria-live="polite" data-cumbre-resultado></div>
    </div>
    <script type="application/json" data-cumbre-datos>{$cumbre_buscador nofilter}</script>
  </section>

  {if $cumbre_categorias}
  <section class="cum-bloque">
    <div class="cum-bloque__cab">
      <div><p class="cum-ceja cum-ceja--oscura">Equípate</p><h2 class="cum-titulo">Todo para <em>la montaña</em></h2></div>
    </div>
    <div class="cum-categorias">
      {foreach $cumbre_categorias as $cat}
        <a class="cum-categoria cum-revela" href="{$cat.url}">
          <img src="{$cat.img}" alt="" loading="lazy" width="1000" height="1000">
          <span class="cum-categoria__txt"><b>{$cat.nombre}</b><small>{$cat.texto}</small></span>
        </a>
      {/foreach}
    </div>
  </section>
  {/if}

  <section class="cum-bloque cum-bloque--productos">
    <div class="cum-bloque__cab">
      <div><p class="cum-ceja cum-ceja--oscura">Lo más usado por el equipo</p><h2 class="cum-titulo">Nuestro <em>material</em></h2></div>
      <a class="cum-enlace" href="{$cumbre_tienda}">Ver todo →</a>
    </div>
    {$cumbre_destacados nofilter}
  </section>

  <section class="cum-historia">
    <div class="cum-historia__foto cum-revela"><img src="{$cumbre_ruta}views/img/grupo.jpg" alt="Grupo de corredores subiendo por un sendero de montaña entre pinos" loading="lazy" width="928" height="1152"></div>
    <div class="cum-historia__texto cum-revela">
      <p class="cum-ceja cum-ceja--oscura">Quiénes somos</p>
      <h2 class="cum-titulo">Corredores <em>antes que tienda.</em></h2>
      <p>Cumbre nace de un grupo de salidas de los domingos por Sierra Espuña. Hartos de comprar a ciegas, empezamos a probar zapatillas y material juntos y a contar qué funcionaba.</p>
      <p>Hoy solo vendemos lo que usaríamos en nuestra próxima carrera. Si dudas con la talla o el modelo, escríbenos: te contesta alguien que corre.</p>
      <div class="cum-cupon">
        <span>Tu primera compra</span>
        <b>10 %</b>
        <span>con el código <strong>BIENVENIDA10</strong></span>
      </div>
    </div>
  </section>
</div>
