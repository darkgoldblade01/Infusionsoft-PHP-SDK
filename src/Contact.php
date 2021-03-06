<?php
/**
 * Created by PhpStorm.
 * User: BrianLogan
 * Date: 8/22/2017
 * Time: 7:44 PM
 */

namespace darkgoldblade01\Infusionsoft;

/**
 * Class Contact
 *
 * All functions that interact with a contact
 * in Infusionsoft.
 *
 * @package darkgoldblade01\Infusionsoft
 *
 */

class Contact extends Infusionsoft {
	/**
	 * The ID of the contact
	 * you are interacting with
	 * in Infusionsoft.
	 *
	 * @var string
	 */
	private $contactId;

	/**
	 * Contacts constructor.
	 *
	 * @param array $accessToken
	 *
	 * @param string $contactId The ID of the contact you want to interact with.
	 *
	 * @throws \Exception
	 */
	public function __construct( array $accessToken = [], string $contactId) {
		parent::__construct( $accessToken );
		if(!isset($this->options['access_token'])) {
			throw new \Exception('Access token must be set.');
		}
		$this->contactId = $contactId;
	}

	/**
	 *
	 * Get Contact
	 *
	 * Get the contact from
	 * Infusionsoft with any
	 * information you can get.
	 *
	 * @return mixed
	 */
	public function get() {
		$request = $this->send("GET", "contacts/" . $this->contactId, [
			'headers' => [
				'Accept' => 'application/json, */*',
			]
		]);
		return $request;
	}

	/**
	 *
	 * List Tags
	 *
	 * Lists applied tags from
	 * the contact.
	 *
	 * @return mixed
	 */
	public function listTags() {
		$request = $this->send("GET", "contacts/" . $this->contactId . '/tags', [
			'headers' => [
				'Accept' => 'application/json, */*',
			],
		]);
		return $request;
	}

	/**
	 *
	 * Apply Tags
	 *
	 * Apply tags to the contact.
	 *
	 * @param array $tagIds An array of IDs of tags you want to apply to the contact.
	 *
	 * @return mixed
	 */
	public function applyTags(array $tagIds) {
		$query = [];
		$query['tagIds'] = $tagIds;
		$request = $this->send("POST", "contacts/" . $this->contactId . '/tags', [
			'headers' => [
				'Accept' => 'application/json, */*',
			],
			'json' => $query
		]);
		return $request;
	}

	/**
	 *
	 * Remove Applied Tag
	 *
	 * Removes a tag from
	 * the contact specified.
	 *
	 * @param string $tagId The ID of a tag you want to remove from the contact.
	 *
	 * @return mixed
	 */
	public function deleteTag(string $tagId) {
		$query = [];
		$query['tagId'] = $tagId;
		$request = $this->send("DELETE", "contacts/" . $this->contactId . '/tags', [
			'headers' => [
				'Accept' => 'application/json, */*',
			],
			'json' => $query
		]);
		return $request;
	}

	/**
	 *
	 * Remove Applied Tags
	 *
	 * Removes a list of tags from
	 * the contact specified.
	 *
	 * @param array $tagIds An array of IDs you want to remove from the contact.
	 *
	 * @return mixed
	 */
	public function deleteTags(array $tagIds) {
		$query = [];
		$query['ids'] = $tagIds;
		$request = $this->send("DELETE", "contacts/" . $this->contactId . '/tags', [
			'headers' => [
				'Accept' => 'application/json, */*',
			],
			'json' => $query
		]);
		return $request;
	}
}