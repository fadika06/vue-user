# User

[![Join the chat at https://gitter.im/vue-user/Lobby](https://badges.gitter.im/vue-user/Lobby.svg)](https://gitter.im/vue-user/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bantenprov/vue-user/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/vue-user/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/bantenprov/vue-user/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/vue-user/build-status/master)
[![Latest Stable Version](https://poser.pugx.org/bantenprov/vue-user/v/stable)](https://packagist.org/packages/bantenprov/user)
[![Total Downloads](https://poser.pugx.org/bantenprov/vue-user/downloads)](https://packagist.org/packages/bantenprov/user)
[![Latest Unstable Version](https://poser.pugx.org/bantenprov/vue-user/v/unstable)](https://packagist.org/packages/bantenprov/user)
[![License](https://poser.pugx.org/bantenprov/vue-user/license)](https://packagist.org/packages/bantenprov/user)
[![Monthly Downloads](https://poser.pugx.org/bantenprov/vue-user/d/monthly)](https://packagist.org/packages/bantenprov/user)
[![Daily Downloads](https://poser.pugx.org/bantenprov/vue-user/d/daily)](https://packagist.org/packages/bantenprov/user)


# User
User

### Install via composer

- Development snapshot

```bash
$ composer require bantenprov/user:dev-master
```

- Latest release:

### Download via github

```bash
$ git clone https://github.com/bantenprov/user.git
```

#### Edit `config/app.php` :

```php
'providers' => [

    /*
    * Laravel Framework Service Providers...
    */
    Illuminate\Auth\AuthServiceProvider::class,
    Illuminate\Broadcasting\BroadcastServiceProvider::class,
    Illuminate\Bus\BusServiceProvider::class,
    Illuminate\Cache\CacheServiceProvider::class,
    Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
    Illuminate\Cookie\CookieServiceProvider::class,
    //....
    Bantenprov\User\UserServiceProvider::class,
```

#### Publish database seeder :

```bash
$ php artisan vendor:publish --tag=user-seeds

```

#### Lakukan auto dump :

```bash
$ composer dump-autoload
```

#### Lakukan seeding :

```bash
$ php artisan db:seed --class=BantenprovUserSeederUser
```

#### Lakukan publish component vue :

```bash
$ php artisan vendor:publish --tag=user-assets
```
#### Tambahkan route di dalam file : `resources/assets/js/routes.js` :

```javascript
{
    path: '/admin',
    redirect: '/admin/dashboard/home',
    component: layout('Default'),
    children: [
        //== ...
        {
            path: '/admin/user',
            components: {
                main: resolve => require(['~/components/bantenprov/user/User.index.vue'], resolve),
                navbar: resolve => require(['~/components/Navbar.vue'], resolve),
                sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "User"
            }
        },
        {
            path: '/admin/user/create',
            components: {
                main: resolve => require(['~/components/bantenprov/user/User.add.vue'], resolve),
                navbar: resolve => require(['~/components/Navbar.vue'], resolve),
                sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "User"
            }
        },
        {
            path: '/admin/user/:id',
            components: {
                main: resolve => require(['~/components/bantenprov/user/User.show.vue'], resolve),
                navbar: resolve => require(['~/components/Navbar.vue'], resolve),
                sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "User"
            }
        },
        {
          path: '/admin/user/user-add-role/:id',
          components: {
              main: resolve => require(['~/components/bantenprov/user/User.AddRole.vue'], resolve),
              navbar: resolve => require(['~/components/Navbar.vue'], resolve),
              sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
          },
          meta: {
              title: "User"
          }
        },
        {
            path: '/admin/user/:id/edit',
            components: {
                main: resolve => require(['~/components/bantenprov/user/User.edit.vue'], resolve),
                navbar: resolve => require(['~/components/Navbar.vue'], resolve),
                sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "User"
            }
        },
        //== ...
    ]
},
```
#### Edit menu `resources/assets/js/menu.js`

```javascript
{
    name: 'Dashboard',
    icon: 'fa fa-dashboard',
    childType: 'collapse',
    childItem: [
        //== ...
         {
            name: 'User',
            link: '/admin/user',
            icon: 'fa fa-angle-double-right'
        }
        //== ...
    ]
},
```

```javascript
{
    name: 'Admin',
    icon: 'fa fa-lock',
    childType: 'collapse',
    childItem: [
        //== ...
        {
            name: 'User',
            link: '/admin/user',
            icon: 'fa fa-angle-double-right'
          }
        //== ...
    ]
},
```
