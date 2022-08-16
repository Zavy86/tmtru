<?php
/**
 * Administration - List
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

use TMTRU\Index;

$Index=new Index();
$links=$Index->getLinks();
//var_dump($Index);
//var_dump($links);

?>
<div class="table-container">
<table class="table is-fullwidth is-striped is-narrow is-hoverable">
	<thead>
	<tr>
		<th style="width:32px;">&nbsp;</th>
		<th><abbr title="Unique Identifier">UID</abbr></th>
		<th><abbr title="Unique Resource Location">URL</abbr></th>
		<th>Description</th>
	</tr>
	</thead>
	<tbody>
<?php
foreach($links as $Link){
?>
	<tr class="<?php if(isset($_REQUEST['link']) && $_REQUEST['link']==$Link->getUID()){echo "has-background-info-light";} ?>">
		<th style="white-space:nowrap;">
			<a href="/<?php echo $Link->getUID(); ?>" target="_blank" title="URL">
					<img src="img/link.png">
			</a>
		</th>
		<th style="white-space:nowrap;">
			<a href="admin.php?page=edit&link=<?php echo $Link->getUID(); ?>" title="Edit">
				<?php echo $Link->getUID(); ?>
			</a>
		</th>
		<td style="white-space:nowrap;"><?php echo $Link->getURL(); ?></td>
		<td style="white-space:nowrap;"><?php echo $Link->getDescription(); ?></td>
	</tr>
<?php
}
?>
	</tbody>
</table>
</div>
