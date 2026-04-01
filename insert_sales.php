<?php 
include 'server/config.php';

if(isset($_POST['product'])){

    // =======================
    // RECEIVE POST DATA
    // =======================
    $user        = $_POST['user'];
    $discount    = $_POST['discount'];
    $total       = $_POST['totalvalue'];
    $price       = $_POST['price'];        // array
    $product     = $_POST['product'];      // array
    $customer    = $_POST['customer'];
    $quantity    = $_POST['quantity'];     // array
    $grandtotal  = $_POST['grandtotal'];
    $days        = $_POST['days'];
    $month       = $_POST['month'];
    $years       = $_POST['years'];
    $typeofcash  = $_POST['typeofcash'];
    $datee       = $_POST['datee'];
   
    // =======================
    // GET CUSTOMER ID
    // =======================
    $stmt = $conn->prepare("
        SELECT customer_id 
        FROM customer 
        WHERE firstnamec || ' ' || lastnamec = :customer
    ");
    $stmt->execute([':customer' => $customer]);
    $cust_id = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$cust_id){
        echo "failure";
        exit();
    }

    $cust_id_new = $cust_id['customer_id'];

    // =======================
    // INSERT INTO SALES TABLE
    // =======================
    $stmt = $conn->prepare("
        INSERT INTO sales
        (customer_id, username, discount, total, grandtotal, days, month, years, typeofcash, created_date)
        VALUES
        (:customer_id, :user, :discount, :total, :grandtotal, :days, :month, :years, :typeofcash, :datee)
    ");

    $result = $stmt->execute([
        ':customer_id' => $cust_id_new,
        ':user'        => $user,
        ':discount'    => $discount,
        ':total'       => $total,
        ':grandtotal'  => $grandtotal,
        ':days'        => $days,
        ':month'       => $month,
        ':years'       => $years,
        ':typeofcash'  => $typeofcash,
        ':datee'       => $datee
    ]);

    if(!$result){
        echo "failure";
        exit();
    }

    // =======================
    // GET LAST INSERTED ID
    // =======================
    $sales_id = $conn->lastInsertId();

    // =======================
    // PROCESS EACH PRODUCT
    // =======================
    for($i = 0; $i < count($product); $i++){

        $product_id = $product[$i];
        $qty_sold   = $quantity[$i];
        $price_item = $price[$i];

        // =======================
        // GET CURRENT STOCK
        // =======================
        $stmt = $conn->prepare("
            SELECT quantity 
            FROM products 
            WHERE product_no = :product_id
        ");
        $stmt->execute([':product_id' => $product_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row){
            $newqty = $row['quantity'] - $qty_sold;
			//var_dump($newqty);
            // =======================
            // UPDATE STOCK
            // =======================
            $stmt = $conn->prepare("
                UPDATE products 
                SET quantity = :newqty 
                WHERE product_no = :product_id
            ");
            $stmt->execute([
                ':newqty'     => $newqty,
                ':product_id' => $product_id
            ]);
        }

        // =======================
        // INSERT INTO SALES_PRODUCT
        // =======================
        if($product_id != '' && $qty_sold != '' && $price_item != ''){
            $stmt = $conn->prepare("
                INSERT INTO sales_product
                (reciept_no, product_id, price, qty)
                VALUES
                (:reciept, :product, :price, :qty)
            ");
            $stmt->execute([
                ':reciept' => $sales_id,
                ':product' => $product_id,
                ':price'   => $price_item,
                ':qty'     => $qty_sold
            ]);
        }
    }

    // =======================
    // INSERT LOG
    // =======================
    $stmt = $conn->prepare("
        INSERT INTO logs (username, purpose)
        VALUES (:user, 'Product sold')
    ");
    $stmt->execute([':user' => $user]);

    // =======================
    // RETURN SUCCESS ID
    // =======================
    echo $sales_id;
}
?>