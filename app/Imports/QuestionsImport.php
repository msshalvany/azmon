<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;

class QuestionsImport implements ToModel
{
    protected $exame_id;

    public function __construct($exame_id)
    {
        $this->exame_id = $exame_id;
    }

    public function model(array $row)
    {
        return new Question([
            'exame_id' => $this->exame_id,
            'text' => $row[0],
            'chose1' => $row[1],
            'chose2' => $row[2],
            'chose3' => $row[3],
            'chose4' => $row[4],
            'answer' => $row[5],
            'level' => $row[6],
            'fasl' => $row[7],
        ]);
    }
}

