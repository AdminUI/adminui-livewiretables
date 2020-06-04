<?php
namespace AdminUI\AdminUI;

use Config;
use Form;
use View;
use Facades\AdminUI\AdminUI\Facades\BootFacade;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use AdminUI\Framework\Provider;

class AdminUIServiceProvider extends Provider
{
    public $viewPrefix = 'ui';
    public $dir        = __DIR__;
    public $namespace  = __NAMESPACE__;

    public function _boot(\Illuminate\Routing\Router $router)
    {
        // add middleware to check for admin auth
        $router->aliasMiddleware('adminAuth', 'AdminUI\AdminUI\Middleware\adminAuth::class');
        $router->aliasMiddleware('adminGuest', 'AdminUI\AdminUI\Middleware\adminGuest::class');

        // cache the config table for access via config
        if (Schema::hasTable('configurations')) {
            $settings = BootFacade::Configuration();
            Config::set('settings', $settings);
        }

        if (Schema::hasTable('navigations')) {
            View::share('navigation', BootFacade::navigation());
        }
        if (Schema::hasTable('media_folders')) {
            View::share('folders', BootFacade::mediaFolders());
        }

        config(
            [
                'auth.guards.admin' => [
                    'driver'   => 'session',
                    'provider' => 'admins',
                ],
                'auth.providers.admins' => [
                    'driver' => 'eloquent',
                    'model'  => \AdminUI\AdminUI\Models\Admin::class,
                ],
                'auth.passwords.admins' => [
                    'provider' => 'admins',
                    'table'    => 'password_resets',
                    'expire'   => 30,
                ],
                'filesystems.disks.public.root' => config('media.public_path'),
                'activitylog.default_auth_driver' => 'admin'
            ]
        );

        // form components
        Form::component('auiText', 'uiforms::text', ['name', 'value', 'attributes', 'label']);
        Form::component('auiDate', 'uiforms::date', ['name', 'value', 'attributes', 'label']);
        Form::component('auiNumber', 'uiforms::number', ['name', 'value', 'attributes', 'label']);
        Form::component('auiMoney', 'uiforms::money', ['name', 'value', 'attributes', 'label']);
        Form::component('auiPassword', 'uiforms::password', ['name', 'value', 'attributes', 'label']);
        Form::component('auiEmail', 'uiforms::email', ['name', 'value', 'attributes', 'label']);
        Form::component('auiTextarea', 'uiforms::textarea', ['name', 'value', 'attributes', 'label']);
        Form::component('auiCheckbox', 'uiforms::checkbox', ['name', 'value', 'checked', 'attributes', 'label']);
        Form::component('auiSelect', 'uiforms::select', ['name', 'options', 'value', 'attributes', 'label']);
        Form::component('auiMultiple', 'uiforms::multiple', ['name', 'options', 'value','attributes', 'label']);
        Form::component('auiSwitch', 'uiforms::switch', ['name', 'value', 'attributes', 'label', 'id']);
        Form::component('auiColorPicker', 'uiforms::colorpicker', ['name', 'value', 'attributes', 'label']);
        Form::component('auiDatePicker', 'uiforms::date', ['name', 'value', 'attributes', 'label']);
        Form::component('auiFile', 'uiforms::file', ['name']);
        Form::component('auiDDFile', 'uiforms::ddfile', ['name', 'value', 'label', 'path']);
    }

    public function _register()
    {
        // Push public css and js to public/vendor/adminui
        $this->publishes([
            __DIR__.'/Build/vendor' => public_path('vendor/')
        ], 'adminui-public');
    }
}
