<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Trait\HasSelectTrait;
use Spatie\Permission\Models\Role;
use App\Repositories\RoleRepositoryInterface;
use TimWassenburg\RepositoryGenerator\Repository\BaseRepository;

/**
 * Class RoleRepository.
 */
class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
