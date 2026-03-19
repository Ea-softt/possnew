	<?php
include('server/config.php');

if (isset($_POST['products'])) {
    // Adding '%' to both sides allows searching for a barcode even if it's a partial match
    $name = '%' . $_POST['products'] . '%'; 

    // Updated SQL to include the 'barcode' column
    $sql = "SELECT * FROM products 
            WHERE (product_name LIKE :name AND quantity > 0) 
            OR (product_no LIKE :name AND quantity > 0)
            OR (barcode LIKE :name AND quantity > 0)"; // <--- Added barcode check here

    $stmt = $conn->prepare($sql);
    $stmt->execute([':name' => $name]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        foreach ($result as $row) {
            // It is good practice to include the barcode in the data attributes 
            // so your JavaScript can access it when the row is clicked.
            echo "<tr class='js-add' 
                    data-barcode='".$row['barcode']."' 
                    data-product_no='".$row['product_no']."' 
                    data-product='".$row['product_name']."' 
                    data-price='".$row['sell_price']."' 
                    data-unt='".$row['unit']."' 
                    data-min='".$row['min_stocks']."' 
                    data-quantity='".$row['quantity']."'>";
            
            echo "<td style='display: none;'>".$row['barcode']."</td>"; // Displaying barcode in the first column
             echo "<td style='display: none;'>".$row['product_no']."</td>";
            echo "<td>".$row['product_name']."</td>";
            echo "<td>Ghc".$row['sell_price']."</td>";
            echo "<td>".$row['unit']."</td>";
            echo "<td>".$row['quantity']."</td>";
            echo "<td>".$row['expire_date']."</td>";
            echo "<td class='text-center p-1'><button class='btn btn-danger btn-sm' type='button' id='delete-row'><i class='fas fa-times-mark'></i></button></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>No Products found!</td></tr>";
    }
}