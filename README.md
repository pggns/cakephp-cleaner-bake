# CakePHP plugin that adds some cleaner Bake Templates

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install the composer packages is:

```
composer require --dev pggns/cakephp-cleaner-bake
```

Then add the following line to `src/Application.php`:

```
$this->addPlugin('Pggns/CleanerBake');
```

## How to use the templates?

To automatically use the templates in every bake command, add the following line to your `config/bootstrap.php`:

```
Configure::write('Bake.theme', 'Pggns/CleanerBake');
```

To manually use them in only some bake commands, just add `--theme Pggns/CleanerBake`.

## What do the templates change?

These templates don't change the output in a functional way, only cosmetic changes are made:

- Replaces 4 spaces with tabs
- Moves opening brackets `{` to the end of the line
- Aligns arrays
- Add some new lines to make the files more organized
- Some other minor changes

### Before:

```
<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $mail
 * @property string $password
 * @property string $register_status
 * @property string|null $register_hash
 * @property \Cake\I18n\FrozenTime|null $register_datetime
 * @property string|null $reset_password_hash
 * @property \Cake\I18n\FrozenTime|null $reset_password_datetime
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\SpotifyUser $spotify_user
 * @property \App\Model\Entity\TwitchUser $twitch_user
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'mail' => true,
        'password' => true,
        'register_status' => true,
        'register_hash' => true,
        'register_datetime' => true,
        'reset_password_hash' => true,
        'reset_password_datetime' => true,
        'created' => true,
        'modified' => true,
        'spotify_user' => true,
        'twitch_user' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
}
```

### After:

```
<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $mail
 * @property string $password
 * @property string $register_status
 * @property string|null $register_hash
 * @property \Cake\I18n\FrozenTime|null $register_datetime
 * @property string|null $reset_password_hash
 * @property \Cake\I18n\FrozenTime|null $reset_password_datetime
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\SpotifyUser $spotify_user
 * @property \App\Model\Entity\TwitchUser $twitch_user
 */
class User extends Entity {
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible  =   [
        'username'                  =>  true,
        'mail'                      =>  true,
        'password'                  =>  true,
        'register_status'           =>  true,
        'register_hash'             =>  true,
        'register_datetime'         =>  true,
        'reset_password_hash'       =>  true,
        'reset_password_datetime'   =>  true,
        'created'                   =>  true,
        'modified'                  =>  true,
        'spotify_user'              =>  true,
        'twitch_user'               =>  true,
    ];
    
    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden  =   [
        'password',
    ];
}
```