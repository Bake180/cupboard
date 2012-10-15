<div class="wrap">
	<h2>
		Document Manager
		<a href="#" id="add-new" class="add-new-h2">Add New</a>
	</h2>
	<p class="search-box">
		<label class="screen-reader-text" for="post-search-input">Search Posts:</label>
		<input type="search" id="post-search-input" name="s" value="">
		<input type="submit" name="" id="search-submit" class="button" value="Search">
	</p>
	<div class="bootstrap-wpadmin">
		<br><br>
		<div class="container">
			<div class="row">
				<div class="span12">
					<?php if ($_POST && $_SERVER['REQUEST_METHOD'] === 'POST') : do_action('cupboard_add'); ?>
					<?php else: ?>
					<div id="manager-form" class="well">
						<div class="span5">
							<form method="post" action="" enctype="multipart/form-data">
								<label>Title</label>
								<input type="text" name="title" id="title" class="span5">
								<label>Description</label>
								<textarea name="description" class="span5" rows="5"></textarea>
						</div>
						<div class="span5">
								<label>Category</label>
								<select name="category" class="span5">
									<option value="0" selected="selected">Please choose category</option>
									<?php foreach (cupboard_get_categories() as $category) : ?>
										<option value="<?php echo $category->id; ?>"><?php echo $category->category; ?></option>
									<?php endforeach; ?>
								</select>
								<label>File</label>
								<input type="file" name="document" id="document">
						</div>
						<div class="span10">
							<?php
								$cp = wp_create_nonce('cupboard_manager');
								$process = wp_create_nonce('cupboard_new');
							?>
							<input type="hidden" name="cp" value="<?php echo $cp; ?>">
							<input type="hidden" name="process" value="<?php echo $process; ?>">
							<button type="submit" class="btn btn-primary">Save Changes</button>
							<button class="btn" id="close-form">Cancel</button>
							</form>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<table class="wp-list-table widefat fixed posts" cellspacing="0">
		<thead>
			<tr>
				<th scope="col" id="cb" class="manage-column column-cb check-column" style=""><input type="checkbox"></th>
				<th scope="col" id="title" class="manage-column column-title" style="">Title</th>
				<th scope="col" id="categories" class="manage-column column-name" style="">Description</th>
				<th scope="col" id="categories" class="manage-column column-name" style="">Category</th>
				<th scope="col" id="categories" class="manage-column column-categories" style="">Date</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach(cupboard_get_documents() as $document) : ?>
				<tr valign="middle">
					<th scope="row" class="check-column"><input type="checkbox" name="linkcheck[]" value="1"></th>
					<td class="column-title">
						<?php $repo = wp_upload_dir(); ?>
						<a href="<?php echo $repo['baseurl'].'/cupboard/'.$document->filename; ?>" class="row-title" target="_blank"><?php echo $document->title; ?></a>
						<div class="row-actions">
							<span class="edit"><a href="<?php echo $document->id; ?>" id="cupboard-edit-button">Edit</a> | </span><span class="trash"><a href="<?php echo $document->id; ?>" id="cupboard-delete-button">Trash</a> | </span><span class="view"><a href="<?php echo $repo['baseurl'].'/cupboard/'.$document->filename; ?>" target="_blank">View</a></span>
						</div>
					</td>
					<td class="column-name"><?php echo $document->description; ?></td>
					<td class="column-name"><?php echo $document->category; ?></td>
					<td class="column-categories"><?php echo $document->created_at; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>


