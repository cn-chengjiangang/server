<?php

/**
 * Skeleton subclass for performing query and update operations on the 'metadata_profile' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package plugins.metadata
 * @subpackage model
 */
class MetadataProfilePeer extends BaseMetadataProfilePeer
{
	
	public static function setDefaultCriteriaFilter()
	{
		if(self::$s_criteria_filter == null)
			self::$s_criteria_filter = new criteriaFilter();
		
		$c = new Criteria();
		$c->addAnd(MetadataProfilePeer::STATUS, MetadataProfile::STATUS_DEPRECATED, Criteria::NOT_EQUAL);
		self::$s_criteria_filter->setFilter($c);
	}
	
	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $id the primary key.
	 * @param      int $version the version number.
	 * @param      PropelPDO $con the connection to use
	 * @return     MetadataProfile
	 */
	public static function retrieveById($id, $version = null, PropelPDO $con = null)
	{
		$criteria = new Criteria();
		$criteria->add(MetadataProfilePeer::ID, $id);
		
		if($version)
			$criteria->add(MetadataProfilePeer::VERSION, $version);
		
		return MetadataProfilePeer::doSelectOne($criteria, $con);
	}
	
	/**
	 * Retrieve a single object by system name (object is retrieved for the current partner).
	 *
	 * @param      int $systemName the system name
	 * @param      PropelPDO $con the connection to use
	 * @return     MetadataProfile
	 */
	public static function retrieveBySystemName($systemName, PropelPDO $con = null)
	{
	    $partnerId = kCurrentContext::$partner_id ? kCurrentContext::$partner_id : kCurrentContext::$ks_partner_id;
		$criteria = new Criteria();
		$criteria->add(MetadataProfilePeer::SYSTEM_NAME, $systemName);
		$criteria->addAnd(MetadataProfilePeer::PARTNER_ID, $partnerId, Criteria::EQUAL);
		return MetadataProfilePeer::doSelectOne($criteria, $con);
	}
	
	/**
	 * @param      int $partnerId the partner id
	 * @param      PropelPDO $con the connection to use
	 * @return     array<MetadataProfile>
	 */
	public static function retrieveByPartnerId($partnerId, PropelPDO $con = null)
	{
		$criteria = new Criteria();
		$criteria->add(MetadataProfilePeer::PARTNER_ID, $partnerId);
		
		self::setUseCriteriaFilter(false);
		$ret = MetadataProfilePeer::doSelectOne($criteria, $con);
		self::setUseCriteriaFilter(true);
		
		return $ret;
	}
	public static function getCacheInvalidationKeys()
	{
		return array(array("metadataProfile:id=%s", self::ID), array("metadataProfile:partnerId=%s", self::PARTNER_ID));		
	}
} // MetadataProfilePeer
