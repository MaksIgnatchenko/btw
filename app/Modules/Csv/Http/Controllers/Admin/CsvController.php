<?php

namespace App\Modules\Csv\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Csv\Exceptions\WrongGeneratorCsvType;
use App\Modules\Csv\Generator\DateDto;
use App\Modules\Csv\Generator\Generator;
use App\Modules\Csv\Requests\GenerateCsvRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CsvController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return view('csv.index');
    }

    public function show(GenerateCsvRequest $request)
    {
        $type = $request->get('type');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $dateDto = new DateDto($dateFrom, $dateTo);

        $generator = new Generator($type, $dateDto);
        try {
            $csvArray = $generator->getCsvDataGenerator()->generate();
        } catch (WrongGeneratorCsvType $exception) {
            // TODO влепить обработку
            return;
        }
        // TODO вынести в generate???
        Excel::create($generator->getName(), function ($excel) use ($csvArray, $type) {
            $excel->sheet($type, function ($sheet) use ($csvArray) {
                // Sheet manipulation
                $sheet->fromArray($csvArray);
            });
        })->download('csv');
    }
}
