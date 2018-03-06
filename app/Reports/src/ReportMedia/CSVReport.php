<?php

namespace App\Reports\src\ReportMedia;

use App, Closure;
use App\Reports\src\ReportGenerator;
use League\Csv\Writer;
use SplTempFileObject;

class CSVReport extends ReportGenerator
{
    protected $showMeta = false;
    protected $showHeader = true;

    public function download($filename)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=Reporte.csv');
        $csv = Writer::createFromFileObject(new SplTempFileObject());

        if ($this->showMeta) {
            foreach ($this->headers['meta'] as $key => $value) {
                $csv->insertOne([$key, $value]);
            }
            $csv->insertOne(['']);
        }

        $ctr = 1;
        $chunkRecordCount = ($this->limit == null || $this->limit > 50000) ? 50000 : $this->limit + 1;

        if ($this->showHeader) {
            $columns = array_keys($this->columns);
            array_unshift($columns,"Nro");
            $csv->insertOne($columns);
        }

        $this->query->chunk($chunkRecordCount, function($results) use(&$ctr, $csv) {
            foreach ($results as $result) {
                if ($this->limit != null && $ctr == $this->limit + 1) return false;
                if ($this->withoutManipulation) {
                    $csv->insertOne($result->toArray());
                } else {
                    $formattedRows = $this->formatRow($result);
                    array_unshift($formattedRows, $ctr);
                    $csv->insertOne($formattedRows);
                }
                $ctr++;
            }

            if ($this->applyFlush) flush();
        });

        $csv->output();
    }

    private function formatRow($result)
    {
        $rows = [];
        foreach ($this->columns as $colName => $colData) {
            if (is_object($colData) && $colData instanceof Closure) {
                $generatedColData = $colData($result);
            } else {
                $generatedColData = $result->$colData;
            }
            $displayedColValue = $generatedColData;
            if (array_key_exists($colName, $this->editColumns)) {
                if (isset($this->editColumns[$colName]['displayAs'])) {
                    $displayAs = $this->editColumns[$colName]['displayAs'];
                    if (is_object($displayAs) && $displayAs instanceof Closure) {
                        $displayedColValue = $displayAs($result);
                    } elseif (!(is_object($displayAs) && $displayAs instanceof Closure)) {
                        $displayedColValue = $displayAs;
                    }
                }
            }

            array_push($rows, $displayedColValue);
        }

        return $rows;
    }
}