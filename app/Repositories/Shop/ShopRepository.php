<?php
/**
 * Created by PhpStorm.
 * User: molap
 * Date: 3/18/2020
 * Time: 11:17 AM
 */

namespace App\Repositories\Shop;


use App\Models\Backend\Shop\Shop;
use App\Repositories\BaseRepository;
use App\Repositories\Shop\ShopRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ShopRepository extends BaseRepository implements ShopRepositoryInterface
{

    public function __construct(Shop $shop)
    {
        parent::__construct($shop);
    }


}
