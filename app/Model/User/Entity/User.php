<?php

namespace App\Model\User\Entity;

use App\Events\User\UserEmailChangedRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use  Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $type
 * @property string $image
 * @property string $phone
 * @property string $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $verify_token
 * @property string $new_email
 * @property string $new_email_token

 * @property string $status
 * @property string $role
 *
 * @property Network[] networks
 *
 * @method Builder byNetwork(string $network, string $identity)
 *
 */


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';

    public const ROLE_USER = 'user';
    public const ROLE_MODERATOR = 'moderator';
    public const ROLE_ADMIN = 'admin';

    public const TYPE_PERSON = 'person';
    public const TYPE_ORGANIZATION = 'organization';

    public const IMAGE_PATH = 'users';

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'verify_token', 'status', 'role', 'type', 'image'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];



    public static function register(string $name, string $email, string $password, string $type): self
    {
        return static::create([
            'name' => $name,
            'email' => $email,
            'type' => $type,
            'password' => bcrypt($password),
            'verify_token' => Str::uuid(),
            'role' => self::ROLE_USER,
            'status' => self::STATUS_WAIT,
        ]);
    }


//    public static function registerByNetwork(string $network, string $identity): self
//    {
//        $user = static::create([
//            'name' => $identity,
//            'email' => null,
//            'password' => null,
//            'verify_token' => null,
//            'role' => self::ROLE_USER,
//            'status' => self::STATUS_ACTIVE,
//        ]);
//        $user->networks()->create([
//            'network' => $network,
//            'identity' => $identity,
//        ]);
//        return $user;
//    }


    public function attachNetwork(string $network, string $identity): void
    {
        $exists = $this->networks()->where([
            'network' => $network,
            'identity' => $identity
        ])->exists();

        if ($exists){
            throw new \DomainException('Already added network');
        }

        $this->networks()->create([
            'network' => $network,
            'identity' => $identity,
        ]);
    }



    public static function new(string $name, string $email, string $type, string $role): self
    {
        return static::create([
            'name' => $name,
            'email' => $email,
            'type' => $type,
            'password' => bcrypt(Str::random()),
            'role' => $role,
            'status' => self::STATUS_ACTIVE,
        ]);
    }


    public function isPerson(): bool
    {
        return $this->type === self::TYPE_PERSON;
    }

    public function isOrganization(): bool
    {
        return $this->type === self::TYPE_ORGANIZATION;
    }

    public static function typeList(): array
    {
        return [
            self::TYPE_PERSON => 'Person',
            self::TYPE_ORGANIZATION => 'Organization',
        ];
    }


    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isModerator(): bool
    {
        return $this->role === self::ROLE_MODERATOR;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public static function rolesList(): array
    {
        return [
            self::ROLE_USER => 'User',
            self::ROLE_MODERATOR => 'Moderator',
            self::ROLE_ADMIN => 'Admin',
        ];
    }

    public static function statusesList(): array
    {
        return [
            self::STATUS_ACTIVE => 'Активный',
            self::STATUS_WAIT => 'Не активный',
        ];
    }


    public function changeRole($role): void
    {
        if (!array_key_exists($role, self::rolesList())) {
            throw new \InvalidArgumentException('Undefined role "' . $role . '"');
        }
        if ($this->role === $role) {
            throw new \DomainException('Role is already assigned.');
        }
        $this->update(['role' => $role]);
    }

    public function verify(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('User is already verified.');
        }

        $this->update([
            'status' => self::STATUS_ACTIVE,
            'verify_token' => null,
        ]);
    }

    public function getImageUrl(): ?string
    {
        if ($this->image){
            return Storage::disk('public')->url($this->image);
        }
        return  null;
    }

    public function deletePhoto(): void
    {
        if ($this->image){
            if(Storage::disk('public')->exists($this->image)) {
                Storage::disk('public')->delete($this->image);
            }
        }
    }


    public function networks()
    {
        return $this->hasMany(Network::class, 'user_id', 'id');
    }


    public function scopeByNetwork(Builder $query, string $network, string $identity): Builder
    {
        return $query->whereHas('networks', function(Builder $query) use ($network, $identity) {
            $query->where('network', $network)->where('identity', $identity);
        });
    }

    public function findForPassport($identifier)
    {
        return self::where('email', $identifier)->where('status', self::STATUS_ACTIVE)->first();
    }


    public function requestEmailChanging(string $email, string $token): void
    {
        if (!$this->isActive()) {
            throw new \DomainException('User is not active.');
        }
        if ($this->email == $email) {
            throw new \DomainException('Email is already same.');
        }
        $this->new_email = $email;
        $this->new_email_token = $token;

        $this->save();

        event(new UserEmailChangedRequest($this));
    }


    public function confirmEmailChanging(string $token): void
    {
        if (!$this->new_email) {
            throw new \DomainException('Changing is not requested.');
        }
        if ($this->new_email_token !== $token) {
            throw new \DomainException('Incorrect changing token.');
        }
        $this->email = $this->new_email;
        $this->new_email = null;
        $this->new_email_token = null;

        $this->save();
    }


}
