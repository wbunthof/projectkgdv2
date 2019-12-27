<?php


namespace App\Services;

use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;

class QuestionService
{
    protected $question;

    public function __construct(QuestionRepository $question)
    {
        $this->question = $question;
    }

    public function index()
    {
        return $this->question->all();
    }

    public function create(Request $request)
    {
        $attributes = $request->all();

        return $this->question->create($attributes);
    }

    public function read($id)
    {
        return $this->question->find($id);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();

        // if the attributes array is made of keys with the id in the name replace with keys without the id
        if (array_key_exists('tekst' . $id, $attributes))
        {
            $attributes = array_combine(str_replace($id, '', array_keys($attributes)), $attributes);
        }

        return $this->question->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->question->delete($id);
    }
}
