<?php


namespace App\Services;


use App\Repositories\DisciplineRepository;
use App\Repositories\LedenRepository;
use Illuminate\Http\Request;


class DisciplineService
{

    protected $disciplinerepository;
    protected $ledenrepository;

    public function __construct(DisciplineRepository $disciplineRepository, LedenRepository $ledenRepository)
    {
        $this->disciplinerepository = $disciplineRepository;
        $this->ledenrepository = $ledenRepository;
    }

    public function index()
    {
        return $this->disciplinerepository->all();
    }

    public function create(Request $request)
    {
        $attributes = $request->all();

        return $this->disciplinerepository->create($attributes);
    }

    public function read($id)
    {
        return $this->disciplinerepository->find($id);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();

        // if the attributes array is made of keys with the id in the name, replace the keyname without id
        if (array_key_exists('naam' . $id, $attributes))
        {
            $attributes = array_combine(str_replace($id, '', array_keys($attributes)), $attributes);
        }

        return $this->disciplinerepository->update($id, $attributes);
    }

    public function delete($id)
    {
//        if (is_a($ids, 'Illuminate\Support\Collection')){
//            foreach ($ids as $id)
//            {
//                $this->answer->permanentDelete($id->id);
//            }
//        } else {
//            $this->answer->permanentDelete($ids);
//        }

        foreach ($this->disciplinerepository->find($id)->leden()->get() as $lid){
            $lid->formonderdelendiscipline_id = null;
            $lid->save();
        }

        return $this->disciplinerepository->delete($id);
    }
}
