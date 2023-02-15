<?php

namespace Juzto_Widgets;

use Elementor\Repeater;
use Elementor\Widget_Base;

class JZT_Card_Widget extends Widget_Base
{
	public function __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);
		// Enqueue styles
		wp_register_style('juzto-widget-table',
			plugin_dir_url(__FILE__) . 'assets/styles.css',
			array(), '0.1.0.1.11', 'all');
		// Enqueue scripts
		wp_register_script('juzto-widget-main',
			plugin_dir_url(__FILE__) . 'assets/main.js',
			array('jquery'), '0.1.0.1', true);
	}

    public function get_style_depends()
    {
        return ['juzto-widget-table'];
    }

    public function get_script_depends()
    {
        return ['juzto-widget-main'];
    }

    public static $slug = 'juzto-elementor-table';

    public function get_name()
    {
        return self::$slug;
    }

    public function get_title()
    {
        return __('Tarjeta de planes para Juzto', self::$slug);
    }

    public function get_icon()
    {
        return 'eicon-table-of-contents';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function register_controls()
    {
        // Plan section
        $this->start_controls_section(
            'content_section_plan',
            [
                'label' => __('Planes', self::$slug),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Repeater item intance
        $repeater = new Repeater();

        $repeater->add_control(
            'number_plan',
            [
                'label' => __('Número de plan', self::$slug),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __("1", self::$slug),
                'placeholder' => __('Número del plan', self::$slug),
            ]
        );

        $repeater->add_control(
            'title_plan',
            [
                'label' => __('Nombre del plan', self::$slug),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __("Nombre del plan", self::$slug),
                'placeholder' => __('Nombre del plan', self::$slug),
            ]
        );

        $repeater->add_control(
            'description_plan',
            [
                'label' => __('Descripción del plan', self::$slug),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __("Descripción del plan", self::$slug),
                'placeholder' => __('Descripción del plan', self::$slug),
            ]
        );

        $repeater->add_control(
            'text_price_plan',
            [
                'label' => __('Precio del plan', self::$slug),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __("10mil", self::$slug),
                'placeholder' => __('108mil', self::$slug),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __('Añadir imagen de cliente', self::$slug),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'customer_name_plan',
            [
                'label' => __('Nombre del cliente', self::$slug),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __("Nombre del cliente", self::$slug),
                'placeholder' => __('Nombre del cliente', self::$slug),
            ]
        );

        $repeater->add_control(
            'customer_problems_plan',
            [
                'label' => __('Lista de los inconvientes', self::$slug),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __("Lista", self::$slug),
                'placeholder' => __('Nombre del cliente', self::$slug),
            ]
        );

        $repeater->add_control(
            'juzto_solution_plan',
            [
                'label' => __('Solución de juzto', self::$slug),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __("Solución", self::$slug),
                'placeholder' => __('', self::$slug),
            ]
        );


        // Add repeater to tab
        $this->add_control(
            'options_list',
            [
                'label' => __('Planes', self::$slug),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    []
                ],
            ]
        );

        $this->end_controls_section();

    }
    protected function render()
    {
        $options_list = $this->get_settings_for_display('options_list');

        $html = '<div class="juzto-planes-wrapper">';

        echo '<ul class="juzto-tabs-wrapper" id="tabs">';
        foreach ($options_list as $key => $option_item) {
            if ($key === array_key_first($options_list)) {
                echo '<li class="juzto-tab tab-' . $key . ' active">
					<a id="link-plan-' . $option_item['number_plan'] . '">
						<h3 class="juzto-tab__title">' . $option_item['number_plan'] . '</h3>
					</a>
				</li>';
            } else {
                echo '<li class="juzto-tab tab-' . $key . '">
					<a id="link-plan-' . $option_item['number_plan'] . '">
						<h3 class="juzto-tab__title">' . $option_item['number_plan'] . '</h3>
					</a>
				</li>';
            }
        }
        echo '</ul>';


        echo $html;
        foreach ($options_list as $option_item) {

            $list = '';
            $list_arrays = explode(',', $option_item['customer_problems_plan']);

            foreach ($list_arrays as $list_item => $value) {
                $list .= '<li class="juzto-list-item">' . $value . '</li>';
            }


            echo '<div class="juzto-wrapper jzt-packages" id="link-plan-' . $option_item['number_plan'] . 'C" >
                <div class="juzto-summary-plan jzt-packages__about">
                    <!-- <img src="" alt="" class="juzto-step-plan"> -->
                    <div class="juzto-step-plan-wrapper">
                        <span class="juzto-step-plan"> ' . $option_item['number_plan'] . '</span>
                    </div>
                    <h3 class="juzto-title-plan">' . $option_item['title_plan'] . '</h3>
                    <p class="juzto-description-plan">
                        ' . $option_item['description_plan'] . '
                    </p>
                    <div class="juzto-card-price-plan-wrapper">
                        <span class="juzto-card-price-plan">' . $option_item['text_price_plan'] . '</span>
                        <a href="" class="juzto-wsform">Evalúa tu caso</a>
                    </div>
                </div>
                <div class="juzto-testimonial jzt-packages__about__testimonial">
                    <div class="juzto-costumer-container">
                        <img class="juzto-photo-profile" src="' . $option_item['image']['url'] . '" alt="" >
                        <h3 class="juzto-testimonial-profile">' . $option_item['customer_name_plan'] . '</h3>
                        <ul class="juzto-list-problems">
                            ' . $list . '                             
                        </ul>
                    </div>
                    <div class="juzto-testimonial__solution">
                        <img src="https://developer.juzto.co/wp-content/plugins/juzto-elementor-widgets/assets/juzto-logo.png" alt="" class="juzto-logo">
                        <p class="juzto-solution">
                            ' . $option_item['juzto_solution_plan'] . '
                        </p>
                    </div> 
                </div>
            </div>';

            /* Tabla de planes - falta dinamizar campos */
            '<div class="" id="link-plan-' . $option_item['number_plan'] . 'C" > 
                    <table class="juzto-table-mobile">
                    <tbody>
                      <tr class="juzto-table-mobile__row">
                        <td class="juzto-table-mobile__row__description-column">Elaboración y entrega de los documentos personalizados a tu caso para presentar la reclamación ante la aerolínea</td>
                        <td class="juzto-table-mobile__row__result-column"> 
                            <i class="fa fa-check jzt-success" aria-hidden="true"></i>
                        </td>
                      </tr>
                      <tr class="juzto-table-mobile__row">
                        <td class="juzto-table-mobile__row__description-column">Si no recibes respuesta de la aerolínea, elaboramos el documento para presentar una tutela</td>
                        <td class="juzto-table-mobile__row__result-column">
                            <i class="fa fa-check jzt-success" aria-hidden="true"></i>
                        </td>
                      </tr>
                      <tr class="juzto-table-mobile__row">
                        <td class="juzto-table-mobile__row__description-column">Radicamos la reclamación directa por ti, tu no te preocupas por nada</td>
                        <td class="juzto-table-mobile__row__result-column">
                            <i class="fa fa-check jzt-success" aria-hidden="true"></i>
                            <i class="fa fa-minus jzt-disabled" aria-hidden="true"></i>
</td>
                      </tr>
                      <tr class="juzto-table-mobile__row">
                        <td class="juzto-table-mobile__row__description-column">Radicamos la tutela por ti, tu no te preocupas por nada</td>
                        <td class="juzto-table-mobile__row__result-column">
                            <i class="fa fa-check jzt-success" aria-hidden="true"></i>
                            <i class="fa fa-minus jzt-disabled" aria-hidden="true"></i>
                        </td>
                      </tr>
                      <tr class="juzto-table-mobile__row">
                        <td class="juzto-table-mobile__row__description-column">Radicamos queja ante la Superintendencia de Transporte</td>
                        <td class="juzto-table-mobile__row__result-column">
                            <i class="fa fa-check jzt-success" aria-hidden="true"></i>
                            <i class="fa fa-minus jzt-disabled" aria-hidden="true"></i>
                        </td>
                      </tr>
                      <tr class="juzto-table-mobile__row">
                        <td class="juzto-table-mobile__row__description-column">Si después de la acción de tutela no recibimos la respuesta esperada, presentamos una demanda ante la SIC (Superintendencia de Industria y Comercio)</td>
                        <td class="juzto-table-mobile__row__result-column">
                            <i class="fa fa-check jzt-success" aria-hidden="true"></i>
                            <i class="fa fa-minus jzt-disabled" aria-hidden="true"></i>
                        </td>
                      </tr>
                      <tr class="juzto-table-mobile__row">
                        <td class="juzto-table-mobile__row__description-column">Te entregamos todas las instrucciones para que puedas realizar el proceso por tu cuenta</td>
                        <td class="juzto-table-mobile__row__result-column">
                            <i class="fa fa-check jzt-success" aria-hidden="true"></i>
                            <i class="fa fa-minus jzt-disabled" aria-hidden="true"></i>
                        </td>
                      </tr>
                      </tbody>
                    </table>

            </div>';
        }
        echo '</div>';
    }
}