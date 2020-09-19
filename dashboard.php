<?php require_once 'includes/header.php'; ?>

<?php 

$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = 0;
while ($orderResult = $orderQuery->fetch_assoc()) {
	$totalRevenue += $orderResult['paid'];
}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$userwisesql = "SELECT users.username , SUM(orders.grand_total) as totalorder FROM orders INNER JOIN users ON orders.user_id = users.user_id WHERE orders.order_status = 1 GROUP BY orders.user_id";
$userwiseQuery = $connect->query($userwisesql);
$userwieseOrder = $userwiseQuery->num_rows;

$connect->close();

?>


<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}

	h2 {
		color: #546B84;
	}

	p {
		color: #546B84
	}

	.dashbaord-title {
		padding-top: 1.7rem;
		display: flex;
		align-items: center;
	}

	.dashbaord-title p {
		padding-left: 0.5rem;
		font-size: 0.9rem;
	}

	.dashboard-details {
		display: flex;
		align-items: center;
		padding-top: 4rem;
		padding-bottom: 4rem;
		justify-content: space-evenly;
		/* offset-x | offset-y | blur-radius | spread-radius | color   */
		box-shadow: 2px 2px 1px 1px rgba(0, 0, 0, 0.1);
	}


	.dashbaord-container .revenue p {
		font-size: 1.2rem;
		font-weight: bold;
	}

	.dashbaord-container .revenue h1 {
		padding-top: 1rem;
		font-size: 2.5rem;
		color: #546B84;
	}

	.count {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		width: 180px;
		height: 150px;
		padding: 1rem 1rem;
		border-radius: 0.6rem;
	}

	.count a {
		padding-top: 1rem;
	}

	.count span {
		padding-top: 0.5rem;
		font-size: 1.5rem;
	}

	.count-1 {
		background-color: #1dd1a1;
		color: #fff;
	}

	.count-2 {
		background-color: #ee5253;
		color: #fff;
	}

	.count-3 {
		background-color: #ff9f43;
		color: #fff;
	}

	.orders {
		padding-top: 2rem;
	}

	table {
		margin-top: 2rem;
		border-collapse: collapse;
		width: 100%;
	}

	th,
	td {
		padding: 0.7rem;
		text-align: center;
		border: 1px solid #ccc;
	}

	tbody tr:nth-child(odd) {
		background: #eee;
	}
</style>

<!-- fullCalendar 2.2.5-->
<link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
<link rel="stylesheet" href="assests/plSugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="container">
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>

	<div class="dashbaord-title">
		<h2>Dashboard</h2>
		<p>Control panel</p>
	</div>


	<div class="dashboard-details">

		<div class="dashbaord-container">
			<div class="revenue">
				<p>TOTAL REVENUE</p>
				<h1>₹
					<?php if($totalRevenue) {
						echo $totalRevenue;
						} else {
							echo '0';
							} ?></h1>
			</div>

		</div>

		<div class="count count-1">
			<a href="product.php" style="color: #fff; font-weight: bold; text-align: center;">
				Total Product
			</a>
			<span style="text-align: center;"><?php echo $countProduct; ?></span>
		</div>
		<!--/panel-hdeaing-->

		<div class="count count-2">
			<a href="product.php" style="color: #fff; font-weight: bold; text-align: center;">
				Low Stock
			</a>
			<span style="text-align: center;"><?php echo $countLowStock; ?></span>
		</div>
		<!--/panel-hdeaing-->

		<?php } ?>
		<div class="count count-3">
			<a href="orders.php?o=manord" style="color: #fff; font-weight: bold; text-align: center;">
				Total Orders
			</a>
			<span style="text-align: center;"><?php echo $countOrder; ?></span>
		</div>
	</div>

	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
	<div class="orders">
		<h2>Orders</h2>
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Orders in ₹</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($orderResult = $userwiseQuery->fetch_assoc()) { ?>
				<tr>
					<td><?php echo $orderResult['username']?></td>
					<td>₹ <?php echo $orderResult['totalorder']?></td>

				</tr>

				<?php } ?>
			</tbody>
		</table>
		<!--<div id="calendar"></div>-->
	</div>

	<?php  } ?>
</div>
<!--/row-->

<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.min.js"></script>


<script type="text/javascript">
	$(function () {
		// top bar active
		$('#navDashboard').addClass('active');

		//Date for the calendar events (dummy data)
		var date = new Date();
		var d = date.getDate(),
			m = date.getMonth(),
			y = date.getFullYear();

		$('#calendar').fullCalendar({
			header: {
				left: '',
				center: 'title'
			},
			buttonText: {
				today: 'today',
				month: 'month'
			}
		});


	});
</script>

<?php require_once 'includes/footer.php'; ?>