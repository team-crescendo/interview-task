<?php

namespace App\Services;

use League\Csv\Writer;
use SplTempFileObject;

class CsvService implements Database {
    public function export($models)
    {
        $csv = Writer::createFromFileObject(new SplTempFileObject());

        $csv->insertOne(['userId', 'id', 'title', 'completed']);

        foreach ($models as $model)
        {
            $csv->insertOne($model->toArray());
        }

       return $csv->output("download.csv");
    }
}
