<?php
/**
 * Created by PhpStorm.
 * User: Unlimited
 * Date: 10/9/2018
 * Time: 9:21 AM
 */

namespace Processmanager\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PMProcess extends Model
{
    protected $table = 'processes';
    protected $fillable = ['name', 'alias', 'model'];
    use SoftDeletes;

    public function setAliasAttribute($value)
    {
        $this->attributes['alias'] = str_replace(' ', '_', $value);
    }

    public function steps()
    {
        return $this->hasMany(PMProcessStep::class, 'process_id', 'id');
    }

    public function notification()
    {
        return $this->belongsTo(PMEventNotification::class);
    }

    public function getPluck()
    {
        return self::pluck('model', 'id');
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
            return $query->where('name', 'LIKE', "%{$data['query']}%");
        })->when($data->filled('sort'), function ($query) use ($data) {
            return $query->orderBy('id', $data['sort']);
        })->unless($data->filled('sort'), function ($query) use ($data) {
            return $query->orderBy('id', 'desc');
        })->paginate(20);
    }
}