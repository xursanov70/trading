<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Models\ProductVariant;
use App\Models\Report;
use App\Models\User;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function saleProduct(Request $request, int $productVariantId)
    {
        $productVariant = ProductVariant::with('product')->where('id', $productVariantId)->first();
        $products = $productVariant->product;
        foreach ($products as $product) {
        }
        $date = date('Y-m-d');
        $productCount = $request->count ?? 1;
        $report =  Report::where('sale_date', $date)->orderBy('id', 'desc')->first();
        if (!$report) {
            Report::create([
                'product_name' => $product->product_name,
                'product_count' => $productCount,
                'original_price' => $productVariant->price,
                'sale_price' => $productVariant->sale_price,
                'benefit' => $productCount * ($productVariant->sale_price - $productVariant->price),
                'sale_date' => $date,
            ]);
        }
        if ($report) {
            if ($report->product_name == $product->product_name) {
                $report->product_count += $productCount;
                $report->benefit += $productCount * ($report->sale_price - $report->original_price);
                $report->save();
            } elseif ($report->product_name != $product->product_name) {
                Report::create([
                    'product_name' => $product->product_name,
                    'product_count' => $productCount,
                    'original_price' => $productVariant->price,
                    'sale_price' => $productVariant->sale_price,
                    'benefit' => $productCount * ($productVariant->sale_price - $productVariant->price),
                    'sale_date' => $date,
                ]);
            }
            return response()->json(["message" => "Mahsulot sotilgani tasdiqlandi!"], 201);
        }
        $count = $request->count;
        $productVariant->count -= $count;
        $productVariant->save();
        return response()->json(["message" => "Mahsulot sotilgani tasdiqlandi!"], 201);
    }

    public function report()
    {
        $startDate = request('startDate');
        $endDate = request('endDate');

        $writer = WriterEntityFactory::createXLSXWriter();
        $filePath = 'storage/reports/' . date('Y_m_d_H_i_s') . 'report.xlsx';
        $writer->openToFile($filePath);
        $reports = Report::whereBetween('sale_date', [$startDate, $endDate])->get();
        $writer->addRow(WriterEntityFactory::createRowFromArray([
            'Mahsulot id raqami',
            'Mahsulot nomi',
            'Sotilgan mahsulot soni',
            'Mahsulot haqiqiy narxi',
            'Mahsulot sotuv narxi',
            'Mahsulotdan tushgan foyda',
            'Mahsulot sotuv sanasi',
        ]));
        $data = [];
        
        foreach ($reports as $report) {
            $data[] = [
                'id' => $report->id,
                'product_name' => $report->product_name,
                'product_count' => $report->product_count,
                'original_price' => $report->original_price,
                'sale_price' => $report->sale_price,
                'benefit' => $report->benefit,
                'sale_date' => $report->sale_date,
            ];
        }
        foreach ($data as $row) {
            $rowFromValues = WriterEntityFactory::createRowFromArray($row);
            $writer->addRow($rowFromValues);
        }
        $writer->close();
        return $filePath;
    }


    public function getSaleProduct()
    {
        $reports = Report::paginate(15);
        Cache::put('reports', $reports);
        return $reports;
    }

    public function delete()
    {
        $directory = 'reports';

$files = Storage::disk('public')->files($directory);

foreach ($files as $file) {
    Storage::disk('public')->delete($file);
}

return response()->json(['message' => 'Excel fayllar tozalandi']);

    }
}
