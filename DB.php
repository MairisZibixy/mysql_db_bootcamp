<?php
class DB
{
    private $mysql;
    private $users = [];

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
     * @return array - tukšs vai tabulas datus
     */
    public function fetchAll($table_name)
    {
        $table_name = $this->mysql->escape_string($table_name);
        $result = $this->mysql->query("SELECT * FROM `$table_name`");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->users[$row["id"]] = $row;
            }
        } else {
            $this->users = [];
        }
    }

    public function getAll()
    {
        return $this->users;
    }

    public function find($id)
    {
        if (array_key_exists($id, $this->users)) {
            return $this->users[$id];
        }
        return [];
    }

    /*
     * @param string $table_name
     * @param array $values - [$field_name => $field_value]
     * 
     * @return string
     */
    public function add(string $table_name, array $entries)
    {
        $columns = array_keys($entries);

        $first = true;
        $fields = "";
        $field_values = "";
        foreach ($entries as $column => $value) {
            if ($first) {
                $fields .= "`" . $column . "`";
                $field_values .= "'" . $this->mysql->escape_string($value) . "'";
                $first = false;
            } else {
                $fields .= ", `" . $column . "`";
                $field_values .= ", '" . $this->mysql->escape_string($value) . "'";
            }
        }

        $sql = "INSERT INTO $table_name ($fields) VALUES ($field_values)";
        if ($this->mysql->query($sql) === true) {
            return "New record created successfully";
        } else {
            return "Error: " . $sql . "<br>" . $this->mysql->error;
        }
    }

    public function delete(string $table_name, $id)
    {
        $sql = "DELETE FROM `$table_name` WHERE id=$id";

        if ($this->mysql->query($sql) === true) {
            unset($this->users[$id]);
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $this->mysql->error;
        }
    }
}
