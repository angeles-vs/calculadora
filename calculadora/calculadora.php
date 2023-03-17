<?php
/*
Plugin Name: Calculadora
Description: Calculadora desarrollada para el reto de AZERTIS.
Author: Angeles Viña
Version: 1.0
Author URI: https://github.com/angelessevilla
*/

// INICIAMOS GUARDADO URL DE LA API 
add_option('calculadora_api_url', '');

// PAGINAS DEL PLUGIN 
add_action('admin_menu', 'calculadora_menu');
function calculadora_menu()
{
    add_menu_page(
        'Calculadora',
        'Calculadora',
        'manage_options',
        'calculadora',
        'calculadora_page',
        'dashicons-calculator',
        4
    );
    add_submenu_page(
        'calculadora',
        'Ajustes de calculadora', 
        'Ajustes', 
        'manage_options', 
        'ajustes-calculadora', 
        'ajustes_calculadora_page'
    );
}

// PROCESAR DATOS DEL FORMULARIO DE AJUSTES
add_action('admin_post_guardar_calculadora_api_url', 'guardar_calculadora_api_url');
function guardar_calculadora_api_url()
{

    // SANITIZACIÓN Y ACTUALIZACIÓN
    $url = sanitize_text_field($_POST['calculadora_api_url']);
    $resultado = update_option('calculadora_api_url', $url);
    if ($resultado) {
        wp_redirect('/wordpress/wp-admin/admin.php?page=ajustes-calculadora&alert=1');
    } else {
        wp_redirect('/wordpress/wp-admin/admin.php?page=ajustes-calculadora&alert=0');
    }
}

// PAGINA DE AJUSTES
function ajustes_calculadora_page()
{

    // COMPROBAMOS SI DEBEMOS MOSTRAR UN ALERT 
    if ( isset($_GET['alert']) ) {    
        
        if ($_GET['alert']==1) {
            echo '<div class="notice notice-success is-dismissible">
                    <p>Se han guardado los ajustes correctamente.</p>
             </div>'; 
        }else{
            echo '<div class="notice notice-warning is-dismissible">
                    <p>No se han podido guardar los ajustes correctamente.</p>
             </div>'; 
        }
    }

    // RENDERIZADO DE FORMULARIO DE AJUSTES
    ?>
    <h1 >
        <?php esc_html_e('Ajustes de Calculadora.'); ?>
    </h1>
    <form method="POST" action="<?= admin_url('admin-post.php') ?>">
        <label>
            <b>API URL</b><br>
            <input type="text" name="calculadora_api_url" value="<?= get_option('calculadora_api_url') ?>">
            <input type="hidden" name="action" value="guardar_calculadora_api_url">
        </label>
        <?php submit_button( __( 'Guardar', 'textdomain' ), 'primary', 'calculadora-api',     true ); ?>
    </form>
    <?php
}

// PAGINA DE LA CALCULADORA
function calculadora_page()
{
    
    $api_url = get_option('calculadora_api_url');

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $data = curl_exec($curl);
    curl_close($curl);
    if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200){

        // PING EXITOSO
        echo "<div class='notice notice-success is-dismissible'>
        <p style='color:black'>La conexión a la API: {$api_url} es exitosa.<p>
        </div>"; 

    }else{

        // PING NO EXITOSO
        echo "<div class='notice notice-error is-dismissible'>
        <p style='color:black'>No se ha podido conectar con API URL: {$api_url}. <a href='/wordpress/wp-admin/admin.php?page=ajustes-calculadora'>Por favor compruebe la url.</a><p>
        </div>"; 

     }
    
    ?>
    <h1 style="color:white;margin-top:3rem;">
        <?php esc_html_e('Reto Azertis: Calculadora y API por Ángeles Viña.'); ?>

    </h1>
    <?php
    include('views/calculadora.html');
    echo '<input type="hidden" id="api_url" value="'.$api_url.'">';
}

// REGISTRAMOS HOJA DE ESTILOS 
add_action('admin_enqueue_scripts', 'cal_registrar_scripts');
function cal_registrar_scripts()
{
    wp_register_style('calculadora-css', plugins_url('calculadora/assets/css/calculadora.css'));
}

// CARGAMOS ESTILO EN PAGINA 'CALCULADORA'
add_action('admin_enqueue_scripts', 'cal_cargar_scripts');
function cal_cargar_scripts($hook)
{
    if ($hook != 'toplevel_page_calculadora') {
        return;
    }
    wp_enqueue_style('calculadora-css');
}

