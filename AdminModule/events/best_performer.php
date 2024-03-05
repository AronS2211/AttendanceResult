<?php
session_start();
include("conn.php");
include("includes/Header.php");

if (!isset($_SESSION['user_id'])) {
    exit();
}
?>

<div class="container mt-5">

	<?php

	// SQL query
	$sql = "SELECT * FROM erp_news WHERE news_type='performer'";
	$result = mysqli_query($conn, $sql);
	?>
	<button onclick="goBack()">Go Back</button>

	<script>
		function goBack() {
			window.history.back();
		}
	</script>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Best Performer Table</h2>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Best Performer</th>
							<th>Description</th>
							<!-- <th>Year</th>
                        <th>Department</th>
                        <th>Date</th>
                        <th>Posted By</th> -->
						</tr>
					</thead>
					<tbody>
						<?php

						// Output data of each row

						while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr id=\"" . $row['news_id'] . "\">";
							echo "<td>" . (isset($row["news_title"]) ? $row["news_title"] : "") . "</td>";
							echo "<td>" . (isset($row["news_desc"]) ? $row["news_desc"] : "") . "</td>";
							// echo "<td>" . (isset($row["year"]) ? $row["year"] : "") . "</td>";
							// echo "<td>" . (isset($row["department"]) ? $row["department"] : "") . "</td>";
							// echo "<td>" . (isset($row["date"]) ? $row["date"] : "") . "</td>";
							// echo "<td>" . (isset($row["posted_by"]) ? $row["posted_by"] : "") . "</td>";
							echo "</tr>";
						}

						?>

					</tbody>
				</table>
				<a href="best_performer_manage.php" class="btn btn-primary">Manage</a>
				<a href="best_performer_create.php" class="btn btn-primary">Create</a>


			</div>
		</div>
	</div>
	<?php include("includes/Footer.php"); ?>