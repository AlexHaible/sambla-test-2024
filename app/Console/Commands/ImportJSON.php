<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ImportJSON extends Command
{
    protected $signature = 'import:json';
    protected $description = 'Import data from JSON file';

    public function handle()
    {
        $json = Storage::disk('json')->get('webform_data.json'); // Update the path as needed
        $data = json_decode($json, true);

        foreach ($data as $item) {
            // Skip deleted entries
            if ($item['id'] === 'DELETED') {
                Log::channel('invalid_data')->warning('Deleted data entry', $item);
                continue;
            }

            // Convert and validate data
            $email = filter_var($item['email'], FILTER_VALIDATE_EMAIL) ? $item['email'] : null;
            $ssn = $this->convertToString($item['ssn']);
            $phone = $this->convertToPhone($item['phone']);
            $firstName = is_string($item['firstname']) ? $item['firstname'] : null;
            $lastName = is_string($item['lastname']) ? $item['lastname'] : null;
            $dob = $this->convertToDate($item['dob']);
            $salary = $this->convertToDecimal($item['salary']);
            $employmentFrom = $this->convertToDate($item['employmentfrom']);
            $employmentTo = $this->convertToDate($item['employmentto']);
            $currentlyWorking = filter_var($item['currentlyworking'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

            // Log invalid data
            if (is_null($email) || is_null($ssn) || is_null($phone) || is_null($firstName) || is_null($lastName) || is_null($dob) || is_null($salary) || is_null($employmentFrom) || is_null($currentlyWorking)) {
                Log::channel('invalid_data')->warning('Invalid data entry', $item);
            }

            Employee::updateOrCreate(
                ['email' => $email],
                [
                    'ssn' => $ssn,
                    'phone' => $phone,
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'dob' => $dob,
                    'salary' => $salary,
                    'employmentFrom' => $employmentFrom,
                    'employmentTo' => $employmentTo,
                    'currentlyWorking' => $currentlyWorking
                ]
            );
        }

        $this->info('Data imported successfully!');
    }

    private function convertToString($value)
    {
        return is_numeric($value) ? (string)$value : null;
    }

    private function convertToPhone($value)
    {
        // Assuming phone numbers should be in the format +XXXXXXXXXXX (international format)
        return preg_match('/^\+\d{10,15}$/', $value) ? $value : null;
    }

    private function convertToDate($value)
    {
        // Validate date in 'Y-m-d' format
        $d = \DateTime::createFromFormat('Y-m-d', $value);
        return $d && $d->format('Y-m-d') === $value ? $value : null;
    }

    private function convertToDecimal($value)
    {
        return is_numeric($value) ? (float)$value : null;
    }
}
