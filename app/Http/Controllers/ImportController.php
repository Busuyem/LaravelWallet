<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Import;
use App\Imports\DataImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importData(Request $request)
    {
        try{
            $validateImportData = $this->validate($request, [
                'file' => 'required|mimes:xlsx'
            ]);

            if($request->has('file')){

                $file = $request->file('file');

                Excel::import(new DataImport, $file);

                //$getImportedData = Import::get('state')->toArray();

                $lagosData = Import::where('state', 'Lagos')->pluck('lga');
                $ogunData = Import::where('state', 'Ogun')->pluck('lga');

                //return response()->json($importedData);
                return response()->json([
                    'status_code' => 201,
                    'message' => 'Data imported successfully',
                    'data' => [
                        'Lagos'=>$lagosData,
                        'Ogun' => $ogunData
                    ]
                ]);

            }else{
                return response()->json([
                    'status_code' => 500,
                    'message' => 'No file selected'
                ]);
            }

        }catch(Throwable $e){
            return response()->json([
                'status_code' => 422,
                'message' => 'file failed to be uploaded',
                'error' => $e->getMessage()
            ]);
        }

    }
}
