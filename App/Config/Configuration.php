<?php

namespace App\Config;

/**
 * Class Configuration
 * Main configuration for the application
 * @package App\Config
 */
class Configuration
{
    public const DB_HOST = 'localhost';
    public const DB_NAME = 'tours';
    public const DB_USER = 'root';
    public const DB_PASS = 'dtb456';

    public const LOGIN_URL = '?c=auth&a=loginForm';
    public const REGISTRATION_URL = '?c=auth&a=registrationForm';

    public const ROOT_LAYOUT = 'root.layout.view.php';

    public const DEBUG_QUERY = false;

    public const TOUR_IMAGE_DIR = "public/tours_images/";
    public const PROFILE_IMAGE_DIR = "public/profile_images/";
    public const DEFAULT_PROFILE_IMAGE = "public/images/default_profile_pic.png";
    public const BLOG_IMAGE_DIR = "public/blog_images/";


}