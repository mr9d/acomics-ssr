<?php

namespace Acomics\Ssr\Helpers;

/**
 * Helper to work with filesystem
 */
class FS
{
    /**
     * Thread safe mkdir
     *
     * @param string $directory   <p>
     *                            The directory path.
     *                            </p>
     * @param int    $permissions [optional] <p>
     *                            The mode is 0777 by default, which means the widest possible
     *                            access. For more information on modes, read the details
     *                            on the chmod page.
     *                            </p>
     *                            <p>
     *                            mode is ignored on Windows.
     *                            </p>
     *                            <p>
     *                            Note that you probably want to specify the mode as an octal number,
     *                            which means it should have a leading zero. The mode is also modified
     *                            by the current umask, which you can change using
     *                            umask().
     *                            </p>
     * @param bool   $recursive   [optional] <p>
     *                            Allows the creation of nested directories specified in the pathname.
     *                            Default to <b>TRUE</b> because it is the most common usage.
     *                            </p>
     *
     * @return void
     */
    public static function mkdir(string $directory, int $permissions = 0775, bool $recursive = true): void
    {
        try {
            if (!\mkdir($directory, $permissions, $recursive) && !\is_dir($directory)) {
                throw new \RuntimeException("Directory \"{$directory}\" was not created");
            }
        } catch (\RuntimeException $exception) {
            throw $exception;
        } catch (\Throwable $exception) {
            throw new \RuntimeException(
                "Directory \"{$directory}\" was not created cause error: {$exception->getMessage()}",
                $exception->getCode(),
                $exception,
            );
        }
    }
}
