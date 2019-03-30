<!--/.sidebar-->
<?php
if(!defined('TEMPLATE')){
	die('Bạn không có quyền truy cập vào file này !');
}
/* lấy ra toàn bộ các thông tin trong bảng sản phẩm sắp xếp theo thứ tự mới nhất 
(giảm dần theo ID ) -> SELECT + ORDER BY

* lệnh kết nối trong sql: JOIN -> INNER JOIN
https://www.w3schools.com/sql/sql_join_inner.asp
*/ 

/* Thuật toán phân trang
LIMIT keystart,5

Trang 1: 1-6|0-5|LIMIT 0,6
Trang 2: 7-12|6-11|LIMIT 6,6
...
Trang N: LIMIT $perRow,$rowPerPage=6
$perRow = N * $rowPerPage - $rowPerPage

Số trang lấy ở url (GET)
index.php?page_layout=product&page=2
*/
if(isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 1;
}
// số bản ghi trên 1 trang
$rowsPerPage = 3;
$perRow = $page*$rowsPerPage - $rowsPerPage;
$totalRow = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM product"));
$totalPage = ceil($totalRow/$rowsPerPage);
// đi xây dựng thanh phân trang
$listPage = '';
// previous
$page_prev = $page - 1;
if($page_prev <= 0){
    $page_prev = 1;
}

$listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$page_prev.'">&laquo;</a></li>';
// $listPage = $listPage . '';

// for($i=1; $i<=$totalPage; $i++){
//     if($page==$i){
//         $listPage .= '<li class="page-item active"><a class="page-link" href="index.php?page_layout=product&page='.$i.'">'.$i.'</a></li>';
//     }
//     else{
//         if($page == $i-1 || $page == $i+1){
//             $listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$i.'">'.$i.'</a></li>';
//         }
//     }
// }
if($page>1){
    $listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$page_prev.'">'.$page_prev.'</a></li>';
}

$listPage .= '<li class="page-item active"><a class="page-link" href="index.php?page_layout=product&page='.$page.'">'.$page.'</a></li>';


// next
$page_next = $page + 1;
if($page_next > $totalPage){
    $page_next = $totalPage;
}else{
    $listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$page_next.'">'.$page_next.'</a></li>';
}


$listPage .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$page_next.'">&raquo;</a></li>';


$sql = "SELECT * FROM product INNER JOIN category ON product.cat_id=category.cat_id 
        ORDER BY prd_id DESC LIMIT $perRow,$rowsPerPage";
$query = mysqli_query($connect, $sql);




?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Danh sách sản phẩm</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh sách sản phẩm</h1>
			</div>
		</div><!--/.row-->
		<div id="toolbar" class="btn-group">
            <a href="index.php?page_layout=add_product" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i> Thêm sản phẩm
            </a>
        </div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
                        <table 
                            data-toolbar="#toolbar"
                            data-toggle="table">

						    <thead>
						    <tr>
						        <th data-field="id" data-sortable="true">ID</th>
						        <th data-field="name"  data-sortable="true">Tên sản phẩm</th>
                                <th data-field="price" data-sortable="true">Giá</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Trạng thái</th>
                                <th>Danh mục</th>
                                <th>Hành động</th>
						    </tr>
                            </thead>
                            <tbody>
                            <?php 
                            
                            while($row = mysqli_fetch_array($query)){
                                ?>
                                <tr>
                                        <td style=""><?php echo $row['prd_id']; ?></td>
                                        <td style=""><?php echo $row['prd_name']; ?></td>
                                        <td style=""><?php echo number_format($row['prd_price']); ?> vnd</td>
                                        <td style="text-align: center"><img width="130" height="180" src="img/product/<?php echo $row['prd_image'];?>"/></td>
                                        <td><span class="label <?php if($row['prd_status']==1){echo 'label-success';}else{echo 'label-danger';} ?>"><?php if($row['prd_status']==1){echo'Còn Hàng';}else{echo 'Hết Hàng';} ?></span></td>
                                        <td><?php echo $row['cat_name']; ?></td>
                                        <td class="form-group">
                                            <a href="index.php?page_layout=edit_product&prd_id=<?php echo $row['prd_id'];?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="del_product.php?prd_id=<?php echo $row['prd_id'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>                                                                     
                                 </tbody>
						</table>
                    </div>
                    <div class="panel-footer">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <?php echo $listPage; ?>
                            </ul>
                        </nav>
                    </div>
				</div>
			</div>
		</div><!--/.row-->	
	</div>	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-table.js"></script>	
</body>

</html>
