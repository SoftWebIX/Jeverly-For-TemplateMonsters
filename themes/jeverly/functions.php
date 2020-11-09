<?php
/**
 * Jeverly functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Jeverly
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'jeverly_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function jeverly_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Jeverly, use a find and replace
		 * to change 'jeverly' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'jeverly', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'jeverly' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'jeverly_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'jeverly_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jeverly_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jeverly_content_width', 640 );
}
add_action( 'after_setup_theme', 'jeverly_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jeverly_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'jeverly' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'jeverly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'jeverly_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function jeverly_scripts() {
    // Styles.
    wp_enqueue_style( 'jeverly-main-style', get_template_directory_uri() . '/assets/css/style.min.css', array(), _S_VERSION );
    wp_enqueue_style( 'jeverly-font-awesome', 'https://use.fontawesome.com/releases/v5.0.13/css/all.css', array(), '4.7.0' );
    wp_enqueue_style( 'jeverly-style', get_stylesheet_uri(), array(), _S_VERSION );

    // Scripts.
    wp_enqueue_script( 'jeverly-jquery', get_template_directory_uri() . '/assets/js/lib/jquery.min.js', array(), '3.5.1' );
    wp_enqueue_script( 'jeverly-custom', get_template_directory_uri() . '/assets/js/custom.min.js', array( 'jeverly-jquery' ), _S_VERSION, true );

    wp_register_script( 'myscript', get_template_directory_uri() . '/assets/js/mailsend.min.js', array( 'jquery' ), _S_VERSION );
    wp_localize_script( 'myscript', 'ajaxobj', array( 'ajaxurl' => admin_url() . 'admin-ajax.php') );
    wp_enqueue_script( 'myscript' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'jeverly_scripts' );

if ( ! function_exists( 'jeverly_gutenberg' ) ) :
	function jeverly_gutenberg() {
		wp_enqueue_style( 'jeverly-gutenberg', get_template_directory_uri() . '/assets/css/gutenberg.min.css' );
	}
endif;

add_action( 'enqueue_block_editor_assets', 'jeverly_gutenberg' );

function image_uploader_enqueue() {
    global $typenow;

    if ( ( $typenow == 'post' ) ) {
        wp_enqueue_media();

        wp_register_script( 'meta-image', get_template_directory_uri() . '/assets/js/media-uploader.js', array( 'jquery' ) );
        wp_enqueue_script( 'meta-image' );
    }
}

add_action( 'admin_enqueue_scripts', 'image_uploader_enqueue' );

function jeverly_scripts_admin() {
    wp_enqueue_script( 'my_custom_script', get_template_directory_uri() . '/assets/js/admin.js', array(), _S_VERSION );
}

add_action( 'admin_enqueue_scripts', 'jeverly_scripts_admin' );

function jeverly_custom_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    $req       = get_option( 'require_name_email' );
    $aria_req  = ( $req ? " aria-required='true'" : ’ );

    $fields[ 'author' ] = '<p class="comment-form-author">' .
        '<input id="author" name="author" type="text" placeholder="Name*" value="'. esc_attr( $commenter[ 'comment_author' ] ) .
        '" size="30" tabindex="1"' . $aria_req . ' /></p>';

    $fields[ 'email' ] = '<p class="comment-form-email">' .
        '<input id="email" name="email" type="text" placeholder="Email*" value="'. esc_attr( $commenter[ 'comment_author_email' ] ) .
        '" size="30"  tabindex="2"' . $aria_req . ' /></p>';

    $fields[ 'url' ] = '';

    return $fields;
}

add_filter( 'comment_form_default_fields', 'jeverly_custom_fields' );

function jeverly_comment_author( $comment, $args, $depth ) {
	if ( 'div' === $args[ 'style' ] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}

	$classes        = ' ' . comment_class( empty( $args[ 'has_children' ] ) ? '' : 'parent', null, null, false );

    $get_user_name  = $comment->comment_author;
    $output_name    = ! empty ( $get_user_name ) ? $get_user_name : 'Admin';

	$get_user_email = $comment->comment_author_email;
	$output_email   = ! empty ( $get_user_email ) ? $get_user_email : '';
?>
	<<?php echo $tag, $classes; ?> id="comment-<?php comment_ID() ?>">
        <?php if ( 'div' != $args[ 'style' ] ) { ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
        <?php } ?>

        <?php if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation">
                <?php _e( 'Your comment is awaiting moderation.', 'jeverly' ); ?>
            </em><br/>
        <?php } ?>

        <div class="comment-author vcard">
            <?php echo get_avatar( $output_email, '', 'monsterid', 'Monster', [ 'class' => 'jeverly-user--img', 'extra_attr' => 'title="' . $output_email . '"' ] ); ?>

            <div class="comment-meta">
                <div class="comment-author--info">
                    <h6 class="comment-author--name"><?php echo $output_name; ?></h6>

                    <div class="comment-author--reply">
                        <?php
                            comment_reply_link(
                                array_merge(
                                    $args,
                                    array(
                                        'add_below' => $add_below,
                                        'depth'     => $depth,
                                        'max_depth' => $args[ 'max_depth' ]
                                    )
                                )
                            );
                        ?>
                    </div>

                     <?php edit_comment_link( __( 'Edit', 'jeverly' ), '  ', '' ); ?>
                </div>

                <div class="comment-author--date-posts">
                    <span class="comment-author--date"><?php echo get_comment_date( 'F j, Y \a\t H:ia', get_comment_ID() ); ?></span>
                </div>

                <div class="comment-author--description">
                    <?php comment_text(); ?>
                </div>
            </div>

        </div>

	<?php if ( 'div' != $args['style'] ) { ?>
		</div>
	<?php }
}

function jeverly_decoration_image_add_metabox () {
	add_meta_box( 'decorationimagediv', __( 'Decoration Image', 'jeverly' ), 'jeverly_decoration_image_metabox', 'post', 'side', 'low' );
}

add_action( 'add_meta_boxes', 'jeverly_decoration_image_add_metabox' );

function jeverly_decoration_image_metabox( $post ) {
	global $content_width, $_wp_additional_image_sizes;

	$image_id = get_post_meta( $post->ID, '_decoration_image_id', true );

	$old_content_width = $content_width;
	$content_width = 254;

	if ( $image_id && get_post( $image_id ) ) {
		if ( ! isset( $_wp_additional_image_sizes[ 'post-thumbnail' ] ) ) {
			$thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
		} else {
			$thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
		}

		if ( ! empty( $thumbnail_html ) ) {
			$content = $thumbnail_html;
			$content .= '<p class="hide-if-no-js"><a href="javascript:;" id="remove_decoration_image_button" >' . esc_html__( 'Remove decoration image', 'jeverly' ) . '</a></p>';
			$content .= '<input type="hidden" id="upload_decoration_image" name="_decoration_cover_image" value="' . esc_attr( $image_id ) . '" />';
		}

		$content_width = $old_content_width;
	} else {
		$content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
		$content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set decoration image', 'jeverly' ) . '" href="javascript:;" id="upload_decoration_image_button" id="set-decoration-image" data-uploader_title="' . esc_attr__( 'Choose an image', 'jeverly' ) . '" data-uploader_button_text="' . esc_attr__( 'Set decoration image', 'jeverly' ) . '">' . esc_html__( 'Set decoration image', 'jeverly' ) . '</a></p>';
		$content .= '<input type="hidden" id="upload_decoration_image" name="_decoration_cover_image" value="" />';
	}

	echo $content;
}

function jeverly_decoration_image_save( $post_id ) {
	if ( isset( $_POST[ '_decoration_cover_image' ] ) ) {
		$image_id = (int) $_POST[ '_decoration_cover_image' ];
		update_post_meta( $post_id, '_decoration_image_id', $image_id );
	}
}

add_action( 'save_post', 'jeverly_decoration_image_save', 10, 1 );


// Register and load the widget
function footer_widget() {
    register_sidebar( array(
        'name'          => 'Footer customize widgets',
        'id'            => 'footer_widgets',
        'description'   => 'Add widgets here.',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ) );
}

add_action( 'widgets_init', 'footer_widget' );


function mail_func_callback() {
     $jeverly_email = sanitize_text_field( $_POST[ 'jeverly_email' ] );

     wp_mail( 'test@gmail.com', 'Subscribe', $jeverly_email );

     die();
}

add_action( 'wp_ajax_mail_func', 'mail_func_callback' );
add_action( 'wp_ajax_nopriv_mail_func', 'mail_func_callback' );

// SMTP connect.
function mailtrap( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host     = 'smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port     = 2525;
    $phpmailer->Username = '2d7a4d0a332ee1';
    $phpmailer->Password = '99014510dd53c1';
}

add_action( 'phpmailer_init', 'mailtrap' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customize widgets.
 */
require get_template_directory() . '/widgets/footer-social.php';
require get_template_directory() . '/widgets/footer-subscribe.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

