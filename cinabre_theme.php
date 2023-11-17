<?php
/**
 * 2007-2023 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2023 PrestaShop SA
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class Cinabre_theme extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'cinabre_theme';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Klorel';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Cinabre - Thème');
        $this->description = $this->l('Module de gestion du thème sur-mesure pour Cinabre.');

        $this->ps_versions_compliancy = ['min' => '1.6', 'max' => _PS_VERSION_];

    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        Configuration::updateValue('CINABRE_THEME_LIVE_MODE', false);

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('displayHome') &&
            $this->registerHook('actionCategoryUpdate') &&
            $this->registerHook('displayBackOfficeHeader');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool) Tools::isSubmit('submitCinabre_themeModule')) == true) {
            echo 'Formulaire enregistré avec succès !';
            $this->postProcess();
        }

        $this->context->smarty->assign('module_dir', $this->_path);

        $imagePaths = [
            'CIN_HOME_UP_L1_IMG_MOBILE_LEFT' => Configuration::get('CIN_HOME_UP_L1_IMG_MOBILE_LEFT'),
            'CIN_HOME_UP_L1_IMG_TABLET_LEFT' => Configuration::get('CIN_HOME_UP_L1_IMG_TABLET_LEFT'),
            'CIN_HOME_UP_L1_IMG_DESKTOP_LEFT' => Configuration::get('CIN_HOME_UP_L1_IMG_DESKTOP_LEFT'),
            'CIN_HOME_UP_L1_IMG_RETINA_MOBILE_LEFT' => Configuration::get('CIN_HOME_UP_L1_IMG_RETINA_MOBILE_LEFT'),
            'CIN_HOME_UP_L1_IMG_RETINA_TABLET_LEFT' => Configuration::get('CIN_HOME_UP_L1_IMG_RETINA_TABLET_LEFT'),
            'CIN_HOME_UP_L1_IMG_RETINA_DESKTOP_LEFT' => Configuration::get('CIN_HOME_UP_L1_IMG_RETINA_DESKTOP_LEFT'),
            'CIN_HOME_UP_L1_IMG_MOBILE_RIGHT' => Configuration::get('CIN_HOME_UP_L1_IMG_MOBILE_RIGHT'),
            'CIN_HOME_UP_L1_IMG_TABLET_RIGHT' => Configuration::get('CIN_HOME_UP_L1_IMG_TABLET_RIGHT'),
            'CIN_HOME_UP_L1_IMG_DESKTOP_RIGHT' => Configuration::get('CIN_HOME_UP_L1_IMG_DESKTOP_RIGHT'),
            'CIN_HOME_UP_L1_IMG_RETINA_MOBILE_RIGHT' => Configuration::get('CIN_HOME_UP_L1_IMG_RETINA_MOBILE_RIGHT'),
            'CIN_HOME_UP_L1_IMG_RETINA_TABLET_RIGHT' => Configuration::get('CIN_HOME_UP_L1_IMG_RETINA_TABLET_RIGHT'),
            'CIN_HOME_UP_L1_IMG_RETINA_DESKTOP_RIGHT' => Configuration::get('CIN_HOME_UP_L1_IMG_RETINA_DESKTOP_RIGHT'),
            'CIN_HOME_UP_L2_IMG_MOBILE_LEFT' => Configuration::get('CIN_HOME_UP_L2_IMG_MOBILE_LEFT'),
            'CIN_HOME_UP_L2_IMG_TABLET_LEFT' => Configuration::get('CIN_HOME_UP_L2_IMG_TABLET_LEFT'),
            'CIN_HOME_UP_L2_IMG_DESKTOP_LEFT' => Configuration::get('CIN_HOME_UP_L2_IMG_DESKTOP_LEFT'),
            'CIN_HOME_UP_L2_IMG_RETINA_MOBILE_LEFT' => Configuration::get('CIN_HOME_UP_L2_IMG_RETINA_MOBILE_LEFT'),
            'CIN_HOME_UP_L2_IMG_RETINA_TABLET_LEFT' => Configuration::get('CIN_HOME_UP_L2_IMG_RETINA_TABLET_LEFT'),
            'CIN_HOME_UP_L2_IMG_RETINA_DESKTOP_LEFT' => Configuration::get('CIN_HOME_UP_L2_IMG_RETINA_DESKTOP_LEFT'),
            'CIN_HOME_UP_L2_IMG_MOBILE_RIGHT' => Configuration::get('CIN_HOME_UP_L2_IMG_MOBILE_RIGHT'),
            'CIN_HOME_UP_L2_IMG_TABLET_RIGHT' => Configuration::get('CIN_HOME_UP_L2_IMG_TABLET_RIGHT'),
            'CIN_HOME_UP_L2_IMG_DESKTOP_RIGHT' => Configuration::get('CIN_HOME_UP_L2_IMG_DESKTOP_RIGHT'),
            'CIN_HOME_UP_L2_IMG_RETINA_MOBILE_RIGHT' => Configuration::get('CIN_HOME_UP_L2_IMG_RETINA_MOBILE_RIGHT'),
            'CIN_HOME_UP_L2_IMG_RETINA_TABLET_RIGHT' => Configuration::get('CIN_HOME_UP_L2_IMG_RETINA_TABLET_RIGHT'),
            'CIN_HOME_UP_L2_IMG_RETINA_DESKTOP_RIGHT' => Configuration::get('CIN_HOME_UP_L2_IMG_RETINA_DESKTOP_RIGHT'),
            'CIN_HOME_CLUB_IMG_DESKTOP_BACKGROUND' => Configuration::get('CIN_HOME_CLUB_IMG_DESKTOP_BACKGROUND'),
            'CIN_HOME_DOWN_L1_IMG_MOBILE_FULLWIDTH' => Configuration::get('CIN_HOME_DOWN_L1_IMG_MOBILE_FULLWIDTH'),
            'CIN_HOME_DOWN_L1_IMG_TABLET_FULLWIDTH' => Configuration::get('CIN_HOME_DOWN_L1_IMG_TABLET_FULLWIDTH'),
            'CIN_HOME_DOWN_L1_IMG_DESKTOP_FULLWIDTH' => Configuration::get('CIN_HOME_DOWN_L1_IMG_DESKTOP_FULLWIDTH'),
            'CIN_HOME_DOWN_L1_IMG_RETINA_MOBILE_FULLWIDTH' => Configuration::get('CIN_HOME_DOWN_L1_IMG_RETINA_MOBILE_FULLWIDTH'),
            'CIN_HOME_DOWN_L1_IMG_RETINA_TABLET_FULLWIDTH' => Configuration::get('CIN_HOME_DOWN_L1_IMG_RETINA_TABLET_FULLWIDTH'),
            'CIN_HOME_DOWN_L1_IMG_RETINA_DESKTOP_FULLWIDTH' => Configuration::get('CIN_HOME_DOWN_L1_IMG_RETINA_DESKTOP_FULLWIDTH'),
            'CIN_HOME_DOWN_L2_IMG_MOBILE_LEFT' => Configuration::get('CIN_HOME_DOWN_L2_IMG_MOBILE_LEFT'),
            'CIN_HOME_DOWN_L2_IMG_TABLET_LEFT' => Configuration::get('CIN_HOME_DOWN_L2_IMG_TABLET_LEFT'),
            'CIN_HOME_DOWN_L2_IMG_DESKTOP_LEFT' => Configuration::get('CIN_HOME_DOWN_L2_IMG_DESKTOP_LEFT'),
            'CIN_HOME_DOWN_L2_IMG_RETINA_MOBILE_LEFT' => Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_MOBILE_LEFT'),
            'CIN_HOME_DOWN_L2_IMG_RETINA_TABLET_LEFT' => Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_TABLET_LEFT'),
            'CIN_HOME_DOWN_L2_IMG_RETINA_DESKTOP_LEFT' => Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_DESKTOP_LEFT'),
            'CIN_HOME_DOWN_L2_IMG_MOBILE_CENTER' => Configuration::get('CIN_HOME_DOWN_L2_IMG_MOBILE_CENTER'),
            'CIN_HOME_DOWN_L2_IMG_TABLET_CENTER' => Configuration::get('CIN_HOME_DOWN_L2_IMG_TABLET_CENTER'),
            'CIN_HOME_DOWN_L2_IMG_DESKTOP_CENTER' => Configuration::get('CIN_HOME_DOWN_L2_IMG_DESKTOP_CENTER'),
            'CIN_HOME_DOWN_L2_IMG_RETINA_MOBILE_CENTER' => Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_MOBILE_CENTER'),
            'CIN_HOME_DOWN_L2_IMG_RETINA_TABLET_CENTER' => Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_TABLET_CENTER'),
            'CIN_HOME_DOWN_L2_IMG_RETINA_DESKTOP_CENTER' => Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_DESKTOP_CENTER'),
            'CIN_HOME_DOWN_L2_IMG_MOBILE_RIGHT' => Configuration::get('CIN_HOME_DOWN_L2_IMG_MOBILE_RIGHT'),
            'CIN_HOME_DOWN_L2_IMG_TABLET_RIGHT' => Configuration::get('CIN_HOME_DOWN_L2_IMG_TABLET_RIGHT'),
            'CIN_HOME_DOWN_L2_IMG_DESKTOP_RIGHT' => Configuration::get('CIN_HOME_DOWN_L2_IMG_DESKTOP_RIGHT'),
            'CIN_HOME_DOWN_L2_IMG_RETINA_MOBILE_RIGHT' => Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_MOBILE_RIGHT'),
            'CIN_HOME_DOWN_L2_IMG_RETINA_TABLET_RIGHT' => Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_TABLET_RIGHT'),
            'CIN_HOME_DOWN_L2_IMG_RETINA_DESKTOP_RIGHT' => Configuration::get('CIN_HOME_DOWN_L2_IMG_RETINA_DESKTOP_RIGHT'),
        ];


        echo '<script>
        function updateImagePreview(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewDiv = document.querySelector(\'#preview-\' + input.getAttribute(\'name\'));
                    previewDiv.innerHTML = \'<img src="\' + e.target.result + \'" style="max-width: 200px; max-height: 200px;" />\';
                };
                reader.readAsDataURL(file);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const fileInputs = document.querySelectorAll(\'input[type="file"]\');
            Array.prototype.forEach.call(fileInputs, function(input) {
                input.addEventListener(\'change\', function() {
                    updateImagePreview(this);
                });

                const previewDiv = document.createElement(\'div\');
                previewDiv.id = \'preview-\' + input.getAttribute(\'name\');
                previewDiv.style.marginTop = \'10px\';

                input.parentNode.insertBefore(previewDiv, input.nextSibling);

                let imagePath = ' . json_encode($imagePaths) . ';
                if (imagePath[input.getAttribute(\'name\')]) {
                    let imgPreview = document.createElement(\'img\');
                    imgPreview.src = imagePath[input.getAttribute(\'name\')];
                    imgPreview.style.maxWidth = \'200px\';
                    imgPreview.style.maxHeight = \'200px\';
                    previewDiv.appendChild(imgPreview);
                }
            });
        });
    </script>';

        return $this->renderForm();
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->form['form']['enctype'] = 'multipart/form-data';

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitCinabre_themeModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = [
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        ];

        return $helper->generateForm([$this->getConfigForm()]);
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return [
            'form' => [
                'legend' => [
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs',
                ],
                'tabs' => [
                    'part_1' => 'Haut de page',
                    'part_2' => 'Bloc Club Cinabre',
                    'part_3' => 'Bas de page',
                ],
                'input' => [
                    [
                        'type' => 'html',
                        'label' => '',
                        'name' => 'HTML',
                        'tab' => 'part_1',
                        'html_content' => '<hr/><h3>' . $this->l('Ligne 1') . '</h3>',
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_LINK_LEFT',
                        'label' => $this->l('Lien / Gauche'),
                        'lang' => true,
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_TEXT_LEFT',
                        'label' => $this->l('Texte / Gauche'),
                        'lang' => true,
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_IMG_MOBILE_LEFT',
                        'label' => $this->l('Image Mobile / Gauche'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_IMG_TABLET_LEFT',
                        'label' => $this->l('Image Tablette / Gauche'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_IMG_DESKTOP_LEFT',
                        'label' => $this->l('Image Desktop / Gauche'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_IMG_RETINA_MOBILE_LEFT',
                        'label' => $this->l('Image Retina Mobile / Gauche'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_IMG_RETINA_TABLET_LEFT',
                        'label' => $this->l('Image Retina Tablette / Gauche'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_IMG_RETINA_DESKTOP_LEFT',
                        'label' => $this->l('Image Retina Desktop / Gauche'),
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_ALT_LEFT',
                        'label' => $this->l('Balise Alt / Gauche'),
                        'lang' => true,
                    ],

                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_LINK_RIGHT',
                        'label' => $this->l('Lien / Droite'),
                        'lang' => true,
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_TEXT_RIGHT',
                        'label' => $this->l('Texte / Droite'),
                        'lang' => true,
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_IMG_MOBILE_RIGHT',
                        'label' => $this->l('Image Mobile / Droite'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_IMG_TABLET_RIGHT',
                        'label' => $this->l('Image Tablette / Droite'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_IMG_DESKTOP_RIGHT',
                        'label' => $this->l('Image Desktop / Droite'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_IMG_RETINA_MOBILE_RIGHT',
                        'label' => $this->l('Image Retina Mobile / Droite'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_IMG_RETINA_TABLET_RIGHT',
                        'label' => $this->l('Image Retina Tablette / Droite'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_IMG_RETINA_DESKTOP_RIGHT',
                        'label' => $this->l('Image Retina Desktop / Droite'),
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L1_ALT_RIGHT',
                        'label' => $this->l('Balise Alt / Droite'),
                        'lang' => true,
                    ],

                    [
                        'type' => 'html',
                        'label' => '',
                        'name' => 'HTML',
                        'tab' => 'part_1',
                        'html_content' => '<hr/><h3>' . $this->l('Ligne 2') . '</h3>',
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_LINK_LEFT',
                        'label' => $this->l('Lien / Gauche'),
                        'lang' => true,
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_TEXT_LEFT',
                        'label' => $this->l('Texte / Gauche'), 'lang' => true,
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_IMG_MOBILE_LEFT',
                        'label' => $this->l('Image Mobile / Gauche'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_IMG_TABLET_LEFT',
                        'label' => $this->l('Image Tablette / Gauche'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_IMG_DESKTOP_LEFT',
                        'label' => $this->l('Image Desktop / Gauche'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_IMG_RETINA_MOBILE_LEFT',
                        'label' => $this->l('Image Retina Mobile / Gauche'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_IMG_RETINA_TABLET_LEFT',
                        'label' => $this->l('Image Retina Tablette / Gauche'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_IMG_RETINA_DESKTOP_LEFT',
                        'label' => $this->l('Image Retina Desktop / Gauche'),
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_ALT_LEFT',
                        'label' => $this->l('Balise Alt / Gauche'),
                        'lang' => true,
                    ],

                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_LINK_RIGHT',
                        'label' => $this->l('Lien / Droite'),
                        'lang' => true,
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_TEXT_RIGHT',
                        'label' => $this->l('Texte / Droite'),
                        'lang' => true,
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_IMG_MOBILE_RIGHT',
                        'label' => $this->l('Image Mobile / Droite'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_IMG_TABLET_RIGHT',
                        'label' => $this->l('Image Tablette / Droite'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_IMG_DESKTOP_RIGHT',
                        'label' => $this->l('Image Desktop / Droite'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_IMG_RETINA_MOBILE_RIGHT',
                        'label' => $this->l('Image Retina Mobile / Droite'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_IMG_RETINA_TABLET_RIGHT',
                        'label' => $this->l('Image Retina Tablette / Droite'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_IMG_RETINA_DESKTOP_RIGHT',
                        'label' => $this->l('Image Retina Desktop / Droite'),
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_1',
                        'name' => 'CIN_HOME_UP_L2_ALT_RIGHT',
                        'label' => $this->l('Balise Alt / Droite'),
                        'lang' => true,
                    ],
                    [
                        'type' => 'html',
                        'label' => '',
                        'name' => 'HTML',
                        'tab' => 'part_2',
                        'html_content' => '<hr/><h3>' . $this->l('Texte Club Cinabre') . '</h3>',
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_2',
                        'name' => 'CIN_HOME_CLUB_P1',
                        'label' => $this->l('Phrase 1'),
                        'lang' => true,
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_2',
                        'name' => 'CIN_HOME_CLUB_P2',
                        'label' => $this->l('Phrase 2 (optionelle)'),
                        'lang' => true,
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_2',
                        'name' => 'CIN_HOME_CLUB_P3',
                        'label' => $this->l('Phrase 3 (optionelle)'),
                        'lang' => true,
                    ],
                    [
                        'type' => 'html',
                        'label' => '',
                        'name' => 'HTML',
                        'tab' => 'part_2',
                        'html_content' => '<hr/><h3>' . $this->l('Images Club Cinabre') . '</h3>',
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_2',
                        'name' => 'CIN_HOME_CLUB_IMG_DESKTOP_BACKGROUND',
                        'label' => $this->l('Image / Background'),
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_2',
                        'name' => 'CIN_HOME_CLUB_ALT_BACKGROUND',
                        'label' => $this->l('Balise Alt / Background'),
                        'lang' => true,
                    ],

                    [
                        'type' => 'html',
                        'label' => '',
                        'name' => 'HTML',
                        'tab' => 'part_3',
                        'html_content' => '<hr/><h3>' . $this->l('Line full width') . '</h3>',
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L1_LINK_FULLWIDTH',
                        'label' => $this->l('Lien / Full width'),
                        'lang' => true,
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L1_TEXT_FULLWIDTH',
                        'label' => $this->l('Texte / Full width'),
                        'lang' => true,
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L1_IMG_MOBILE_FULLWIDTH',
                        'label' => $this->l('Image Mobile / Full width'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L1_IMG_TABLET_FULLWIDTH',
                        'label' => $this->l('Image Tablette / Full width'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L1_IMG_DESKTOP_FULLWIDTH',
                        'label' => $this->l('Image Desktop / Full width'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L1_IMG_RETINA_MOBILE_FULLWIDTH',
                        'label' => $this->l('Image Retina Mobile / Full width'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L1_IMG_RETINA_TABLET_FULLWIDTH',
                        'label' => $this->l('Image Retina Tablette / Full width'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L1_IMG_RETINA_DESKTOP_FULLWIDTH',
                        'label' => $this->l('Image Retina Desktop / Full width'),
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L1_ALT_FULLWIDTH',
                        'label' => $this->l('Balise Alt / Full width'),
                        'lang' => true,
                    ],

                    [
                        'type' => 'html',
                        'label' => '',
                        'name' => 'HTML',
                        'tab' => 'part_3',
                        'html_content' => '<hr/><h3>' . $this->l('Ligne 3 blocs') . '</h3>',
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_LINK_LEFT',
                        'label' => $this->l('Lien / Gauche'),
                        'lang' => true,
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_TEXT_LEFT',
                        'label' => $this->l('Texte / Gauche'),
                        'lang' => true,
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_MOBILE_LEFT',
                        'label' => $this->l('Image Mobile / Gauche'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_TABLET_LEFT',
                        'label' => $this->l('Image Tablette / Gauche'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_DESKTOP_LEFT',
                        'label' => $this->l('Image Desktop / Gauche'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_MOBILE_LEFT',
                        'label' => $this->l('Image Retina Mobile / Gauche'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_TABLET_LEFT',
                        'label' => $this->l('Image Retina Tablette / Gauche'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_DESKTOP_LEFT',
                        'label' => $this->l('Image Retina Desktop / Gauche'),
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_ALT_LEFT',
                        'label' => $this->l('Balise Alt / Gauche'),
                        'lang' => true,
                    ],

                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_LINK_CENTER',
                        'label' => $this->l('Lien / Centre'),
                        'lang' => true,
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_TEXT_CENTER',
                        'label' => $this->l('Texte / Centre'),
                        'lang' => true,
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_MOBILE_CENTER',
                        'label' => $this->l('Image Mobile / Centre'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_TABLET_CENTER',
                        'label' => $this->l('Image Tablette / Centre'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_DESKTOP_CENTER',
                        'label' => $this->l('Image Desktop / Centre'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_MOBILE_CENTER',
                        'label' => $this->l('Image Retina Mobile / Centre'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_TABLET_CENTER',
                        'label' => $this->l('Image Retina Tablette / Centre'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_DESKTOP_CENTER',
                        'label' => $this->l('Image Retina Desktop / Centre'),
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_ALT_CENTER',
                        'label' => $this->l('Balise Alt / Centre'),
                        'lang' => true,
                    ],

                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_LINK_RIGHT',
                        'label' => $this->l('Lien / Droite'),
                        'lang' => true,
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_TEXT_RIGHT',
                        'label' => $this->l('Texte / Droite'),
                        'lang' => true,
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_MOBILE_RIGHT',
                        'label' => $this->l('Image / Droite'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_TABLET_RIGHT',
                        'label' => $this->l('Image / Droite'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_DESKTOP_RIGHT',
                        'label' => $this->l('Image / Droite'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_MOBILE_RIGHT',
                        'label' => $this->l('Image Retina / Droite'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_TABLET_RIGHT',
                        'label' => $this->l('Image Retina / Droite'),
                    ],
                    [
                        'col' => 6,
                        'type' => 'file',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_DESKTOP_RIGHT',
                        'label' => $this->l('Image Retina / Droite'),
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'tab' => 'part_3',
                        'name' => 'CIN_HOME_DOWN_L2_ALT_RIGHT',
                        'label' => $this->l('Balise Alt / Droite'),
                        'lang' => true,
                    ],

                ],
                'submit' => [
                    'title' => $this->l('Save'),
                ],
            ],
        ];
    }

    protected function renderImagePreviews($imagePreviews)
    {
        $html = '';
        foreach ($imagePreviews as $fieldName => $imagePath) {
            $html .= '<div id="preview-' . $fieldName . '">';
            $html .= '<img src="' . $imagePath . '" style="max-width: 200px; max-height: 200px;" />';
            $html .= '</div>';
        }

        return $html;
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        return [
            'CIN_HOME_UP_L1_LINK_LEFT' => [
                '1' => Configuration::get('CIN_HOME_UP_L1_LINK_LEFT_1'),
                '2' => Configuration::get('CIN_HOME_UP_L1_LINK_LEFT_2'),
            ],
            'CIN_HOME_UP_L1_TEXT_LEFT' => [
                '1' => Configuration::get('CIN_HOME_UP_L1_TEXT_LEFT_1'),
                '2' => Configuration::get('CIN_HOME_UP_L1_TEXT_LEFT_2'),
            ],
            'CIN_HOME_UP_L1_ALT_LEFT' => [
                '1' => Configuration::get('CIN_HOME_UP_L1_ALT_LEFT_1'),
                '2' => Configuration::get('CIN_HOME_UP_L1_ALT_LEFT_2'),
            ],

            'CIN_HOME_UP_L1_LINK_RIGHT' => [
                '1' => Configuration::get('CIN_HOME_UP_L1_LINK_RIGHT_1'),
                '2' => Configuration::get('CIN_HOME_UP_L1_LINK_RIGHT_2'),
            ],
            'CIN_HOME_UP_L1_TEXT_RIGHT' => [
                '1' => Configuration::get('CIN_HOME_UP_L1_TEXT_RIGHT_1'),
                '2' => Configuration::get('CIN_HOME_UP_L1_TEXT_RIGHT_2'),
            ],
            'CIN_HOME_UP_L1_ALT_RIGHT' => [
                '1' => Configuration::get('CIN_HOME_UP_L1_ALT_RIGHT_1'),
                '2' => Configuration::get('CIN_HOME_UP_L1_ALT_RIGHT_2'),
            ],

            'CIN_HOME_UP_L2_LINK_LEFT' => [
                '1' => Configuration::get('CIN_HOME_UP_L2_LINK_LEFT_1'),
                '2' => Configuration::get('CIN_HOME_UP_L2_LINK_LEFT_2'),
            ],
            'CIN_HOME_UP_L2_TEXT_LEFT' => [
                '1' => Configuration::get('CIN_HOME_UP_L2_TEXT_LEFT_1'),
                '2' => Configuration::get('CIN_HOME_UP_L2_TEXT_LEFT_2'),
            ],
            'CIN_HOME_UP_L2_ALT_LEFT' => [
                '1' => Configuration::get('CIN_HOME_UP_L2_ALT_LEFT_1'),
                '2' => Configuration::get('CIN_HOME_UP_L2_ALT_LEFT_2'),
            ],

            'CIN_HOME_UP_L2_LINK_RIGHT' => [
                '1' => Configuration::get('CIN_HOME_UP_L2_LINK_RIGHT_1'),
                '2' => Configuration::get('CIN_HOME_UP_L2_LINK_RIGHT_2'),
            ],
            'CIN_HOME_UP_L2_TEXT_RIGHT' => [
                '1' => Configuration::get('CIN_HOME_UP_L2_TEXT_RIGHT_1'),
                '2' => Configuration::get('CIN_HOME_UP_L2_TEXT_RIGHT_2'),
            ],
            'CIN_HOME_UP_L2_ALT_RIGHT' => [
                '1' => Configuration::get('CIN_HOME_UP_L2_ALT_RIGHT_1'),
                '2' => Configuration::get('CIN_HOME_UP_L2_ALT_RIGHT_2'),
            ],

            'CIN_HOME_CLUB_P1' => [
                '1' => Configuration::get('CIN_HOME_CLUB_P1_1'),
                '2' => Configuration::get('CIN_HOME_CLUB_P1_2'),
            ],
            'CIN_HOME_CLUB_P2' => [
                '1' => Configuration::get('CIN_HOME_CLUB_P2_1'),
                '2' => Configuration::get('CIN_HOME_CLUB_P2_2'),
            ],
            'CIN_HOME_CLUB_P3' => [
                '1' => Configuration::get('CIN_HOME_CLUB_P3_1'),
                '2' => Configuration::get('CIN_HOME_CLUB_P3_2'),
            ],

            'CIN_HOME_CLUB_ALT_BACKGROUND' => [
                '1' => Configuration::get('CIN_HOME_CLUB_ALT_BACKGROUND_1'),
                '2' => Configuration::get('CIN_HOME_CLUB_ALT_BACKGROUND_2'),
            ],

            'CIN_HOME_DOWN_L1_LINK_FULLWIDTH' => [
                '1' => Configuration::get('CIN_HOME_DOWN_L1_LINK_FULLWIDTH_1'),
                '2' => Configuration::get('CIN_HOME_DOWN_L1_LINK_FULLWIDTH_2'),
            ],
            'CIN_HOME_DOWN_L1_TEXT_FULLWIDTH' => [
                '1' => Configuration::get('CIN_HOME_DOWN_L1_TEXT_FULLWIDTH_1'),
                '2' => Configuration::get('CIN_HOME_DOWN_L1_TEXT_FULLWIDTH_2'),
            ],
            'CIN_HOME_DOWN_L1_ALT_FULLWIDTH' => [
                '1' => Configuration::get('CIN_HOME_DOWN_L1_ALT_FULLWIDTH_1'),
                '2' => Configuration::get('CIN_HOME_DOWN_L1_ALT_FULLWIDTH_2'),
            ],

            'CIN_HOME_DOWN_L2_LINK_LEFT' => [
                '1' => Configuration::get('CIN_HOME_DOWN_L2_LINK_LEFT_1'),
                '2' => Configuration::get('CIN_HOME_DOWN_L2_LINK_LEFT_2'),
            ],
            'CIN_HOME_DOWN_L2_TEXT_LEFT' => [
                '1' => Configuration::get('CIN_HOME_DOWN_L2_TEXT_LEFT_1'),
                '2' => Configuration::get('CIN_HOME_DOWN_L2_TEXT_LEFT_2'),
            ],
            'CIN_HOME_DOWN_L2_ALT_LEFT' => [
                '1' => Configuration::get('CIN_HOME_DOWN_L2_ALT_LEFT_1'),
                '2' => Configuration::get('CIN_HOME_DOWN_L2_ALT_LEFT_2'),
            ],

            'CIN_HOME_DOWN_L2_LINK_CENTER' => [
                '1' => Configuration::get('CIN_HOME_DOWN_L2_LINK_CENTER_1'),
                '2' => Configuration::get('CIN_HOME_DOWN_L2_LINK_CENTER_2'),
            ],
            'CIN_HOME_DOWN_L2_TEXT_CENTER' => [
                '1' => Configuration::get('CIN_HOME_DOWN_L2_TEXT_CENTER_1'),
                '2' => Configuration::get('CIN_HOME_DOWN_L2_TEXT_CENTER_2'),
            ],
            'CIN_HOME_DOWN_L2_ALT_CENTER' => [
                '1' => Configuration::get('CIN_HOME_DOWN_L2_ALT_CENTER_1'),
                '2' => Configuration::get('CIN_HOME_DOWN_L2_ALT_CENTER_2'),
            ],

            'CIN_HOME_DOWN_L2_LINK_RIGHT' => [
                '1' => Configuration::get('CIN_HOME_DOWN_L2_LINK_RIGHT_1'),
                '2' => Configuration::get('CIN_HOME_DOWN_L2_LINK_RIGHT_2'),
            ],
            'CIN_HOME_DOWN_L2_TEXT_RIGHT' => [
                '1' => Configuration::get('CIN_HOME_DOWN_L2_TEXT_RIGHT_1'),
                '2' => Configuration::get('CIN_HOME_DOWN_L2_TEXT_RIGHT_2'),
            ],
            'CIN_HOME_DOWN_L2_ALT_RIGHT' => [
                '1' => Configuration::get('CIN_HOME_DOWN_L2_ALT_RIGHT_1'),
                '2' => Configuration::get('CIN_HOME_DOWN_L2_ALT_RIGHT_2'),
            ],

        ];
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();
        $languages = Language::getLanguages(false);

        foreach (array_keys($form_values) as $key) {
            foreach ($languages as $language) {
                Configuration::updateValue($key . '_' . (int) $language['id_lang'], Tools::getValue($key . '_' . (int) $language['id_lang']));
            }
        }

        $uploadDir = __DIR__ . '/assets/';

        $fileFields = [
            [
                'name' => 'CIN_HOME_UP_L1_IMG_MOBILE_LEFT',
                'label' => $this->l('Image Mobile / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_UP_L1_IMG_TABLET_LEFT',
                'label' => $this->l('Image Tablette / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_UP_L1_IMG_DESKTOP_LEFT',
                'label' => $this->l('Image Desktop / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_UP_L1_IMG_RETINA_MOBILE_LEFT',
                'label' => $this->l('Image Retina Mobile / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_UP_L1_IMG_RETINA_TABLET_LEFT',
                'label' => $this->l('Image Retina Tablette / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_UP_L1_IMG_RETINA_DESKTOP_LEFT',
                'label' => $this->l('Image Retina Desktop / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_UP_L1_IMG_MOBILE_RIGHT',
                'label' => $this->l('Image Mobile / Droite'),
            ],
            [
                'name' => 'CIN_HOME_UP_L1_IMG_TABLET_RIGHT',
                'label' => $this->l('Image Tablette / Droite'),
            ],
            [
                'name' => 'CIN_HOME_UP_L1_IMG_DESKTOP_RIGHT',
                'label' => $this->l('Image Desktop / Droite'),
            ],
            [
                'name' => 'CIN_HOME_UP_L1_IMG_RETINA_MOBILE_RIGHT',
                'label' => $this->l('Image Retina Mobile / Droite'),
            ],
            [
                'name' => 'CIN_HOME_UP_L1_IMG_RETINA_TABLET_RIGHT',
                'label' => $this->l('Image Retina Tablette / Droite'),
            ],
            [
                'name' => 'CIN_HOME_UP_L1_IMG_RETINA_DESKTOP_RIGHT',
                'label' => $this->l('Image Retina Desktop / Droite'),
            ],
            [
                'name' => 'CIN_HOME_UP_L2_IMG_MOBILE_LEFT',
                'label' => $this->l('Image Mobile / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_UP_L2_IMG_TABLET_LEFT',
                'label' => $this->l('Image Tablette / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_UP_L2_IMG_DESKTOP_LEFT',
                'label' => $this->l('Image Desktop / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_UP_L2_IMG_RETINA_MOBILE_LEFT',
                'label' => $this->l('Image Retina Mobile / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_UP_L2_IMG_RETINA_TABLET_LEFT',
                'label' => $this->l('Image Retina Tablette / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_UP_L2_IMG_RETINA_DESKTOP_LEFT',
                'label' => $this->l('Image Retina Desktop / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_UP_L2_IMG_MOBILE_RIGHT',
                'label' => $this->l('Image Mobile / Droite'),
            ],
            [
                'name' => 'CIN_HOME_UP_L2_IMG_TABLET_RIGHT',
                'label' => $this->l('Image Tablette / Droite'),
            ],
            [
                'name' => 'CIN_HOME_UP_L2_IMG_DESKTOP_RIGHT',
                'label' => $this->l('Image Desktop / Droite'),
            ],
            [
                'name' => 'CIN_HOME_UP_L2_IMG_RETINA_MOBILE_RIGHT',
                'label' => $this->l('Image Retina Mobile / Droite'),
            ],
            [
                'name' => 'CIN_HOME_UP_L2_IMG_RETINA_TABLET_RIGHT',
                'label' => $this->l('Image Retina Tablette / Droite'),
            ],
            [
                'name' => 'CIN_HOME_UP_L2_IMG_RETINA_DESKTOP_RIGHT',
                'label' => $this->l('Image Retina Desktop / Droite'),
            ],
            [
                'name' => 'CIN_HOME_CLUB_IMG_DESKTOP_BACKGROUND',
                'label' => $this->l('Image Desktop / Background'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L1_IMG_MOBILE_FULLWIDTH',
                'label' => $this->l('Image Mobile / Full width'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L1_IMG_TABLET_FULLWIDTH',
                'label' => $this->l('Image Tablette / Full width'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L1_IMG_DESKTOP_FULLWIDTH',
                'label' => $this->l('Image Desktop / Full width'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L1_IMG_RETINA_MOBILE_FULLWIDTH',
                'label' => $this->l('Image Retina Mobile / Full width'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L1_IMG_RETINA_TABLET_FULLWIDTH',
                'label' => $this->l('Image Retina Tablette / Full width'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L1_IMG_RETINA_DESKTOP_FULLWIDTH',
                'label' => $this->l('Image Retina Desktop / Full width'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_MOBILE_LEFT',
                'label' => $this->l('Image Mobile / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_TABLET_LEFT',
                'label' => $this->l('Image Tablette / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_DESKTOP_LEFT',
                'label' => $this->l('Image Desktop / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_MOBILE_LEFT',
                'label' => $this->l('Image Retina Mobile / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_TABLET_LEFT',
                'label' => $this->l('Image Retina Tablette / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_DESKTOP_LEFT',
                'label' => $this->l('Image Retina Desktop / Gauche'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_MOBILE_CENTER',
                'label' => $this->l('Image Mobile / Centre'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_TABLET_CENTER',
                'label' => $this->l('Image Tablette / Centre'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_DESKTOP_CENTER',
                'label' => $this->l('Image Desktop / Centre'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_MOBILE_CENTER',
                'label' => $this->l('Image Retina Mobile / Centre'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_TABLET_CENTER',
                'label' => $this->l('Image Retina Tablette / Centre'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_DESKTOP_CENTER',
                'label' => $this->l('Image Retina Desktop / Centre'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_MOBILE_RIGHT',
                'label' => $this->l('Image Mobile / Droite'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_TABLET_RIGHT',
                'label' => $this->l('Image Tablette / Droite'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_DESKTOP_RIGHT',
                'label' => $this->l('Image Desktop / Droite'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_MOBILE_RIGHT',
                'label' => $this->l('Image Retina Mobile / Droite'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_TABLET_RIGHT',
                'label' => $this->l('Image Retina Tablette / Droite'),
            ],
            [
                'name' => 'CIN_HOME_DOWN_L2_IMG_RETINA_DESKTOP_RIGHT',
                'label' => $this->l('Image Retina Desktop / Droite'),
            ],
        ];

        foreach ($fileFields as $fileField) {
            $fieldName = $fileField['name'];
            $uploadedPhoto = $_FILES[$fieldName];

            if ($uploadedPhoto['error'] === UPLOAD_ERR_OK) {
                $fileName = $uploadedPhoto['name'];
                $fileTmpPath = $uploadedPhoto['tmp_name'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $allowedExtensions = ['webp', 'jpg', 'jpeg', 'png'];

                if (in_array($fileExtension, $allowedExtensions)) {
                    $filePath = $uploadDir . $fileName;

                    if (!file_exists($filePath)) {
                        if (move_uploaded_file($fileTmpPath, $filePath)) {
                            $this->saveImagePathToDatabase($fieldName, $filePath);
                            echo 'Le fichier ' . $fileName . ' a été téléchargé avec succès.';
                        } else {
                            echo 'Une erreur s\'est produite lors du déplacement du fichier ' . $fileName . '.';
                        }
                    } else {
                        echo 'Le fichier ' . $fileName . ' existe déjà dans le dossier cible. Il n\'a pas été téléchargé.';
                    }
                } else {
                    echo 'L\'extension de fichier du fichier ' . $fileName . ' n\'est pas autorisée. Veuillez télécharger un fichier au format WEBP, JPG, JPEG ou PNG.';
                }
            }
        }
    }

    protected function saveImagePathToDatabase($fieldName, $filePath)
    {
        $relativePath = str_replace(_PS_ROOT_DIR_, '', $filePath);
        Configuration::updateValue($fieldName, $relativePath);
    }

    /**
     * Add the CSS & JavaScript files you want to be loaded in the BO.
     */
    public function hookDisplayBackOfficeHeader()
    {
        if (Tools::getValue('configure') == $this->name) {
            $this->context->controller->addJS($this->_path . 'views/js/back.js');
            $this->context->controller->addCSS($this->_path . 'views/css/back.css');
        }
    }

    public function hookDisplayHome()
    {
        return $this->context->smarty->fetch($this->local_path . 'views/templates/admin/home-klorel.tpl');
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path . '/views/js/front.js');
        $this->context->controller->addCSS($this->_path . '/views/css/front.css');
    }

    public function hookActionCategoryUpdate()
    {
        $categoryID = Tools::getValue('id_category');
        $languages = Language::getLanguages(false);

        $categoryIsMadeInFr = Tools::getValue('CIN_IS_MADE_IN_FR_' . (int) $categoryID);
        Configuration::updateValue('CIN_IS_MADE_IN_FR_' . (int) $categoryID, $categoryIsMadeInFr);

        foreach ($languages as $language) {
            $made_in_france_description = Tools::getValue('CIN_DESC_MADE_IN_FR_'. (int) $categoryID . '_' . (int) $language['id_lang']);
            Configuration::updateValue('CIN_DESC_MADE_IN_FR_' . (int) $categoryID . '_' . (int) $language['id_lang'], $made_in_france_description, true);
        }

        $categoryIsCustomizable = Tools::getValue('CIN_IS_CUSTOMIZABLE_' . $categoryID);
        Configuration::updateValue('CIN_IS_CUSTOMIZABLE_' . (int) $categoryID, $categoryIsCustomizable);

        foreach ($languages as $language) {
            $customizable_description = Tools::getValue('CIN_DESC_CUSTOMIZABLE_'. $categoryID . '_' . (int) $language['id_lang']);
            Configuration::updateValue('CIN_DESC_CUSTOMIZABLE_' . (int) $categoryID . '_' . (int) $language['id_lang'], $customizable_description, true);
        }

        $categoryIsLining = Tools::getValue('CIN_IS_LINING_' . $categoryID);
        Configuration::updateValue('CIN_IS_LINING_' . (int) $categoryID, $categoryIsLining);

        foreach ($languages as $language) {
            $lining_description = Tools::getValue('CIN_DESC_LINING_'. $categoryID . '_' . (int) $language['id_lang']);
            Configuration::updateValue('CIN_DESC_LINING_' . (int) $categoryID . '_' . (int) $language['id_lang'], $lining_description, true);
        }

    }
}
