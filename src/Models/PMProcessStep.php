<?php
/**
 * Created by PhpStorm.
 * User: Unlimited
 * Date: 10/9/2018
 * Time: 9:21 AM
 */

namespace Alireza1992\ProcessManager\Models;


use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PMProcessStep extends Model
{

    use SoftDeletes;
    protected $table = 'process_steps';
    protected $fillable = ['process_id', 'name', 'priority', 'alias', 'presenter_group_id', 'group_id', 'group_mode'];

    public function setAliasAttribute($value)
    {
        $this->attributes['alias'] = str_replace(' ', '_', $value);
    }

    public function process()
    {
        return $this->belongsTo(PMProcess::class, 'process_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'presenter_group_id');
    }


    public function statuses()
    {
        return $this->hasMany(PMProcessStepStatus::class, 'process_step_id', 'id');
    }

    public function variables()
    {
        return $this->hasMany(PMProcessStepVariable::class, 'process_step_id', 'id');
    }

    public function getGroupModeNameAttribute()
    {
        return $this->group_mode == '0' ? 'ادمین' : 'کاربر';
    }


    public function getPluck()
    {
        return self::pluck('name', 'id');
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