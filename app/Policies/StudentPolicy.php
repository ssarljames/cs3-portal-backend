<?php

namespace App\Policies;

use App\Models\Student;
use App\User;
use App\UserPermission;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class StudentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any students.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->permissions()->permits(UserPermission::STUDENTS, UserPermission::VIEWANY)->count() > 0;
    }

    /**
     * Determine whether the user can view the student.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Student  $student
     * @return mixed
     */
    public function view(User $user, Student $student)
    {

        Log::info($student->id);

        return $user->permissions()->permits(UserPermission::STUDENTS, UserPermission::VIEW)->count() > 0;
    }

    /**
     * Determine whether the user can create students.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->permissions()->permits(UserPermission::STUDENTS, UserPermission::CREATE)->count() > 0;
    }

    /**
     * Determine whether the user can update the student.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Student  $student
     * @return mixed
     */
    public function update(User $user, Student $student)
    {
        return $user->permissions()->permits(UserPermission::STUDENTS, UserPermission::UPDATE)->count() > 0;
    }

    /**
     * Determine whether the user can delete the student.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Student  $student
     * @return mixed
     */
    public function delete(User $user, Student $student)
    {
        return $user->permissions()->permits(UserPermission::STUDENTS, UserPermission::DELETE)->count() > 0;
    }

    /**
     * Determine whether the user can restore the student.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Student  $student
     * @return mixed
     */
    public function restore(User $user, Student $student)
    {
        return $user->permissions()->permits(UserPermission::STUDENTS, UserPermission::RESTORE)->count() > 0;
    }

    /**
     * Determine whether the user can permanently delete the student.
     *
     * @param  \App\User  $user
     * @param  \App\App\Models\Student  $student
     * @return mixed
     */
    public function forceDelete(User $user, Student $student)
    {
        return $user->permissions()->permits(UserPermission::STUDENTS, UserPermission::FORCEDELETE)->count() > 0;
    }
}
