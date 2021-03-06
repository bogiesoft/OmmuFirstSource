<?php
/**
 * Ommu Zone Villages (ommu-zone-village)
 * @var $this ZonevillageController
 * @var $model OmmuZoneVillage
 * @var $form CActiveForm
 * version: 1.3.0
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2015 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/core
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ommu Zone Villages'=>array('manage'),
		$model->village_id=>array('view','id'=>$model->village_id),
		'Update',
	);
?>

<div class="form">
	<?php echo $this->renderPartial('/zone_village/_form', array('model'=>$model)); ?>
</div>
