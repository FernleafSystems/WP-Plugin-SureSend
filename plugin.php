<?php
/*
 * Plugin Name: SureSend
 * Plugin URI: https://shsec.io/2f
 * Description: Ensure Emails Are Always Delivered.
 * Version: 0.1.0
 * Text Domain: apto-suresend
 * Domain Path: /languages
 * Author: Apto Technologies
 * Author URI: https://shsec.io/bv
 */

/**
 * Copyright (c) 2020 Shield Security <support@shieldsecurity.io>
 * All rights reserved.
 * "Shield" (formerly WordPress Simple Firewall) is distributed under the GNU
 * General Public License, Version 2, June 1991. Copyright (C) 1989, 1991 Free
 * Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110, USA
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

if ( @is_file( __DIR__.'/lib/vendor/autoload.php' ) ) {

	if ( in_array( 'mailgun/mailgun.php', (array)get_option( 'active_plugins', [] ), true ) ) {
		add_action( 'admin_notices', function () {
			echo sprintf( '<div class="error"><h4>%s</h4><p>%s</p></div>',
				'SureSend - The older Mailgun plugin appears to be active',
				implode( '<br/>', [
					"Please disable the old plugin and then this plugin will automatically take over.",
				] )
			);
		} );
	}
	else {
		require_once( __DIR__.'/lib/vendor/autoload.php' );
		\FernleafSystems\Wordpress\Plugin\SureSend\Mailgun\Legacy\AptoMailgunLegacy::GetInstance();
	}
}
else {
	add_action( 'admin_notices', function () {
		echo sprintf( '<div class="error"><h4>%s</h4><p>%s</p></div>',
			'SureSend - Broken Installation',
			implode( '<br/>', [
				'It appears the SureSend plugin was not upgraded/installed correctly.',
				"We run a quick check to make sure certain important files are present in-case a faulty installation breaks your site.",
				'Try refreshing this page, and if you continue to see this notice, we recommend that you reinstall the Shield Security plugin.'
			] )
		);
	} );
}