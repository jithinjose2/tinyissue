<h3>
	<?php echo __('tinyissue.create_a_new_issue'); ?>
	<span><?php echo __('tinyissue.create_a_new_issue_in'); ?> <a href="<?php echo $project->to(); ?>"><?php echo $project->name; ?></a></span>
</h3>

<div class="pad">

	<form method="post" action="">

		<table class="form" style="width: 100%;">
			<tr>
				<th style="width: 10%"><?php echo __('tinyissue.title'); ?></th>
				<td>
					<input type="text" name="title" style="width: 98%;" value="<?php echo Input::old('title'); ?>" />

					<?php echo $errors->first('title', '<span class="error">:message</span>'); ?>
				</td>
			</tr>
			<tr>
				<th><?php echo __('tinyissue.issue'); ?></th>
				<td>
					<textarea name="body" style="width: 98%; height: 150px;"><?php echo Input::old('body'); ?></textarea>
					<?php echo $errors->first('body', '<span class="error">:message</span>'); ?>
				</td>
			</tr>
			<tr>
				<th><?php echo __('tinyissue.points'); ?></th>
				<td>
          <?php echo Form::select('points', array('0.5' => '0.5', '1.0' => '1', '2.0' => '2', '3.0' => '3', '5.0' => '5', '8.0' => '8'), Input::old('points')); ?>
					<?php echo $errors->first('points', '<span class="error">:message</span>'); ?>
				</td>
			</tr>
			<?php if(Auth::user()->permission('issue-modify')): ?>
			<tr>
				<th><?php echo __('tinyissue.assigned_to'); ?></th>
				<td>
          <?php 
            $old_user = Input::old('assigned_to'); 
            $default_user = (!empty($old_user)) ? $old_user : $default_user;  
          ?>
					<?php echo Form::select('assigned_to', array(0 => '') + $project_users, $default_user); ?>
				</td>
			</tr>
			<?php endif; ?>
			<tr>
				<th><?php echo __('tinyissue.attachments'); ?></th>
				<td>
					<input id="upload" type="file" name="file_upload" />

					<ul id="uploaded-attachments"></ul>
				</td>
			</tr>
			<tr>
				<th></th>
				<td><input type="submit" value="<?php echo __('tinyissue.create_issue'); ?>" class="button primary" /></td>
			</tr>
		</table>

		<?php echo Form::hidden('session', Crypter::encrypt(Auth::user()->id)); ?>
		<?php echo Form::hidden('project_id', Project::current()->id); ?>
		<?php echo Form::hidden('token', md5(Project::current()->id . time() . \Auth::user()->id . rand(1, 100))); ?>
		<?php echo Form::token(); ?>

	</form>

</div>
