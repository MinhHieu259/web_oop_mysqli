<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php
	$product= new product();
	if(isset($_GET['update_type']) && isset($_GET['type'])){
		$id= $_GET['update_type'];
		$type= $_GET['type'];
		$upd_slider= $product->updateTypeSlider($id,$type);
	}
	if(isset($_GET['del_slider'])){
		$id= $_GET['del_slider'];
	
		$del_slider= $product->del_slider($id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
		
						$show_slider= $product->showAllSlider();
						if($show_slider){
							$i=0;
							while($row_slider= $show_slider->fetch_assoc()){
								$i++;
					?>
				<tr class="odd gradeX">
					<td><?php echo $i?></td>
					<td><?php echo $row_slider['sliderName']?></td>
					<td><img src="uploads/<?php echo $row_slider['sliderImage']?>" height="120px" width="200px"/></td>	
					<td><?php 
						if($row_slider['type']==0){
							?>
						<a href="?update_type=<?php echo $row_slider['sliderId']?>&type=0">Off</a>
						<?php
						}else {
						?>
						<a href="?update_type=<?php echo $row_slider['sliderId']?>&type=1">On</a>
						<?php
						}
						?>
					</td>			
				<td>
					
					<a href="?del_slider=<?php echo $row_slider['sliderId']?>" onclick="return confirm('Are you sure to Delete!');" >Delete</a> 
				</td>
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
