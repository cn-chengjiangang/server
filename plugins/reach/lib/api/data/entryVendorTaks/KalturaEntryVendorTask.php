<?php
/**
 * @package plugins.reach
 * @subpackage api.objects
 */
class KalturaEntryVendorTask extends KalturaObject implements IFilterable, IApiObjectFactory
{
	/**
	 * @var int
	 * @readonly
	 * @filter eq,in,order
	 */
	public $id;
	
	/**
	 * @var int
	 * @readonly
	 */
	public $partnerId;
	
	/**
	 * @var int
	 * @readonly
	 */
	public $vendorPartnerId;
	
	/**
	 * @var time
	 * @readonly
	 * @filter gte,lte,order
	 */
	public $createdAt;
	
	/**
	 * @var time
	 * @readonly
	 * @filter gte,lte,order
	 */
	public $updatedAt;
	
	/**
	 * @var time
	 * @readonly
	 * @filter gte,lte,order
	 */
	public $queuedAt;
	
	/**
	 * @var time
	 * @readonly
	 * @filter gte,lte,order
	 */
	public $finishedAt;
	
	/**
	 * @var string
	 * @filter eq
	 * @insertonly
	 */
	public $entryId;
	
	/**
	 * @var KalturaEntryVendorTaskStatus
	 * @readonly
	 * @filter eq,in
	 */
	public $status;
	
	/**
	 * The profile id from which this task base cnfig is taken from
	 * @var int
	 * @filter eq,in
	 * @insertonly
	 */
	public $vendorProfileId;
	
	/**
	 * The catalog item Id containing the task description 
	 * @var int
	 * @filter eq,in
	 * @insertonly
	 */
	public $catalogItemId;
	
	/**
	 * The charged price to execute this task
	 * @var int
	 * @readonly
	 */
	public $price;
	
	/**
	 * The ID of the user who created this task
	 * @var string
	 * @filter eq,in,notin
	 * @insertonly
	 */
	public $userId;
	
	/**
	 * The user ID that approved this task for execution (in case moderation is requested)
	 * @var string
	 * @filter eq,in,notin
	 */
	public $approvedBy;
	
	/**
	 * Err description provided by provider in case job execution has failed
	 * @var string
	 */
	public $ErrDescription;
	
	/**
	 * Access key generated by Kaltura to allow vendors to ingest the end result to the destination
	 * @var string
	 * @readonly
	 */
	public $accessKey;
	
	/**
	 * User generated notes that should be taken into account by the vendor while executing the task
	 * @var string
	 */
	public $notes;
	
	private static $map_between_objects = array
	(
		'id',
		'partnerId',
		'vendorPartnerId',
		'createdAt',
		'updatedAt',
		'queuedAt',
		'finishedAt',
		'entryId',
		'status',
		'vendorProfileId',
		'catalogItemId',
		'price',
		'userId',
		'approvedBy',
		'ErrDescription',
		'accessKey',
		'notes',
	);
	
	/* (non-PHPdoc)
	 * @see KalturaCuePoint::getMapBetweenObjects()
	 */
	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), self::$map_between_objects);
	}
	
	/* (non-PHPdoc)
 	 * @see KalturaObject::toInsertableObject()
 	 */
	public function toInsertableObject($object_to_fill = null, $props_to_skip = array())
	{
		if (is_null($object_to_fill))
			$object_to_fill = new EntryVendorTask();
		
		$dbVendorProfile = VendorProfilePeer::retrieveByPK($this->vendorProfileId);
		if(!$dbVendorProfile)
			throw new KalturaAPIException(KalturaReachErrors::VENDOR_PROFILE_NOT_FOUND, $this->vendorProfileId);
		
		$dbVendorCatalogItem = VendorCatalogItemPeer::retrieveByPK($this->catalogItemId);
		if(!$dbVendorCatalogItem)
			throw new KalturaAPIException(KalturaReachErrors::CATALOG_ITEM_NOT_FOUND, $this->catalogItemId);
		
		$status = KalturaEntryVendorTaskStatus::PENDING;
		if($dbVendorProfile->shouldModerate($dbVendorCatalogItem->getServiceType()))
			$status = KalturaEntryVendorTaskStatus::PENDING_MODERATION;
		
		$object_to_fill->setStatus($status);
		$object_to_fill->setPartnerId(kCurrentContext::getCurrentPartnerId());
		
		return parent::toInsertableObject($object_to_fill, $props_to_skip);
	}
	
	public function validateForInsert($propertiesToSkip = array())
	{
		$this->validate();
		return parent::validateForInsert($propertiesToSkip);
	}
	
	public function validateForUpdate($sourceObject, $propertiesToSkip = array())
	{
		$this->validate($sourceObject);
		return parent::validateForUpdate($sourceObject, $propertiesToSkip);
	}
	
	private function validate(EntryVendorTask $sourceObject = null)
	{
		if(!$sourceObject) //Source object will be null on insert
		{
			$this->validatePropertyNotNull(array("vendorProfileId", "catalogItemId", "entryId"));
		}
		
		return;
	}
	
	public function getExtraFilters()
	{
		return array();
	}
	
	public function getFilterDocs()
	{
		return array();
	}

	/* (non-PHPdoc)
 	 * @see IApiObjectFactory::getInstance($sourceObject, KalturaDetachedResponseProfile $responseProfile)
 	 */
	public static function getInstance($sourceObject, KalturaDetachedResponseProfile $responseProfile = null)
	{
		$object = new KalturaEntryVendorTask();
		/* @var $object KalturaEntryVendorTask */
		$object->fromObject($sourceObject, $responseProfile);
		return $object;
	}
}