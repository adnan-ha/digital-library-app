<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\AdminRepository\AdminRepositoryInterface;

class AdminService
{
  private AdminRepositoryInterface $adminRepository;

  public function __construct(AdminRepositoryInterface $adminRepository)
  {
    $this->adminRepository = $adminRepository;
  }

  public function update(User $admin, array $data): bool
  {
    $data['password'] = $data['password'] ?? $admin->password;

    return $this->adminRepository->update($admin, $data);
  }
}
