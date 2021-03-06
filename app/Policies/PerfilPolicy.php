<?php

namespace App\Policies;

use App\Perfil;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PerfilPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Perfil  $perfil
     * @return mixed
     */
    public function view(User $user, Perfil $perfil)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Perfil  $perfil
     * @return mixed
     */
    public function update(User $user, Perfil $perfil)
    {
        //Revisa que solo el usuario registrado pueda update el perfil

        return $user->id===$perfil->user_id;

        //Si el ID del usuario logeado, es igual al id del usuario
        //dueño del perfil, es el mismo usuario.

    }
    public function edit(User $user, Perfil $perfil)
    {
        //Revisa que solo el usuario registrado pueda update el perfil

        return $user->id===$perfil->user_id;

        //Si el ID del usuario logeado, es igual al id del usuario
        //dueño del perfil, es el mismo usuario.

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Perfil  $perfil
     * @return mixed
     */
    public function delete(User $user, Perfil $perfil)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Perfil  $perfil
     * @return mixed
     */
    public function restore(User $user, Perfil $perfil)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Perfil  $perfil
     * @return mixed
     */
    public function forceDelete(User $user, Perfil $perfil)
    {
        //
    }
}
