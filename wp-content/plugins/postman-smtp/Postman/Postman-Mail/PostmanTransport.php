<?php
if (! interface_exists ( 'PostmanTransport' )) {
	interface PostmanTransport {
		public function isServiceProviderGoogle($hostname);
		public function isServiceProviderMicrosoft($hostname);
		public function isServiceProviderYahoo($hostname);
		public function isTranscriptSupported();
		public function getSlug();
		public function getName();
		public function createZendMailTransport($hostname, $config);
		public function isConfigured(PostmanOptionsInterface $options, PostmanOAuthToken $token);
		public function isReady(PostmanOptionsInterface $options, PostmanOAuthToken $token);
		public function getMisconfigurationMessage(PostmanConfigTextHelper $scribe, PostmanOptionsInterface $options, PostmanOAuthToken $token);
		
		// @deprecated
		public function isOAuthUsed($authType);
		// @deprecated
		public function createPostmanMailAuthenticator(PostmanOptions $options, PostmanOAuthToken $authToken);
		// @deprecated
		public function getConfigurationRecommendation($hostData);
		// @deprecated
		public function getHostsToTest($hostname);
	}
}

if (! interface_exists ( 'PostmanTransportPrivate' )) {
	interface PostmanTransportPrivate extends PostmanTransport {
		public function getHostname();
		public function getHostPort();
		public function getAuthenticationType();
		public function getSecurityType();
		public function getCredentialsId();
		public function getCredentialsSecret();
		public function getDeliveryDetails();
		public function getSocketsForSetupWizardToProbe($hostname, $isGmail);
		public function getConfigurationBid($hostData, $userAuthOverride, $originalSmtpServer);
	}
}
