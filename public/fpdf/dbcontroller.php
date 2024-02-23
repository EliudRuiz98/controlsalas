<?php
class DBController {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "reservas";
    
    private static $conn;
    
    public function __construct() {
        self::$conn = self::connectDB(); // Acceder a connectDB como método estático
        if (!empty(self::$conn)) {
            $this->selectDB();
        }
    }
    
    public static function connectDB() {
        self::$conn = mysqli_connect(self::$host, self::$user, self::$password, self::$database); // Acceder a las propiedades como estáticas
        return self::$conn;
    }
    
    public function selectDB() {
        mysqli_select_db(self::$conn, self::$database);
    }
    
    public function runQuery($query) {
        $result = mysqli_query(self::$conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset)) {
            return $resultset;
        }
    }
    
    public function numRows($query) {
        $result = mysqli_query(self::$conn, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
}
?>
