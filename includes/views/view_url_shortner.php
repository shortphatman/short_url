<?php include 'view_header.php'; ?>
<div class="container-full" >	
		<div class="row headliner" >
			<div class="col-md-1 col-lg-2"></div>
			<div class="col-12 col-sm-11 col-md-10 col-lg-9" >
				<h1>Simplify your links</h1>				
				<form action="index.php" method="post">
					<div class="row" >					
						<input type="text" name="long_url" class="col-md-7 col-12 input_margins" >					
						<input type="submit" class="col-md-2 col-4 btn btn-primary input_margins" value="Shorten URL" >						
					</div>
				</form>
			</div>
		</div>	
	</div>
	<?php if(is_array($all_short_urls)){ ?>
	<div class="container-full" style="margin-top:30px">
		<div class="row">
			<div class="col-md-1 col-lg-2"></div>
			<div class="col-11 col-sm-10 col-md-9 col-lg-8">
				<table class="table">
					<thead class="table_color">
						<tr>
							<th style="max-width:500px">Original URL</th>
							<th class="no_small">Created</th>
							<th>Short URL</th>
							<th class="no_small">All Clicks</th>
						</tr>
					</thead>
					<tbody>
					<?php
					
					foreach($all_short_urls as $value){ ?>
						<tr>
							<td class="long_cell"><?= $value['long_url'] ?></td>
							<td class="no_small"><?= $value['create_date'] ?></td>
							<td><?= $_SERVER['HTTP_HOST'] . '/r?x=' . $value['short_url'] ?></td>
							<td class="no_small text-center"><?= $value['clicks'] ?></td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot class="table_color">
						<tr>
							<td colspan="4">
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<?php } ?>
<?php
include 'view_footer.php';
?>