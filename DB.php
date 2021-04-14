<?php
class DB
{
    private $mysql;

    public function __construct($server_name, $username, $password, $dbname)
    {
        $this->mysql = new mysqli($server_name, $username, $password, $dbname);

        if ($this->mysql->connect_error) {
            die("Connection failed: " . $this->mysql->connect_error);
        }
    }

    public function __deconstruct()
    {
        $this->mysql->close();
    }

    /*
     * Atgriež visu tabulu masīvā
     * 
     * @return array - tukšs vai visus tabulas datus
    */
    public function getAll($table_name)
    {
        $sql = "SELECT * FROM `$table_name`";
        $result = $this->mysql->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }
    /*
     * @param string $table_name
     * @param array $values [$field_name => $field_value]
     */
    public function add(string $table_name, array $entries)
    {
        $columns = array_keys($entries);

        $fields = join(",", $columns);

        $values = [];
        foreach ($entries as $value) {
            $values[] = "'" . $value . "'";
        }
        $field_values = join(",", $values);


        $sql = "INSERT INTO $table_name ($fields) VALUES ($field_values)";
        echo $sql;
        if ($this->mysql->query($sql) === TRUE) {
            return "New record created successfully";
        } else {
            return "Error: " . $sql . "<br>" . $this->mysql->error;
        }
    }
}
