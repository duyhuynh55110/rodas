<?php

namespace Base\Assets;

/**
 * The main Assets singleton class, responsible for registering and rendering assets.
 */
class AssetsManager
{
    /**
     * @var array
     */
    public static $headerScript = [];

    /**
     * @var array
     */
    public static $script = [];

    /**
     * @var array
     */
    public static $css = [];

    /**
     * @var array
     */
    public static $js = [];

    /**
     * @var array
     */
    public static $headerJs = [];

    /**
     * @var array
     */
    public static $baseCss = [];

    /**
     * @var array
     */
    public static $baseJs = [];

    /**
     * Add css or get all css.
     *
     * @param  null  $css
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function css($css = null)
    {
        if (! is_null($css)) {
            return self::$css = array_merge(self::$css, (array) $css);
        }

        $css = array_merge(static::$css, static::baseCss());
        $css = array_filter(array_unique($css));

        return view('Assets::css', compact('css'));
    }

    /**
     * @param  null  $css
     * @return array|null
     */
    public static function baseCss($css = null)
    {
        if (! is_null($css)) {
            return static::$baseCss = $css;
        }

        return static::$baseCss;
    }

    /**
     * Add js or get all js.
     *
     * @param  null  $js
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function js($js = null)
    {
        if (! is_null($js)) {
            return self::$js = array_merge(self::$js, (array) $js);
        }

        $js = array_merge(static::baseJs(), static::$js);
        $js = array_filter(array_unique($js));

        return view('Assets::js', compact('js'));
    }

    /**
     * Add js or get all js.
     *
     * @param  null  $js
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function headerJs($js = null)
    {
        if (! is_null($js)) {
            return self::$headerJs = array_merge(self::$headerJs, (array) $js);
        }

        return view('Assets::js', ['js' => array_unique(static::$headerJs)]);
    }

    /**
     * @param  null  $js
     * @return array|null
     */
    public static function baseJs($js = null)
    {
        if (! is_null($js)) {
            return static::$baseJs = $js;
        }

        return static::$baseJs;
    }

    /**
     * @param  string  $script
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function script($script = '')
    {
        if (! empty($script)) {
            return self::$script = array_merge(self::$script, (array) $script);
        }

        return view('Assets::script', ['script' => array_unique(self::$script)]);
    }

    /**
     * @param  string  $headerScript
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function headerScript($headerScript = '')
    {
        if (! empty($headerScript)) {
            return self::$headerScript = array_merge(self::$headerScript, (array) $headerScript);
        }

        return view('Assets::script', ['script' => array_unique(self::$headerScript)]);
    }
}
