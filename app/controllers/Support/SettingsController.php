<?php

class SettingsController extends BaseController {

	public $restful = true;

	/**
	* Shows the settings
	*
	* @access	public
	*/
	public function getIndex() {
		// get all the settings and send them to the view
		$settings = Setting::all();

		foreach ($settings as $setting) {
			$data[$setting->name] = $setting->value;
		}

		// cast the array as an object, for ease of access
		$data = (object) $data;

		Load::markdown();
		
		return View::make('support.settings.index')->with('setting', $data)->with('title', 'Configuraion');
	}

	/**
	* Updates settings
	*
	* @access	public
	*/
	public function putIndex() {
		$settings = array(
			'per_page'					=> Input::get('per_page'),
			'smtp_host'					=> Input::get('smtp_host'),
			'smtp_port'					=> Input::get('smtp_port'),
			'smtp_user'					=> Input::get('smtp_user'),
			'smtp_pass'					=> Input::get('smtp_pass'),
			'smtp_name'					=> Input::get('smtp_name'),
			'smtp_crypto'				=> Input::get('smtp_crypto'),
			'system_message_title'		=> Input::get('system_message_title'),
			'system_message'			=> Input::get('system_message')
		);

		foreach ($settings as $setting => $value) {
			Setting::where('name', '=', $setting)->update(array('value' => $value, 'updated_at' => DB::raw('NOW()')));
		}

		return Redirect::to('support/settings')->with('notification', 'settings_success');
	}
}