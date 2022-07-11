<?php

/**
 * Plugin Name: SIGA Faker
 * Version: 1.0.0
 * Plugin URI: 
 * Description: Gerenciar dados fakes no ambiente de desenvolvimento do SIGA
 * Author: Another Equipe
 * Author URI: 
 *
 * @package WordPress
 * @author Another Equipe
 * @since 1.0.0
 */

include __DIR__."/classes/class.siga_faker.php";

if (!defined('ABSPATH')) {
    exit;
}

if (class_exists("SIGAFaker")) {
    $SIGA_faker = new SIGAFaker();

    register_activation_hook(__FILE__, array($SIGA_faker, "activate"));
    register_deactivation_hook(__FILE__, array($SIGA_faker, "deactivate"));
}
