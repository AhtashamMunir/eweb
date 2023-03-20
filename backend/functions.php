<?php
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/** 
 * @Admin menu func 
 * 
*/
function eweb_menu_hooker() {
     
    add_menu_page(
        'Embed Website Settings', 
        'Embed Website', 
        'administrator', 
        'eweb-main',
        'eweb_admin_settings_page', 
        'dashicons-media-spreadsheet'
    );
    
    add_submenu_page(
        'eweb-main', 
        'Embed Website Settings', 
        'Settings', 
        'administrator', 
        'eweb-settings',
        'eweb_admin_settings_page'
    );
    
    remove_submenu_page(
        "eweb-main", 
        "eweb-main"
    );
}

function eweb_admin_settings_page(){
    $message = array('display' => false, 'msg' => '');
    if( isset ( $_POST['eweb_settings_update'] ) ) {
        
        if ( ! isset( $_POST['eweb_nonce'] ) 
            || ! wp_verify_nonce( $_POST['eweb_nonce'] ) 
        ) {
            wp_die ( "Invalid Nonce. Reload the page and try again!" );
        }
        
        
        if( isset( $_POST['eweb_url'] ) ){
            
            /* Sanitizing web url */
            $eweb_url = sanitize_url( $_POST['eweb_url'], wp_allowed_protocols() );
            
            update_option( 'eweb_url', $eweb_url );
            $message['msg'] = 'settings saved successfully';
            $message['display'] = true;
        }
       
        if( isset( $_POST['iframe_width'] ) ){
            
            /* only allowing integers */
            $iframe_width = sanitize_text_field( $_POST['iframe_width'] );
            
            update_option( 'iframe_width', $iframe_width );
            
        }

        if( isset( $_POST['iframe_height'] ) ){
            
            /* only allowing integers */
            $iframe_height = sanitize_text_field( $_POST['iframe_height'] );
            
            update_option( 'iframe_height', $iframe_height );
            
        }

        if( isset( $_POST['css_box'] ) ){
            
            /* only allowing integers */
            $css_box = $_POST['css_box'];
            
            update_option( 'css_box', $css_box );
            
        }
        
    }

?>    
    <style type="text/css">
        .text-success{
            color: lightgreen;
        }
    </style>   
    <div class="wrap eweb">
        <h1>Embed Website Settings</h1>
        <hr>
        <form class="" method="post">
            <div class="msg" style="display:<?=($message['display'] == true)?'block':'none'?>;color:#09c009;"><?=!empty($message['msg'])?ucwords($message['msg']):''?></div>
            <?php wp_nonce_field(-1, "eweb_nonce");?>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th>Website URL</th>
                        <td>
                            <input type="text" name="eweb_url" value="<?=get_option('eweb_url');?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th>Iframe width</th>
                        <td>
                            <input type="number" min="0" max="1000" name="iframe_width" value="<?=get_option('iframe_width');?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th>Iframe height</th>
                        <td>
                            <input type="number" min="0" max="1000" name="iframe_height" value="<?=get_option('iframe_height');?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th>Additional CSS</th>
                        <td>
                            <?php
                            $css_editor = new Editor('css_editor');
                            $css_editor->getEditor();
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>ShortCode</th>
                        <td>
                            <p>Copy the ShortCode and place into any page: <code>[EWEB]</code></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <p>
                <button type="submit" class="button button-primary" name="eweb_settings_update">Submit</button>
            </p>
        </form>
    </div>
    <script>
        jQuery(document).ready(function(){
            setTimeout(function(){
                jQuery('.msg').hide();
            },1000);
        });
    </script>
<?php    
}


/**
 * @function
 * Display output of shortcode with provided attributes
 * 
 * @atts can be an with following attributes
 */
function eweb_shortcode($atts) {
    
    $iframe_url                 = get_option( 'eweb_url' );
    $width                      = !empty(get_option( 'iframe_width' ))?get_option( 'iframe_width' ):"300";
    $height                     = !empty(get_option( 'iframe_height' ))?get_option( 'iframe_height' ):"300";
    $css                        = get_option( 'css_box' );

    $return = '
        <style>
            '.$css.'
        </style>
        <div class="container">
            <iframe src="'.$iframe_url.'" height="'.$height.'" width="'.$width.'" frameborder="0"></iframe>
        </div>
    ';
    
    
    return $return;
}