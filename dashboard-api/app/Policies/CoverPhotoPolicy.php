<?php

namespace App\Policies;

use App\Models\About;
use App\Models\CoverPhoto;
use App\Models\User;
use Illuminate\Auth\Access\Response;


class CoverPhotoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CoverPhoto $coverPhoto): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CoverPhoto $coverPhoto): bool    {

        $about = About::where('id', $coverPhoto->about_id)->get();
        return $about[0]->user()->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CoverPhoto $coverPhoto): bool    {

        $about = About::where('id', $coverPhoto->about_id)->get();
        return $this->update($user, $about);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CoverPhoto $coverPhoto): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CoverPhoto $coverPhoto): bool
    {
        //
    }
}
