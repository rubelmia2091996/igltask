<?php
namespace App\Imports;

use App\Models\Candidate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CandidatesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Extract and format the required data
        $data = $this->extractData($row);
        // Save the extracted data into the Candidate table
        return new Candidate($data);
    }

    private function extractData(array $row)
    {
        return [
            'name' => $this->extractName($row['name']),
            'email' => $this->extractEmail($row['name']),
            'phone_number' => $this->extractPhone($row['name']),
            'experience_year' => 1,
            'company_experience' => $this->extractInstitutes($row['career_summary']),
            'age' => $this->extractAge($row['name']),
        ];
    }

    private function extractName($nameColumn)
    {
        preg_match('/Name:\s*(.+)/i', $nameColumn, $matches);
        return $matches[1] ?? null;
    }

    private function extractEmail($nameColumn)
    {
        preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $nameColumn, $matches);
        return $matches[0] ?? null;
    }

    private function extractPhone($nameColumn)
    {

        preg_match('/\+?\d{1,4}\s\d{3}-\d{3}-\d{4}/', $nameColumn, $matches);
        return $matches[0] ?? null;
    }

    private function extractExperience($experienceColumn)
    {
        preg_match('/Total Experience:\s*(.+)/i', $experienceColumn, $matches);
        return $matches[1] ?? null;
    }

    private function extractInstitutes($careerSummaryColumn)
    {
        $entries = explode("\n", $careerSummaryColumn);
        $institutes = [];
        foreach ($entries as $entry) {
            $parts = explode(':', trim($entry));
            if (count($parts) === 2) {
                $company = trim($parts[0]);
                $roleAndDuration = trim($parts[1]);
                $institutes[$company] = $roleAndDuration;
            }
        }
        return $institutes;
    }


    private function extractAge($nameColumn)
    {
        preg_match('/Age:\s*([\d.]+)/i', $nameColumn, $matches);
        return $matches[1] ?? null;
    }
}
