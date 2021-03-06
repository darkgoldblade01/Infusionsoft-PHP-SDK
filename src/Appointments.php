<?php
/**
 * Created by PhpStorm.
 * User: BrianLogan
 * Date: 8/22/2017
 * Time: 7:44 PM
 */

namespace darkgoldblade01\Infusionsoft;

use Carbon\Carbon;

/**
 * Class Appointments
 *
 * All functions that interact with appointments
 * in Infusionsoft.
 *
 * @package darkgoldblade01\Infusionsoft
 *
 */

class Appointments extends Infusionsoft {

	/**
	 * Appointments constructor.
	 *
	 * @param array $options
	 *
	 * @throws \Exception
	 *
	 */
	public function __construct( array $options = [] ) {
		parent::__construct( $options );
		if(!isset($this->options['access_token'])) {
			throw new \Exception('Access token must be set.');
		}
	}

    /**
     *
     * List Appointments
     *
     * Get a list of all of the appointments
     * in Infusionsoft, paginated. The max
     * is 1000 records per page. Offset is
     * the number of records you want to skip
     * at the beginning, for instance, if your
     * limit is 100, and you have 200 appointments,
     * the offset for page 2 should be 100.
     *
     * @param int $limit The limit you want to get per page. Max is 1000
     * @param int $offset The offset from the start. (for pagination)
     * @param string $since The start date you want to get data from.
     * @param string $until The end date you want to get data from.
     *
     * @return mixed
     */
	public function listAppointments(int $limit = 1000, int $offset = null, string $since = null, string $until = null) {
		$query = [];
		if($limit)
			$query['limit'] = $limit;
        if($offset)
            $query['offset'] = $offset;
        if($since)
            $query['since'] = Carbon::parse($since)->toIso8601String();
        if($until)
            $query['until'] = Carbon::parse($until)->toIso8601String();

		$request = $this->send("GET", "appointments", [
			'headers' => [
				'Accept' => 'application/json, */*',
			],
			'query' => $query
		]);
		return $request;
	}

    /**
     *
     * Get Appointment
     *
     * Get a specific appointment
     * from Infusionsoft, seeing more
     * details than you would through
     * the List Appointments function.
     *
     * @param string $appointmentId The ID of the appointment ou want to retrieve.
     *
     * @return mixed
     */
    public function getAppointment(string $appointmentId) {
        $request = $this->send("GET", "appointments/" . $appointmentId, [
            'headers' => [
                'Accept' => 'application/json, */*',
            ],
        ]);
        return $request;
    }

    /**
     *
     * Create Appointment
     *
     * @return mixed
     *
     */
    public function createAppointment(array $appointment) {

        // TODO: Implement createAppointment() method.

//        $request = $this->send("POST", "appointments/" . $appointmentId, [
//            'headers' => [
//                'Accept' => 'application/json, */*',
//            ],
//        ]);
//        return $request;
    }

    /**
     *
     * Update Appointment
     *
     * @return mixed
     */
    public function updateAppointment(string $appointmentId, array $appointment) {

        // TODO: Implement updateAppointment() method.

//        $request = $this->send("PATCH", "appointments/" . $appointmentId, [
//            'headers' => [
//                'Accept' => 'application/json, */*',
//            ],
//        ]);
//        return $request;
    }

    /**
     *
     * Update Appointment
     *
     *
     * @return mixed
     */
    public function deleteAppointment(string $appointmentId) {

        // TODO: Implement deleteAppointment() method.

//        $request = $this->send("DELETE", "appointments/" . $appointmentId, [
//            'headers' => [
//                'Accept' => 'application/json, */*',
//            ],
//        ]);
//        return $request;
    }

    /**
     *
     * Search Appointments
     *
     * @return mixed
     */
    public function searchAppointments(string $appointmentId) {

        // TODO: Implement searchAppointments() method.

//        $request = $this->send("DELETE", "appointments/" . $appointmentId, [
//            'headers' => [
//                'Accept' => 'application/json, */*',
//            ],
//        ]);
//        return $request;
    }

    /**
     *
     * Replace Appointments
     *
     * @return mixed
     */
    public function replaceAppointment(string $appointmentId) {

        // TODO: Implement replaceAppointment() method.

//        $request = $this->send("DELETE", "appointments/" . $appointmentId, [
//            'headers' => [
//                'Accept' => 'application/json, */*',
//            ],
//        ]);
//        return $request;
    }

    /**
     *
     * Retrieve Synced Appointments
     *
     * @return mixed
     */
    public function syncAppointments(string $appointmentId) {

        // TODO: Implement syncAppointments() method.

//        $request = $this->send("DELETE", "appointments/" . $appointmentId, [
//            'headers' => [
//                'Accept' => 'application/json, */*',
//            ],
//        ]);
//        return $request;
    }

}