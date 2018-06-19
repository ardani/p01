<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Scp_Theme_Icon {

	protected $name = 'Theme Icon';
	protected $namespace = 'scp_theme_icon';
	protected $textdomain = SCP_TEXT_DOMAIN;

	function __construct() {
		// We safely integrate with VC with this hook
		add_action( 'init', array( $this, 'integrateWithVC' ) );

		// Use this when creating a shortcode addon
		add_shortcode( $this->namespace, array( $this, 'render' ) );

		// Register CSS and JS
		add_action( 'wp_enqueue_scripts', array( $this, 'loadCssAndJs' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'loadCssAndJs' ) );

		add_filter( 'vc_iconpicker-type-theme-icons', array( $this, 'theme_icons' ) );
	}

	public function integrateWithVC() {
		// Check if Visual Composer is installed
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			// Display notice that Visual Compser is required
			add_action( 'admin_notices', array( $this, 'showVcVersionNotice' ) );

			return;
		}

		/*
		Add your Visual Composer logic here.
		Lets call vc_map function to "register" our custom shortcode within Visual Composer interface.

		More info: http://kb.wpbakery.com/index.php?title=Vc_map
		*/
		vc_map( array(
			'name'             => esc_html( $this->name, $this->textdomain ),
			'description'      => '',
			'base'             => $this->namespace,
			'class'            => '',
			'controls'         => 'full',
			'icon'             => plugins_url( 'assets/aislin-vc-icon.png', __FILE__ ),
			// or css class name which you can reffer in your css file later. Example: 'vc_extend_my_class'
			'category'         => __( 'Aislin', $this->textdomain ),
			'admin_enqueue_js' => array( plugins_url( 'assets/admin-theme-icon.js', __FILE__ ) ),
			// This will load js file in the VC backend editor
			//'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
			'params'           => array(
				array(
					'type'        => 'iconpicker',
					'param_name'  => 'theme_icon',
					'heading'     => __( 'Icon', $this->textdomain ),
					'value'       => '', // default value to backend editor admin_label
					'class'       => 'scp-theme-icon-name',
					'holder'      => 'div',
					'settings'    => array(
						'emptyIcon'    => false,
						'type'         => 'theme-icons',
						// default true, display an "EMPTY" icon?
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
					),
					'description' => __( 'Select icon from library.', $this->textdomain ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Font Size', $this->textdomain ),
					'param_name'  => 'icon_font_size',
					'description' => __( 'Value in px. Enter number only.', $this->textdomain ),
				),
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Position Absolute?', $this->textdomain ),
					'param_name' => 'position_absolute',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Icon alignment', 'js_composer' ),
					'param_name'  => 'alignment',
					'value'       => array(
						__( 'Left', 'js_composer' )   => 'left',
						__( 'Right', 'js_composer' )  => 'right',
						__( 'Center', 'js_composer' ) => 'center',
					),
					'description' => __( 'Select alignment.', 'js_composer' ),
				),
				array(
					'type'        => 'vc_link',
					'heading'     => __( 'URL (Link)', 'js_composer' ),
					'param_name'  => 'link',
					'description' => __( 'Add link to icon.', 'js_composer' ),
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Icon Color', $this->textdomain ),
					'param_name'  => 'color',
					'description' => __( 'If color is not set, theme accent color will be used.', $this->textdomain ),
				),
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Use Theme Accent Color for Hover', $this->textdomain ),
					'param_name' => 'hover_accent_color',
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Icon Hover Color', $this->textdomain ),
					'param_name'  => 'hover_color',
					'description' => __( 'Will not be used if Use Accent Color is checked.', $this->textdomain ),
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'el_class',
					'heading'     => __( 'Extra class name', $this->textdomain ),
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', $this->textdomain ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'CSS box', 'js_composer' ),
					'param_name' => 'css',
					'group'      => __( 'Design Options', 'js_composer' ),
				),
			)
		) );
	}


	/*
	Shortcode logic how it should be rendered
	*/
	public function render( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'theme_icon'         => 'Text on the button',
			'icon_font_size'     => '',
			'position_absolute'  => '',
			'link'               => '',
			'alignment'          => 'left',
			'color'              => '',
			'hover_color'        => '',
			'hover_accent_color' => '',
			'css'                => '',
			'el_class'           => '',
		), $atts ) );
		// $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content

		$class_to_filter = 'wh-theme-icon';
		$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' );
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter . ' ' . $el_class, $this->namespace, $atts );

		$link     = vc_build_link( $link );
		$a_href   = $link['url'];
		$a_title  = $link['title'];
		$a_target = $link['target'];

		if ( $hover_accent_color == 'true' && function_exists( 'school_time_get_option' ) ) {
			$theme_accent_color = school_time_get_option( 'global-accent-color' );
			if ( $theme_accent_color ) {
				$hover_color = $theme_accent_color;
			}
		}

		$icon_style = '';

		if ( $icon_font_size ) {
			$icon_style .= 'font-size:' . (int) $icon_font_size . 'px;';
		}

		if ( $position_absolute == 'true' ) {
			$icon_style .= 'position:absolute;';
		}

		$hover = '';

		if ( $hover_color && $color ) {

			$hover = 'onMouseOver="this.style.color=\'' . $hover_color . '\'"';
			$hover .= ' onMouseOut="this.style.color=\'' . $color . '\'"';

		}

		if ( $color ) {
			$icon_style .= 'color:' . $color . '!important;';
		}

		if ( $alignment ) {
			if ( $alignment != 'left' ) {
				$icon_style .= 'text-align:' . $alignment . ';';
			}
		}

		if ( $icon_style ) {
			$icon_style = 'style="' . $icon_style . '"';
		}

		ob_start();
		?>

		<?php if ( $a_href ) : ?>
			<a
				href="<?php echo esc_attr( $a_href ); ?>"
				class="<?php echo esc_attr( trim( $css_class ) ); ?>"
				<?php if ( $a_title ) : ?>
					title="<?php echo esc_attr( $a_title ); ?>"
				<?php endif; ?>
				<?php if ( $a_target ) : ?>
					target="<?php echo esc_attr( $a_target ); ?>"
				<?php endif; ?>
				<?php echo $icon_style; ?>
				><i class="<?php echo $theme_icon; ?>" <?php echo $hover; ?>></i></a>
		<?php else: ?>
			<div class="<?php echo esc_attr( $css_class ); ?>" <?php echo $icon_style; ?>>
				<i class="<?php echo $theme_icon; ?>" <?php echo $hover; ?>></i>
			</div>
		<?php endif; ?>

		<?php
		$content = ob_get_clean();

		return $content;
	}

	/*
	Load plugin css and javascript files which you may need on front end of your site
	*/
	public function loadCssAndJs() {
		wp_register_style( 'school-time-icons', get_template_directory_uri() . '/assets/css/school-time-icons.css', false );

		wp_enqueue_style( 'school-time-icons' );
	}

	/*
	Show notice if your plugin is activated but Visual Composer is not
	*/
	public function showVcVersionNotice() {
		$plugin_data = get_plugin_data( __FILE__ );
		echo '
        <div class="updated">
          <p>' . sprintf( __( '<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', $this->textdomain ), $plugin_data['Name'] ) . '</p>
        </div>';
	}

	function theme_icons( $icons ) {

		// class="(icon-\S+)\b" regex
		// .(icon-\S+)\b: regex (copy css for icons)
		// array('$1' => '$1'),\n format

		$theme_icons = array(
			array('icon-alarm-button' => 'icon-alarm-button'),
			array('icon-ancient-school' => 'icon-ancient-school'),
			array('icon-basic-clock' => 'icon-basic-clock'),
			array('icon-bible' => 'icon-bible'),
			array('icon-bible-with-cross-in-cover' => 'icon-bible-with-cross-in-cover'),
			array('icon-black-back-closed-envelope-shape' => 'icon-black-back-closed-envelope-shape'),
			array('icon-black-clock' => 'icon-black-clock'),
			array('icon-black-heart' => 'icon-black-heart'),
			array('icon-book-with-bookmark2' => 'icon-book-with-bookmark2'),
			array('icon-bus-school' => 'icon-bus-school'),
			array('icon-calendar-black' => 'icon-calendar-black'),
			array('icon-calendar-empty' => 'icon-calendar-empty'),
			array('icon-calendar-nice' => 'icon-calendar-nice'),
			array('icon-calendar-round' => 'icon-calendar-round'),
			array('icon-checked-symbol' => 'icon-checked-symbol'),
			array('icon-christian-church' => 'icon-christian-church'),
			array('icon-church-front' => 'icon-church-front'),
			array('icon-church' => 'icon-church'),
			array('icon-done-tick' => 'icon-done-tick'),
			array('icon-down-arrow-download-button' => 'icon-down-arrow-download-button'),
			array('icon-email' => 'icon-email'),
			array('icon-framed-portrait' => 'icon-framed-portrait'),
			array('icon-icon' => 'icon-icon'),
			array('icon-map-marker' => 'icon-map-marker'),
			array('icon-map-placeholder-rounded' => 'icon-map-placeholder-rounded'),
			array('icon-musical-eighth-notes' => 'icon-musical-eighth-notes'),
			array('icon-building' => 'icon-building'),
			array('icon-play-rounded' => 'icon-play-rounded'),
			array('icon-play' => 'icon-play'),
			array('icon-headphone' => 'icon-headphone'),
			array('icon-bible-front' => 'icon-bible-front'),
			array('icon-video' => 'icon-video'),
			array('icon-bell-circle' => 'icon-bell-circle'),
			array('icon-church-solid' => 'icon-church-solid'),
			array('icon-church-line' => 'icon-church-line'),
			array('icon-addmission' => 'icon-addmission'),
			array('icon-ball' => 'icon-ball'),
			array('icon-pencil-and-ruler' => 'icon-pencil-and-ruler'),
			array('icon-phone-call' => 'icon-phone-call'),
			array('icon-map' => 'icon-map'),
			array('icon-map-solid' => 'icon-map-solid'),
			array('icon-planet-earth' => 'icon-planet-earth'),
			array('icon-right-arrow' => 'icon-right-arrow'),
			array('icon-round-account-button-with-user-inside' => 'icon-round-account-button-with-user-inside'),
			array('icon-school-calendar' => 'icon-school-calendar'),
			array('icon-sms-bubble-speech' => 'icon-sms-bubble-speech'),
			array('icon-tag2' => 'icon-tag2'),
			array('icon-time' => 'icon-time'),
			array('icon-turn-notifications-on-button' => 'icon-turn-notifications-on-button'),
			array('icon-watch' => 'icon-watch'),
			array('icon-write-email-envelope-button' => 'icon-write-email-envelope-button'),
			array('icon-arrows-left' => 'icon-arrows-left'),
			array('icon-arrows-right' => 'icon-arrows-right'),
			array('icon-arrows-right-thin' => 'icon-arrows-right-thin'),
			array('icon-Arrow-Left-New' => 'icon-Arrow-Left-New'),
			array('icon-Arrow-Right-New' => 'icon-Arrow-Right-New'),
			array('icon-Book-New' => 'icon-Book-New'),
			array('icon-Browser-New' => 'icon-Browser-New'),
			array('icon-Calendar-New' => 'icon-Calendar-New'),
			array('icon-Check-New' => 'icon-Check-New'),
			array('icon-Clock-New' => 'icon-Clock-New'),
			array('icon-Contact-New' => 'icon-Contact-New'),
			array('icon-Pdf-New' => 'icon-Pdf-New'),
			array('icon-Pin-New' => 'icon-Pin-New'),
			array('icon-Video-New' => 'icon-Video-New'),
			array('icon-Check' => 'icon-Check'),
			array('icon-black' => 'icon-black'),
			array('icon-circle' => 'icon-circle'),
			array('icon-internet' => 'icon-internet'),
			array('icon-program' => 'icon-program'),
			array('icon-sign' => 'icon-sign'),
			array('icon-signs1' => 'icon-signs1'),
			array('icon-signs' => 'icon-signs'),
			array('icon-social' => 'icon-social'),
			array('icon-social-media1' => 'icon-social-media1'),
			array('icon-social-media' => 'icon-social-media'),
			array('icon-Phone' => 'icon-Phone'),
			array('icon-Phone2' => 'icon-Phone2'),
			array('icon-Folder2' => 'icon-Folder2'),
			array('icon-add-new-user' => 'icon-add-new-user'),
			array('icon-Agenda' => 'icon-Agenda'),
			array('icon-alarm1' => 'icon-alarm1'),
			array('icon-alarm-clock-with-bells' => 'icon-alarm-clock-with-bells'),
			array('icon-american-fooball-ball' => 'icon-american-fooball-ball'),
			array('icon-american-football-helmet' => 'icon-american-football-helmet'),
			array('icon-apartment' => 'icon-apartment'),
			array('icon-apple-with-leaf' => 'icon-apple-with-leaf'),
			array('icon-application-documents' => 'icon-application-documents'),
			array('icon-arrow-down' => 'icon-arrow-down'),
			array('icon-arrow-down-circle' => 'icon-arrow-down-circle'),
			array('icon-arrow-left' => 'icon-arrow-left'),
			array('icon-arrow-left-circle' => 'icon-arrow-left-circle'),
			array('icon-arrow-right' => 'icon-arrow-right'),
			array('icon-arrow-right-circle' => 'icon-arrow-right-circle'),
			array('icon-arrow-up' => 'icon-arrow-up'),
			array('icon-arrow-up-circle' => 'icon-arrow-up-circle'),
			array('icon-Bascketball' => 'icon-Bascketball'),
			array('icon-basketball-hoop' => 'icon-basketball-hoop'),
			array('icon-bicycle' => 'icon-bicycle'),
			array('icon-big-backpack' => 'icon-big-backpack'),
			array('icon-big-basket-ball' => 'icon-big-basket-ball'),
			array('icon-big-book-with-bookmark' => 'icon-big-book-with-bookmark'),
			array('icon-big-circular-clock' => 'icon-big-circular-clock'),
			array('icon-big-telephone' => 'icon-big-telephone'),
			array('icon-Book2' => 'icon-Book2'),
			array('icon-book' => 'icon-book'),
			array('icon-book-and-magnifying-glass' => 'icon-book-and-magnifying-glass'),
			array('icon-book-with-bookmark' => 'icon-book-with-bookmark'),
			array('icon-briefcase' => 'icon-briefcase'),
			array('icon-bubble' => 'icon-bubble'),
			array('icon-building-with-big-windows' => 'icon-building-with-big-windows'),
			array('icon-Bulb' => 'icon-Bulb'),
			array('icon-bus' => 'icon-bus'),
			array('icon-calendar-full' => 'icon-calendar-full'),
			array('icon-car3' => 'icon-car3'),
			array('icon-Chart2' => 'icon-Chart2'),
			array('icon-chart-bars' => 'icon-chart-bars'),
			array('icon-checkmark-circle' => 'icon-checkmark-circle'),
			array('icon-check-square' => 'icon-check-square'),
			array('icon-chevron-down' => 'icon-chevron-down'),
			array('icon-chevron-down-circle' => 'icon-chevron-down-circle'),
			array('icon-chevron-left' => 'icon-chevron-left'),
			array('icon-chevron-left-circle' => 'icon-chevron-left-circle'),
			array('icon-chevron-right' => 'icon-chevron-right'),
			array('icon-chevron-right-circle' => 'icon-chevron-right-circle'),
			array('icon-chevron-up' => 'icon-chevron-up'),
			array('icon-chevron-up-circle' => 'icon-chevron-up-circle'),
			array('icon-circle-minus' => 'icon-circle-minus'),
			array('icon-circular-info-sign' => 'icon-circular-info-sign'),
			array('icon-ClipboardText' => 'icon-ClipboardText'),
			array('icon-clipboard-with-blank-paper' => 'icon-clipboard-with-blank-paper'),
			array('icon-clock' => 'icon-clock'),
			array('icon-clock-with-clockwise' => 'icon-clock-with-clockwise'),
			array('icon-closed-book' => 'icon-closed-book'),
			array('icon-cloud' => 'icon-cloud'),
			array('icon-cloud-check' => 'icon-cloud-check'),
			array('icon-cloud-download' => 'icon-cloud-download'),
			array('icon-cloud-upload' => 'icon-cloud-upload'),
			array('icon-Column' => 'icon-Column'),
			array('icon-cup' => 'icon-cup'),
			array('icon-cup-1' => 'icon-cup-1'),
			array('icon-cutlery' => 'icon-cutlery'),
			array('icon-diploma' => 'icon-diploma'),
			array('icon-down-arrow-with-cloud' => 'icon-down-arrow-with-cloud'),
			array('icon-Download2' => 'icon-Download2'),
			array('icon-download' => 'icon-download'),
			array('icon-download6' => 'icon-download6'),
			array('icon-download-big-arrow' => 'icon-download-big-arrow'),
			array('icon-DSLRCamera' => 'icon-DSLRCamera'),
			array('icon-earning-a-degree' => 'icon-earning-a-degree'),
			array('icon-earth' => 'icon-earth'),
			array('icon-educational-programs' => 'icon-educational-programs'),
			array('icon-elemental-tip' => 'icon-elemental-tip'),
			array('icon-enter' => 'icon-enter'),
			array('icon-enter-down' => 'icon-enter-down'),
			array('icon-envelope' => 'icon-envelope'),
			array('icon-faculty-shield' => 'icon-faculty-shield'),
			array('icon-female-student' => 'icon-female-student'),
			array('icon-File' => 'icon-File'),
			array('icon-film-play' => 'icon-film-play'),
			array('icon-financial-presentation' => 'icon-financial-presentation'),
			array('icon-flag' => 'icon-flag'),
			array('icon-flag-1' => 'icon-flag-1'),
			array('icon-flag-2' => 'icon-flag-2'),
			array('icon-flag7' => 'icon-flag7'),
			array('icon-freshman-applicant' => 'icon-freshman-applicant'),
			array('icon-Glasses' => 'icon-Glasses'),
			array('icon-glasses-with-reflection' => 'icon-glasses-with-reflection'),
			array('icon-hand-bell' => 'icon-hand-bell'),
			array('icon-hand-with-thumb-up' => 'icon-hand-with-thumb-up'),
			array('icon-inclined-pin' => 'icon-inclined-pin'),
			array('icon-inclined-pushpin' => 'icon-inclined-pushpin'),
			array('icon-inclined-rocket' => 'icon-inclined-rocket'),
			array('icon-incoming-email' => 'icon-incoming-email'),
			array('icon-insignia-1' => 'icon-insignia-1'),
			array('icon-keyboard' => 'icon-keyboard'),
			array('icon-laptop-phone' => 'icon-laptop-phone'),
			array('icon-library-building' => 'icon-library-building'),
			array('icon-license' => 'icon-license'),
			array('icon-little-flag' => 'icon-little-flag'),
			array('icon-little-home' => 'icon-little-home'),
			array('icon-little-smartphone' => 'icon-little-smartphone'),
			array('icon-location-placeholder' => 'icon-location-placeholder'),
			array('icon-Mail' => 'icon-Mail'),
			array('icon-mailing' => 'icon-mailing'),
			array('icon-map-placeholder' => 'icon-map-placeholder'),
			array('icon-map-with-roads-and-placeholder' => 'icon-map-with-roads-and-placeholder'),
			array('icon-marker-pen' => 'icon-marker-pen'),
			array('icon-mathematic-calculator' => 'icon-mathematic-calculator'),
			array('icon-Medal2' => 'icon-Medal2'),
			array('icon-medal' => 'icon-medal'),
			array('icon-medal-2' => 'icon-medal-2'),
			array('icon-menu' => 'icon-menu'),
			array('icon-menu-circle' => 'icon-menu-circle'),
			array('icon-Message' => 'icon-Message'),
			array('icon-MessageRight' => 'icon-MessageRight'),
			array('icon-minus-symbol' => 'icon-minus-symbol'),
			array('icon-musical-note' => 'icon-musical-note'),
			array('icon-MusicMixer' => 'icon-MusicMixer'),
			array('icon-MusicNote' => 'icon-MusicNote'),
			array('icon-new-message-envelope' => 'icon-new-message-envelope'),
			array('icon-newspaper' => 'icon-newspaper'),
			array('icon-Notes' => 'icon-Notes'),
			array('icon-notification' => 'icon-notification'),
			array('icon-notification-bell' => 'icon-notification-bell'),
			array('icon-openbook' => 'icon-openbook'),
			array('icon-caledar' => 'icon-caledar'),
			array('icon-calendar-clock' => 'icon-calendar-clock'),
			array('icon-pin' => 'icon-pin'),
			array('icon-open-book' => 'icon-open-book'),
			array('icon-download-cloud' => 'icon-download-cloud'),
			array('icon-calendar-small' => 'icon-calendar-small'),
			array('icon-calendar' => 'icon-calendar'),
			array('icon-pin-02' => 'icon-pin-02'),
			array('icon-pdf' => 'icon-pdf'),
			array('icon-clock-02' => 'icon-clock-02'),
			array('icon-cloud-download2' => 'icon-cloud-download2'),
			array('icon-calendar2' => 'icon-calendar2'),
			array('icon-bookbook' => 'icon-bookbook'),
			array('icon-certificate' => 'icon-certificate'),
			array('icon-one-cloud' => 'icon-one-cloud'),
			array('icon-one-protactor' => 'icon-one-protactor'),
			array('icon-open-book2' => 'icon-open-book2'),
			array('icon-open-book-on-lectern' => 'icon-open-book-on-lectern'),
			array('icon-open-book-with-bookmark' => 'icon-open-book-with-bookmark'),
			array('icon-open-scissors' => 'icon-open-scissors'),
			array('icon-paint-brush-and-palette' => 'icon-paint-brush-and-palette'),
			array('icon-paper-bill' => 'icon-paper-bill'),
			array('icon-pc-tower-and-monitor' => 'icon-pc-tower-and-monitor'),
			array('icon-pdf-file' => 'icon-pdf-file'),
			array('icon-phone' => 'icon-phone'),
			array('icon-phone-handset' => 'icon-phone-handset'),
			array('icon-photo-camera-with-big-len' => 'icon-photo-camera-with-big-len'),
			array('icon-picture' => 'icon-picture'),
			array('icon-pie-chart' => 'icon-pie-chart'),
			array('icon-placeholder' => 'icon-placeholder'),
			array('icon-Planet' => 'icon-Planet'),
			array('icon-play-circular-button' => 'icon-play-circular-button'),
			array('icon-playlist-square-button' => 'icon-playlist-square-button'),
			array('icon-plus' => 'icon-plus'),
			array('icon-plus-circle' => 'icon-plus-circle'),
			array('icon-podium-1' => 'icon-podium-1'),
			array('icon-Pointer' => 'icon-Pointer'),
			array('icon-printer' => 'icon-printer'),
			array('icon-printing-document' => 'icon-printing-document'),
			array('icon-professor-consultation' => 'icon-professor-consultation'),
			array('icon-projector-screen' => 'icon-projector-screen'),
			array('icon-pushpin' => 'icon-pushpin'),
			array('icon-quality' => 'icon-quality'),
			array('icon-quality-badge' => 'icon-quality-badge'),
			array('icon-question-circle' => 'icon-question-circle'),
			array('icon-rocket' => 'icon-rocket'),
			array('icon-round-add-button' => 'icon-round-add-button'),
			array('icon-round-alarm-clock' => 'icon-round-alarm-clock'),
			array('icon-round-clock' => 'icon-round-clock'),
			array('icon-rounded-delete-button-with-minus1' => 'icon-rounded-delete-button-with-minus1'),
			array('icon-rounded-delete-button-with-minus' => 'icon-rounded-delete-button-with-minus'),
			array('icon-schedule' => 'icon-schedule'),
			array('icon-school-bag' => 'icon-school-bag'),
			array('icon-school-building-with-flag' => 'icon-school-building-with-flag'),
			array('icon-school-bus-front-view' => 'icon-school-bus-front-view'),
			array('icon-school-certificate' => 'icon-school-certificate'),
			array('icon-science-symbol' => 'icon-science-symbol'),
			array('icon-Scisors' => 'icon-Scisors'),
			array('icon-select' => 'icon-select'),
			array('icon-sending-mail' => 'icon-sending-mail'),
			array('icon-send-message' => 'icon-send-message'),
			array('icon-smartphone' => 'icon-smartphone'),
			array('icon-speech-bubble-with-question-mark' => 'icon-speech-bubble-with-question-mark'),
			array('icon-speech-bubble-with-text' => 'icon-speech-bubble-with-text'),
			array('icon-sport-centre' => 'icon-sport-centre'),
			array('icon-sport-faculty' => 'icon-sport-faculty'),
			array('icon-sport-medal' => 'icon-sport-medal'),
			array('icon-square-browser' => 'icon-square-browser'),
			array('icon-star' => 'icon-star'),
			array('icon-star9' => 'icon-star9'),
			array('icon-star-empty' => 'icon-star-empty'),
			array('icon-star-half' => 'icon-star-half'),
			array('icon-star-in-square' => 'icon-star-in-square'),
			array('icon-student-hostel' => 'icon-student-hostel'),
			array('icon-student-id' => 'icon-student-id'),
			array('icon-student-reading' => 'icon-student-reading'),
			array('icon-students-on-lecture' => 'icon-students-on-lecture'),
			array('icon-study-desk-with-lamp' => 'icon-study-desk-with-lamp'),
			array('icon-studying-desk-and-chair' => 'icon-studying-desk-and-chair'),
			array('icon-study-lamp-on' => 'icon-study-lamp-on'),
			array('icon-study-process' => 'icon-study-process'),
			array('icon-study-tools' => 'icon-study-tools'),
			array('icon-tablet' => 'icon-tablet'),
			array('icon-tag' => 'icon-tag'),
			array('icon-teacher-briefcase' => 'icon-teacher-briefcase'),
			array('icon-teacher-pointing-at-blackboard' => 'icon-teacher-pointing-at-blackboard'),
			array('icon-teaching' => 'icon-teaching'),
			array('icon-three-emails' => 'icon-three-emails'),
			array('icon-thumb-up' => 'icon-thumb-up'),
			array('icon-Time' => 'icon-Time'),
			array('icon-Tools' => 'icon-Tools'),
			array('icon-touch' => 'icon-touch'),
			array('icon-triangular-ruler' => 'icon-triangular-ruler'),
			array('icon-trophy' => 'icon-trophy'),
			array('icon-Typing' => 'icon-Typing'),
			array('icon-university-app' => 'icon-university-app'),
			array('icon-university-building' => 'icon-university-building'),
			array('icon-university-campus' => 'icon-university-campus'),
			array('icon-university-hospital' => 'icon-university-hospital'),
			array('icon-university-lecture' => 'icon-university-lecture'),
			array('icon-university-musem' => 'icon-university-musem'),
			array('icon-university-proffesor' => 'icon-university-proffesor'),
			array('icon-User2' => 'icon-User2'),
			array('icon-user' => 'icon-user'),
			array('icon-Users2' => 'icon-Users2'),
			array('icon-Video' => 'icon-Video'),
			array('icon-video-player' => 'icon-video-player'),
			array('icon-vintage-camera-filming' => 'icon-vintage-camera-filming'),
			array('icon-Web' => 'icon-Web'),
			array('icon-WorldGlobe' => 'icon-WorldGlobe'),
			array('icon-WorldWide' => 'icon-WorldWide'),

		);

		return array_merge( $icons, $theme_icons );
	}
}

// Finally initialize code
new Scp_Theme_Icon();
