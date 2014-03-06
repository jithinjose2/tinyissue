<h3>
	<?php echo __('tinyissue.edit_issue'); ?>
</h3>

<div class="pad">

	<form method="post" action="">

		<table class="form" style="width: 100%;">
			<tr>
				<th style="width: 10%"><?php echo __('tinyissue.title'); ?></th>
				<td>
					<input type="text" name="title" style="width: 98%;" value="<?php echo Input::old('title', $issue->title); ?>" />
					<?php echo $errors->first('title', '<span class="error">:message</span>'); ?>
				</td>
			</tr>
			<tr>
				<th><?php echo __('tinyissue.issue'); ?></th>
				<td>
					<textarea name="body" style="width: 98%; height: 150px;"><?php echo Input::old('body', $issue->body); ?></textarea>
					<?php echo $errors->first('body', '<span class="error">:message</span>'); ?>
				</td>
			</tr>
			<tr>
				<th><?php echo __('tinyissue.points'); ?></th>
				<td>
          <?php echo Form::select('points', array('0.5' => '0.5', '1.0' => '1', '2.0' => '2', '3.0' => '3', '5.0' => '5', '8.0' => '8'), Input::old('points', $issue->points)); ?>
					<?php echo $errors->first('points', '<span class="error">:message</span>'); ?>
				</td>
			</tr>
			<?php if(Auth::user()->permission('issue-modify')): ?>
			<tr>
				<th><?php echo __('tinyissue.assigned_to'); ?></th>
				<td>
					<?php echo Form::select('assigned_to', array(0 => '') + Project\User::dropdown($project->users()->get()), Input::old('asigned_to', $issue->assigned_to)); ?>
				</td>
			</tr>
			<?php endif; ?>
			<tr>
				<th></th>
				<td><input type="submit" value="<?php echo __('tinyissue.update_issue'); ?>" class="button primary" /></td>
			</tr>
		</table>

		<?php echo Form::token(); ?>

	</form>

</div>
