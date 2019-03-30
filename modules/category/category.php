<!--	List Product	-->
<?php
if(isset($_GET['page'])){
	$page = $_GET['page'];
}
else{
	$page = 1;	
}
$cat_id = $_GET['cat_id'];
$rowperpage = 6;
$per_row = $page*$rowperpage - $rowperpage;
$total_rows = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM product WHERE cat_id = $cat_id"));
$total_page = ceil($total_rows/$rowperpage);
$list_page = "";

$sql = "SELECT * FROM product
		WHERE cat_id = $cat_id
		ORDER BY prd_id DESC
		LIMIT $per_row, $rowperpage";
$query = mysqli_query($connect,$sql);
$rows = mysqli_num_rows($query);
// page prev
$page_prev = $page - 1;
if($page_prev <= 0){
    $page_prev = 1; 
}
$list_page .='<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&page='.$page_prev.'">Trang trước</a></li>';
//page
for($j=1;$j<=$total_page;$j++){
    if($j == $page){
        $active ='active';
    }
    else{
        $active = '';
    }
    $list_page .= '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&page='.$j.'">'.$j.'</a></li>';
}
//next page
$page_next = $page + 1;
if($page_next > $total_page){
    $page_next = $total_page;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&page='.$page_next.'">Trang sau</a></li>';
?>
<div class="products">
    <h3>Hiện có <?php echo $total_rows;?> sản phẩm</h3>


    <?php
    $i=1;
    while($row =mysqli_fetch_array($query)){
        if($i==1){
            echo '<div class="product-list card-deck">';
        }
    ?>
            <div class="product-item card text-center">
            <a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id'];?>"><img src="admin/img/product/<?php echo $row['prd_image'];?>"></a>
            <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id'];?>"><?php echo $row['prd_name'];?></a></h4>
            <p>Giá Bán: <span><?php echo $row['prd_price'];?></span></p>
            </div>
    <?php   
    if($i==3){
        echo '</div>';
        $i=0;
    } 
    $i++;
    }
    if($rows%3!=0){
        echo '</div>';
    }
    ?>
    
        
        
    
</div>
<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
       <?php echo $list_page; ?>
        
    </ul> 
</div>