<?php

namespace App;

use PDO;

/**
 * Application configuration
 */
class Config
{
    /**
     * Database host
     * @var string
     */
    const DB_HOST = '';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = '';

    /**
     * Database charset
     * @var string
     */
    const DB_CHARSET = '';

    /**
     * Database user
     * @var string
     */
    const DB_USER = '';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = '';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = false;

    /**
     * PDO ATTR_ERRMODE default
     * @var string
     */
    const PDO_ATTR_ERRMODE = PDO::ERRMODE_EXCEPTION;

    /**
     * PDO default fetch mode
     * @var string
     */
    const PDO_ATTR_DEFAULT_FETCH_MODE = PDO::FETCH_ASSOC;

    /**
     * PDO emulate prepares default
     * @var string
     */
    const PDO_ATTR_EMULATE_PREPARES = false;
}
