<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/17/18
 * Time: 3:11 PM
 */
namespace Processmanager\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PMEventNotification extends Model
{
    protected $table = 'event_notification';
    protected $fillable = ['process_id', 'step_id', 'status_id', 'target', 'body'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function step()
    {
        return $this->hasOne(PMProcessStep::class, 'id', 'step_id');
    }

    public function process()
    {
        return $this->hasOne(PMProcess::class, 'id', 'process_id');
    }

    public function getPluck()
    {
        return self::pluck('model', 'id');
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
        return $record;
    }

    public function find($id)
    {
        return self::findOrFail($id);
    }

    public function paginate($data = null)
    {
        return self::when($data->filled('query'), function ($query) use ($data) {
            return $query->where('body', 'LIKE', "%{$data['query']}%");
        })->when($data->filled('sort'), function ($query) use ($data) {
            return $query->orderBy('id', $data['sort']);
        })->unless($data->filled('sort'), function ($query) use ($data) {
            return $query->orderBy('id', 'desc');
        })->paginate(20);
    }
}