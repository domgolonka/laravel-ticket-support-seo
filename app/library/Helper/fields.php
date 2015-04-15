<?php

class Fields {

	/**
	* Creates the members in each department
	*
	* @param	object	$depart     The department in question
	* @access	public
	*/
	public static function members($depart = null) {
		// if no speicfic department is called, use all departments
		if (empty($depart)) {
			$depart = Department::all();
		}

		// start with empty field
		$field		= '<option></option>';

		// loop through each department to form groups
		foreach ($depart as $department) {
			// get the members of THIS department
			$members	= Department::find($department->id)->user()->where('status', 'active')->get();

			// start the group
			$field .= '<optgroup label="' . $department->name . '">';

			// fill the group
			foreach ($members as $member) {
				$field .= '<option value="' . $member->id . '">' . $member->firstname . ' ' . $member->lastname . '</option>';
			}

			// end the group
			$field .= '</optgroup>';
		}

		// rinse, repeat, then show
		echo $field;
	}

	/**
	* Creates/Generates all the departments in the model
	*
	* @access	public
	*/
	public static function departments() {
		// the field starts empty
		$field = '<option></option>';

		$depart = Department::all();

		foreach($depart as $department) {
			$field .= '<option value="' . $department->id . '">' . $department->name . '</option>';
		}
		
		// no need to return
		echo $field;
	}

	
}