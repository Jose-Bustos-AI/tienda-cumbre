<?php
/**
 * Cumbre: módulo a medida de la tienda de ejemplo Cumbre (trail running y montaña).
 * Portada propia, buscador de zapatillas, ficha con barras de la zapatilla, aviso de tienda de prueba, pago de prueba y estilos.
 * Hecho por Dania360.
 */

use PrestaShop\PrestaShop\Core\Payment\PaymentOption;

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__ . '/classes/CumbreDatos.php';

class Cumbre extends PaymentModule
{
    public function __construct()
    {
        $this->name = 'cumbre';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Dania360';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->ps_versions_compliancy = ['min' => '8.0.0', 'max' => _PS_VERSION_];
        $this->currencies = true;
        $this->currencies_mode = 'checkbox';
        parent::__construct();
        $this->displayName = 'Cumbre';
        $this->description = 'Portada, buscador de zapatillas, estilos y pago de prueba de la tienda de ejemplo Cumbre.';
    }

    public function install()
    {
        return parent::install()
            && $this->registerHook('displayHeader')
            && $this->registerHook('displayHome')
            && $this->registerHook('displayAfterBodyOpeningTag')
            && $this->registerHook('displayProductAdditionalInfo')
            && $this->registerHook('displayFooterAfter')
            && $this->registerHook('paymentOptions')
            && $this->registerHook('displayPaymentReturn');
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->registerStylesheet('cumbre-css', 'modules/' . $this->name . '/views/css/cumbre.css', ['media' => 'all', 'priority' => 900]);
        $this->context->controller->registerJavascript('cumbre-js', 'modules/' . $this->name . '/views/js/cumbre.js', ['position' => 'bottom', 'priority' => 900]);
        return '<link rel="preload" href="' . $this->_path . 'views/fonts/archivo.woff2" as="font" type="font/woff2" crossorigin>'
            . '<meta name="robots" content="noindex, nofollow">';
    }

    public function hookDisplayAfterBodyOpeningTag()
    {
        return '<div class="cumbre-aviso">Tienda de demostración hecha por <a href="https://tiendas.dania360.com/">Dania360</a>: puedes comprar de prueba, no se cobra nada ni se envía nada.</div>';
    }

    private function precio($valor)
    {
        return $this->context->getCurrentLocale()->formatPrice($valor, $this->context->currency->iso_code);
    }

    /** Datos de las zapatillas para el buscador: precio, foto y enlace a cada talla. */
    private function datosBuscador()
    {
        $idLang = (int) $this->context->language->id;
        $salida = [];
        foreach (CumbreDatos::zapatillas() as $ref => $z) {
            $id = (int) Product::getIdByReference($ref);
            if (!$id) {
                continue;
            }
            $p = new Product($id, false, $idLang);
            $portada = Product::getCover($id);
            $tallas = [];
            foreach ($p->getAttributeCombinations($idLang) as $c) {
                $tallas[$c['attribute_name']] = $this->context->link->getProductLink($p, null, null, null, null, null, (int) $c['id_product_attribute']);
            }
            $actual = Product::getPriceStatic($id, true);
            $normal = Product::getPriceStatic($id, true, null, 6, null, false, false);
            $ficha = [];
            foreach (CumbreDatos::productos() as $d) {
                if ($d['ref'] === $ref) {
                    $ficha = $d['ficha'];
                }
            }
            $salida[] = [
                'ref' => $ref,
                'nombre' => $p->name,
                'precio' => $this->precio($actual),
                'antes' => $normal > $actual + 0.01 ? $this->precio($normal) : '',
                'img' => $portada ? $this->context->link->getImageLink($p->link_rewrite, $id . '-' . $portada['id_image'], 'home_default') : '',
                'url' => $this->context->link->getProductLink($p),
                'tallas' => $tallas,
                'terreno' => $z['terreno'],
                'distancia' => $z['distancia'],
                'estabilidad' => $z['estabilidad'],
                'claves' => $z['claves'],
                'ficha' => $ficha,
            ];
        }
        return $salida;
    }

    public function hookDisplayHome()
    {
        $destacados = '';
        $modulo = Module::getInstanceByName('ps_featuredproducts');
        if ($modulo && $modulo->active) {
            $destacados = $modulo->renderWidget('displayHome', []);
        }

        $categorias = [];
        foreach (CumbreDatos::categorias() as $clave => $cat) {
            $idCat = (int) Configuration::get('CUMBRE_CAT_' . strtoupper($clave));
            if ($idCat) {
                $categorias[] = [
                    'nombre' => $cat['nombre'],
                    'texto' => $cat['corta'],
                    'url' => $this->context->link->getCategoryLink($idCat),
                    'img' => $this->_path . 'views/img/productos/' . $cat['foto'],
                ];
            }
        }

        $this->context->smarty->assign([
            'cumbre_ruta' => $this->_path,
            'cumbre_destacados' => $destacados,
            'cumbre_categorias' => $categorias,
            'cumbre_tallas' => CumbreDatos::tallasZapatilla(),
            'cumbre_buscador' => json_encode($this->datosBuscador(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP),
            'cumbre_tienda' => $this->context->link->getCategoryLink((int) Configuration::get('PS_HOME_CATEGORY')),
        ]);

        return $this->fetch('module:cumbre/views/templates/hook/portada.tpl');
    }

    public function hookDisplayProductAdditionalInfo($params)
    {
        $html = '';
        $id = isset($params['product']['id_product']) ? (int) $params['product']['id_product'] : 0;
        $ref = $id ? (new Product($id))->reference : '';
        $zapatillas = CumbreDatos::zapatillas();
        if (isset($zapatillas[$ref])) {
            $z = $zapatillas[$ref];
            $html .= '<div class="cumbre-perfil"><p class="cumbre-perfil__titulo">Así es esta zapatilla</p><dl>';
            foreach ($z['barras'] as $nombre => $valor) {
                $html .= '<div><dt>' . htmlspecialchars($nombre) . '</dt><dd aria-label="' . (int) $valor . ' de 5"><span style="--v:' . (int) $valor . '"></span></dd></div>';
            }
            $html .= '</dl><ul>';
            foreach ($z['claves'] as $c) {
                $html .= '<li>' . htmlspecialchars($c) . '</li>';
            }
            $html .= '</ul><p class="cumbre-perfil__talla"><b>Talla:</b> pide tu talla de siempre. Para ultras, media o una talla más: el pie se hincha tras muchas horas.</p>'
                . '<a class="cumbre-perfil__enlace" href="' . $this->context->link->getPageLink('index') . '#buscador">¿No sabes si es la tuya? Usa el buscador →</a></div>';
        }
        return $html . '<ul class="cumbre-ventajas-ficha">'
            . '<li><b>Envío gratis</b> desde 50 €</li>'
            . '<li><b>30 días</b> para cambiar de talla</li>'
            . '<li><b>Probadas</b> en las sierras de Murcia</li>'
            . '</ul>';
    }

    public function hookDisplayFooterAfter()
    {
        return '<div class="cumbre-pie-base">© Cumbre · Tienda de ejemplo hecha por <a href="https://tiendas.dania360.com/">Dania360</a> con PrestaShop · Fotos creadas para la marca</div>';
    }

    /* ---------- Pago de prueba ---------- */

    public function hookPaymentOptions($params)
    {
        if (!$this->active) {
            return [];
        }
        $opcion = new PaymentOption();
        $opcion->setModuleName($this->name)
            ->setCallToActionText('Pago de prueba')
            ->setAction($this->context->link->getModuleLink($this->name, 'validacion', [], true))
            ->setAdditionalInformation('<p class="cumbre-pago-info">Tienda de demostración: no se pide tarjeta y no se cobra nada. Al confirmar verás cómo termina un pedido real.</p>');
        return [$opcion];
    }

    public function hookDisplayPaymentReturn($params)
    {
        return '<p class="cumbre-pago-info">Este pedido es de prueba: no se ha cobrado nada y no se enviará nada.</p>';
    }
}
