<?php

namespace App\Repositories\AdminRepository;

use App\Models\User;

class AdminRepository implements AdminRepositoryInterface
{
  public function update(User $admin, array $data): bool
  {
    return $admin->update($data);
  }
}
