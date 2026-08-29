<?php

namespace IlBronza\Ukn;

class Notification
{
	protected $status = 'primary';
	protected $position = 'top-right';
	protected $timeout = null;
	protected $message;

	public function __construct(string $message)
	{
		$this->message = $message;
	}

	public function success()
	{
		return $this->status('success');
	}

	public function danger()
	{
		return $this->status('danger');
	}

	public function error()
	{
		return $this->danger();
	}

	public function warning()
	{
		return $this->status('warning');
	}

	public function info()
	{
		return $this->status('primary');
	}

	public function status(string $status)
	{
		$this->status = $status;

		return $this;
	}

	public function position(string $position)
	{
		$this->position = $position;

		return $this;
	}

	public function center()
	{
		return $this->position('top-center');
	}

	public function timeout($milliseconds)
	{
		$this->timeout = $milliseconds;

		return $this;
	}

	public function send()
	{
		Ukn::pushUikitNotification($this->status, $this->message, [
			'position' => $this->position,
			'timeout' => $this->timeout,
		]);
	}
}
