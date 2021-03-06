<?php
/**
 * Created by PhpStorm.
 * User: BrianLogan
 * Date: 8/22/2017
 * Time: 7:44 PM
 */

namespace darkgoldblade01\Infusionsoft;

/**
 * Class Contacts
 *
 * All functions that interact with contacts
 * in Infusionsoft.
 *
 * @package darkgoldblade01\Infusionsoft
 *
 */

class Contacts extends Infusionsoft {

	/**
	 * Contacts constructor.
	 *
	 * @param array $accessToken
	 *
	 * @throws \Exception
	 */
	public function __construct( array $accessToken = [] ) {
		parent::__construct( $accessToken );
		if(!isset($this->options['access_token'])) {
			throw new \Exception('Access token must be set.');
		}
	}

	/**
	 *
	 * List all contacts in Infusionsoft
	 *
	 * @param int $limit - 1000 is the max able to be returned at once
	 * @param int|null $offset
	 * @param string $email
	 * @param string $given_name
	 * @param string $family_name
	 * @param string $order
	 *
	 * @return mixed
	 */
	public function listContacts(int $limit = 1000, int $offset = null, string $email = null, string $given_name = null, string $family_name = null, string $order = null) {
	    $query = [];
	    //Building the query
	    if($limit)
		    $query['limit'] = $limit;
	    if($offset)
		    $query['offset'] = $offset;
	    if($email)
		    $query['email'] = $email;
	    if($given_name)
		    $query['given_name'] = $given_name;
	    if($family_name)
		    $query['family_name'] = $family_name;
	    if($order)
		    $query['order'] = $order;

	    //Sending the request
		$request = $this->send("GET", "contacts", [
			'headers' => [
				'Accept' => 'application/json, */*',
			],
			'query' => $query
		]);
		return $request;
    }

	/**
	 *
	 * Create a contact in Infusionsoft
	 *  ** THIS CREATES, NOT UPDATES **
	 *
	 * @param array $contact
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function createContact(array $contact) {
		//Checking for the required fields
		if(!isset($contact['email_addresses']) && !isset($contact['phone_numbers'])) {
			throw new \Exception('Either an email address or phone number is required to create a contact');
		}
		if(isset($contact['phone_numbers'])) {
			foreach ( $contact['phone_numbers'] AS $phone_number ) {
				if ( ! isset( $phone_number['field'] ) ) {
					throw new \Exception( 'The field is required for all phone numbers, ie PHONE1 to PHONE5, etc.' );
				}
				if ( ! isset( $phone_number['number'] ) ) {
					throw new \Exception( 'The phone number is required for all phone numbers, it should be 10 digits long' );
				}
			}
		}
		if(isset($contact['email_addresses'])) {
			foreach ( $contact['email_addresses'] AS $email_address ) {
				if ( ! isset( $email_address['field'] ) ) {
					throw new \Exception( 'The field is required for all email addresses, ie EMAIL1 to EMAIL3, etc.' );
				}
				if ( ! isset( $email_address['email'] ) ) {
					throw new \Exception( 'The email address is required for all email addresses, and it should be in a valid format' );
				}
			}
		}

		//Sending the request
		$request = $this->send("POST", 'contacts', [
			'headers' => [
				'Accept' => 'application/json, */*'
			],
			'json' => $contact
		]);
		return $request;
	}

	/**
	 *
	 * Update a contact based on Contact ID
	 *
	 * @param string $contactId
	 * @param array $contact
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function updateContact(string $contactId, array $contact) {
		//Checking for the required fields
		if(!isset($contact['email_addresses']) && !isset($contact['phone_numbers'])) {
			throw new \Exception('Either an email address or phone number is required to create a contact');
		}
		if(isset($contact['phone_numbers'])) {
			foreach ( $contact['phone_numbers'] AS $phone_number ) {
				if ( ! isset( $phone_number['field'] ) ) {
					throw new \Exception( 'The field is required for all phone numbers, ie PHONE1 to PHONE5, etc.' );
				}
				if ( ! isset( $phone_number['number'] ) ) {
					throw new \Exception( 'The phone number is required for all phone numbers, it should be 10 digits long' );
				}
			}
		}
		if(isset($contact['email_addresses'])) {
			foreach ( $contact['email_addresses'] AS $email_address ) {
				if ( ! isset( $email_address['field'] ) ) {
					throw new \Exception( 'The field is required for all email addresses, ie EMAIL1 to EMAIL3, etc.' );
				}
				if ( ! isset( $email_address['email'] ) ) {
					throw new \Exception( 'The email address is required for all email addresses, and it should be in a valid format' );
				}
			}
		}

		//Sending the request
		$request = $this->send("PATCH", 'contacts/' . $contactId, [
			'headers' => [
				'Accept' => 'application/json, */*'
			],
			'json' => $contact
		]);
		return $request;
	}


	/**
	 *
	 * Delete Contact
	 *
	 * Delete a contact from Infusionsoft
	 * based on the Contact ID.
	 *
	 * @param $contactId
	 *
	 * @return mixed
	 */
	public function deleteContact($contactId) {
		$request = $this->send("DELETE", 'contacts/' . $contactId, [
			'headers' => [
				'Accept' => 'application/json, */*'
			]
		], false);
		return $request;
	}


	/**
	 *
	 * Custom Fields
	 *
	 * Get the custom fields that a
	 * contact can have assigned
	 * to it.
	 *
	 * @return mixed
	 */
	public function customFields() {
		$request = $this->send("GET", 'contactCustomFields', [
			'headers' => [
				'Accept' => 'application/json, */*'
			]
		]);
		return $request;
	}
}