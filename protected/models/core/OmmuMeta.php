<?php
/**
 * OmmuMeta
 * version: 1.3.0
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2012 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/core
 * @contact (+62)856-299-4114
 *
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 *
 * --------------------------------------------------------------------------------------
 *
 * This is the model class for table "ommu_core_meta".
 *
 * The followings are the available columns in table 'ommu_core_meta':
 * @property integer $id
 * @property string $meta_image
 * @property string $meta_image_alt
 * @property integer $office_on
 * @property string $office_name
 * @property string $office_location
 * @property string $office_place
 * @property integer $office_country_id
 * @property integer $office_province_id
 * @property integer $office_city_id
 * @property string $office_district
 * @property string $office_village
 * @property string $office_zipcode
 * @property string $office_hour
 * @property string $office_phone
 * @property string $office_fax
 * @property string $office_email
 * @property string $office_hotline
 * @property string $office_website
 * @property string $map_icons
 * @property string $map_icon_size
 * @property integer $google_on
 * @property integer $twitter_on
 * @property integer $twitter_card
 * @property string $twitter_site
 * @property string $twitter_creator
 * @property string $twitter_photo_size
 * @property string $twitter_country
 * @property string $twitter_iphone
 * @property string $twitter_ipad
 * @property string $twitter_googleplay
 * @property integer $facebook_on
 * @property integer $facebook_type
 * @property string $facebook_profile_firstname
 * @property string $facebook_profile_lastname
 * @property string $facebook_profile_username
 * @property string $facebook_sitename
 * @property string $facebook_see_also
 * @property string $facebook_admins
 * @property string $modified_date
 * @property string $modified_id
 */
class OmmuMeta extends CActiveRecord
{
	public $defaultColumns = array();	
	public $old_meta_image;
	
	// Variable Search
	public $modified_search;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OmmuMeta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ommu_core_meta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('office_location, office_place, office_city_id, office_district, office_village, office_zipcode, office_email', 'required', 'on'=>'contact, google'),
			array('office_on', 'required', 'on'=>'setting, google'),
			array('office_province_id, office_village, office_hour, office_hotline', 'required', 'on'=>'contact'),
			array('office_website', 'required', 'on'=>'google'),
			array('google_on', 'required', 'on'=>'setting'),
			array('facebook_on', 'required', 'on'=>'setting, facebook, facebook_profile'),
			array('facebook_type', 'required', 'on'=>'facebook, facebook_profile'),
			array('facebook_profile_firstname, facebook_profile_lastname, facebook_profile_username', 'required', 'on'=>'facebook_profile'),
			array('twitter_on', 'required', 'on'=>'setting, twitter'),
			array('twitter_card, twitter_site, twitter_creator', 'required', 'on'=>'twitter'),
			array('id, office_on, office_country_id, office_province_id, office_city_id, google_on, twitter_on, twitter_card, facebook_on, facebook_type', 'numerical', 'integerOnly'=>true),
			array('facebook_see_also', 'length', 'max'=>256),
			array('meta_image, facebook_sitename,
				old_meta_image', 'length', 'max'=>64),
			array('office_location, office_district, office_village, office_phone, office_fax, office_email, office_hotline, office_website, map_icons, twitter_site, twitter_creator, twitter_country, facebook_profile_firstname, facebook_profile_lastname, facebook_profile_username, facebook_admins', 'length', 'max'=>32),
			array('office_city_id', 'length', 'max'=>11),
			array('office_zipcode', 'length', 'max'=>6),
			//array('meta_image', 'file', 'allowEmpty' => true, 'types' => 'jpg, jpeg, png, gif'),
			array('office_email', 'email'),
			array('meta_image, meta_image_alt, office_name, office_province_id, office_district, office_village, office_phone, office_fax, map_icons, twitter_photo_size, twitter_country, twitter_iphone, twitter_ipad, twitter_googleplay, facebook_sitename, facebook_see_also, facebook_admins,
				old_meta_image', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, meta_image, meta_image_alt, office_on, office_name, office_location, office_place, office_country_id, office_province_id, office_city_id, office_district, office_village, office_zipcode, office_hour, office_phone, office_fax, office_email, office_hotline, office_website, map_icons, map_icon_size, google_on, twitter_on, twitter_card, twitter_site, twitter_creator, twitter_photo_size, twitter_country, twitter_iphone, twitter_ipad, twitter_googleplay, facebook_on, facebook_type, facebook_profile_firstname, facebook_profile_lastname, facebook_profile_username, facebook_sitename, facebook_see_also, facebook_admins,
				modified_search', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'view' => array(self::BELONGS_TO, 'ViewMeta', 'id'),
			'country' => array(self::BELONGS_TO, 'OmmuZoneCountry', 'office_country_id'),			
			'province' => array(self::BELONGS_TO, 'OmmuZoneProvince', 'office_province_id'),
			'city' => array(self::BELONGS_TO, 'OmmuZoneCity', 'office_city_id'),
			'modified' => array(self::BELONGS_TO, 'Users', 'modified_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('attribute', 'ID'),
			'meta_image' => Yii::t('attribute', 'Meta Image'),
			'meta_image_alt' => Yii::t('attribute', 'Meta Image Alt'),
			'office_on' => Yii::t('attribute', 'Google Owner Meta'),
			'office_name' => Yii::t('attribute', 'Office Name'),
			'office_location' => Yii::t('attribute', 'Office Maps Location'),
			'office_place' => Yii::t('attribute', 'Office Address'),
			'office_country_id' => Yii::t('attribute', 'Office Country'),
			'office_province_id' => Yii::t('attribute', 'Office Province'),
			'office_city_id' => Yii::t('attribute', 'Office City'),
			'office_district' => Yii::t('attribute', 'Office District'),
			'office_village' => Yii::t('attribute', 'Office Village'),
			'office_zipcode' => Yii::t('attribute', 'Office Zipcode'),
			'office_hour' => Yii::t('attribute', 'Office Hour'),
			'office_phone' => Yii::t('attribute', 'Office Phone'),
			'office_fax' => Yii::t('attribute', 'Office Fax'),
			'office_email' => Yii::t('attribute', 'Office Email'),
			'office_hotline' => Yii::t('attribute', 'Office Hotline'),
			'office_website' => Yii::t('attribute', 'Office Website'),
			'map_icons' => Yii::t('attribute', 'Map Icons'),
			'map_icon_size' => Yii::t('attribute', 'Map Icon Size'),
			'google_on' => Yii::t('attribute', 'Google Plus Meta'),
			'twitter_on' => Yii::t('attribute', 'Twitter Meta'),
			'twitter_card' => Yii::t('attribute', 'Twitter Card'),
			'twitter_site' => Yii::t('attribute', 'Site'),
			'twitter_creator' => Yii::t('attribute', 'Creator'),
			'twitter_photo_size' => Yii::t('attribute', 'Photo Size'),
			'twitter_country' => Yii::t('attribute', 'Country'),
			'facebook_on' => Yii::t('attribute', 'Facebook Meta'),
			'facebook_type' => Yii::t('attribute', 'Facebook Type'),
			'facebook_profile_firstname' => Yii::t('attribute', 'Profile Firstname'),
			'facebook_profile_lastname' => Yii::t('attribute', 'Profile Lastname'),
			'facebook_profile_username' => Yii::t('attribute', 'Profile Username'),
			'facebook_sitename' => Yii::t('attribute', 'Sitename'),
			'facebook_see_also' => Yii::t('attribute', 'See Also'),
			'facebook_admins' => Yii::t('attribute', 'Admins'),
			'modified_date' => Yii::t('attribute', 'Modified Date'),
			'modified_id' => Yii::t('attribute', 'Modified'),
			'old_meta_image' => Yii::t('attribute', 'Old Meta Image'),
			'twitter_photo_width_i' => Yii::t('attribute', 'Photo Width'),
			'twitter_photo_height_i' => Yii::t('attribute', 'Photo Height'),
			'twitter_iphone_name_i' => Yii::t('attribute', 'Iphone Name'),
			'twitter_iphone_id_i' => Yii::t('attribute', 'Iphone'),
			'twitter_iphone_url_i' => Yii::t('attribute', 'Iphone Url'),
			'twitter_ipad_name_i' => Yii::t('attribute', 'Ipad Name'),
			'twitter_ipad_id_i' => Yii::t('attribute', 'Ipad'),
			'twitter_ipad_url_i' => Yii::t('attribute', 'Ipad Url'),
			'twitter_googleplay_name_i' => Yii::t('attribute', 'Googleplay Name'),
			'twitter_googleplay_id_i' => Yii::t('attribute', 'Googleplay'),
			'twitter_googleplay_url_i' => Yii::t('attribute', 'Googleplay Url'),
			'modified_search' => Yii::t('attribute', 'Modified'),
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		
		// Custom Search
		$criteria->with = array(
			'modified' => array(
				'alias'=>'modified',
				'select'=>'displayname'
			),
		);

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.meta_image',$this->meta_image,true);
		$criteria->compare('t.meta_image_alt',$this->meta_image_alt,true);
		$criteria->compare('t.office_on',$this->office_on);
		$criteria->compare('t.office_name',$this->office_name,true);
		$criteria->compare('t.office_location',$this->office_location,true);
		$criteria->compare('t.office_place',$this->office_place,true);
		$criteria->compare('t.office_country_id',$this->office_country_id);
		$criteria->compare('t.office_province_id',$this->office_province_id);
		$criteria->compare('t.office_city_id',$this->office_city_id);
		$criteria->compare('t.office_district',$this->office_district);
		$criteria->compare('t.office_village',$this->office_village);
		$criteria->compare('t.office_zipcode',$this->office_zipcode,true);
		$criteria->compare('t.office_hour',$this->office_hour,true);
		$criteria->compare('t.office_phone',$this->office_phone,true);
		$criteria->compare('t.office_fax',$this->office_fax,true);
		$criteria->compare('t.office_email',$this->office_email,true);
		$criteria->compare('t.office_hotline',$this->office_hotline,true);
		$criteria->compare('t.office_website',$this->office_website,true);
		$criteria->compare('t.map_icons',$this->map_icons,true);
		$criteria->compare('t.map_icon_size',$this->map_icon_size,true);
		$criteria->compare('t.google_on',$this->google_on);
		$criteria->compare('t.twitter_on',$this->twitter_on);
		$criteria->compare('t.twitter_card',$this->twitter_card);
		$criteria->compare('t.twitter_site',$this->twitter_site,true);
		$criteria->compare('t.twitter_creator',$this->twitter_creator,true);
		$criteria->compare('t.twitter_photo_size',$this->twitter_photo_size,true);
		$criteria->compare('t.twitter_country',$this->twitter_country,true);
		$criteria->compare('t.twitter_iphone',$this->twitter_iphone,true);
		$criteria->compare('t.twitter_ipad',$this->twitter_ipad,true);
		$criteria->compare('t.twitter_googleplay',$this->twitter_googleplay,true);
		$criteria->compare('t.facebook_on',$this->facebook_on);
		$criteria->compare('t.facebook_type',$this->facebook_type);
		$criteria->compare('t.facebook_profile_firstname',$this->facebook_profile_firstname,true);
		$criteria->compare('t.facebook_profile_lastname',$this->facebook_profile_lastname,true);
		$criteria->compare('t.facebook_profile_username',$this->facebook_profile_username,true);
		$criteria->compare('t.facebook_sitename',$this->facebook_sitename,true);
		$criteria->compare('t.facebook_see_also',$this->facebook_see_also,true);
		$criteria->compare('t.facebook_admins',$this->facebook_admins,true);
		if($this->modified_date != null && !in_array($this->modified_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.modified_date)',date('Y-m-d', strtotime($this->modified_date)));
		if(isset($_GET['modified']))
			$criteria->compare('t.modified_id',$_GET['modified']);
		else
			$criteria->compare('t.modified_id',$this->modified_id);
		
		$criteria->compare('modified.displayname',strtolower($this->modified_search),true);

		if(!isset($_GET['OmmuMeta_sort']))
			$criteria->order = 't.id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Get column for CGrid View
	 */
	public function getGridColumn($columns=null) {
		if($columns !== null) {
			foreach($columns as $val) {
				/*
				if(trim($val) == 'enabled') {
					$this->defaultColumns[] = array(
						'name'  => 'enabled',
						'value' => '$data->enabled == 1? "Ya": "Tidak"',
					);
				}
				*/
				$this->defaultColumns[] = $val;
			}
		}else {
			//$this->defaultColumns[] = 'id';
			$this->defaultColumns[] = 'meta_image';
			$this->defaultColumns[] = 'meta_image_alt';
			$this->defaultColumns[] = 'office_on';
			$this->defaultColumns[] = 'office_name';
			$this->defaultColumns[] = 'office_location';
			$this->defaultColumns[] = 'office_place';
			$this->defaultColumns[] = 'office_country_id';
			$this->defaultColumns[] = 'office_province_id';
			$this->defaultColumns[] = 'office_city_id';
			$this->defaultColumns[] = 'office_district';
			$this->defaultColumns[] = 'office_village';
			$this->defaultColumns[] = 'office_zipcode';
			$this->defaultColumns[] = 'office_hour';
			$this->defaultColumns[] = 'office_phone';
			$this->defaultColumns[] = 'office_fax';
			$this->defaultColumns[] = 'office_email';
			$this->defaultColumns[] = 'office_hotline';
			$this->defaultColumns[] = 'office_website';
			$this->defaultColumns[] = 'map_icons';
			$this->defaultColumns[] = 'map_icon_size';
			$this->defaultColumns[] = 'google_on';
			$this->defaultColumns[] = 'twitter_on';
			$this->defaultColumns[] = 'twitter_card';
			$this->defaultColumns[] = 'twitter_site';
			$this->defaultColumns[] = 'twitter_creator';
			$this->defaultColumns[] = 'twitter_photo_size';
			$this->defaultColumns[] = 'twitter_country';
			$this->defaultColumns[] = 'twitter_iphone';
			$this->defaultColumns[] = 'twitter_ipad';
			$this->defaultColumns[] = 'twitter_googleplay';
			$this->defaultColumns[] = 'facebook_on';
			$this->defaultColumns[] = 'facebook_type';
			$this->defaultColumns[] = 'facebook_profile_firstname';
			$this->defaultColumns[] = 'facebook_profile_lastname';
			$this->defaultColumns[] = 'facebook_profile_username';
			$this->defaultColumns[] = 'facebook_sitename';
			$this->defaultColumns[] = 'facebook_see_also';
			$this->defaultColumns[] = 'facebook_admins';
			$this->defaultColumns[] = 'modified_date';
			$this->defaultColumns[] = 'modified_id';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			$this->defaultColumns[] = 'id';
			$this->defaultColumns[] = 'meta_image';
			$this->defaultColumns[] = 'meta_image_alt';
			$this->defaultColumns[] = 'office_on';
			$this->defaultColumns[] = 'office_name';
			$this->defaultColumns[] = 'office_location';
			$this->defaultColumns[] = 'office_place';
			$this->defaultColumns[] = 'office_country_id';
			$this->defaultColumns[] = 'office_province_id';
			$this->defaultColumns[] = 'office_city_id';
			$this->defaultColumns[] = 'office_district';
			$this->defaultColumns[] = 'office_village';
			$this->defaultColumns[] = 'office_zipcode';
			$this->defaultColumns[] = 'office_hour';
			$this->defaultColumns[] = 'office_phone';
			$this->defaultColumns[] = 'office_fax';
			$this->defaultColumns[] = 'office_email';
			$this->defaultColumns[] = 'office_hotline';
			$this->defaultColumns[] = 'office_website';
			$this->defaultColumns[] = 'map_icons';
			$this->defaultColumns[] = 'map_icon_size';
			$this->defaultColumns[] = 'google_on';
			$this->defaultColumns[] = 'twitter_on';
			$this->defaultColumns[] = 'twitter_card';
			$this->defaultColumns[] = 'twitter_site';
			$this->defaultColumns[] = 'twitter_creator';
			$this->defaultColumns[] = 'twitter_photo_size';
			$this->defaultColumns[] = 'twitter_country';
			$this->defaultColumns[] = 'twitter_iphone';
			$this->defaultColumns[] = 'twitter_ipad';
			$this->defaultColumns[] = 'twitter_googleplay';
			$this->defaultColumns[] = 'facebook_on';
			$this->defaultColumns[] = 'facebook_type';
			$this->defaultColumns[] = 'facebook_profile_firstname';
			$this->defaultColumns[] = 'facebook_profile_lastname';
			$this->defaultColumns[] = 'facebook_profile_username';
			$this->defaultColumns[] = 'facebook_sitename';
			$this->defaultColumns[] = 'facebook_see_also';
			$this->defaultColumns[] = 'facebook_admins';
			$this->defaultColumns[] = 'modified_date';
			$this->defaultColumns[] = array(
				'name' => 'modified_search',
				'value' => '$data->modified->displayname',
			);
		}
		parent::afterConstruct();
	}

	/**
	 * User get information
	 */
	public static function getInfo($column=null)
	{
		if($column != null) {
			$model = self::model()->findByPk(1,array(
				'select' => $column
			));
			return $model->$column;
			
		} else {
			$model = self::model()->findByPk(1);
			return $model;			
		}
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() 
	{
		$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
		
		if(parent::beforeValidate()) {
			if($this->office_place == '' || $this->office_district == '' || $this->office_village == '') {
				$this->addError('office_place', Yii::t('phrase', 'Office Address cannot be blank.'));
				$this->addError('office_village', Yii::t('phrase', 'Office Village cannot be blank.'));
				$this->addError('office_district', Yii::t('phrase', 'Office District cannot be blank.'));
			}
			
			$meta_image = CUploadedFile::getInstance($this, 'meta_image');	
			if($meta_image->name != '') {
				$extension = pathinfo($meta_image->name, PATHINFO_EXTENSION);
				if(!in_array($extension, array('bmp','gif','jpg','png')))
					$this->addError('meta_image', 'The file $image_name cannot be uploaded. Only files with these extensions are allowed: bmp, gif, jpg, png.', array('$image_name'=>$meta_image->name));
			}
			
			if($currentAction == 'meta/twitter') {
				if($this->twitter_card == 3) {			
					if($this->twitter_photo_size['width'] == '')
						$this->addError('twitter_photo_size[width]', Yii::t('phrase', 'Photo Width cannot be blank.'));
					if($this->twitter_photo_size['height'] == '')
						$this->addError('twitter_photo_size[height]', Yii::t('phrase', 'Photo Height cannot be blank.'));
				}
			}
			
			$this->modified_id = Yii::app()->user->id;	
		}
		return true;
	}
	
	/**
	 * After save attributes
	 */
	protected function beforeSave() 
	{
		$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
		
		if(parent::beforeSave()) {
			$meta_path = "public";
			$this->meta_image = CUploadedFile::getInstance($this, 'meta_image');
			if($this->meta_image instanceOf CUploadedFile) {
				$fileName = 'meta_'.time().'.'.$this->meta_image->extensionName;
				if($this->meta_image->saveAs($meta_path.'/'.$fileName)) {
					if($this->old_meta_image != '')
						@unlink($meta_path.'/'.$this->old_meta_image);
					$this->meta_image = $fileName;

					//create thumb image
					Yii::import('ext.phpthumb.PhpThumbFactory');
					$pageImg = PhpThumbFactory::create($meta_path.'/'.$fileName, array('jpegQuality' => 90, 'correctPermissions' => true));
					$pageImg->resize(700);
					$pageImg->save($meta_path.'/'.$fileName);
				}
			}
			
			if($currentAction == 'meta/edit')
				$this->map_icon_size = serialize($this->map_icon_size);
			
			if($currentAction == 'meta/twitter') {
				$this->twitter_photo_size = serialize($this->twitter_photo_size);
				$this->twitter_iphone = serialize($this->twitter_iphone);
				$this->twitter_ipad = serialize($this->twitter_ipad);
				$this->twitter_googleplay = serialize($this->twitter_googleplay);
			}
		}
		return true;
	}

}