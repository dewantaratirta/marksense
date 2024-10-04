<?php

namespace App\Repositories\Eloquent;

use App\Models\Wallet;
use App\Repositories\WalletRepositoryInterface;
use TimWassenburg\RepositoryGenerator\Repository\BaseRepository;

/**
 * Class WalletRepository.
 */
class WalletRepository extends BaseRepository implements WalletRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Wallet $model
     */
    public function __construct(Wallet $model)
    {
        parent::__construct($model);
    }
}
