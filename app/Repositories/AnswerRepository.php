<?php


namespace App\Repositories;

use App\Antwoord;
use Exception;

class AnswerRepository
{
    protected $answer;

    public function __construct(Antwoord $answer)
    {
        $this->answer = $answer;
    }

    public function create($attributes)
    {
        return $this->answer->create($attributes);
    }

    public function all()
    {
        return $this->answer->all();
    }

    public function find($id)
    {
        return $this->answer->find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->answer->find($id)->update($attributes);
    }

    public function delete($id)
    {
        try {
            return $this->answer->find($id)->delete();
        } catch (Exception $e) {
            return $e;
        }
    }

    public function deleteFromVraag($id)
    {
        try {
            return $this->answer->where('vraag_id', $id)->delete();
        } catch (Exception $e) {
            return $e;
        }
    }

    public function undelete($id)
    {
        return $this->answer->withTrashed()->find($id)->restore();
    }
}
