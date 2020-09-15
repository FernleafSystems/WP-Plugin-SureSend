<?php declare( strict_types=1 );

namespace FernleafSystems\Wordpress\Plugin\SureSend\Mailgun\Legacy;

class Init {

	public function run() {
		$this->originalInitFixed();
	}

	private function originalInitFixed() {
		$mg = new \Mailgun();
		add_action( 'widgets_init', [ $mg, 'load_list_widget' ] );
		add_action( 'wp_ajax_nopriv_add_list', [ $mg, 'add_list' ] );
		add_action( 'wp_ajax_add_list', [ $mg, 'add_list' ] );
		if ( is_admin() ) {
			$mailgunAdmin = new \MailgunAdmin();
		}
	}
}