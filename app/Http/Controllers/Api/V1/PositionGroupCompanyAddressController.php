<?php

namespace App\Http\Controllers\Api\V1;

use App\CompanyAddress;
use App\Http\Controllers\Controller;
use App\PositionGroup;

/** @resource PositionGroupCompanyAddress
 *
 * Resource to show and update PositionGroup-CompanyAddress relation
 */

class PositionGroupCompanyAddressController extends Controller {
	/**
	 * Display the list of company addresses related to a position group.
	 *
	 * @param  \App\CompanyAddress  $company_address_id
	 * @param  \App\PositionGroup  $position_group_id
	 * @return \Illuminate\Http\Response
	 */
	public function get_addresses($position_group_id) {
		$position_group = PositionGroup::findOrFail($position_group_id);
		return $position_group->company_address;
	}

	/**
	 * Display the specified company address related to a position group.
	 *
	 * @param  \App\CompanyAddress  $company_address_id
	 * @param  \App\PositionGroup  $position_group_id
	 * @return \Illuminate\Http\Response
	 */
	public function get_address($position_group_id, $company_address_id) {
		$position_group = PositionGroup::findOrFail($position_group_id);
		$company_address = CompanyAddress::findOrFail($company_address_id);
		if ($position_group->company_address_id == $company_address_id) {
			return $company_address;
		} else {
			return App::abort(404);
		}
	}

	public function get_city($position_group_id, $company_address_id) {
		$position_group = PositionGroup::findOrFail($position_group_id);
		$company_address = CompanyAddress::findOrFail($company_address_id);
		if ($position_group->company_address_id == $company_address_id) {
			return $company_address->city;
		} else {
			return App::abort(404);
		}
	}

	/**
	 * Attach company address to a position group.
	 *
	 * @param  \App\CompanyAddress  $company_address_id
	 * @param  \App\PositionGroup  $position_group_id
	 * @return \Illuminate\Http\Response
	 */
	public function set_address($position_group_id, $company_address_id) {
		$position_group = PositionGroup::findOrFail($position_group_id);
		$company_address = CompanyAddress::findOrFail($company_address_id);
		$position_group->addresses()->attach($company_address);
		$position_group->addresses;
		return $position_group;
	}

	/**
	 * Detach company address from position group.
	 *
	 * @param  \App\CompanyAddress  $company_address_id
	 * @param  \App\PositionGroup  $position_group_id
	 * @return \Illuminate\Http\Response
	 */
	public function unset_address($position_group_id, $company_address_id) {
		$position_group = PositionGroup::findOrFail($position_group_id);
		$company_address = CompanyAddress::findOrFail($company_address_id);
		$position_group->addresses()->detach($company_address);
		$position_group->addresses;
		return $position_group;
	}
}
