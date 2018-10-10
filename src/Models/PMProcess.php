<?php
/**
 * Created by PhpStorm.
 * User: Unlimited
 * Date: 10/9/2018
 * Time: 9:21 AM
 */

namespace Alireza1992\ProcessManager\Models;


use Illuminate\Database\Eloquent\Model;

class PMProcess extends Model
{
    protected $table = 'processes';
    protected $fillable = ['name', 'alias', 'model'];
}