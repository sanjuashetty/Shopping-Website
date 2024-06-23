<?php


include('../config/dbcon.php');
include('../functions/myfunction.php');

if(isset($_POST['add_category_btn']))
{
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0';
    $popular = isset($_POST['popular']) ? '1':'0';

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;
      
    $cate_query = "INSERT INTO categories 
    (name,slug,description,meta_title,meta_description,meta_keywords,status,popular,image)
    VALUES ('$name','$slug','$description','$meta_title','$meta_description','$meta_keywords','$status','$popular','$filename')";

    $cate_query_run = mysqli_query($con, $cate_query);

    if($cate_query_run)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        redirect("add-category.php", "Category Added Successfully");

    }
    else
    {
         redirect("add-category-php", "Something went Wrong");
    }
}
else if(isset($_POST['update_category_btn']))
{
    $category_id = $_POST['category_id']; 
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0';
    $popular = isset($_POST['popular']) ? '1':'0';

    $new_image = $_FILES['image']['name'];   
    $old_image = $_POST['old_image'];
    
    if($new_image != "")
    {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }
    $path = "../uploads";
    
    $update_query = "UPDATE categories SET name='$name', slug='$slug', description='$description', 
    meta_title='$meta_title', meta_description='$meta_description', meta_keywords='$meta_keywords',
    status='$status', popular='$popular', image='$update_filename' WHERE id='$category_id' ";

    $update_query_run = mysqli_query($con, $update_query);

    if($update_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("edit-category.php?id=$category_id", "Category Updated Successfully");
    }
    else
    {
         redirect("edit-category.php?id=$category_id", "Something went Wrong");
    }
    }
else if(isset($_POST['delete_category_btn']))
{
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    $category_query = "SELECT * FROM categories WHERE id='$category_id' ";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id='$category_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query)
    {
        if(file_exists("../uploads/".$image))
            {
                unlink("../uploads/".$image);
            }  
        // redirect("category.php", "Category deleted Successfully");
        echo 200;
    }
    else
    {
        // redirect("category.php", "Something went Wrong");
        echo 500;
    }
    
}

else if(isset($_POST['add_product_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0';
    $trending = isset($_POST['trending']) ? '1':'0';

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    if($name != "" && $slug != "" && $description != "")
    {
        $product_query = "INSERT INTO products (category_id, name, slug, small_description, description, original_price, selling_price, image,
        qty, status, trending, meta_title, meta_keywords, meta_description) VALUES 
        ('$category_id', '$name', '$slug', '$small_description', '$description', '$original_price', '$selling_price', '$filename', '$qty', 
        '$status', '$trending', '$meta_title', '$meta_keywords', '$meta_description')";
    
        $product_query_run = mysqli_query($con, $product_query);
    
        if($product_query_run)
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
    
            redirect("add-product.php", "Product Added Successfully");
        }
        else
        {
            redirect("add-product.php", "Something went Wrong");   
        }
    }
    else
        {
            redirect("add-product.php", "all fields are mandatory");   
        }
}
         else if(isset($_POST['update_product_btn']))
         {
            $product_id = $_POST['product_id'];
            $category_id = $_POST['category_id'];
            $name = $_POST['name'];
            $slug = $_POST['slug'];
            $small_description = $_POST['small_description'];
            $description = $_POST['description'];
            $original_price = $_POST['original_price'];
            $selling_price = $_POST['selling_price'];
            $qty = $_POST['qty'];
            $meta_title = $_POST['meta_title'];
            $meta_description = $_POST['meta_description'];
            $meta_keywords = $_POST['meta_keywords'];
            $status = isset($_POST['status']) ? '1':'0';
            $trending = isset($_POST['trending']) ? '1':'0';
        
        
            $path = "../uploads";
        

            $new_image = $_FILES['image']['name'];   
            $old_image = $_POST['old_image'];
    
            if($new_image != "")
            {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
          }
         else
         {
        $update_filename = $old_image;
         }

         $update_product_query = "UPDATE products SET name='$name',slug='$slug',small_description='$small_description',description='$description',original_price='$original_price',selling_price='$selling_price',image='$update_filename',
         qty='$qty',status=' $status',trending='$trending',meta_title='$meta_title',meta_keywords='$meta_keywords',meta_description='$meta_description' WHERE id='$product_id' ";
$update_product_query_run =mysqli_query($con, $update_product_query);


if($update_product_query_run)
{
    if($_FILES['image']['name'] != "")
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
        if(file_exists("../uploads/".$old_image))
        {
            unlink("../uploads/".$old_image);
        }
    }
    redirect("edit-products.php?id=$product_id", "product Updated Successfully");
}
else
{
     redirect("edit-products.php?id=$cproduct_id", "Something went Wrong");
}


}
else if(isset($_POST['delete_products_btn']))
{
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    $product_query = "SELECT * FROM products WHERE id='$product_id' ";
    $product_query_run = mysqli_query($con, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data['image'];

    $delete_query = "DELETE FROM products WHERE id='$product_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query)
    {
        if(file_exists("../uploads/".$image))
            {
                unlink("../uploads/".$image);
            }  
        // redirect("products.php", "product deleted Successfully");
        echo 200;
    }
    else
    {
        // redirect("products.php", "Something went Wrong");/
        echo 500;
    }
}
else if(isset($_POST['update_order_btn']))
 {
$track_no = $_POST['tracking_no'];
$order_status = $_POST['order_status'];

$updateOrder_query = "UPDATE orders SET status='$order_status' WHERE tracking_no='$track_no' ";
$updateOrder_query_run = mysqli_query($con, $updateOrder_query);


redirect("view-order.php?t=$track_no", "Order status updated successfully");


 }        else
         {
            header('Location: ../index.php');
}

    
?>
