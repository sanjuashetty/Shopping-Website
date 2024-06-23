<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../middleware/adminMiddleware.php');
include('includes/header.php');



if (isset($_GET['t'])) {
    $tracking_no = $_GET['t'];
    $orderData =  checkTrackingNoValid($tracking_no);
    if (mysqli_num_rows($orderData) > 0) {
        $data = mysqli_fetch_array($orderData);
?>






<div class="container">
    <div class="row">
        <div class="col-md-12">




            

            <div class="card">
                <div class="card-header bg-primary">
                    <span class="text-white fs-4"> View Order</span>
                    <a href="orders.php" class="btn btn-warning float-end"><i class="fa fa-reply"></i>Back</a>
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
                                        <?= $data['name']; ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="fw-bold">Email</label>
                                    <div class="border p-1">
                                        <?= $data['email']; ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="fw-bold">Phone</label>
                                    <div class="border p-1">
                                        <?= $data['phone']; ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="fw-bold">Treacking No</label>
                                    <div class="border p-1">
                                        <?= $data['tracking_no']; ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="fw-bold">Address</label>
                                    <div class="border p-1">
                                        <?= $data['address']; ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="fw-bold">Pin Code</label>
                                    <div class="border p-1">
                                        <?= $data['pincode']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Ordered Details</h4>
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
                                    

                                    $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*,oi.qty as orderqty, p.* FROM orders o, order_items oi,
                                     products p  WHERE oi.order_id=o.id AND p.id=oi.prod_id AND o.tracking_no= '$tracking_no'";
                                                 


                                    $order_query_run = mysqli_query($con, $order_query);
                                    if (mysqli_num_rows($order_query_run) > 0) {
                                        foreach ($order_query_run as  $item) {
                                    ?>
                                            <tr>

                                            </tr>
                                            <td class="align-middle">
                                                <img src="../uploads/<?= $item['image']; ?>" alt="<?= $item['name']; ?>" width="50px" height="50px">
                                                <?= $item['name']; ?>
                                            </td>
                                            <td class="align-middle">
                                                <?= $item['price']; ?>
                                            </td>
                                            <td class="align-middle">
                                                <?= $item['orderqty']; ?>
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

                                <?= $data['payment_mode'] ?>
                            </div>
                            <label class="fw-bold">status</label>
                            <div class="  mb-3">
                              <form action="code.php" method="POST">
                                <input type="hidden" name="tracking_no" value="<?= $data['tracking_no'] ?>">
                            <select name="order_status"  class="form-select">
                                <option value="0" <?= $data['status'] == 0?"selected":"" ?>>Under process</option>
                                <option value="1" <?= $data['status'] == 1?"selected":"" ?>>Compleated</option>
                                <option value="2" <?= $data['status'] == 2?"selected":"" ?>>Cancelled</option>
                            </select>
                              <button type="submit" name="update_order_btn" class="btn btn-primary mt-2">Update Status</button>
                              </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
    } else {
        // Handle the case where no data was found.
        // You could display an error message or take some other action.
        ?>
        <h4>Something went wrong</h4>
        <?php
    }
} else {
    ?>
    <h4>Something went wrong</h4>
    <?php
    die();
}

 include('includes/footer.php') ?>