<?php
require_once("config/config.php");
$objCommon 		= new Common;
$objMenu 		= new Menu;
$objNews 		= new News;
$objContent 	= new Content;
$objTemplate 	= new Template;
$objMail 		= new Mail;
$objCustomer 	= new Customer;
$objCart 	= new Cart;
$objAdminUser 	= new AdminUser;
$objProduct 	= new Product;
$objValidate 	= new Validate;
$objOrder 		= new Order;
$objLog 		= new Log;
require_once('rs_lang.admin.php');
require_once('rs_lang.website.php');
?>

<?php

if ($objAdminUser->is_login == false) {
	header("location: index.php");
}
?>

<div class="card">

	<div class="card-header">
		<h1 class="card-title"><i class="fas fa-scroll mr-1"></i><?php echo "Buffer Analysis"; ?></h1>
	</div>

	<div class="card-body">
		<?php
		$lat = $_REQUEST['lati'];
		$lng = $_REQUEST['lngi'];
		$d_in_km = $_REQUEST['dis_km'];

		$sql = "SELECT  a.giscode as giscod,a.vcode as vcode,a.dcode as dcode,a.tcode as tcode, b.village as village,a.wssname as wscheme,a.statusval as status, (6371 * acos(cos(radians($lat) )* cos(radians(y))*cos(radians( x )-radians($lng))+ sin(radians($lat) )* sin(radians( y ) ) ) ) AS distance 
	FROM p2005wss a inner join p2003village b on (a.giscode=b.giscode)
	HAVING distance < $d_in_km
	ORDER BY distance ";
		$query = mysql_query($sql);
		?>

		<div class="row">
			<div class="col-md-6">
				<h4><?php echo "Villages Statistics"; ?> </h4>
				<table class="bb table table-bordered table-striped">
					<thead>
						<tr>
							<th>Village</th>
							<th>Population</th>
							
						</tr>
					</thead>
					<tbody>
						<?php
						while ($res = mysql_fetch_array($query)) {

							$v_code = $res['vcode'];
							$t_code = $res['tcode'];
							$d_code = $res['dcode'];

							$aquery_s = "SELECT vcode,tcode from p2004vp where tcode=" . $t_code . " and vcode=" . $v_code;
							$aresult_s = mysql_query($aquery_s);
							$rows_s = mysql_num_rows($aresult_s);
							$adata_s = mysql_fetch_array($aresult_s);

							$aquery_t = "SELECT vcode from p2005wss where tcode=" . $t_code . " and vcode=" . $v_code;
							$aresult_t = mysql_query($aquery_t);
							$rows_t = mysql_num_rows($aresult_t);
							if ($rows_s == 1 && $rows_t == 1) {
						?>

							<?php
								$flag1 = 1;
								$v1_name = $res['village'];
							} else if ($rows_s == 1 && $rows_t == 0) {
							?>

							<?php
								$flag2 = 2;
								$v1_name = $res['village'];
							} else if ($rows_s == 0 && $rows_t == 1) {
							?>

							<?php
								$flag3 = 3;
								$v1_name = $res['village'];
							}

							$giscode1 = $res['giscod'];
							 $query_p = "SELECT tot_village_p from p2004vp where giscode=" . $giscode1;
							$res_p = mysql_query($query_p);
							$result_p = mysql_fetch_array($res_p);

							?>

							<tr>
								<td <?php if ($flag1 == 1) { ?> class="red" <?php $flag1 = "";
																		}
																		if ($flag2 == 2) { ?> class="green" <?php $flag2 = "";
																										}
																										if ($flag3 == 3) { ?> class="blue" <?php $flag3 = "";
																																		} ?>><?php echo $v1_name; ?></td>
								<td><?php echo $result_p['tot_village_p']; ?></td>
								
							</tr>
						<?php
						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<th>Village</th>
							<th>Population</th>
							
						</tr>
					</tfoot>
				</table>
				<?php $sql = "SELECT layer, count(layer) as total ,water_connection, count(water_connection) as water_con FROM tbl_layers
	Where (6371 * acos(cos(radians($lat) )* cos(radians(latitude))*cos(radians( longitude )-radians($lng))+ sin(radians($lat) )* sin(radians( latitude ) ) ) ) < $d_in_km group by layer order by layer";
				//echo $query;
				$query = mysql_query($sql);

				$sql3 = "SELECT bld_htc_info, count(bld_htc_info) as water_con FROM tbl_layers
	Where (6371 * acos(cos(radians($lat) )* cos(radians(latitude))*cos(radians( longitude )-radians($lng))+ sin(radians($lat) )* sin(radians( latitude ) ) ) ) < $d_in_km  and layer='Building'  group by bld_htc_info order by bld_htc_info";
				//echo $query;
				$query3 = mysql_query($sql3);
				while ($res_res3 = mysql_fetch_array($query3)) {
					if ($res_res3['bld_htc_info'] == 1) {
						$yesc = $res_res3['water_con'];
					} else if ($res_res3['bld_htc_info'] == 0) {
						$noc = $res_res3['water_con'];
					}
				}

				while ($res_res = mysql_fetch_array($query)) {
					if ($res_res['layer'] == "Building") {



				?>
						</br>
						<h4><?php echo "Water Connection Statistics"; ?> </h4>
						<table class="bb table table-bordered table-striped">
							<thead>
								<tr>
									<th rowspan="2">Name</th>
									<th rowspan="2">Count</th>
									<th colspan="2">Water Connection</th>
								</tr>
								<tr>
									<th>Yes</th>
									<th>No</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $res_res['layer']; ?></td>
									<td><?php echo $res_res['total']; ?></td>
									<td><?php echo $yesc; ?></td>
									<td><?php echo $noc; ?></td>
								</tr>
							</tbody>
							<thead>
								<tr>
									<th rowspan="2">Name</th>
									<th rowspan="2">Count</th>
									<th colspan="2">Water Connection by end of 2020</th>
								</tr>
								<tr>
									<th>Yes</th>
									<th>No</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $res_res['layer']; ?></td>
									<td><?php echo $res_res['total']; ?></td>
									<td><?php echo $res_res['total']; ?></td>
									<td><?php echo "0" ?></td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<th rowspan="2">Name</th>
									<th rowspan="2">Count</th>
									<th colspan="2">Water Connection</th>
								</tr>
								<tr>
									<th>Yes</th>
									<th>No</th>
								</tr>
							</tfoot>
						</table>

				<?php
					}
				}
				?>

				
				
				
				

			</div>
			<?php
			$sql_1 = "SELECT layer, count(layer) as total ,water_connection, count(water_connection) as water_con FROM tbl_layers
	Where (6371 * acos(cos(radians($lat) )* cos(radians(latitude))*cos(radians( longitude )-radians($lng))+ sin(radians($lat) )* sin(radians( latitude ) ) ) ) < $d_in_km  and layer !='Building' group by layer order by layer";
			//echo $query;
			$query_1 = mysql_query($sql_1);

			?>

			<div class="col-md-6">
				<h4><?php echo "Other Statistics"; ?> </h4>
				<table class="bb table table-bordered table-striped">
					<thead>
						<th>Name</th>
						<th>Total</th>
					</thead>
					<tbody>
						<?php
						while ($res_res_1 = mysql_fetch_array($query_1)) {
						?>
							<tr>
								<td><?php echo $res_res_1['layer']; ?></td>
								<td><?php echo $res_res_1['total']; ?></td>
							</tr>

							<?php
							if ($res_res_1['layer'] == "Design_Water_Network") {
								$sql_c = "SELECT sum(shape_length) as shape_length FROM tbl_layers
	Where (6371 * acos(cos(radians($lat) )* cos(radians(latitude))*cos(radians( longitude )-radians($lng))+ sin(radians($lat) )* sin(radians( latitude ) ) ) ) < $d_in_km  and layer ='Design_Water_Network' group by layer";
								$query_c = mysql_query($sql_c);
								$res_res_c = mysql_fetch_array($query_c);
							?>
								<tr>
									<td><?php echo "Design Water Network Length" ?></td>
									<td><?php echo number_format($res_res_c['shape_length'] / 1000, 2); ?> KM</td>
								</tr>
						<?php
							}
						}
						?>
					</tbody>
					<tfoot>
						<th>Name</th>
						<th>Total</th>
					</tfoot>
				</table>
			</div>

		</div>
	</div>
</div>