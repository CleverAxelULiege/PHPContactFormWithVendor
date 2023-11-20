<?php

namespace App\Validation;

class OldData{
    private ?array $oldData;

    public function __construct(array $oldData = null)
    {
        $this->oldData =$oldData;
    }

    public function __invoke(string $key, string $default = null, $rawValue = false)
    {
        $data = $this->oldData[$key] ?? "";

        if($default != null && $data == ""){
            $data = $default;
        }
        
        if($rawValue){
            return $data;
        }

        echo htmlspecialchars($data);
    }
}