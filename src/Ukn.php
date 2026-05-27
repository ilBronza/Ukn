<?php

namespace IlBronza\Ukn;

use Illuminate\Support\Str;

class Ukn
{
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

	static function pushUikitNotification(string $type, string $message)
	{
		if(! $message)
			return ;

		if($message == '')
			return ;

		$notifications = session()->get('UiKitNotifications', []);
		$typeMessages = $notifications[$type] ?? [];
		if (is_array($typeMessages)) {
			foreach ($typeMessages as $existing) {
				if ($existing === $message) {
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

		session()->flash(implode(".", $key) , $message ?? __('messages.' . $type));
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