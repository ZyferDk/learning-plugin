<div class="wrap">
	<h1>Learning</h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#tab-1">Manage Settings</a>
		</li>
		<li>
			<a href="#tab-2">Updates</a>
		</li>
		<li>
			<a href="#tab-3">About</a>
		</li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="tab-1">
			<form method="post" action="options.php">
				<?php
				settings_fields('learning_options_group');
				do_settings_sections('data_learning_plugin');
				submit_button();
				?>
			</form>
		</div>

		<div id="tab-2" class="tab-pane">
			<h3>Updates</h3>
		</div>

		<div id="tab-3" class="tab-pane">
			<h3>About</h3>
		</div>
	</div>
</div>