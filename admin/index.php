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
					<div id="success-message" class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert">×</a>
						<strong>Your changes have been successfully saved!</strong>
					</div>
					<div id="error-message" class="alert alert-error">
						<strong>Error</strong>
					</div>
					<div id="manager-form" class="well">
						<div class="span5">
							<form id="form-submit">
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
								<input type="file" name="document">
						</div>
						<div class="span10">
							</form>
							<button id="form-submit" class="submit-cupboard btn btn-primary">Save Changes</button>
							<button class="btn" id="close-form">Cancel</button>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
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