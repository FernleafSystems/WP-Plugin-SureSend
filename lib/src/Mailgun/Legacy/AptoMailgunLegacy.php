<?php declare( strict_types=1 );

namespace FernleafSystems\Wordpress\Plugin\SureSend\Mailgun\Legacy;

class AptoMailgunLegacy {

	/**
	 * @var \Mailgun
	 */
	private static $mailgun;

	/**
	 * @var \MailgunAdmin
	 */
	private static $mailgunAdmin;

	public static function GetInstance() :\Mailgun {
		if ( empty( self::$mailgun ) ) {
			new self();
		}
		return self::$mailgun;
	}

	private function __construct() {
		$this->originalInit();
	}

	private function originalInit() {
		self::$mailgun = new \Mailgun();
		add_action( 'widgets_init', [ self::$mailgun, 'load_list_widget' ] );
		add_action( 'wp_ajax_nopriv_add_list', [ self::$mailgun, 'add_list' ] );
		add_action( 'wp_ajax_add_list', [ self::$mailgun, 'add_list' ] );
		if ( is_admin() ) {
			self::$mailgunAdmin = new \MailgunAdmin();
		}
	}
}