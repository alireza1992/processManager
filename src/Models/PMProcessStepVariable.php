<?php
/**
 * Created by PhpStorm.
 * User: Unlimited
 * Date: 10/9/2018
 * Time: 9:21 AM
 */

namespace Alireza1992\ProcessManager\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PMProcessStepVariable extends Model
{

    use SoftDeletes;
    protected $table = 'process_step_variables';
    protected $fillable = ['process_step_id', 'name', 'alias', 'description', 'type'];

    public function setAliasAttribute($value)
    {
        $this->attributes['alias'] = str_replace(' ', '_', $value);
    }

    public function process_step()
    {
        return $this->belongsTo(PMProcessStep::class, 'process_step_id');
    }

    public function getAll()
    {
        return self::all();

    }

    public function store($data, $record_id = null)
    {
        if (!empty($record_id)) {
            $record = $this->find($record_id);
        } else {
            $record = new self();
        }
        $record->fill($data->all());
        $record->save();
    }

    public function find($id)
    {
        return self::findOrFail($id);
    }

    public function paginate($data = null)
    {
        return self::when($data->filled('query'), function ($query) use ($data) {
            return $query->where('status_name', 'LIKE', "%{$data['query']}%");
        })->when($data->filled('sort'), function ($query) use ($data) {
            return $query->orderBy('id', $data['sort']);
        })->unless($data->filled('sort'), function ($query) use ($data) {
            return $query->orderBy('id', 'desc');
        })->paginate(20);
    }
}