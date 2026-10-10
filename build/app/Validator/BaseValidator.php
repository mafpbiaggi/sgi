<?php
class BaseValidator
{
    public function sanitizeFields(array $data)
    {
        foreach ($data as $field => $value){
            $trimmed = trim($value);

            if ($field === 'email') {
                $sanitized = mb_strtolower($trimmed);
        
            } else {
                $sanitized = mb_strtoupper($trimmed);
            }
            $data[$field] = $sanitized;
        }

        return $data;
    }
}
