<?php
/**
 * Created by PhpStorm.
 * User: molap
 * Date: 3/18/2020
 * Time: 11:17 AM
 */

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
