<div class="wrap">
	<h2>
		Document Manager
		<a href="admin.php?page=manager" class="add-new-h2">Add New</a>
	</h2>
	<div class="well">
		asas
	</div>
	<table class="wp-list-table widefat fixed posts" cellspacing="0">
		<thead>
			<tr>
				<th scope="col" id="cb" class="manage-column column-cb check-column" style=""><input type="checkbox"></th>
				<th scope="col" id="title" class="manage-column column-title" style="">Title</th>
				<th scope="col" id="categories" class="manage-column column-name" style="">Categories</th>
				<th scope="col" id="categories" class="manage-column column-tags" style="">Extension</th>
				<th scope="col" id="categories" class="manage-column column-categories" style="">Date</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach(cupboard_get_documents() as $document) : ?>
				<tr valign="middle">
					<th scope="row" class="check-column"><input type="checkbox" name="linkcheck[]" value="1"></th>
					<td class="column-title"><a class="row-title"><?php echo $document->title; ?></a></td>
					<td class="column-name"><?php echo $document->category; ?></td>
					<td class="column-categories">
						<?php
							preg_match('/\.[^\.]+$/i', $document->filename, $ext);
							echo str_replace('.', '', $ext[0]);
						?>
					</td>
					<td class="column-categories"><?php echo $document->created_at; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>