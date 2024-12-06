<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Jadwal;
use Illuminate\Auth\Access\HandlesAuthorization;

class JadwalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->can('view_any_jadwal::dokter');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, Jadwal $jadwal): bool
    {
        return $admin->can('view_jadwal::dokter');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->can('create_jadwal::dokter');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Jadwal $jadwal): bool
    {
        return $admin->can('update_jadwal::dokter');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Jadwal $jadwal): bool
    {
        return $admin->can('delete_jadwal::dokter');
    }

    /**
     * Determine whether the admin can bulk delete.
     */
    public function deleteAny(Admin $admin): bool
    {
        return $admin->can('delete_any_jadwal::dokter');
    }

    /**
     * Determine whether the admin can permanently delete.
     */
    public function forceDelete(Admin $admin, Jadwal $jadwal): bool
    {
        return $admin->can('force_delete_jadwal::dokter');
    }

    /**
     * Determine whether the admin can permanently bulk delete.
     */
    public function forceDeleteAny(Admin $admin): bool
    {
        return $admin->can('force_delete_any_jadwal::dokter');
    }

    /**
     * Determine whether the admin can restore.
     */
    public function restore(Admin $admin, Jadwal $jadwal): bool
    {
        return $admin->can('restore_jadwal::dokter');
    }

    /**
     * Determine whether the admin can bulk restore.
     */
    public function restoreAny(Admin $admin): bool
    {
        return $admin->can('restore_any_jadwal::dokter');
    }

    /**
     * Determine whether the admin can replicate.
     */
    public function replicate(Admin $admin, Jadwal $jadwal): bool
    {
        return $admin->can('replicate_jadwal::dokter');
    }

    /**
     * Determine whether the admin can reorder.
     */
    public function reorder(Admin $admin): bool
    {
        return $admin->can('reorder_jadwal::dokter');
    }
}
