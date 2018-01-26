<?php
namespace App\Models;

use App\Models\Model;
use Illuminate\Support\Facades\Config;
use Admin as Admin1;

class OpLog extends Model
{

    protected $table = 'admin_op_log';

    /**
     * 与用户的一对一关系
     *
     * @return Illuminate/Database/Eloquent/Relations/HasOne
     */
    public function user()
    {
        return $this->hasOne(Config::get('auth.providers.users.model'), 'id', 'user_id');
    }

    public static function addOpLog($url, $controller, $className, $classMethod, $method, $realMethod, $description = '', $params = [])
    {
        unset($params[static::CREATED_AT]);
        unset($params[static::UPDATED_AT]);

        $log['user_id'] = Admin1::userId();
        $log['url'] = $url;
        $log['controller'] = $controller;
        $log['class_name'] = $className;
        $log['class_method'] = $classMethod;
        $log['method'] = $method;
        $log['real_method'] = $realMethod;
        $log['description'] = $description;
        $log['parameter'] = json_encode($params);
        parent::create($log);
    }

}
