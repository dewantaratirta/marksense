<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use TimWassenburg\RepositoryGenerator\Repository\BaseRepository;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public RoleRepository $roleRepository;

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model, RoleRepository $roleRepository)
    {
        parent::__construct($model);
        $this->roleRepository = $roleRepository;
    }

    public function create(array $attributes): Model
    {
        $this->model = $this->model->create($attributes);
        $this->model->refresh();

        if (isset($attributes['role'])) {
            $this->updateRoleByIdRole($attributes['role']);
        }

        if (isset($attributes['password'])) {
            $this->updatePassword($attributes['password']);
        }

        if (isset($attributes['avatar']) && !empty($attributes['avatar'])) {
            $this->uploadAvatar($attributes['avatar']);
        }

        return $this->model;
    }

    public function update(int $id, array $attributes): bool
    {
        /**
         * @var User $model
         */
        $model = $this->find($id);
        $old_model = $model;

        $this->model = &$model;
        $model->update($attributes);

        if (isset($attributes['role'])) {
            $this->updateRoleByIdRole($attributes['role']);
        }

        if (isset($attributes['password'])) {
            $this->updatePassword($attributes['password']);
        }

        if (isset($attributes['avatar']) && !empty($attributes['avatar'])) {
            $this->uploadAvatar($attributes['avatar']);
        }

        return true;
    }

    public function delete(int $id)
    {
        DB::beginTransaction();
        $model = $this->model::query()->find($id);
        $result =  $model->delete();

        if ($model->dokter) $model->dokter->delete();

        DB::commit();
        return $result;
    }


    /**
     * Updates the role of a user by syncing the roles with the given role ID.
     *
     * @param int $id_role The ID of the role to update.
     * @return bool Always returns true.
     */
    public function updateRoleByIdRole(int $id_role): bool
    {
        $role = $this->roleRepository->find($id_role);
        $this->model->syncRoles($role->name);
        return true;
    }


    /**
     * Updates the password of the model with the given password.
     *
     * @param string $password The new password to set.
     * @return bool Returns true if the password was successfully updated, false otherwise.
     */
    public function updatePassword(string $password): bool
    {
        $this->model->password = (string) $this->model->generatePassword($password);
        return $this->model->save();
    }


    /**
     * Returns the avatar of the model.
     * 
     * @return string The URL of the avatar.
     */
    function getAvatar(): string
    {
        return $this->model->getFirstMediaUrl('avatar');
    }


    /**
     * Uploads an avatar to the model.
     * 
     * @param \Illuminate\Http\UploadedFile $avatar The avatar to upload.
     * @return \Spatie\MediaLibrary\MediaCollections\Models\Media The uploaded media.
     */
    public function uploadAvatar(\Illuminate\Http\UploadedFile $avatar): \Spatie\MediaLibrary\MediaCollections\Models\Media
    {
        /**
         * @var User $old_model
         */
        $old_model = $this->model;
        $collection = $old_model->getMedia('avatar');
        $count = $collection->count();

        # delete previous image
        if ($count > 0) {
            $old_model->getMedia('avatar')->first()->delete();
        }
        # upload
        $result =  $old_model->addMedia($avatar)
            ->toMediaCollection('avatar', 'uploads');
        return $result;

    }
}
