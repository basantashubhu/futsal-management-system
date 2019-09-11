<?php
namespace App\Traits;

use App\Lib\Exporter\CSVExporter;
use App\Lib\Exporter\JSONExporter;
use App\Lib\Exporter\PDFExporter;

trait ReportGenerator
{

    private function mapData($data, &$fields, $mapPdf = false)
    {
        $dataArr = [];
        foreach ($data as $key => $d) {
            foreach ($fields as $field => &$t) {
                $value = null;
                if (is_object($d) && isset($d->$field)) {
                    $value = $d->$field;
                } elseif (is_array($d) && isset($d[$field])) {
                    $value = $d[$field];
                }

                if (preg_match('/DateRaw/', $t)) {

                } elseif (preg_match('/Date/', $t)) {
                    $value = $value ? newDate($value) : null;
                }
                if ($mapPdf) {
                    if (preg_match('/[=>]$/', $t)) {
                        $value .= substr($t, -1);
                    }
                } else {
                    if (preg_match('/[=>]$/', $t)) {
                        $t = substr($t, 0, -1);
                    }
                }
                $dataArr[$key][$field] = $value;
            }
        }
        $fields = array_map(function ($t) {
            return str_replace('Raw', '', $t);
        }, $fields);
        return $dataArr;
    }

    private function generate($format, $field, $data, $fileName, $mode = '')
    {

        switch (strtolower($format)) {
            case 'csv':
                unset($data['table']);
                return CSVExporter::arrayToCSV($field, $data, $fileName);
                break;
            case 'json':
                unset($data['request']);
                unset($data['table']);
                return JSONExporter::jsonExport($data, $fileName);
                break;
            case 'pdf':
                return PDFExporter::pdfExport($field, $data, $fileName, $mode);
                break;
            default:
                return false;
        }
    }

    public function downloadReportFile($filename)
    {
        $path = storage_path("reports/$filename");
        if (file_exists($path)) {
            return response()->download($path)->deleteFileAfterSend(true);
        }

        abort(404);
    }
}
