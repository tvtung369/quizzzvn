<?php

namespace Phplite\Database;

use Exception;
use PDO;
use PDOException;
use Phplite\File\File;

class Database {
    /**
     * Database instance
     *
     * @var $instance
     */
    protected static $instance;

    /**
     * Database connection
     *
     * @var $connection
     */
    protected static $connection;

    /**
     * Select data
     *
     * @var array
     */
    protected static $select;

    /**
     * Table name
     *
     * @var string
     */
    protected static $table;

    /**
     * Join data
     *
     * @var string
     */
    protected static $join;

    /**
     * Where data
     * 
     * @var string
     */ 
    protected static $where;

    /**
     * Where binding
     *
     * @var array
     */
    protected static $where_binding = [];

    /**
     * Group by data
     *
     * @var string
     */
    protected static $group_by;

    /**
     * Having data
     *
     * @var string
     */
    protected static $having;

    /**
     * Having binding
     *
     * @var array
     */
    protected static $having_binding = [];

    /**
     * Oder by data
     *
     * @var string
     */
    protected static $order_by;

    /**
     * limit
     *
     * @var string
     */
    protected static $limit;

    /**
     * Offset
     *
     * @var string
     */
    protected static $offset;

    /**
     * Query
     *
     * @var string
     */
    protected static $query;

    /**
     * all binding
     *
     * @var string
     */
    protected static $binding = [];

    /**
     * Setter
     *
     * @var string
     */
    protected static $setter;

    /**
     * Database constructor
     */
    private function __construct($table) {
        static::$table = $table;
    }

    /**
     * Connect to database
     *
     * @return void
     */
    private static function connect() {
        if(! static::$connection) {
            $database_data = File::require_file('config/database.php');
            extract($database_data);
            $dsn = 'mysql:dbname=' . $database . ';host=' . $host . '';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_PERSISTENT => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ". $charset,
            ];
            try {
                static::$connection = new PDO($dsn, $username, $password, $options);
            }
            catch (PDOException $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }

    /**
     * Get the instance of the class
     *
     * @return void
     */
    private static function instance() {
        static::connect();

        if(! self::$instance) {
            self::$instance = new Database(static::$table);
        }

        return self::$instance;
    }

    /**
     * Query function
     *
     * @param string $query
     * @return string
     */
    public static function query($query = null) {
        static::instance();

        if($query == null) {
            if (! static::$table) {
                throw new \Exception("Unknow table");
            }
            // SELECT * FROM uses join roles roles.id = user.role_id WHERE id > 1 HAVING id > 1 limit offset 2
            $query = "SELECT ";
            $query .= static::$select ? : '*';
            $query .= " FROM " . static::$table . " ";
            $query .= static::$join . " ";
            $query .= static::$where . " ";
            $query .= static::$group_by . " ";
            $query .= static::$having . " ";
            $query .= static::$order_by . " ";
            $query .= static::$limit . " ";
            $query .= static::$offset . " ";
        }
        static::$query = $query;
        static::$binding = array_merge(static::$where_binding, static::$having_binding);

        return static::instance();
    }

    /**
     * Select data from table
     *
     * @return object $instance
     */
    public static function select() {
        $select = func_get_args();
        $select = implode(', ', $select);
        
        static::$select = $select;
        
        return static::instance();
    }
    
    /**
     * Define table
     *
     * @param strign $table
     * @return object $instance
     */
    public static function table($table) {
        static::$table = $table;
        
        return static::instance();
    }

    /**
     * Where data
     *
     * @param string $column
     * @param string $operator
     * @param string $value
     * @param string $type
     * @return object $instance
     */
    public static function where($column, $operator, $value, $type = null) {
        $where = '`' . $column . '`' . $operator . ' ? ';
        if (! static::$where) {
            $statement = " WHERE " . $where;
        } else {
            if($type == null) {
                $statement = " AND " . $where;
            } else {
                $statement = " " . $type . " " . $where;
            }
        }

        static::$where .= $statement;
        static::$where_binding[] = htmlspecialchars($value);

        return static::instance();
    }

    /**
     * Or where
     *
     * @param string $column
     * @param string $operator
     * @param string $value
     * @return object $instance
     */
    public static function orWhere($column, $operator, $value) {
        static::where($column, $operator, $value, "OR");

        return static::instance();
    }
    
    /**
     * Join table
     *
     * @param string $table
     * @param string $fist
     * @param string $operator
     * @param string $second
     * @param string $type
     * @return object $instance
     */
    public static function join($table, $first, $operator, $second, $type = "INNER") {
        static::$join .= " " . $type . " JOIN " . $table . " ON " . $first . $operator . $second . " ";
        
        return static::instance();
    }

    /**
     * Right join table
     *
     * @param string $table
     * @param string $first
     * @param string $operator
     * @param string $second
     * @return onbject $instance
     */
    public static function rightJoin($table, $first, $operator, $second) {
        static::join($table, $first, $operator, $second, "RIGHT");
        return static::instance();
    }

    /**
     * Left join table
     *
     * @param string $table
     * @param string $first
     * @param string $operator
     * @param string $second
     * @return onbject $instance
     */
    public static function leftJoin($table, $first, $operator, $second) {
        static::join($table, $first, $operator, $second, "LEFT");
        return static::instance();
    }


    /**
     * Group by
     *
     * @return object $instance
     */
    public static function groupBy() {
        $group_by = func_get_args();
        $group_by = "GROUP BY " . implode(', ', $group_by) . " ";

        static::$group_by = $group_by;

        return static::instance();
    }

    /**
     * Having data
     *
     * @param string $column
     * @param string $operator
     * @param string $value
     * @param string $type
     * @return object $instance
     */
    public static function having($column, $operator, $value, $type = null) {
        $having = '`' . $column . '`' . $operator . ' ? ';
        if (! static::$having) {
            $statement = " HAVING " . $having;
        } else {
            $statement = " AND " . $having;
        }

        static::$having .= $statement;
        static::$having_binding[] = htmlspecialchars($value);

        return static::instance();
    }

    /**
     * Order by
     *
     * @param string $column
     * @param string $type
     * @return object $instance
     */
    public static function orderBy($column, $type=null) {
        $sep = static::$order_by ? " , " : " ORDER BY ";
        $type = strtoupper($type);
        $type = ($type != null && in_array($type, ['ASC', 'DESC', 'RAND()'])) ? $type : "ASC";
        $statement = $sep . $column . " " . $type . " ";

        static::$order_by .= $statement;

        return static::instance();
    }

    /**
     * Limit
     *
     * @param string $limit
     * @return object $instance
     */
    public static function limit($limit) {
        static::$limit = "LIMIT " . $limit . " ";

        return static::instance();
    }

    /**
     * Offset
     *
     * @param string $offset
     * @return object $instance
     */
    public static function offset($offset) {
        static::$offset = "OFFSET " . $offset . " ";

        return static::instance();
    }

    /**
     * Fetch excute
     *
     * @return object $data
     */
    private static function fetchExcute() {
        static::query(static::$query);
        $query = trim(static::$query, ' ');
        $data = static::$connection->prepare($query);
        $data->execute(static::$binding);

        static::clear();

        return $data;
    }

    /**
     * Get records
     *
     * @return object $result
     */
    public static function get() {
        $data = static::fetchExcute();
        $result = $data->fetchAll();

        return $result;
    }

    /**
     * Get record
     *
     * @return object $result
     */
    public static function first() {
        $data = static::fetchExcute();
        $result = $data->fetch();

        return $result;
    }

    /**
     * Excute
     *
     * @param Array $data
     * @param string $query
     * @param bool $where
     * @return void
     */
    private static function execute(Array $data, $query, $where = null) {
        static::instance();
        if (! static::$table) {
            throw new \Exception('Unknow table');
        }

        foreach ($data as $key => $value) {
            static::$setter .= '`' . $key . '` = ?, ';
            static::$binding[] = filter_var($value, FILTER_SANITIZE_STRING);
        }

        static::$setter = trim(static::$setter, ', ');
        
        $query .= static::$setter;
        $query .= $where != null ? static::$where . " " : '';

        static::$binding = $where != null ? array_merge(static::$binding, static::$where_binding): static::$binding;

        $data = static::$connection->prepare($query);
        $data->execute(static::$binding);

        static::clear();
    }

    /**
     * Insert to table
     *
     * @param array $data
     * @return object
     */
    public static function insert($data) {
        $table = static::$table;
        $query = "INSERT INTO " . $table . " SET ";
        static::execute($data, $query);

        $object_id = static::$connection->lastInsertId();
        $object = $object_id ? static::table($table)->where('id', '=', $object_id)->first() : null;

        return $object;
    }

    /**
     * Update record on table
     *
     * @param array $data
     * @return bool
     */
    public static function update($data) {
        $query = "UPDATE " . static::$table . " SET ";
        static::execute($data, $query, true);

        return true;
    }

    /**
     * Delete record on table
     *
     * @return void
     */
    public static function delete() {
        $query = "DELETE FROM " . static::$table . " ";
        static::execute([], $query, true);
        
        return true;
    }

    /**
     * Clear the propertites
     *
     * @return void
     */
    private static function clear() {
        static::$select = '';
        static::$join = '';
        static::$where = '';
        static::$where_binding = [];
        static::$group_by = '';
        static::$having = '';
        static::$having_binding = [];
        static::$order_by = '';
        static::$limit = '';
        static::$offset = '';
        static::$query = '';
        static::$binding = [];
        static::$instance = '';
        static::$setter = '';
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public static function getQuery() {
        static::query(static::$query);
        return static::$query;
    }
}