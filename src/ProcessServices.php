<?php
/**
 * Created by PhpStorm.
 * User: Unlimited
 * Date: 10/9/2018
 * Time: 9:30 AM
 */

namespace Alireza1992\ProcessManager;


use Alireza1992\ProcessManager\Models\PMProcess;

class ProcessServices
{

    public function all()
    {
        return PMProcess::all();

    }

    public function store($data, $record_id = null)
    {
        if (!empty($record_id)) {
            $record = $this->find($record_id);
        } else {
            $record = new PMProcess();
        }
        $record->fill($data->all());
        $record->save();
    }

    public function find($id)
    {
        return PMProcess::findOrFail($id);
    }

    public function paginate($data = null)
    {
        return PMProcess::when($data->filled('query'), function ($query) use ($data) {
            return $query->where('name', 'LIKE', "%{$data['query']}%");
        })->when($data->filled('sort'), function ($query) use ($data) {
            return $query->orderBy('id', $data['sort']);
        })->unless($data->filled('sort'), function ($query) use ($data) {
            return $query->orderBy('id', 'desc');
        })->paginate(20);
    }


}