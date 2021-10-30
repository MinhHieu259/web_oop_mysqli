<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php';?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/product.php';?>

<?php
$product= new product();
$fm= new Format();
if(isset($_GET['productid'])){
	$id=$_GET['productid'];
	$del_product= $product->delete_product($id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
			<?php
				if(isset($del_product)){
					echo $del_product;
				}
			?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Product Name</th>
					<th>Product Price</th>
					<th>Product Image</th>
					<th>Category</th>
					<th>brand</th>
					<th>Description</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					
					$product_list= $product->show_product();
					$i=0;
					if($product_list){
						while($row_product=$product_list->fetch_assoc()){
							$i++;

				?>
				<tr class="odd gradeX">
					<td><?php echo $i?></td>
					<td><?php echo $row_product['productName']?></td>
					<td><?php echo $row_product['price']?></td>
					<td class="center"> <img width="80" src="uploads/<?php echo $row_product['image']?>" alt="Ảnh product"></td>
					<td><?php echo $row_product['catName']?></td>
					<td><?php echo $row_product['brandName']?></td>
					<td><?php echo $fm->textShorten($row_product['descrip'],50)?></td>
					<td><?php 
					 if($row_product['type']==1){
						 echo "Featured";
					 }else {
						 echo "None-Featured";
					 }
					 
					 ?>
				
				</td>
					<td><a href="productedit.php?productid=<?php echo $row_product['productId']?>">Edit</a> || <a href="?productid=<?php echo $row_product['productId']?>">Delete</a></td>
					
				</tr>
				<?php
						}
					}
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
