<?php
/**
 * Catálogo y textos de la tienda de ejemplo Cumbre (trail running y montaña).
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

class CumbreDatos
{
    public static function categorias()
    {
        return [
            'zapatillas' => ['nombre' => 'Zapatillas de trail', 'url' => 'zapatillas-de-trail', 'foto' => 'roca.jpg', 'corta' => 'Para pistas, roca y barro', 'desc' => 'Tres modelos pensados para terrenos distintos. Usa el buscador de la portada si dudas.'],
            'ropa' => ['nombre' => 'Ropa técnica', 'url' => 'ropa-tecnica', 'foto' => 'chaqueta.jpg', 'corta' => 'Chaquetas, camisetas y mallas', 'desc' => 'Tejidos ligeros que secan rápido y no rozan en las tiradas largas.'],
            'hidratacion' => ['nombre' => 'Mochilas e hidratación', 'url' => 'mochilas-e-hidratacion', 'foto' => 'chaleco.jpg', 'corta' => 'Chalecos y bidones', 'desc' => 'Agua y comida a mano sin tener que pararte.'],
            'accesorios' => ['nombre' => 'Accesorios', 'url' => 'accesorios', 'foto' => 'frontal.jpg', 'corta' => 'Frontales, bastones y más', 'desc' => 'Lo que marca la diferencia cuando el día se alarga o la subida se empina.'],
        ];
    }

    /** Tallas de las zapatillas (EU). */
    public static function tallasZapatilla()
    {
        return ['39', '40', '41', '42', '43', '44', '45'];
    }

    /**
     * Productos. "variantes": [valor => impacto en precio]. Precios con IVA incluido.
     */
    public static function productos()
    {
        $tallas = array_fill_keys(self::tallasZapatilla(), 0);
        $ropa = ['S' => 0, 'M' => 0, 'L' => 0, 'XL' => 0];
        return [
            ['ref' => 'CUM-CRE', 'nombre' => 'Zapatilla Cresta Trail', 'cat' => 'zapatillas', 'foto' => 'cresta.jpg', 'precio' => 129.90,
                'grupo' => 'Talla', 'variantes' => $tallas,
                'corta' => 'La todoterreno: amortiguación media, tacos de 4 mm y una placa antirroca. Igual de cómoda en pista que en senderos con piedra.',
                'larga' => 'Mediasuela de espuma reactiva con placa flexible que protege de las piedras sin perder sensibilidad. Empeine de malla técnica que seca rápido y puntera reforzada. Si solo vas a tener unas zapatillas de trail, son estas.',
                'ficha' => ['Drop' => '6 mm', 'Peso' => '285 g (talla 42)', 'Tacos' => '4 mm', 'Terreno' => 'Mixto y técnico']],
            ['ref' => 'CUM-ROC', 'nombre' => 'Zapatilla Roca Grip', 'cat' => 'zapatillas', 'foto' => 'roca.jpg', 'precio' => 139.90, 'oferta' => 20.00,
                'grupo' => 'Talla', 'variantes' => $tallas,
                'corta' => 'Agarre máximo: tacos de 6 mm y goma pegajosa para barro, roca mojada y bajadas técnicas. Ahora con 20 € de descuento.',
                'larga' => 'Suela de goma blanda con tacos separados que no acumulan barro. Ajuste ceñido y drop bajo para notar el terreno. Pensada para carreras cortas y medias en terreno complicado.',
                'ficha' => ['Drop' => '4 mm', 'Peso' => '270 g (talla 42)', 'Tacos' => '6 mm', 'Terreno' => 'Técnico y barro']],
            ['ref' => 'CUM-SEN', 'nombre' => 'Zapatilla Sendero Max', 'cat' => 'zapatillas', 'foto' => 'sendero.jpg', 'precio' => 119.90,
                'grupo' => 'Talla', 'variantes' => $tallas,
                'corta' => 'Máxima amortiguación y plataforma ancha y estable para tiradas largas y ultras por pistas y senderos.',
                'larga' => 'Mediasuela gruesa de doble densidad que absorbe el impacto hora tras hora, y una base ancha que da estabilidad si tu pisada tiende a irse hacia dentro. Tacos de 3,5 mm para pistas y caminos.',
                'ficha' => ['Drop' => '8 mm', 'Peso' => '310 g (talla 42)', 'Tacos' => '3,5 mm', 'Terreno' => 'Pistas y senderos']],
            ['ref' => 'CUM-CHA', 'nombre' => 'Chaqueta cortavientos ultraligera', 'cat' => 'ropa', 'foto' => 'chaqueta.jpg', 'precio' => 79.90,
                'grupo' => 'Talla', 'variantes' => $ropa,
                'corta' => 'Pesa 95 g y se guarda en su propio bolsillo. Corta el viento en las cimas y repele la llovizna.',
                'larga' => 'Tejido ripstop con tratamiento repelente al agua, capucha ajustable y puños elásticos. Cabe en el chaleco de hidratación sin que lo notes.',
                'ficha' => ['Peso' => '95 g', 'Tejido' => 'Poliamida ripstop', 'Plegada' => 'Tamaño de un puño']],
            ['ref' => 'CUM-CAM', 'nombre' => 'Camiseta técnica de trail', 'cat' => 'ropa', 'foto' => 'camiseta.jpg', 'precio' => 34.90,
                'grupo' => 'Talla', 'variantes' => $ropa,
                'corta' => 'Malla transpirable con costuras planas que no rozan bajo la mochila. Seca en minutos.',
                'larga' => 'Tejido con un 40 % de poliéster reciclado y tratamiento antiolor. Corte ligeramente más largo por detrás para que no se suba con el chaleco.',
                'ficha' => ['Tejido' => 'Poliéster reciclado', 'Costuras' => 'Planas', 'Color' => 'Verde bosque']],
            ['ref' => 'CUM-MAL', 'nombre' => 'Mallas cortas con bolsillos', 'cat' => 'ropa', 'foto' => 'mallas.jpg', 'precio' => 44.90,
                'grupo' => 'Talla', 'variantes' => $ropa,
                'corta' => 'Cinco bolsillos elásticos alrededor de la cintura para geles, móvil y llaves. No botan al correr.',
                'larga' => 'Malla interior de compresión ligera y pantalón exterior suelto. El bolsillo trasero con cremallera guarda el móvil seguro.',
                'ficha' => ['Bolsillos' => '5', 'Largo' => '13 cm de pernera', 'Tejido' => 'Elástico y transpirable']],
            ['ref' => 'CUM-CHL', 'nombre' => 'Chaleco de hidratación 8 L', 'cat' => 'hidratacion', 'foto' => 'chaleco.jpg', 'precio' => 89.90,
                'grupo' => 'Talla', 'variantes' => ['S/M' => 0, 'L/XL' => 0],
                'corta' => 'Ajuste de chaleco que no bota, 8 litros de capacidad y dos bidones blandos de 500 ml incluidos.',
                'larga' => 'Bolsillos delanteros para bidones y geles, compartimento trasero para la chaqueta y enganches para bastones. Ideal para ultras y tiradas largas.',
                'ficha' => ['Capacidad' => '8 L', 'Incluye' => '2 bidones de 500 ml', 'Peso' => '210 g']],
            ['ref' => 'CUM-BID', 'nombre' => 'Bidones blandos 500 ml (2 uds.)', 'cat' => 'hidratacion', 'foto' => 'bidones.jpg', 'precio' => 24.90,
                'corta' => 'Se pliegan cuando se vacían y caben en cualquier chaleco. Boquilla de mordida con cierre.',
                'larga' => 'Material sin BPA, apto para bebidas isotónicas. Se lavan a mano con agua tibia.',
                'ficha' => ['Capacidad' => '500 ml cada uno', 'Material' => 'TPU sin BPA']],
            ['ref' => 'CUM-FRO', 'nombre' => 'Frontal recargable 400 lúmenes', 'cat' => 'accesorios', 'foto' => 'frontal.jpg', 'precio' => 49.90, 'oferta' => 10.00,
                'corta' => 'Luz potente para salir antes del amanecer o volver de noche. Se carga por USB-C. Ahora con 10 € de descuento.',
                'larga' => 'Tres modos de luz y luz roja para no deslumbrar. Hasta 40 horas en modo bajo. Cinta elástica que no se mueve al correr.',
                'ficha' => ['Potencia' => '400 lúmenes', 'Autonomía' => 'Hasta 40 h', 'Carga' => 'USB-C']],
            ['ref' => 'CUM-BAS', 'nombre' => 'Bastones plegables de carbono', 'cat' => 'accesorios', 'foto' => 'bastones.jpg', 'precio' => 99.90,
                'corta' => 'Par de bastones de carbono plegables en tres tramos. Para las subidas largas en las que andar es correr.',
                'larga' => 'Pesan 150 g cada uno y se pliegan en segundos para guardarlos en el chaleco. Puño de espuma que no resbala con el sudor.',
                'ficha' => ['Peso' => '150 g cada uno', 'Largo' => '120 cm', 'Plegados' => '38 cm']],
            ['ref' => 'CUM-CAL', 'nombre' => 'Calcetines de trail (pack de 3)', 'cat' => 'accesorios', 'foto' => 'calcetines.jpg', 'precio' => 19.90,
                'grupo' => 'Talla', 'variantes' => ['S (36-39)' => 0, 'M (40-43)' => 0, 'L (44-47)' => 0],
                'corta' => 'Caña media que no deja entrar piedras, refuerzo en talón y puntera, y sin costuras. Tres colores.',
                'larga' => 'Lana merino y fibra técnica: abrigan sin sudar y no huelen aunque los uses varios días seguidos.',
                'ficha' => ['Material' => 'Merino y poliamida', 'Caña' => 'Media']],
            ['ref' => 'CUM-GOR', 'nombre' => 'Gorra técnica ligera', 'cat' => 'accesorios', 'foto' => 'gorra.jpg', 'precio' => 22.90,
                'corta' => 'Visera flexible que se puede doblar y paneles de malla para que no se acumule el calor.',
                'larga' => 'Banda interior que absorbe el sudor y cierre trasero ajustable. Pesa 45 g.',
                'ficha' => ['Peso' => '45 g', 'Talla' => 'Única ajustable']],
        ];
    }

    /**
     * Zapatillas del buscador: puntos por terreno, distancia y estabilidad (de 0 a 3),
     * barras de la ficha (1 a 5) y por qué encaja.
     */
    public static function zapatillas()
    {
        return [
            'CUM-CRE' => [
                'terreno' => ['pistas' => 2, 'mixto' => 3, 'tecnico' => 3, 'barro' => 1],
                'distancia' => ['corta' => 2, 'media' => 3, 'ultra' => 2],
                'estabilidad' => 2,
                'barras' => ['Amortiguación' => 3, 'Agarre' => 4, 'Ligereza' => 4],
                'claves' => ['Placa antirroca que protege sin perder sensibilidad', 'Tacos de 4 mm: agarra en piedra y no molesta en pista', 'La más versátil: una sola zapatilla para casi todo'],
            ],
            'CUM-ROC' => [
                'terreno' => ['pistas' => 1, 'mixto' => 2, 'tecnico' => 3, 'barro' => 3],
                'distancia' => ['corta' => 3, 'media' => 2, 'ultra' => 1],
                'estabilidad' => 1,
                'barras' => ['Amortiguación' => 2, 'Agarre' => 5, 'Ligereza' => 5],
                'claves' => ['Tacos de 6 mm separados que no acumulan barro', 'Goma blanda que se pega a la roca mojada', 'Ajuste ceñido y drop bajo para bajar con confianza'],
            ],
            'CUM-SEN' => [
                'terreno' => ['pistas' => 3, 'mixto' => 2, 'tecnico' => 1, 'barro' => 1],
                'distancia' => ['corta' => 1, 'media' => 2, 'ultra' => 3],
                'estabilidad' => 3,
                'barras' => ['Amortiguación' => 5, 'Agarre' => 3, 'Ligereza' => 3],
                'claves' => ['Máxima amortiguación para muchas horas seguidas', 'Plataforma ancha y estable si tu pie se va hacia dentro', 'Drop de 8 mm: menos carga para gemelos y tendón de Aquiles'],
            ],
        ];
    }
}
