<?php
/**
 * Database Connection Wrapper
 * Uses PDO with Prepared Statements and Connection Pooling Singleton
 */

require_once __DIR__ . '/config.php';

class Database {
    private static ?PDO $instance = null;
    private static bool $connectionAttempted = false;
    private static ?string $errorMessage = null;

    /**
     * Get the active PDO instance
     */
    public static function getInstance(): ?PDO {
        if (self::$instance === null && !self::$connectionAttempted) {
            self::$connectionAttempted = true;
            try {
                $dsn = sprintf(
                    'mysql:host=%s;dbname=%s;charset=%s',
                    DB_HOST,
                    DB_NAME,
                    DB_CHARSET
                );

                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET
                ];

                self::$instance = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
            } catch (PDOException $e) {
                self::$errorMessage = $e->getMessage();
                error_log('Database Connection Error: ' . $e->getMessage());
                // In production, do not reveal full connection credentials
                self::$instance = null;
            }
        }

        return self::$instance;
    }

    /**
     * Check if database connection is alive
     */
    public static function isConnected(): bool {
        return self::getInstance() !== null;
    }

    /**
     * Retrieve the last connection error message if any
     */
    public static function getErrorMessage(): ?string {
        return self::$errorMessage;
    }
}
