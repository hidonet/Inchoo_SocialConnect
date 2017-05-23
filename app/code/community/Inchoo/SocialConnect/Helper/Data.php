<?php
/**
 * Inchoo is not affiliated with or in any way responsible for this code.
 *
 * Commercial support is available directly from the [extension author](http://www.techytalk.info/contact/).
 *
 * @category Marko-M
 * @package SocialConnect
 * @author Marko Martinović <marko@techytalk.info>
 * @copyright Copyright (c) Marko Martinović (http://www.techytalk.info)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

class Inchoo_SocialConnect_Helper_Data extends Mage_Core_Helper_Abstract
{
    public static function log($message, $level = null, $file = '', $forceLog = false)
    {
        if(Mage::getIsDeveloperMode()) {
            Mage::log($message, $level, $file, $forceLog);
        }
    }

	// ---------------------------------------------------------------------------------------------------
	function getFacebookAuthUrl() {
	
		//$client = Mage::getSingleton('Inchoo_SocialConnect_Model_Facebook_Oauth2_Client');

		//$this->client = Mage::getSingleton('Inchoo_SocialConnect_Model_Facebook_Client');

        $this->client = Mage::getSingleton('inchoo_socialconnect/facebook_oauth2_client');
        if(!($this->client->isEnabled())) {
            return;
        }

        $this->userInfo = Mage::registry('inchoo_socialconnect_facebook_userinfo');

        // CSRF protection
        Mage::getSingleton('core/session')->setFacebookCsrf($csrf = md5(uniqid(rand(), true)));
        $this->client->setState($csrf);

        Mage::getSingleton('customer/session')->setSocialConnectRedirect(Mage::helper('core/url')->getCurrentUrl());
		$auth_url = $this->client->createAuthUrl();

		return $auth_url;

	} // function sonu -----------------------------------------------------------------------------------

}