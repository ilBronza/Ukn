<?php

namespace IlBronza\Ukn;

use Illuminate\Support\Str;

class Ukn
{
	static function notification(string $message): Notification
	{
		return new Notification($message);
	}

	static function displayDatabaseNotification(array $notificationFields)
	{
		if(count($notificationFields) > 0)
			static::w(json_encode($notificationFields));
	}

	static function e(string $message = null)
	{
		static::error($message);
	}

	static function s(string $message = null)
	{
		static::success($message);
	}

	static function w(string $message = null)
	{
		static::warning($message);
	}

	static function i(string $message = null)
	{
		static::info($message);
	}

	static function pushUikitNotification(string $type, string $message, $options = null)
	{
		if(! $message)
			return ;

		if($message == '')
			return ;

		$notifications = session()->get('UiKitNotifications', []);
		$typeMessages = $notifications[$type] ?? [];
		if (is_array($typeMessages)) {
			foreach ($typeMessages as $existing) {
				$existingMessage = is_array($existing)
					? ($existing['message'] ?? null)
					: $existing;

				if ($existingMessage === $message) {
					return;
				}
			}
		} elseif ($typeMessages === $message) {
			return;
		}

		$key = [
			'UiKitNotifications',
			$type,
			Str::random()
		];

		$value = $options === null
			? $message
			: array_merge(['message' => $message], $options);

		session()->flash(implode(".", $key) , $value);
	}

	static function error(string $message)
	{
		static::pushUikitNotification('danger', $message);
	}

	static function success(string $message)
	{
		static::pushUikitNotification('success', $message);
	}

	static function warning(string $message)
	{
		static::pushUikitNotification('warning', $message);
	}

	static function info(string $message)
	{
		static::pushUikitNotification('primary', $message);
	}
}
