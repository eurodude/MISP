<div class="feed form">
<?php echo $this->Form->create('Feed');?>
	<fieldset>
		<legend><?php echo __('Add MISP Feed');?></legend>
		<p><?php echo __('Add a new MISP feed source.');?></p>
	<?php
		echo $this->Form->input('enabled', array());
	?>
		<div class="input clear"></div>
	<?php
		echo $this->Form->input('lookup_visible', array());
		echo $this->Form->input('name', array(
				'div' => 'input clear',
				'placeholder' => __('Feed name'),
				'class' => 'form-control span6',
		));
		echo $this->Form->input('provider', array(
				'div' => 'input clear',
				'placeholder' => __('Name of the content provider'),
				'class' => 'form-control span6'
		));
		echo $this->Form->input('input_source', array(
				'label' => __('Source Format'),
				'div' => 'input clear',
				'options' => array('network' => 'Network', 'local' => 'Local'),
				'class' => 'form-control span6'
		));
		?>
		<div class="input clear"></div>
		<div id="DeleteLocalFileDiv" class="optionalField">
				<?php
					echo $this->Form->input('delete_local_file', array(
							'label' => __('Remove input after ingestion')
					));
			?>
		</div>
		<div class="input clear"></div>
		<?php
		echo $this->Form->input('url', array(
				'div' => 'input clear',
				'placeholder' => __('URL of the feed'),
				'class' => 'form-control span6'
		));
		echo $this->Form->input('source_format', array(
				'label' => __('Source Format'),
				'div' => 'input clear',
				'options' => $feed_types,
				'class' => 'form-control span6'
		));
	?>
		<div id="TargetDiv" class="optionalField">
	<?php
		echo $this->Form->input('fixed_event', array(
				'label' => __('Target Event'),
				'div' => 'input clear',
				'options' => array('New Event Each Pull', 'Fixed Event'),
				'class' => 'form-control span6'
		));
	?>
		</div>
		<div id="TargetEventDiv" class="optionalField">
	<?php
		echo $this->Form->input('target_event', array(
				'label' => __('Target Event ID'),
				'div' => 'input clear',
				'placeholder' => __('Leave blank unless you want to reuse an existing event.'),
				'class' => 'form-control span6'
		));
	?>
		</div>
		<div id="settingsCsvValueDiv" class="optionalField">
			<?php
				echo $this->Form->input('Feed.settings.csv.value', array(
						'label' => __('Value field(s) in the CSV'),
						'title' => __('Select one or several fields that should be parsed by the CSV parser and converted into MISP attributes'),
						'div' => 'input clear',
						'placeholder' => __('2,3,4 (column position separated by commas)'),
						'class' => 'form-control span6'
				));
			?>
		</div>
		<div id="settingsCsvDelimiterDiv" class="optionalField">
			<?php
				echo $this->Form->input('Feed.settings.csv.delimiter', array(
						'label' => __('Delimiter'),
						'title' => __('Set the default CSV delimiter (default = ",")'),
						'div' => 'input clear',
						'placeholder' => ',',
						'class' => 'form-control span6',
						'value' => ','
				));
			?>
		</div>
		<div id="settingsCommonExcluderegexDiv" class="optionalField">
			<?php
				echo $this->Form->input('Feed.settings.common.excluderegex', array(
						'label' => __('Exclusion Regex'),
						'title' => __('Add a regex pattern for detecting iocs that should be skipped (this can be useful to exclude any references to the actual report / feed for example)'),
						'div' => 'input clear',
						'placeholder' => __('Regex pattern, for example: "/^https://myfeedurl/i'),
						'class' => 'form-control span6'
				));
			?>
		</div>
		<div id="PublishDiv" class="input clear optionalField">
		<?php
			echo $this->Form->input('publish', array(
					'label' => __('Auto Publish'),
					'title' => __('Publish events directly after pulling the feed - if you would like to review the event before publishing uncheck this'),
					'type' => 'checkbox',
					'class' => 'form-control'
			));
		?>
		</div>
		<div id="OverrideIdsDiv" class="input clear optionalField">
		<?php
			echo $this->Form->input('override_ids', array(
					'label' => __('Override IDS Flag'),
					'title' => __('If checked, the IDS flags will always be set to off when pulling from this feed'),
					'type' => 'checkbox',
					'class' => 'form-control'
			));
		?>
		</div>
		<div id="DeltaMergeDiv" class="input clear optionalField">
		<?php
			echo $this->Form->input('delta_merge', array(
					'label' => __('Delta Merge'),
					'title' => __('Merge attributes (only add new attributes, remove revoked attributes)'),
					'type' => 'checkbox',
					'class' => 'form-control'
			));
		?>
		</div>
	<?php
		echo $this->Form->input('distribution', array(
				'options' => array($distributionLevels),
				'div' => 'input clear',
				'label' => __('Distribution'),
				'selected' => 3,
		));
	?>
		<div id="SGContainer" style="display:none;">
	<?php
		if (!empty($sharingGroups)) {
			echo $this->Form->input('sharing_group_id', array(
					'options' => array($sharingGroups),
					'label' => __('Sharing Group'),
			));
		}
	?>
		</div>
		<div class="input clear"></div>
	<?php
		echo $this->Form->input('tag_id', array(
				'options' => $tags,
				'label' => __('Default Tag'),
				'selected' => 0,
		));
		echo $this->Form->input('pull_rules', array('style' => 'display:none;', 'label' => false, 'div' => false));
	?>
	</fieldset>
	<b><?php echo __('Filter rules');?>:</b><br />
	<span id="pull_tags_OR" style="display:none;"><?php echo __('Events with the following tags allowed');?>: <span id="pull_tags_OR_text" style="color:green;"></span><br /></span>
	<span id="pull_tags_NOT" style="display:none;"><?php echo __('Events with the following tags blocked');?>: <span id="pull_tags_NOT_text" style="color:red;"></span><br /></span>
	<span id="pull_orgs_OR" style="display:none;"><?php echo __('Events with the following organisations allowed');?>: <span id="pull_orgs_OR_text" style="color:green;"></span><br /></span>
	<span id="pull_orgs_NOT" style="display:none;"><?php echo __('Events with the following organisations blocked');?>: <span id="pull_orgs_NOT_text" style="color:red;"></span><br /></span>
	<span id="pull_modify"  class="btn btn-inverse" style="line-height:10px; padding: 4px 4px;"><?php echo __('Modify');?></span><br /><br />
	<?php
	echo $this->Form->button(__('Add'), array('class' => 'btn btn-primary'));
	echo $this->Form->end();
	?>
	<div id="hiddenRuleForms">
		<?php echo $this->element('serverRuleElements/pull'); ?>
	</div>
</div>
<?php
	echo $this->element('side_menu', array('menuList' => 'feeds', 'menuItem' => 'add'));
?>
<script type="text/javascript">

var rules = {"pull": {"tags": {"OR":[], "NOT":[]}, "orgs": {"OR":[], "NOT":[]}}};
var validOptions = ['pull'];
var validFields = ['tags', 'orgs'];
var modelContext = 'Feed';

$(document).ready(function() {
	feedDistributionChange();
	$("#pull_modify").click(function() {
		serverRuleFormActivate('pull');
	});
	$("#FeedDistribution").change(function() {
		feedDistributionChange();
	});
	feedFormUpdate();
});
$("#FeedSourceFormat, #FeedFixedEvent, #FeedInputSource").change(function() {
	feedFormUpdate();
});
</script>
