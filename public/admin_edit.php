<?php
/**
 * Administration - Edit
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

use TMTRU\Link;

$Link=null;
$linkUid=$_REQUEST['link']??null;
if($linkUid && Link::exists($linkUid)){
	$Link=new Link($linkUid);
	//var_dump($Link);
}

?>

<form action="admin.php?page=save_link&debug=<?php echo (DEBUG?'1':'0'); ?>" method="post">

<?php if($Link?->getUID()){ ?>

	<input type="hidden" name="action" value="update"/>

	<div class="field is-horizontal">
		<div class="field-label is-normal">
			<label class="label">Date</label>
		</div>
		<div class="field-body">
			<div class="field">
				<div class="control">
					<input name="tags" class="input is-static" type="text" value="<?php echo date('Y-m-d H:i',$Link->getCreated())." - ".date('Y-m-d H:i',$Link->getUpdated()); ?>"/>
				</div>
			</div>
		</div>
	</div>

	<div class="field is-horizontal">
		<div class="field-label is-normal">
			<label class="label">UID</label>
		</div>
		<div class="field-body">
			<div class="field">
				<div class="control">
					<input name="uid" class="input" type="text" value="<?php echo $Link->getUID(); ?>" readonly="readonly"/>
				</div>
			</div>
		</div>
	</div>

<?php }else{ ?>

	<input type="hidden" name="action" value="create"/>

	<div class="field is-horizontal">
		<div class="field-label is-normal">
			<label class="label">UID</label>
		</div>
		<div class="field-body">
			<div class="field">
				<div class="control">
					<input name="uid" class="input <!--is-danger-->" type="text" placeholder="Empty for auto-generated"/>
				</div>
				<!--<p class="help is-danger">This UID already exists</p>-->
			</div>
		</div>
	</div>

<?php } ?>

	<div class="field is-horizontal">
		<div class="field-label is-normal">
			<label class="label">URL</label>
		</div>
		<div class="field-body">
			<div class="field">
				<div class="control">
					<input name="url" class="input <!--is-warning-->" type="text" placeholder="Unique Resource Locator" value="<?php echo $Link?->getURL(); ?>"/>
				</div>
				<!--<p class="help is-warning">This URL is already linked</p>-->
			</div>
		</div>
	</div>

	<div class="field is-horizontal">
		<div class="field-label is-normal">
			<label class="label">Description</label>
		</div>
		<div class="field-body">
			<div class="field">
				<div class="control">
					<textarea name="description" class="textarea" placeholder="Description"><?php echo $Link?->getDescription(); ?></textarea>
				</div>
			</div>
		</div>
	</div>

	<div class="field is-horizontal">
		<div class="field-label is-normal">
			<label class="label">Tags</label>
		</div>
		<div class="field-body">
			<div class="field">
				<div class="control">
					<input name="tags" class="input" type="text" data-type="tags" data-selectable="false" placeholder="Insert tags" value="<?php echo implode(',',$Link?$Link->getTags():array()); ?>"/>
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
					<input class="button is-info" type="submit" value="Save link"/>
				</div>
				<div class="control">
					<a href="admin.php?page=list&link=<?php echo $Link?->getUID(); ?>" class="button is-info is-light">Cancel</a>
				</div>
			</div>
		</div>
	</div>

</form>
