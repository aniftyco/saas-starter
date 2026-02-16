<?php

use App\Models\User;
use Hashids\Hashids;
use TailwindMerge\Contracts\TailwindMergeContract;

if (! function_exists('relative_path')) {
    /**
     * Get the relative path from the base path.
     *
     * @param  string  $separator
     */
    function relative_path(string $path, $separator = DIRECTORY_SEPARATOR): string
    {
        $base = array_slice(explode($separator, rtrim(base_path(), $separator)), 1);
        $path = array_slice(explode($separator, rtrim($path, $separator)), 1);

        return implode($separator, array_slice($path, count($base)));
    }
}

if (! function_exists('clsx')) {
    /**
     * clsx / tailwind-merge for Blade.
     *
     * @param  string|array<array-key, string|bool>  ...$classes
     */
    function clsx(...$classes): string
    {
        return app(TailwindMergeContract::class)->merge(
            implode(' ',
                array_filter(
                    array_map(function ($class) {
                        return is_array($class)
                          ? implode(' ', array_filter(
                              array_map(fn ($value, $key) => $value && ! empty($key)
                              ? $key : '', $class, array_keys($class))))
                          : $class;
                    }, $classes)
                )
            )
        );
    }
}

if (! function_exists('user')) {
    /**
     * Get the authenticated user.
     */
    function user(): User
    {
        return auth()->user();
    }
}

if (! function_exists('hashid')) {
    /**
     * Return a Hashids instance.
     */
    function hashid(): Hashids
    {
        return new Hashids(config('app.key'), 8);
    }
}

if (! function_exists('hashid_encode')) {
    /**
     * Encode a UUID to a short hashid string.
     */
    function hashid_encode(string $uuid): string
    {
        $hex = str_replace('-', '', $uuid);
        if (! preg_match('/^[0-9a-fA-F]{32}$/', $hex)) {
            return $uuid;
        }

        $parts = [];
        for ($i = 0; $i < 4; $i++) {
            $parts[] = hexdec(substr($hex, $i * 8, 8));
        }

        return hashid()->encode(...$parts);
    }
}

if (! function_exists('hashid_decode')) {
    /**
     * Decode a hashid string back to a UUID.
     * Returns the original value if decoding fails.
     */
    function hashid_decode(string $shortId): string
    {
        try {
            $parts = hashid()->decode($shortId);
            if (is_array($parts) && count($parts) === 4) {
                $hex = '';
                foreach ($parts as $p) {
                    $hex .= str_pad(dechex((int) $p), 8, '0', STR_PAD_LEFT);
                }

                return substr($hex, 0, 8).'-'.substr($hex, 8, 4).'-'.substr($hex, 12, 4).'-'.substr($hex, 16, 4).'-'.substr($hex, 20);
            }
        } catch (\Throwable) {
            // Fall back to original value
        }

        return $shortId;
    }
}
