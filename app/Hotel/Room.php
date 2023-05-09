<?php

namespace Hotel;

use PDO;
use DateTime;
use Exception;
use Hotel\BaseService;



class Room  extends BaseService
{
	public function get($roomId)
	{
		$parameters = [':room_id' => $roomId,];
		return $this->fetch('SELECT * FROM room WHERE room_id = :room_id', $parameters);
	}

	public function getCities()
	{
		// Get all cities

		$cities = [];
		try {
			$rows = $this->fetchAll('SELECT DISTINCT city FROM room');

			foreach ($rows as $row) {
				$cities[] = $row['city'];
			}
		} catch (Exception $ex) {
			// log error
		}
		return $cities;
	}
	public function getAllCount() {
		return $this->fetchAll('SELECT DISTINCT count_of_guests  FROM room');
	}

	public function getAllPrices() {
		return $this->fetchAll ('SELECT DISTINCT price FROM room');
	}
	public function search($checkInDate, $checkOutDate, $city = ' ', $typeId = ' ')
	{
		// Setup parameters
		$parameters = [
			':check_in_date' => $checkInDate->format(DateTime::ATOM),
			':check_out_date' => $checkOutDate->format(DateTime::ATOM),
		];
		if (!empty($city)) {
			$parameters[':city'] = $city;
		}
		if (!empty($typeId)) {
			$parameters[':type_id'] = $typeId;
		}
		// Build query
		$sql = 'SELECT * FROM room WHERE ';
		if (!empty($city)) {
			$sql .= 'city = :city AND ';
		}
		if (!empty($typeId)) {
			$sql .= 'type_id = :type_id AND ';
		}
		$sql .= 'room_id NOT IN (
					SELECT room_id
					FROM booking
					WHERE check_in_date <= :check_out_date AND check_out_date >= :check_in_date)';
		// var_dump($sql);die;
		// Get results


		// return $this->fetchAll($sql, $parameters);


		// // execute SQL
		$statement = $this->getPdo()->prepare(
			'SELECT * FROM room
			 WHERE city=:city AND type_id=:type_id AND room_id NOT IN (
			 		SELECT room_id
			 		FROM booking
			 		 WHERE check_in_date <= :check_out_date AND check_out_date >= :check_in_date)',
			$parameters
		);
		// // Get all available roons

		$parameters = [
			':city' => $city,
			':type_id' => $typeId,
			':check_in_date' => $checkInDate->format(DateTime::ATOM),
			':check_out_date' => $checkOutDate->format(DateTime::ATOM)

		];
		$statement->execute($parameters);
		$rooms = $statement->fetchAll(PDO::FETCH_ASSOC);


		return $rooms;

		// var_dump($statement);
		// die;
		// return $this->fetchAll('SELECT * FROM room
		// WHERE city =:city AND type_id=:type_id AND room_id NOT IN (
		// 	SELECT room_id
		// 	FROM booking
		// 	WHERE check_in_date <=:check_out_date AND check_out_date >=:check_in_date',$parameters);

	}

}
