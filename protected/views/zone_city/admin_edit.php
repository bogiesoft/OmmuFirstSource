<?php
/**
 * Ommu Zone Cities (ommu-zone-city)
 * @var $this ZonecityController
 * @var $model OmmuZoneCity
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
		'Ommu Zone Cities'=>array('manage'),
		$model->city_id=>array('view','id'=>$model->city_id),
		'Update',
	);
?>

<div class="form">
	<?php echo $this->renderPartial('/zone_city/_form', array('model'=>$model)); ?>
</div>
