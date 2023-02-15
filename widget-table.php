<?php

namespace Juzto_Widgets;

use Elementor\Repeater;
use Elementor\Widget_Base;

class JZT_Table_Widget extends Widget_Base
{
    // public function __construct($data = [], $args = null)
    // {
    //     parent::__construct($data, $args);
    //     wp_enqueue_style('juzto-widget-table',
    //         'https://developer.juzto.co/wp-content/plugins/juzto-elementor-widgets/assets/style.css',
    //         array(), '0.1.6', 'all');
    //     wp_enqueue_script('juzto-widget-main',
    //         'https://developer.juzto.co/wp-content/plugins/juzto-elementor-widgets/assets/main.js',
    //         array('jquery'), '0.1', 'all');
    // }

    public function get_style_depends()
    {
        return ['juzto-widget-table-css'];
    }

    public function get_script_depends()
    {
        return ['juzto-widget-main-js'];
    }

    public static $slug = 'juzto-elementor-table-plan';

    public function get_name()
    {
        return self::$slug;
    }

    public function get_title()
    {
        return __('Juzto tabla de planes', self::$slug);
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
        // Start Título de la tabla section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Características', self::$slug),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'name_caracteristica',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => __('Título de la tabla', self::$slug)
            ]
        );

        $this->end_controls_section();
        // End Características section

        // Start Nombre de los planes section
        $this->start_controls_section(
            'style_section',
            [
                'label' => 'Planes',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'nombre_del_plan_2',
            [
                'label' => __('Nombre del plan', self::$slug),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __("", self::$slug),
                'placeholder' => __('', self::$slug),
            ]
        );

        $repeater->add_control(
            'precio_plan_en_letras',
            [
                'label' => __('Precio en letras', self::$slug),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __("", self::$slug),
                'placeholder' => __('99mil', self::$slug),
            ]
        );

        $this->add_control(
            'planes',
            [
                'label' => __('Planes', self::$slug),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    []
                ],
                'title_filed' => '{{{ option_contents }}}'
            ]
        );

        $this->end_controls_section();
        // End Nombre de los planes section

        // Start Características de los planes section
        $this->start_controls_section(
            'caracteristicas_de_los_planes', [
                'label' => __('Caracteristicas', self::$slug),
                'type' => \Elementor\Controls_Manager::TAB_CONTENT
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'caracteristica',
            [
                'label' => __('Característica', self::$slug),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __("", self::$slug),
                'placeholder' => __('', self::$slug),
            ]
        );
        // $repeater->add_control(
        //     'caracteristica',
        // [
        //     'label' => __('Característica', self::$slug),
        //     'type' => \Elementor\Controls_Manager::TEXT,
        //     'default' => __("", self::$slug),
        //     'placeholder' => __('', self::$slug),
        // ]
        // );

        $repeater->add_control(
            'plan_one',
            [
                'label' => __('Plan 1', self::$slug),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Si', self::$slug),
                'label_off' => __('No', self::$slug),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater->add_control(
            'plan_two',
            [
                'label' => __('Plan 3', self::$slug),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Si', self::$slug),
                'label_off' => __('No', self::$slug),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater->add_control(
            'plan_three',
            [
                'label' => __('Plan 3', self::$slug),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Si', self::$slug),
                'label_off' => __('No', self::$slug),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'lista',
            [
                'label' => __('Caracteristicas', self::$slug),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    []
                ],
                'title_filed' => '{{{ option_contents }}}'
            ]
        );
        // End Características de los planes section
        $this->end_controls_section();

    }
    protected function render()
    {
        $options_list = $this->get_settings_for_display('name_caracteristica');
        $options = $this->get_settings_for_display('planes');
        $lista_de_caracteristicas = $this->get_settings_for_display('lista');

        echo '
        <div class="about-toggle">
        <div class="about-toggle___button">
            <h3 class="about-toggle__title">
                ' . $options_list . '
            </h3>
            <span class="open-tab">
                <i class="fa fa-plus fa-3" aria-hidden="true"  style="display:none;"></i>
                <i class="fa fa-minus close-tab fa-3" aria-hidden="true" ></i>
            </span>
        </div>
        <div class="about-toggle__table">
            <table class="juzto-table">
                <tbody>
                    <tr>
                        <th></th>

                    
        ';

        foreach ($options as $option) {
            echo '<th class="table-head"> <div class="juzto-name-table-head">' . $option['nombre_del_plan_2'] . '</div> <span class="juzto-price-plan"> ' . $option['precio_plan_en_letras'] . ' </span></th>';
        }

        echo '</tr>';

        foreach ($lista_de_caracteristicas as $carac) {
            echo '
            <tr>
                <td>' . $carac['caracteristica'] . '</td>';
            if ($carac['plan_one'] === 'yes') {
                echo '<td> <i class="fa fa-check jzt-success" aria-hidden="true"></i> </td>';
            }
            else {
                echo '<td> <i class="fa fa-minus jzt-disabled" aria-hidden="true"></i> </td>';
            }
            if ($carac['plan_two'] === 'yes') {
                echo '<td> <i class="fa fa-check jzt-success" aria-hidden="true"></i> </td>';
            }
            else {
                echo '<td> <i class="fa fa-minus jzt-disabled" aria-hidden="true"></i> </td>';
            }
            if ($carac['plan_three'] === 'yes') {
                echo '<td> <i class="fa fa-check jzt-success" aria-hidden="true"></i> </td>';
            }
            else {
                echo '<td> <i class="fa fa-minus jzt-disabled" aria-hidden="true"></i> </td>';
            }
            echo '</tr>';
        }

        echo '
                </tbody>
                    </table>
                </div>
            </div>';


        // Juzto tables responsive

        // echo '<h1>Plan 1</h1>';
        echo '
		<div class="" id="table-link-plan-79mil" >  <!-- id="link-plan-1C" id="table-link-plan-79mil"-->
			<table class="juzto-table-mobile">
			<tbody>';
        foreach( $lista_de_caracteristicas as $caract ) {

            echo'
			<tr class="juzto-table-mobile__row">
				<td class="juzto-table-mobile__row__description-column">
				' . $caract["caracteristica"] . '
				</td>
				<td class="juzto-table-mobile__row__result-column">';

            if( $caract["plan_one"] == 'yes' ) {
                echo '
					<i class="fa fa-check jzt-success" aria-hidden="true"></i>';
            } else {
                echo '
					<i class="fa fa-minus jzt-disabled" aria-hidden="true"></i>';
            }

            echo '
				</td>
			</tr>';
        }
        echo '
				</tbody>
			</table>
		</div>';

        // echo '<h1>Plan 2</h1>';
        echo '
		<div class="" id="table-link-plan-149mil" >  <!-- id="link-plan-2C" id="table-link-plan-149mil"--> 
			<table class="juzto-table-mobile">
			<tbody>';
        foreach( $lista_de_caracteristicas as $caract ) {

            echo'
			<tr class="juzto-table-mobile__row">
				<td class="juzto-table-mobile__row__description-column">
				' . $caract["caracteristica"] . '
				</td>
				<td class="juzto-table-mobile__row__result-column">';

            if( $caract["plan_two"] == 'yes' ) {
                echo '
					<i class="fa fa-check jzt-success" aria-hidden="true"></i>';
            } else {
                echo '
					<i class="fa fa-minus jzt-disabled" aria-hidden="true"></i>';
            }

            echo '
				</td>
			</tr>';
        }
        echo '
				</tbody>
			</table>
		</div>';

        // echo '<h1>Plan 3</h1>';
        echo '
		<div class="" id="table-link-plan-299mil" >  <!-- id="table-link-plan-299mil" id="link-plan-3C"  -->
			<table class="juzto-table-mobile">
			<tbody>';
        foreach( $lista_de_caracteristicas as $caract ) {

            echo'
			<tr class="juzto-table-mobile__row">
				<td class="juzto-table-mobile__row__description-column">
				' . $caract["caracteristica"] . '
				</td>
				<td class="juzto-table-mobile__row__result-column">';

            if( $caract["plan_three"] == 'yes' ) {
                echo '
					<i class="fa fa-check jzt-success" aria-hidden="true"></i>';
            } else {
                echo '
					<i class="fa fa-minus jzt-disabled" aria-hidden="true"></i>';
            }

            echo '
				</td>
			</tr>';
        }
        echo '
				</tbody>
			</table>
		</div>';
    }

}