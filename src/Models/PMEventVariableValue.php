<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/17/18
 * Time: 4:35 PM
 */

namespace Alireza1992\ProcessManager\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PMEventVariableValue extends Model
{
    protected $table = 'event_variable_values';
    protected $guarded = [];
    use SoftDeletes;


    public function setAliasAttribute($value)
    {
        $this->attributes['alias'] = str_replace(' ', '_', $value);
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

}