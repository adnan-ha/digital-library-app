<?php

namespace App\Repositories\AdminRepository;

use App\Models\User;

interface AdminRepositoryInterface
{
  public function update(User $admin, array $data): bool;
}
