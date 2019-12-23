<?php


namespace App\Repositories;

use App\Antwoord;

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
        return $this->answer->find($id)->delete();
    }

    public function deleteFromVraag($id)
    {
        return $this->answer->where('vraag_id', $id)->delete();
    }
}
