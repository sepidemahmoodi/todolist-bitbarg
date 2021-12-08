<?php 
namespace App\traits;

use Illuminate\Support\Facades\Validator;

trait ValidationTrait {
    public $errors;

    public function validateRules($data, $rules) {
        $validator = Validator::make($data, $rules);
        if($validator->fails()) {
            $this->errors = $validator->messages()->all();
            return false;
        }
        return true;
    }

    public function validationErrors() {
        return $this->errors;
    }
}
