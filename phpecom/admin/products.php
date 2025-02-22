<?php 

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
include('includes/header.php'); 
include('../middleware/adminmiddleware.php');

?>

<div class="container">
    <div class="row">
    <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Products</h4>
                    </div>
                    <div class="card-body" id="products_table">
                    <table class="table table-bordered">
                        <thread>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thread>
                        <tbody>
                            <?php
                                $products = getAll("products");

                                if(mysqli_num_rows($products) > 0)
                                {
                                     foreach($products as $item)
                                     {
                                        ?>
                                        <tr>
                                            <td><?= $item['id']; ?></td>
                                            <td><?= $item['name']; ?></td>
                                            <td>
                                                <img src="../uploads/<?= $item['image']; ?>" width="50px" height="50px"  alt="<?= $item['name']; ?>">
                                            </td>
                                            <td><?= $item['status'] == '0'? "visible":"Hidden" ?>
                                        </td>
                                            
                                        <td>
                                            <a href="edit-products.php?id=<?= $item['id']; ?>" class="btn  btn-sm btn-primary">Edit</a>
                                            
                                        </td>
                                        <td>
                                       

                                            <button type="button" class="btn btn-sm btn-danger delete_products_btn" value="<?= $item['id']; ?>">Delete</button>
                                        
                                        </td>
                                        </tr>
                                        <?php
                                     }
                                }
                                else
                                {
                                    echo "No records found";
                                }
                            ?>
                        </tbody>

                    </table>
                    </div>
                </div>
            </div>
    </div>
</div>


<?php
include('includes/footer.php');


?>
       