<?php 

/**
* Plugin Name: Stone Code Contact
* Description: Plugin to show contact information from custom post-type into plugins own page template.
* Author: Jarkko Kivi
* Author URI: https://www.jarkkokivi.fi/
* Version: 1.0.9
* License: GLP v3 or later
* License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

function wpdocs_kantbtrue_init() {
    $labels = array(
        'name'                  => _x( 'Yhteystiedot', 'Post type general name', 'yhteystieto' ),
        'singular_name'         => _x( 'Yhteystieto', 'Post type singular name', 'yhteystieto' ),
        'menu_name'             => _x( 'Yhteystiedot', 'Admin Menu text', 'yhteystieto' ),
        'name_admin_bar'        => _x( 'Yhteystiedot', 'Lisää uusi on Toolbar', 'yhteystieto' ),
        'add_new'               => __( 'Lisää uusi yhteystieto', 'yhteystieto' ),
        'add_new_item'          => __( 'Lisää uusi yhteystieto', 'yhteystieto' ),
        'new_item'              => __( 'Uusi yhteystieto', 'yhteystieto' ),
        'edit_item'             => __( 'Muokkaa yhteystietoa', 'yhteystieto' ),
        'view_item'             => __( 'Avaa yhteystieto', 'yhteystieto' ),
        'all_items'             => __( 'Kaikki yhteystiedot', 'yhteystieto' ),
        'search_items'          => __( 'Etsi kaikista yhteystiedoista', 'yhteystieto' ),
        'parent_item_colon'     => __( 'Ylätason yhteystieto:', 'yhteystieto' ),
        'not_found'             => __( 'Yhteystietoa ei löytynyt', 'yhteystieto' ),
        'not_found_in_trash'    => __( 'Roskiksessa ei ole yhtään yhteystietoa', 'yhteystieto' ),
        'featured_image'        => _x( 'Terapeutin kuva', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'yhteystieto' ),
        'set_featured_image'    => _x( 'Lataa kuva', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'yhteystieto' ),
        'remove_featured_image' => _x( 'Poista kuva', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'yhteystieto' ),
        'use_featured_image'    => _x( 'Käytä kuvaa', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'yhteystieto' ),
        'insert_into_item'      => _x( 'Lisää yhteystietoon', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'yhteystieto' ),
        'uploaded_to_this_item' => _x( 'Lisää tähän yhteystietoon', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'yhteystieto' ),
        'filter_items_list'     => _x( 'Filter yhteystiedot list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'yhteystieto' ),
        'items_list_navigation' => _x( 'Yhteystiedot list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'yhteystieto' ),
        'items_list'            => _x( 'Yhteystiedot list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'yhteystieto' ),
    );     
    $args = array(
        'labels'             => $labels,
        'description'        => 'Yhteystieto custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'page',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array( 'title', 'thumbnail', 'page-attributes' ),
        'show_in_rest'       => true,
        'register_meta_box_cb' => 'yhteystiedot_metabox',
        'rewrite'            => false,
        'menu_icon'           => 'dashicons-businesswoman',
    );
      
    register_post_type( 'Yhteystieto', $args );
}
add_action( 'init', 'wpdocs_kantbtrue_init' );

function remove_quick_edit( $actions, $post ) { 
     unset($actions['inline hide-if-no-js']);
     return $actions;
}
add_filter('post_row_actions','remove_quick_edit',10,2);




function yhteystiedot_metabox()
{
    add_meta_box( 'yhteystiedot_custom_fields', 'Yhteystietokentät', 'yhteystiedot_metabox_display', 'yhteystieto', 'normal', 'high');
}

add_action( 'add_meta_box', 'yhteystiedot_metabox');

// Tähän tulevat kaikki yhteystieto tyypin lisäkentät
function yhteystiedot_metabox_display()
{
    global $post;

    $paikkakunnat = get_post_meta($post->ID, 'paikkakunnat', true);
    $etavastaanotto = get_post_meta($post->ID, 'etavastaanotto', true);
    $osaaminen = get_post_meta($post->ID, 'osaaminen', true);
    $palvelut = get_post_meta($post->ID, 'palvelut', true);
    $aika = get_post_meta($post->ID, 'aika', true);
    $loppuaika = get_post_meta($post->ID, 'loppuaika', true);
    $pnro = get_post_meta($post->ID, 'pnro', true);
    $email = get_post_meta($post->ID, 'email', true);
    $www = get_post_meta($post->ID, 'www', true);
    $vapaitaAikoja = get_post_meta($post->ID, 'vapaita-aikoja', true);
    $lisatietoja = get_post_meta($post->ID, 'lisatietoja', true);

    ?>
        <br><br>
        <label for="paikkakunnat">Lisää paikkakunnat, jossa pidät vastaanottoa. Erottele paikkakunnat pilkulla ( Pori, Rauma, ... )</label><br>
        <input type="text" name="paikkakunnat" class="widefat" value="<?php echo $paikkakunnat?>"/> <br>
        <label for="etavastaanotto">Etävastaanotto:</label>
        <input type="checkbox" name="etavastaanotto" value="True" <?php  if($etavastaanotto == 'True'){ echo 'checked';} else {echo '';} ?>/>
        <br><br>

        <label for="osaaminen">Lisää tähän osaamisesi/koulutuksesi esim. Psykologi, Psykoterapeutti, ET, KELA</label><br>
        <input type="text" name="osaaminen" class="widefat" value="<?php echo $osaaminen?>"/> <br><br>

        <label for="palvelut">Listaa tähän tarjoamasi terapiatyypit. Erottele pilkulla ( Kognitiivien psykoterapia, lyhytterapia, ... )</label><br>
        <input type="text" name="palvelut" class="widefat" value="<?php echo $palvelut?>"/> <br><br>
        <hr>
        <label for="aika">Otan vastaan ajanvarauksia aikavälillä</label><br>
        <input type="time" name="aika" value="<?php echo $aika?>"/>  -  <input type="time" name="loppuaika" value="<?php echo $loppuaika?>"/> <br><br>
        <label for="pnro">Puhelinnumero</label><br>
        <input type="text" name="pnro" value="<?php echo $pnro?>"/><br><br>
        <label for="email">Email</label><br>
        <input type="email" name="email" value="<?php echo $email?>"/><br><br>
        <label for="www">www - osoite</label><br>
        <input type="url" name="www" value="<?php echo $www?>"/><br><br>
        <label for="vapaita-aikoja">Vapaita aikoja</label>
        <input type="checkbox" name="vapaita-aikoja" value="True" <?php  if($vapaitaAikoja == 'True'){ echo 'checked';} else {echo '';} ?>/><br><br>
        <label for="lisatietoja">Lisätietoja (max. 330 merkkiä)</label><br>
        <textarea name="lisatietoja" id="" cols="30" rows="10" maxlength="280" class="widefat" value="<?php echo $lisatietoja; ?>" ><?php echo $lisatietoja ;?></textarea>

        
    <?php
}

function yhteystiedot_post_type_save($post_id)
{
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );

    if ($is_autosave || $is_revision)
    {
        return;
    }

    $post = get_post($post_id);

    if($post->post_type == "yhteystieto")
    {
         update_post_meta($post_id, 'paikkakunnat', $_POST['paikkakunnat']);
    }

    if($post->post_type == "yhteystieto")
    {
         update_post_meta($post_id, 'etavastaanotto', $_POST['etavastaanotto']);
    }

    if($post->post_type == "yhteystieto")
    {
         update_post_meta($post_id, 'osaaminen', $_POST['osaaminen']);
    }

    if($post->post_type == "yhteystieto")
    {
         update_post_meta($post_id, 'osaaminen', $_POST['osaaminen']);
    }

    if($post->post_type == "yhteystieto")
    {
         update_post_meta($post_id, 'palvelut', $_POST['palvelut']);
    }

    if($post->post_type == "yhteystieto")
    {
         update_post_meta($post_id, 'aika', $_POST['aika']);
    }

    if($post->post_type == "yhteystieto")
    {
         update_post_meta($post_id, 'loppuaika', $_POST['loppuaika']);
    }

    if($post->post_type == "yhteystieto")
    {
         update_post_meta($post_id, 'pnro', $_POST['pnro']);
    }

    if($post->post_type == "yhteystieto")
    {
         update_post_meta($post_id, 'email', $_POST['email']);
    }
    if($post->post_type == "yhteystieto")
    {
         update_post_meta($post_id, 'vapaita-aikoja', $_POST['vapaita-aikoja']);
    }
    if($post->post_type == "yhteystieto")
    {
         update_post_meta($post_id, 'www', $_POST['www']);
    }
    if($post->post_type == "yhteystieto")
    {
         update_post_meta($post_id, 'lisatietoja', $_POST['lisatietoja']);
    }



}

add_action( 'save_post', 'yhteystiedot_post_type_save');

function custom_templates_array() {
     $template_array = [];
     $template_array['terapeutit-template.php'] = 'Terapeutit template';

     return $template_array;
}


function custom_template_register($page_templates, $theme, $post) {

     $templates = custom_templates_array();

     foreach($templates as $key => $val){
          $page_templates[$key] = $val;
     }

     return $page_templates;
}

add_filter( 'theme_page_templates', 'custom_template_register', 10, 3 );

function my_template_select($template){

     global $post, $wp_query, $wpdb;

     $page_template_slug = get_page_template_slug($post->ID);
     $templates = custom_templates_array();

     if(isset($templates[$page_template_slug])){
          $template = plugin_dir_path(__FILE__).'templates/'.$page_template_slug;
     }

     return $template;
}
add_filter( 'template_include', 'my_template_select', 99);


// register javascript and style on initialization

add_action('init', 'register_script');
function register_script() {
    wp_register_script( 'contact_card_js', plugins_url('/contactcard.js', __FILE__), false, '1.0', 'all');
    wp_register_script( 'terapeutit-iconify', 'https://code.iconify.design/2/2.2.1/iconify.min.js'  );

    wp_register_style( 'contact_card_style', plugins_url('/contactcard.css', __FILE__), false, '1.0.0', 'all');
}

// use the registered javascript and style above
add_action('wp_enqueue_scripts', 'enqueue_style');

function enqueue_style(){
   wp_enqueue_script('contact_card_js');
   wp_enqueue_script('terapeutit-iconify');
   wp_enqueue_style( 'contact_card_style' );
}