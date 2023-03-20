<?php
class Editor {

    protected $id;
  
    public function __construct($id) {
      $this->id = $id;
    }
  
    public function getEditor() {
        $settings =   array(
            'wpautop' => true, // enable auto paragraph?
            'media_buttons' => false, // show media buttons?
            'textarea_name' => 'css_box', // id of the target textarea
            'textarea_rows' => get_option('default_post_edit_rows', 10), // This is equivalent to rows="" in HTML
            'tabindex' => '',
            'editor_css' => '', //  additional styles for Visual and Text editor,
            'editor_class' => '', // sdditional classes to be added to the editor
            'teeny' => true, // show minimal editor
            'dfw' => false, // replace the default fullscreen with DFW
            'tinymce' => array(
                // Items for the Visual Tab
                'toolbar1'=> 'bold,italic,underline,bullist,numlist,link,unlink,forecolor,undo,redo,',
            ),
            'quicktags' => array(
                // Items for the Text Tab
                'buttons' => 'strong,em,underline,ul,ol,li,link,code'
            )
        );
        return sprintf(
            wp_editor( __((get_option('css_box')!='')?get_option('css_box'):''), $this->id, $settings )
        );
    }
}
?>