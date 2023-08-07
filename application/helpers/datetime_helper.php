<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('time_elapsed_string')) {
	function time_elapsed_string($datetime, $full = false)
	{
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diffString = [
			'y' => 'year',
			'm' => 'month',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		];

		foreach ($diffString as $key => &$value) {
			if ($diff->$key) {
				$value = $diff->$key . ' ' . $value . ($diff->$key > 1 ? 's' : '');
			} else {
				unset($diffString[$key]);
			}
		}

		if (!$full) {
			$diffString = array_slice($diffString, 0, 1);
		}

		return $diffString ? implode(', ', $diffString) . ' ago' : 'just now';
	}
}
