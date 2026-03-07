<?php 
include 'server/config.php';

$fees = $conn->query("SELECT * FROM sales sp inner join newemployee us on sp.username = us.EmpID inner join customer ct on sp.customer_id = ct.customer_id where reciept_no = {$_GET['reciept_no']}");
foreach($fees->fetch(PDO::FETCH_ASSOC) as $k => $v){
	$$k= $v;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Receipt</title>
    <style>
        @media print {
            @page {
                margin: 0;
                size: auto;
            }
            body {
                margin: 0;
                padding: 0;
            }
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            width: 78mm;
            margin: 0 auto;
            padding: 5px;
            background: #fff;
            color: #000;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h4, .header h5, .header h6 {
            margin: 2px 0;
            font-weight: bold;
        }
        .info {
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
        }
        .info p {
            margin: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th {
            text-align: left;
            border-bottom: 1px dashed #000;
            padding: 2px 0;
            font-size: 11px;
        }
        td {
            text-align: left;
            padding: 2px 0;
            vertical-align: top;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .totals {
            border-top: 1px dashed #000;
            padding-top: 5px;
        }
        .totals div {
            display: flex;
            justify-content: space-between;
            margin: 2px 0;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h4>VEEMOS CHEMICAL SHOP</h4>
        <h6>"A domestic and trusted chemical shop."</h6>
        <h6>ELUBO, AT THE COMMUNITY MARKET</h6>
        <h6>CONTACT: 0204427665, 0248827351</h6>
    </div>

    <div class="info">
        <p>Date: <?php echo $created_date; ?></p>
        <p>Invoice #: <?php echo $reciept_no; ?></p>
        <p>Customer: <?php echo $firstnamec . " " . $lastnamec; ?></p>
        <p>Cashier: <?php echo $FullName; ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 45%;">Item</th>
                <th style="width: 15%; text-align: center;">Qty</th>
                <th style="width: 20%; text-align: right;">Price</th>
                <th style="width: 20%; text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            $reciept1 = $conn->query("SELECT sl.*,sp.*,pd.* FROM  sales sl inner join sales_product sp on sl.reciept_no = sp.reciept_no inner join products pd on pd.product_no = sp.product_id where sl.reciept_no = {$_GET['reciept_no']}");
            
            while($row=$reciept1->fetch_assoc()):
                $subtotal = ($row['qty']*$row['price']);
            ?>
            <tr>
                <td><?php echo $row['product_name']; ?></td>
                <td class="text-center"><?php echo $row['qty']; ?></td>
                <td class="text-right"><?php echo number_format($row['price'], 2); ?></td>
                <td class="text-right"><?php echo number_format($subtotal, 2); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="totals">
        <div>
            <span>SubTotal:</span>
            <span>Ghc <?php echo number_format($total, 2); ?></span>
        </div>
        <div>
            <span>Discount:</span>
            <span>Ghc <?php echo number_format($discount, 2); ?></span>
        </div>
        <div style="font-weight: bold; border-top: 1px solid #000; padding-top: 2px;">
            <span>Grand Total:</span>
            <span>Ghc <?php echo number_format($grandtotal, 2); ?></span>
        </div>
    </div>

    <div class="footer">
        <p>Thank you for your patronage!</p>
        <p>Software by EA-Soft</p>
    </div>
</body>
</html>