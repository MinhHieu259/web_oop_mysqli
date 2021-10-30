<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php
    $classCat= new brand();
	if(isset($_GET['delid'])){
		$id=$_GET['delid'];
		$delete_brand= $classCat->delete_brand($id);
	}
	
	
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block">
					<?php
						if(isset($delete_brand)){
							echo $delete_brand;
						}
					?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$show_cat= $classCat->show_brand();
							if($show_cat){
								$i=0;
								while($row = $show_cat->fetch_assoc()){
									$i++;
							
						?>
						<tr class="odd gradeX">
							<td><?php echo $i?></td>
							<td><?php echo $row['brandName']?></td>
							<td><a href="brandedit.php?brandid=<?php echo $row['brandId']?>">Edit</a> || <a onclick="return confirm('Are you want to delete ?')" href="?delid=<?php echo $row['brandId']?>">Delete</a></td>
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

