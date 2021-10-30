<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php
    $filepath= realpath(dirname(__FILE__));
    include_once($filepath.'/../classes/customer.php');
?>
<?php
if(!isset($_GET['customerid']) || $_GET['customerid']==NULL){
    echo "<script>window.location= 'inbox.php'</script>";
}else {
    $id=$_GET['customerid'];
}
    $customer= new customer();
	
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục</h2>
                
               <div class="block copyblock"> 
         
                <?php
                    $get_customer= $customer->showCustomer($id);
                    if($get_customer){
                        while($result = $get_customer->fetch_assoc()){
                    
                ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>Tên</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" name="catName" value="<?php echo $result['name']?>"class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" name="catName" value="<?php echo $result['address']?>"class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Thành phố</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" name="catName" value="<?php echo $result['city']?>"class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Số điện thoại</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" name="catName" value="<?php echo $result['phone']?>"class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" name="catName" value="<?php echo $result['email']?>"class="medium" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                    }
                }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>