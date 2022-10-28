<?php

namespace App\Modules;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use PragmaRX\Yaml\Package\Yaml;

/**
 * Create Module Service Provider.
 */
class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register module.
     *
     * @return void
     */
    public function boot(Application $app, Yaml $yaml)
    {
        $modules = array_map('basename', File::directories(__DIR__));
        foreach ($modules as $module) {
            $modulePath = __DIR__.'/'.$module;

            // Load the config
            $configPath = $modulePath.'/Config';

            if (is_dir($configPath)) {
                // load config yml file
                $yaml->loadToConfig($configPath, strtolower($module));

                // load config php file
                // - get all php files in config path
                // - load config file with key name
                // - using config: config('module.file-name.key')
                $configFiles = collect(File::files($configPath))->filter(
                    function ($file) {
                        return $file->getExtension() == 'php';
                    }
                );
                foreach ($configFiles as $configFile) {
                    $key = str_replace('.php', '', $configFile->getBaseName());
                    $this->mergeConfigFrom($configFile, strtolower($module).'.'.$key);
                }
            }

            // Load the given routes
            $routePath = $modulePath.'/Routes/routes.php';
            if (file_exists($routePath)) {
                include $routePath;
            }

            // Register views
            // - using view: __('module::view-name')
            $viewPath = $modulePath.'/Resources/views';
            if (is_dir($viewPath)) {
                $this->loadViewsFrom($viewPath, $module);
            }

            // Register translations
            // - using translation: __('module::file-name.key')
            $langPath = $modulePath.'/Resources/lang';
            if (is_dir($langPath)) {
                $this->loadTranslationsFrom($langPath, strtolower($module));
            }
        }
    }
}
