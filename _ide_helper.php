<?php
/* @noinspection ALL */
// @formatter:off
// phpcs:ignoreFile

/**
 * A helper file for Laravel, to provide autocomplete information to your IDE
 * Generated for Laravel 12.15.0.
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 * @see https://github.com/barryvdh/laravel-ide-helper
 */
namespace Mews\Captcha\Facades {
    /**
     * 
     *
     * @see \Mews\Captcha\Captcha
     */
    class Captcha {
        /**
         * Create captcha image
         *
         * @param string $config
         * @param bool $api
         * @return array|mixed 
         * @throws Exception
         * @static 
         */
        public static function create($config = 'default', $api = false)
        {
            /** @var \Mews\Captcha\Captcha $instance */
            return $instance->create($config, $api);
        }

        /**
         * Captcha check
         *
         * @param string $value
         * @return bool 
         * @static 
         */
        public static function check($value)
        {
            /** @var \Mews\Captcha\Captcha $instance */
            return $instance->check($value);
        }

        /**
         * Captcha check
         *
         * @param string $value
         * @param string $key
         * @param string $config
         * @return bool 
         * @static 
         */
        public static function check_api($value, $key, $config = 'default')
        {
            /** @var \Mews\Captcha\Captcha $instance */
            return $instance->check_api($value, $key, $config);
        }

        /**
         * Generate captcha image source
         *
         * @param string $config
         * @return string 
         * @static 
         */
        public static function src($config = 'default')
        {
            /** @var \Mews\Captcha\Captcha $instance */
            return $instance->src($config);
        }

        /**
         * Generate captcha image html tag
         *
         * @param string $config
         * @param array $attrs $attrs -> HTML attributes supplied to the image tag where key is the attribute and the value is the attribute value
         * @return string 
         * @static 
         */
        public static function img($config = 'default', $attrs = [])
        {
            /** @var \Mews\Captcha\Captcha $instance */
            return $instance->img($config, $attrs);
        }

            }
    }

namespace Illuminate\Http {
    /**
     * 
     *
     */
    class Request {
        /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestValidation()
         * @param array $rules
         * @param mixed $params
         * @static 
         */
        public static function validate($rules, ...$params)
        {
            return \Illuminate\Http\Request::validate($rules, ...$params);
        }

        /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestValidation()
         * @param string $errorBag
         * @param array $rules
         * @param mixed $params
         * @static 
         */
        public static function validateWithBag($errorBag, $rules, ...$params)
        {
            return \Illuminate\Http\Request::validateWithBag($errorBag, $rules, ...$params);
        }

        /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestSignatureValidation()
         * @param mixed $absolute
         * @static 
         */
        public static function hasValidSignature($absolute = true)
        {
            return \Illuminate\Http\Request::hasValidSignature($absolute);
        }

        /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestSignatureValidation()
         * @static 
         */
        public static function hasValidRelativeSignature()
        {
            return \Illuminate\Http\Request::hasValidRelativeSignature();
        }

        /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestSignatureValidation()
         * @param mixed $ignoreQuery
         * @param mixed $absolute
         * @static 
         */
        public static function hasValidSignatureWhileIgnoring($ignoreQuery = [], $absolute = true)
        {
            return \Illuminate\Http\Request::hasValidSignatureWhileIgnoring($ignoreQuery, $absolute);
        }

        /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestSignatureValidation()
         * @param mixed $ignoreQuery
         * @static 
         */
        public static function hasValidRelativeSignatureWhileIgnoring($ignoreQuery = [])
        {
            return \Illuminate\Http\Request::hasValidRelativeSignatureWhileIgnoring($ignoreQuery);
        }

            }
    }

namespace Illuminate\Routing {
    /**
     * 
     *
     * @mixin \Illuminate\Routing\RouteRegistrar
     */
    class Router {
        /**
         * 
         *
         * @see \LaravelLang\Routes\ServiceProvider::registerGroup()
         * @param \Closure $callback
         * @static 
         */
        public static function localizedGroup($callback)
        {
            return \Illuminate\Routing\Router::localizedGroup($callback);
        }

        /**
         * 
         *
         * @see \Laravel\Ui\AuthRouteMethods::auth()
         * @param mixed $options
         * @static 
         */
        public static function auth($options = [])
        {
            return \Illuminate\Routing\Router::auth($options);
        }

        /**
         * 
         *
         * @see \Laravel\Ui\AuthRouteMethods::resetPassword()
         * @static 
         */
        public static function resetPassword()
        {
            return \Illuminate\Routing\Router::resetPassword();
        }

        /**
         * 
         *
         * @see \Laravel\Ui\AuthRouteMethods::confirmPassword()
         * @static 
         */
        public static function confirmPassword()
        {
            return \Illuminate\Routing\Router::confirmPassword();
        }

        /**
         * 
         *
         * @see \Laravel\Ui\AuthRouteMethods::emailVerification()
         * @static 
         */
        public static function emailVerification()
        {
            return \Illuminate\Routing\Router::emailVerification();
        }

            }
    }


namespace  {
    class Captcha extends \Mews\Captcha\Facades\Captcha {}
}





