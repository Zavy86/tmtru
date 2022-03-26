<?php
/**
 * Administration - Settings
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

use TMTRU\Configuration;
use TMTRU\Link;

$Configuration=new Configuration();
//var_dump($Configuration);

$lengths=array(
	3=>"3 chars (".number_format(Link::calculatePossibles(3),0,',','.').")",
	4=>"4 chars (".number_format(Link::calculatePossibles(4),0,',','.').")",
	5=>"5 chars (".number_format(Link::calculatePossibles(5),0,',','.').")",
	6=>"6 chars (".number_format(Link::calculatePossibles(6),0,',','.').")",
	7=>"7 chars (".number_format(Link::calculatePossibles(7),0,',','.').")",
	8=>"8 chars (".number_format(Link::calculatePossibles(8),0,',','.').")",
);

if(isset($_REQUEST['alert'])){

?>

<?php if($_REQUEST['alert']=="updated"){ ?>

	<div class="notification is-success is-light">
		Settings updated succesfully
	</div>

<?php }elseif($_REQUEST['alert']=="error"){ ?>

	<div class="notification is-danger is-light">
		Error saving settings
	</div>

<?php }} ?>

<form action="admin.php?page=save_settings&debug=<?php echo (DEBUG?'1':'0'); ?>" method="post">

	<div class="field is-horizontal">
		<div class="field-label is-normal">
			<label class="label">Length</label>
		</div>
		<div class="field-body">
			<div class="field">
				<div class="control">
					<div class="select">
						<select name="length">
							<?php foreach($lengths as $length=>$label){ ?>
								<option value="<?php echo $length; ?>"<?php if($Configuration?->getLength()==$length){echo " selected";} ?>><?php echo $label; ?></option>
							<?php } ?>
						</select>
				</div>
			</div>
		</div>
		</div>
	</div>

	<div class="field is-horizontal">
		<div class="field-label is-normal">
			<label class="label">Title</label>
		</div>
		<div class="field-body">
			<div class="field">
				<div class="control">
					<input name="title" class="input" type="text" placeholder="Web view title" value="<?php echo $Configuration?->getTitle(); ?>"/>
				</div>
			</div>
		</div>
	</div>

	<div class="field is-horizontal">
		<div class="field-label is-normal">
			<label class="label">Owner</label>
		</div>
		<div class="field-body">
			<div class="field">
				<div class="control">
					<input name="owner" class="input" type="text" placeholder="Web view owner" value="<?php echo $Configuration?->getOwner(); ?>"/>
				</div>
			</div>
		</div>
	</div>

	<div class="field is-horizontal">
		<div class="field-label is-normal">
			<label class="label">Password</label>
		</div>
		<div class="field-body">
			<div class="field">
				<div class="control">
					<input name="password" class="input" placeholder="New password only for update" type="password"/>
				</div>
			</div>
		</div>
	</div>

	<div class="field is-horizontal">
		<div class="field-label is-normal">
			<label class="label">Debuggable</label>
		</div>
		<div class="field-body">
			<div class="field">
				<div class="control">
					<label class="checkbox" style="padding:9px 0 9px 0;">
						<input name="debuggable" type="checkbox" value="1" <?php if($Configuration?->isDebuggable()){echo "checked";} ?>>
						If checked enable <code>?debug=1</code> parameter for debugging
					</label>
				</div>
			</div>
		</div>
	</div>

	<div class="field is-horizontal">
		<div class="field-label is-normal">
			<label class="label">&nbsp;</label>
		</div>
		<div class="field-body">
			<div class="field is-grouped">
				<div class="control">
					<input class="button is-info" type="submit" value="Save settings"/>
				</div>
				<div class="control">
					<a href="admin.php?page=list" class="button is-info is-light">Cancel</a>
				</div>
			</div>
		</div>
	</div>

</form>
