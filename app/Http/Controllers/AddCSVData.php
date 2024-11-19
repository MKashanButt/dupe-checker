<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicareId;
use Illuminate\Support\Facades\DB;

class AddCSVData extends Controller
{
    public function uploadCSV(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $filePath = $file->getRealPath();

        $fileHandle = fopen($filePath, 'r');
        $header = fgetcsv($fileHandle); // Skip the header row

        // Begin database transaction
        DB::beginTransaction();

        try {
            $newRecords = 0; // Counter for new records

            while (($row = fgetcsv($fileHandle)) !== false) {
                $rawMedicareId = trim($row[0]); // Original data from CSV
                $medicareId = $this->extractMedicareId($rawMedicareId); // Clean the medicare_id

                if (!empty($medicareId) && !MedicareId::where('medicare_id', $medicareId)->exists()) {
                    MedicareId::create([
                        'medicare_id' => $medicareId,
                    ]);
                    $newRecords++;
                }
            }

            DB::commit();
            fclose($fileHandle);

            return redirect()->back()->with('success', "$newRecords new record(s) uploaded successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            fclose($fileHandle);

            return redirect()->back()->withErrors('Error uploading CSV: ' . $e->getMessage());
        }
    }

    /**
     * Extracts the medicare_id from a raw string.
     *
     * @param string $rawMedicareId
     * @return string|null
     */
    private function extractMedicareId(string $rawMedicareId): ?string
    {
        preg_match('/^[^\(]+/', $rawMedicareId, $matches);
        return isset($matches[0]) ? trim($matches[0]) : null;
    }
}
