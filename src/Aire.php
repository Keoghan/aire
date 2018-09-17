<?php

namespace Galahad\Aire;

use Galahad\Aire\Elements\Button;
use Galahad\Aire\Elements\Form;
use Galahad\Aire\Elements\Input;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Factory;

class Aire
{
	/**
	 * @var \Illuminate\View\Factory
	 */
	protected $factory;
	
	/**
	 * @var \Galahad\Aire\Elements\Form
	 */
	protected $form;
	
	/**
	 * @var array
	 */
	protected $config;
	
	/**
	 * Aire constructor.
	 *
	 * @param \Illuminate\View\Factory $factory
	 */
	public function __construct(Factory $factory, array $config = [])
	{
		$this->factory = $factory;
		$this->config = $config;
	}
	
	/**
	 * Open a new Form.
	 *
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function open() : Form
	{
		$this->form = (new Form($this))->open();
		
		return $this->form;
	}
	
	/**
	 * Close active Form.
	 *
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function close() : Form
	{
		return $this->form->close();
	}
	
	public function button(string $label) : Button
	{
		return new Button($label, $this);
	}
	
	public function input() : Input
	{
		return new Input($this);
	}
	
	public function config($key, $default = null)
	{
		return Arr::get($this->config, $key, $default);
	}
	
	/**
	 * Render an Aire view.
	 *
	 * @param $view
	 * @param array $data
	 * @param array $merge_data
	 * @return string
	 */
	public function render($view, array $data = [], array $merge_data = []) : string
	{
		return $this->make($view, $data, $merge_data)->render();
	}
	
	/**
	 * Make a namespaced View.
	 *
	 * @param $view
	 * @param array $data
	 * @param array $merge_data
	 * @return \Illuminate\Contracts\View\View
	 */
	protected function make($view, array $data = [], array $merge_data = []) : View
	{
		return $this->factory->make("aire::{$view}", $data, $merge_data);
	}
}