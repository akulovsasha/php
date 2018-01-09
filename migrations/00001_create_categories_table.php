<?php

function up()
{
    $sql = <<<SQL
CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
SQL;

    if (mysqli_query(getDbConnection(), $sql)) {
        echo "Table 'categories' created successfully\r\n";
    } else {
        echo "Error creating table: " . mysqli_error(getDbConnection()) . "\r\n";
    }
}
