<?php

add_action('acf/init', 'localrule_acf_blocks_init');
function localrule_acf_blocks_init(){
	if(function_exists('acf_register_block_type')){
		// Hero block type
		acf_register_block_type(array(
			'name' 				=> 'hero',
			'title' 			=> __('Hero'),
			'description' 		=> __('A custom hero block.'),
			'mode'				=> 'preview',
			'render_template' 	=> 'template-parts/blocks/hero.php',
			'category' 			=> 'layout',
			'enqueue_style'		=> get_template_directory_uri() . '/scripts/css/main.css',
			'supports'			=> [
				'jsx' => true,
			],
			'icon' 				=> '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M4.828 21l-.02.02-.021-.02H2.992A.993.993 0 0 1 2 20.007V3.993A1 1 0 0 1 2.992 3h18.016c.548 0 .992.445.992.993v16.014a1 1 0 0 1-.992.993H4.828zM20 15V5H4v14L14 9l6 6zm0 2.828l-6-6L6.828 19H20v-1.172zM8 11a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg>',
		));
		// Plain text block type
		acf_register_block_type(array(
			'name' 				=> 'plain_text',
			'title' 			=> __('Plain Text'),
			'description' 		=> __('A custom plain text block.'),
			'mode'				=> 'preview',
			'render_template' 	=> 'template-parts/blocks/plain-text.php',
			'category' 			=> 'layout',
			'enqueue_style'		=> get_template_directory_uri() . '/scripts/css/main.css',
			'supports'			=> [
				'jsx' => true,
			],
			'icon' 				=> '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M21 8v12.993A1 1 0 0 1 20.007 22H3.993A.993.993 0 0 1 3 21.008V2.992C3 2.455 3.449 2 4.002 2h10.995L21 8zm-2 1h-5V4H5v16h14V9zM8 7h3v2H8V7zm0 4h8v2H8v-2zm0 4h8v2H8v-2z"/></svg>',
		));
	}
}

?>