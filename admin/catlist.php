<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php
    $classCat= new category();
	if(isset($_GET['delid'])){
		$id=$_GET['delid'];
		$delete_cate= $classCat->delete_category($id);
	}
	
	
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">
					<?php
						if(isset($delete_cate)){
							echo $delete_cate;
						}
					?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$show_cat= $classCat->show_category();
							if($show_cat){
								$i=0;
								while($row = $show_cat->fetch_assoc()){
									$i++;
							
						?>
						<tr class="odd gradeX">
							<td><?php echo $i?></td>
							<td><?php echo $row['catName']?></td>
							<td><a href="catedit.php?catid=<?php echo $row['catId']?>">Edit</a> || <a onclick="return confirm('Are you want to delete ?')" href="?delid=<?php echo $row['catId']?>">Delete</a></td>
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

