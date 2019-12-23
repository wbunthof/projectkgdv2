<?php


namespace App\Services;

use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;

class AnswerService
{
    protected $answer;

    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    public function index()
    {
        return $this->answer->all();
    }

    public function create(Request $request)
    {

        $attributes = $request->all();
        return $this->answer->create($attributes);
    }

    public function read($id)
    {
        return $this->answer->find($id);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();
        return $this->answer->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->answer->delete($id);
    }

    public function deleteFromVraag($id)
    {
        return $this->answer->deleteFromVraag($id);
    }
}
