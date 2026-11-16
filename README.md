# Cumbre · tienda PrestaShop de demostración

Tienda de trail running y montaña: zapatillas, ropa técnica, chalecos de hidratación y accesorios, con un buscador en la portada que te recomienda zapatilla y talla según por dónde corres, qué distancias haces y cómo pisas.

**Verla publicada:** https://cumbre.dania360.com/

## Qué hay en este repositorio
Solo el módulo hecho a medida para esta tienda; PrestaShop no se incluye.

```
modulo/cumbre/cumbre.php                 Módulo principal: ganchos de la portada, estilos y scripts
modulo/cumbre/classes/                  Datos del catálogo
modulo/cumbre/controllers/front/        Montaje de la tienda y pago de demostración
modulo/cumbre/views/                    Plantilla de la portada, CSS sobre el tema Hummingbird, JavaScript y tipografías
```

## Cómo está hecha
- PrestaShop 9.2 con el tema oficial Hummingbird, en el hosting de Hostinger, con su propio subdominio y certificado de seguridad
- Módulo propio para PrestaShop que añade la portada, el buscador, los estilos, el aviso de tienda de prueba y el pago de prueba
- Paleta de montaña (verde bosque, piedra y naranja) y tipografía Archivo servida desde la propia tienda
- Portada con foto a pantalla completa, buscador de zapatillas, categorías con foto, productos destacados, historia del equipo y preguntas frecuentes desplegables
- Tienda, carrito y pago en español, también los textos que PrestaShop deja en inglés

## Catálogo y compra
- 12 productos en 4 categorías: zapatillas de trail, ropa técnica, mochilas e hidratación y accesorios
- Tallas con su stock: de la 39 a la 45 en zapatillas, de la S a la XL en ropa, y tallas propias en chaleco y calcetines
- Ficha técnica de cada producto (drop, peso, tacos, tejido, capacidad...)
- En las zapatillas, barras de amortiguación, agarre y ligereza y consejo de talla
- Ofertas con precio tachado y etiqueta de descuento
- Fotos de producto creadas para la marca
- Página "Todo el material" con los 12 productos y su propia dirección
- Dos transportistas: envío estándar a 4,95 € y gratis desde 50 €, y exprés en 24 h a 7,95 €
- Cupón de bienvenida BIENVENIDA10 con un 10 % de descuento
- Aviso en el carrito de cuánto falta para el envío gratis, con barra de progreso
- Compra como invitado, sin tener que crear cuenta
- Pago de prueba propio que no pide tarjeta y deja el pedido como pagado, con su factura
- Tres pedidos de prueba completos: zapatilla en oferta elegida desde el buscador, con cupón y envío gratis; desde el móvil con talla y envío exprés; y otro desde el móvil tras la última actualización, con talla, cupón y envío gratis

## Detalles
- Sin módulos de pago: lo propio está en un módulo hecho a medida
- Buscador de zapatillas: terreno, distancia y pisada dan un porcentaje de coincidencia para cada modelo, la recomendación con sus claves y la talla que conviene pedir (una más para ultras); el botón abre la zapatilla con esa talla ya elegida
- Montaje automático del catálogo, las tallas, los transportistas, el cupón y el pago desde el propio módulo
- El módulo se actualiza sobre la tienda instalada, sin reinstalarla ni perder pedidos
- Título y descripción para buscadores en la portada y en la página con todo el material
- Lista para conectar Redsys, Bizum o Stripe cuando sea una tienda real

## Cómo instalarlo
1. PrestaShop 9 con el tema Hummingbird.
2. Copia `modulo/cumbre` en la carpeta `modules/` e instálalo desde el panel.
3. El controlador de montaje solo funciona mientras exista un archivo de claves en la instalación, y se elimina al terminar.

Tipografías de Google Fonts con licencia SIL Open Font License, incluidas en `modulo/cumbre/views/fonts`.

## Sobre esta tienda
Diseño y desarrollo de [Dania360](https://dania360.com). Es una tienda de ejemplo: la marca y los productos son inventados, las fotos se crearon para la marca y el pago es de prueba, no cobra nada. El código se publica para enseñar cómo está hecha; no tiene licencia de uso.

Más tiendas en el portafolio: https://tiendas.dania360.com
