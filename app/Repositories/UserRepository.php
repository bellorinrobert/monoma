<?php 
/**
 * Summary of namespace App\Repositories
 * @author Robert Bellorin <bellorinrobert@gmail.com>
 * @date 2024-09-15
 * 
 */
namespace App\Repositories;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements RepositoryInterface {
    /**
     * Summary of getAll
     * @return \Illuminate\Support\Collection
     */
    public function getAll() : Collection {

        return User::all();

    }
    /**
     * Summary of getById
     * @param mixed $id
     * @return mixed
     */
    public function getById($id): mixed {

        return User::find(id:$id);

    }
    /**
     * Summary of create
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed {

        return User::create($data);

    }

    public function update($id, array $data): mixed {

        return null;
    }
    /**
     * Summary of delete
     * @param mixed $id
     * @return bool
     */
    public function delete($id): bool {

        return false;
    }

    public function getByUserName($name) : User|null {

        return User::where(
            column: 'username'
            , operator: $name)
                ->first();
    }

}