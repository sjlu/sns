<?php

$config['apns_environment'] = ENVIRONMENT;

/**
 * The generated certificate.
 */
$config['certificate_path'] = APPPATH . 'config/Apns/server_certificates_bundle_development.pem';

if (ENVIRONMENT == 'production')
	$config['certificate_path'] = APPPATH . 'config/Apns/server_certificates_bundle_production.pem';

/**
 * The trustworthy certificate.
 */
$config['root_certificate_path'] = APPPATH . 'config/Apns/entrust_root_certification_authority.pem';