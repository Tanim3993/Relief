<?php
// Database connection file using SQLite and PDO
try {
    $db_file = __DIR__ . '/database.sqlite';
    $conn_pdo = new PDO("sqlite:" . $db_file);
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn_pdo->exec("PRAGMA foreign_keys = ON;");

    // Compatibility Layer for MySQLi-style code
    class SQLite_MySQLi_Compatibility {
        private $pdo;
        public $error;
        public $connect_error = null;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function query($sql) {
            try {
                if (stripos(trim($sql), 'SELECT') === 0 || stripos(trim($sql), 'SHOW') === 0) {
                    $stmt = $this->pdo->query($sql);
                    if (!$stmt) return false;
                    return new SQLite_Result_Compatibility($stmt);
                } else {
                    $res = $this->pdo->exec($sql);
                    return ($res !== false);
                }
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                return false;
            }
        }

        public function real_escape_string($string) {
            return str_replace("'", "''", $string);
        }
    }

    class SQLite_Result_Compatibility {
        private $stmt;
        private $rows = null;
        public $num_rows = 0;

        public function __construct($stmt) {
            $this->stmt = $stmt;
            // For simplicity in this small project, we fetch all to get num_rows
            $this->rows = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->num_rows = count($this->rows);
            reset($this->rows);
        }

        public function fetch_assoc() {
            $row = current($this->rows);
            next($this->rows);
            return $row;
        }
    }

    $conn = new SQLite_MySQLi_Compatibility($conn_pdo);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function mysqli_real_escape_string($conn, $string) {
    return $conn->real_escape_string($string);
}
?>