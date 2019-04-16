<?php 
namespace App\Helpers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;


trait ActionTypeManager 
{
    public function getActionType(array $request) :string
    {
        return $this->determineType($request);
    }

    private function determineType(array $requestParams) :string
    {
            try {
                return Crypt::decrypt(@$requestParams['action_type']);
            } catch (DecryptException $e) {
                return abort(419);
            }
    }


}

