<?php
namespace App\Models;

use App\Models\Model;
use Request;
use Illuminate\Support\Facades\Config;
use Admin as AdminU;

class LoginLog extends Model
{

    protected $table = 'admin_login_log';

    /**
     * 与用户的一对一关系
     *
     * @return Illuminate/Database/Eloquent/Relations/HasOne
     */
    public function user()
    {
        return $this->hasOne(Config::get('auth.providers.users.model'), 'id', 'user_id');
    }

    public static function addLiginLog()
    {
        $log['user_id'] = AdminU::userId();
        $log['ips'] = implode(",", Request::getClientIps());
        $log['address'] = '';
        parent::create($log);
    }

}
