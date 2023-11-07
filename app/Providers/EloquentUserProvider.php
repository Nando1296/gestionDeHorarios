<?php

namespace App\Providers;

use Closure;
use Illuminate\Auth\EloquentUserProvider as UserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EloquentUserProvider extends UserProvider
{
    const PASSWORD_KEY = 'contrasenia';

    /**
     * @param array $credentials
     * @return Builder|Model|object|void|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
            (count($credentials) === 1 &&
                Str::contains($this->firstCredentialKey($credentials), self::PASSWORD_KEY))) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->newModelQuery();

        foreach ($credentials as $key => $value) {
            if (Str::contains($key, self::PASSWORD_KEY)) {
                continue;
            }

            if (is_array($value) || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } elseif ($value instanceof Closure) {
                $value($query);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }

    public function validateCredentials(UserContract $user, array $credentials): bool
    {
        $plain = $credentials[self::PASSWORD_KEY];

        return $this->hasher->check($plain, $user->getAuthPassword());
    }

}
