<?php
if ($objAdminUser->is_login == false) {
	header("location: index.php");
}

if (isset($_REQUEST['update'])) {
	$dprid = $_POST['dprid'];
	$total_villages = $_POST['total_villages'];
	$completed = $_REQUEST['completed'];
	$percent_completed = $_REQUEST['percent_completed'];

	$sql_pro = "UPDATE tbl_dpr set completed = " . $completed . ", percent_completed = " . $percent_completed . " where dprid=" . $dprid;

	$sql_proresult = mysql_query($sql_pro) or die(mysql_error());

	if ($sql_proresult == TRUE) {
		$message =  "Record updated successfully";
	} else {
		$message = mysql_error($db);
	}
	redirect('./?p=workp_dist');
}
?>

<script language="javascript" type="text/javascript">
	function frmValidate(frm) {
		var msg = "<?php echo _JS_FORM_ERROR; ?>\r\n-----------------------------------------";
		var flag = true;
		if (frm.current_password.value == "") {
			msg = msg + "\r\n<?php echo CHANGEPWD_FLD_MSG_CURPWD; ?>";
			flag = false;
		}
		if (frm.npassword.value == "") {
			msg = msg + "\r\n<?php echo CHANGEPWD_FLD_MSG_NEWPWD; ?>";
			flag = false;
		}
		if (frm.c_password.value == "") {
			msg = msg + "\r\n<?php echo CHANGEPWD_FLD_MSG_CNEWPWD; ?>";
			flag = false;
		}
		if (frm.npassword.value != frm.c_password.value) {
			msg = msg + "\r\n<?php echo CHANGEPWD_FLD_MSG_DOESTMATCH; ?>";
			flag = false;
		}
		if (flag == false) {
			alert(msg);
			return false;
		}
	}
</script>

<section>
	<div class="fluid-container p-2">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-info text-white">
						<h3 class="card-title"><?php echo "Work Progress" ?></h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped display responsive nowrap" style="width:100%">
							<thead>
								<tr>
									<th>District</th>
									<th>Tehsil</th>
									<th><?php echo "Milestone"; ?></th>
									<th><?php echo "Total Villages"; ?></th>
									<th><?php echo "Completed"; ?></th>
									<th><?php echo "Percent Completed"; ?></th>
									<th><?php echo ACTION; ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$query4 = "SELECT * FROM tbl_dpr group by dcode";
								//echo $query4;
								$result4 = mysql_query($query4);
								mysql_num_rows($result4);
								if (mysql_num_rows($result4) > 0) {
									while ($row4 = mysql_fetch_assoc($result4)) {
										$did = $row4['dcode'];
										$cquery = mysql_query("select * from  p2001district where code=$did");
										$cdata = mysql_fetch_array($cquery);
								?>
										<?php
										$queryt = "SELECT * FROM tbl_dpr where dcode=$did group by tcode";
										//echo $query4;
										$resultt = mysql_query($queryt);
										mysql_num_rows($resultt);
										if (mysql_num_rows($resultt) > 0) {
											while ($rowt = mysql_fetch_assoc($resultt)) {
												$tid = $rowt['tcode'];
												$cquery1 = mysql_query("select * from  p2002tehsil where code=$tid");
												$cdata1 = mysql_fetch_array($cquery1);
										?>
												<?php
												$querytd = "SELECT * FROM tbl_dpr where dcode=$did and tcode=$tid";
												//echo $query4;
												$resulttd = mysql_query($querytd);
												mysql_num_rows($resulttd);
												if (mysql_num_rows($resulttd) > 0) {
													while ($rowtd = mysql_fetch_assoc($resulttd)) {
														$total_villages = $rowtd['total_villages'];
														$completed = $rowtd['completed'];
														$percent_completed = $rowtd['percent_completed'];
														$dprid = $rowtd['dprid'];
												?>
														<tr>
															<td><?php echo $cdata['name']; ?></td>
															<td><?php echo $cdata1['tehsil']; ?></td>

															<form id="dpr_updated" name='dpr_updated' method="post" action="" enctype="multipart/form-data" onSubmit="return frmValidate(this);">
																<td><?php echo $rowtd['milestone']; ?></td>

																<td><?php echo $total_villages ?></td>
																<?php if ($_REQUEST['dprid'] && ($_REQUEST['dprid'] == $dprid)) {
																?>
																	<td>
																		<input type="text" name="completed" id="completed" value="<?php echo $completed ?>" />
																	</td>
																	<td>
																		<input type="text" name="percent_completed" id="percent_completed" value="<?php echo $percent_completed ?>" />
																	</td>
																	<td> <input type="hidden" name="dprid" id="dprid" value="<?php echo $_REQUEST['dprid']; ?>" />
																		<input type="submit" name="update" id="update" value="Update" /></td>
																<?php
																} else { ?>
																	<td><?php echo $completed ?></td>
																	<td><?php echo $percent_completed ?></td>
																	<td>
																		<a class="btn btn-info btn-md" href="./?p=workp_dist&dprid=<?php echo $dprid; ?>" title="<?php echo EDIT; ?>"><i class="fas fa-pencil-alt">
																			</i>
																		</a>
																	</td>
																<?php
																}
																?>
														</tr>
														</form>
								<?php
													}
												}
											}
										}
									}
								}
								?>
							</tbody>
							<tfoot>
								<tr>
									<th>District</th>
									<th>Tehsil</th>
									<th><?php echo "Milestone"; ?></th>
									<th><?php echo "Total Villages"; ?></th>
									<th><?php echo "Completed"; ?></th>
									<th><?php echo "Percent Completed"; ?></th>
									<th><?php echo ACTION; ?></th>
								</tr>
							</tfoot>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
		var groupColumn = [0, 1];
		var table = $('#example1').DataTable({
			"columnDefs": [{
				"visible": false,
				"targets": groupColumn
			}],
			"responsive": true,
			"autoWidth": true,
			"drawCallback": function(settings) {
				var api = this.api();
				var rows = api.rows({
					page: 'current'
				}).nodes();
				var last = null;

				api.column(groupColumn[0], {
					page: 'current'
				}).data().each(function(group, i) {
					if (last !== group) {
						$(rows).eq(i).before(
							'<tr class="group" style="background-color:#9CF"><td colspan="100%">' + group + '</td></tr>'
						);
						last = group;
					}
				});
				api.column(groupColumn[1], {
					page: 'current'
				}).data().each(function(group, i) {
					if (last !== group) {
						$(rows).eq(i).before(
							'<tr class="group" style="background-color:#CCC"><td colspan="100%">' + group + '</td></tr>'
						);
						last = group;
					}
				});
			}
		});
	});
</script>