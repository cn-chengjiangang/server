<?php
/**
 * @package plugins.reach
 * @subpackage api.filters.base
 * @abstract
 */
abstract class KalturaEntryVendorTaskBaseFilter extends KalturaFilter
{
	static private $map_between_objects = array
	(
		"idEqual" => "_eq_id",
		"idIn" => "_in_id",
		"createdAtGreaterThanOrEqual" => "_gte_created_at",
		"createdAtLessThanOrEqual" => "_lte_created_at",
		"updatedAtGreaterThanOrEqual" => "_gte_updated_at",
		"updatedAtLessThanOrEqual" => "_lte_updated_at",
		"queuedAtGreaterThanOrEqual" => "_gte_queued_at",
		"queuedAtLessThanOrEqual" => "_lte_queued_at",
		"finishedAtGreaterThanOrEqual" => "_gte_finished_at",
		"finishedAtLessThanOrEqual" => "_lte_finished_at",
		"entryIdEqual" => "_eq_entry_id",
		"statusEqual" => "_eq_status",
		"statusIn" => "_in_status",
		"vendorProfileIdEqual" => "_eq_vendor_profile_id",
		"vendorProfileIdIn" => "_in_vendor_profile_id",
		"catalogItemIdEqual" => "_eq_catalog_item_id",
		"catalogItemIdIn" => "_in_catalog_item_id",
		"userIdEqual" => "_eq_user_id",
		"userIdIn" => "_in_user_id",
		"userIdNotIn" => "_notin_user_id",
		"approvedByEqual" => "_eq_approved_by",
		"approvedByIn" => "_in_approved_by",
		"approvedByNotIn" => "_notin_approved_by",
	);

	static private $order_by_map = array
	(
		"+id" => "+id",
		"-id" => "-id",
		"+createdAt" => "+created_at",
		"-createdAt" => "-created_at",
		"+updatedAt" => "+updated_at",
		"-updatedAt" => "-updated_at",
		"+queuedAt" => "+queued_at",
		"-queuedAt" => "-queued_at",
		"+finishedAt" => "+finished_at",
		"-finishedAt" => "-finished_at",
	);

	public function getMapBetweenObjects()
	{
		return array_merge(parent::getMapBetweenObjects(), self::$map_between_objects);
	}

	public function getOrderByMap()
	{
		return array_merge(parent::getOrderByMap(), self::$order_by_map);
	}

	/**
	 * @var int
	 */
	public $idEqual;

	/**
	 * @var string
	 */
	public $idIn;

	/**
	 * @var time
	 */
	public $createdAtGreaterThanOrEqual;

	/**
	 * @var time
	 */
	public $createdAtLessThanOrEqual;

	/**
	 * @var time
	 */
	public $updatedAtGreaterThanOrEqual;

	/**
	 * @var time
	 */
	public $updatedAtLessThanOrEqual;

	/**
	 * @var time
	 */
	public $queuedAtGreaterThanOrEqual;

	/**
	 * @var time
	 */
	public $queuedAtLessThanOrEqual;

	/**
	 * @var time
	 */
	public $finishedAtGreaterThanOrEqual;

	/**
	 * @var time
	 */
	public $finishedAtLessThanOrEqual;

	/**
	 * @var string
	 */
	public $entryIdEqual;

	/**
	 * @var KalturaEntryVendorTaskStatus
	 */
	public $statusEqual;

	/**
	 * @var string
	 */
	public $statusIn;

	/**
	 * @var int
	 */
	public $vendorProfileIdEqual;

	/**
	 * @var string
	 */
	public $vendorProfileIdIn;

	/**
	 * @var int
	 */
	public $catalogItemIdEqual;

	/**
	 * @var string
	 */
	public $catalogItemIdIn;

	/**
	 * @var string
	 */
	public $userIdEqual;

	/**
	 * @var string
	 */
	public $userIdIn;

	/**
	 * @var string
	 */
	public $userIdNotIn;

	/**
	 * @var string
	 */
	public $approvedByEqual;

	/**
	 * @var string
	 */
	public $approvedByIn;

	/**
	 * @var string
	 */
	public $approvedByNotIn;
}