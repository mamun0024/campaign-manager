<?php

namespace App\Utils\Traits;

trait HelperTrait
{
    /**
     * Isset or null check of a value.
     *
     * @param mixed $value
     * @return bool
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function emptyCheck($value): bool
    {
        if (isset($value) && ($value != null) && ($value != '')) {
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }

    /**
     * Application Response structure.
     *
     * @param bool $status Response Status.
     * @param int $code Response code.
     * @param string $message Response message.
     * @param array|null $data Response array data.
     * @param string|null $details Response details.
     * @return array Final response data.
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    public function responseData(bool $status, int $code, string $message, $data = null, $details = null): array
    {
        $response = [
            'status'  => $status,
            'code'    => $code,
            'message' => $message
        ];

        if ($this->emptyCheck($details)) {
            $response['data'] = [
                'details' => $details
            ];
        } else {
            $response['data'] = $data;
        }

        return $response;
    }
}
