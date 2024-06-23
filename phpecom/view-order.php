<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
include('functions/userfunctions.php');

include('includes/header.php');
include('authenticate.php');


if(isset($_GET['t']))
{
    $tracking_no = $_GET['t'];
    $orderData =  checkTrackingNoValid($tracking_no);
    if(mysqli_num_rows( $orderData) < 0)
    {
        ?>

        <h4>something went wrong</h4>
        <?php
        die();
    }

}else{
     ?>

     <h4>something went wrong</h4>
     <?php
     die();
}

$data = mysqli_fetch_array($orderData);


 ?>

<div class="py-3 bg-primary">

<div class="container">
    <h6 class="text-white">
        <a href="index.php" class="text-white">
        Home / 
     </a>
        <a href="my-orders.php" class="text-white">
        MY Orders 
        </a>
        <a href="#" class="text-white">
         View Orders 
        </a>
        </h6>
</div>
</div>

<div class="py-5">


    <div class="container">
        <div class="">
        <div class="row">
            <div class="col-md-12">
                
            <div class="card">
                <div class="card-header bg-primary">
                 <span class="text-white fs-4"> View Order</span>
                  <a href="my-orders.php" class="btn btn-warning float-end"><i class="fa fa-reply"></i>Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Delivary Details</h4>
                            <hr>
<div class="row">
                     <div class="col-md-12 mb-2">
                        <label class="fw-bold">Name</label>
                            <div class="border p-1">
                             <?= $data['name'];?>
                            </div>
    </div>
    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Email</label>
                            <div class="border p-1">
                             <?= $data['email'];?>
                            </div>
    </div>
    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Phone</label>
                            <div class="border p-1">
                             <?= $data['phone'];?>
                            </div>
    </div>
    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Treacking No</label>
                            <div class="border p-1">
                             <?= $data['tracking_no'];?>
                            </div>
    </div>
    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Address</label>
                            <div class="border p-1">
                             <?= $data['address'];?>
                            </div>
    </div>
    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Pin Code</label>
                            <div class="border p-1">
                             <?= $data['pincode'];?>
                            </div>
    </div>
</div>
</div>                   
                            <div class="col-md-6">
                                <h4>Ordered  Details</h4>
                               <hr>
                               <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                
<?php
 $userId = $_SESSION['auth_user']['user_id'];

 $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*,oi.qty as orderqty, p.* FROM orders o, order_items oi,
 products p  WHERE o.user_id='$userId' AND oi.order_id=o.id AND p.id=oi.prod_id AND o.tracking_no= '$tracking_no'";
// $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, p.* 
//                 FROM orders o 
//                 INNER JOIN order_items oi ON oi.order_id = o.id
//                 INNER JOIN products p ON p.id = oi.prod_id
//                 WHERE o.user_id='$userId' AND o.tracking_no= '$tracking_no'";


$order_query_run = mysqli_query($con, $order_query);
if(mysqli_num_rows($order_query_run) > 0)
{
    foreach ($order_query_run as  $item) {
       ?>
        <tr>

</tr><td class="align-middle">
    <img src="uploads/<?= $item['image'];?>" alt="<?= $item['name'];?>" width="50px" height="50px">
    <?= $item['name'];?>
</td>
<td class="align-middle">
<?= $item['price'];?> 
</td>
<td class="align-middle">
<?= $item['orderqty'];?> 
</td>
       <?php
    }
}
?>
</tbody>
                               </table>
                               <hr>
                               <h5>Total Price : <span class="float-end fw-bold"><?= $data['total_price']; ?></span></h5>
                               <hr>
                               <label class="fw-bold">Payment Method</label>
<div class="border p1 mb-3">
    
<?= $data['payment_mode']?>
</div>
<label class="fw-bold">status</label>
<div class="border p1 mb-3">
   
<?php 

if($data['status'] == 0)
{
    echo "Under process";
}else if($data['status'] == 1)
    {
        echo "Compleated";
    }else if($data['status'] == 2){
        echo "Cancelled";
}

?>
</div>
                            </div>

                        </div>
                    </div>
                </div>
            
            </div>
        </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php') ?>