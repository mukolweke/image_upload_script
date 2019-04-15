<?php

require_once "Conn.php";

class Item
{
    private $conn;

    public function __construct()
    {
        $dbConn = new Conn();

        $this->conn = $dbConn->dbConn();
    }

    // test connection
    public function echoMsg()
    {
        if ($this->conn) {
            echo "connected";
        } else {
            echo "Not Connected";
        }
    }

    // save items
    public function saveItem($itemDetails, $image_location = null)
    {
        $item_name = $itemDetails['item_name'];
        $item_price = $itemDetails['item_price'];
        $item_count = $itemDetails['item_count'];

        try {

            $sql = "INSERT into items(image_location, item_name, item_price, item_count)
                        VALUES ('$image_location', '$item_name', '$item_price', $item_count)";

            $stmt = mysqli_prepare(
                $this->conn, $sql
            );

            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getAllItems()
    {
        $sql = "SELECT id, image_location, item_name, item_price, item_count FROM items 
                     WHERE deleted_at IS NULL OR deleted_at = ''";

        $stmt = mysqli_prepare($this->conn, $sql);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $id, $img_location, $item_name, $item_price, $item_count);
            while (mysqli_stmt_fetch($stmt)) {
                $items[] = ['id' => $id, 'img_location' => $img_location, 'item_name' => $item_name, 'item_price' => $item_price, 'item_count' => $item_count];
            }
            if (empty($items)) {
                return false;
            } else {
                return $items;
            }
        }
    }
}