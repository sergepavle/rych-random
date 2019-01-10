<?php
/**
 * Ryan's Random Data Library
 *
 * @package Rych\Random
 * @author Ryan Chouinard <rchouinard@gmail.com>
 * @copyright Copyright (c) 2013, Ryan Chouinard
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */

namespace Rych\Random\Generator;

/**
 * Cryptographically secure pseudo-random number generator
 *
 * The cryptographically secure pseudo-random number generator (CSPRNG) API
 * provides an easy and reliable way to generate crypto-strong random integers
 * and bytes for use within cryptographic contexts.
 *
 * @package Rych\Random
 * @author Ryan Chouinard <rchouinard@gmail.com>
 * @copyright Copyright (c) 2013, Ryan Chouinard
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */
class CSPRNGenerator implements GeneratorInterface
{

    /**
     * Generate a string of random data.
     *
     * @param  integer $byteCount The desired number of bytes.
     * @return string  Returns the generated string.
     */
    public function generate($byteCount)
    {
      $bytes = '';

      if (self::isSupported()) {
        $mcryptStr = random_bytes($byteCount);
        if ($mcryptStr !== false) {
          $bytes = $mcryptStr;
        }
      }

      return str_pad($bytes, $byteCount, chr(0));
    }

    /**
     * Test system support for this generator.
     *
     * @return boolean Returns true if the generator is supported on the current
     *     platform, otherwise false.
     */
    public static function isSupported()
    {
      $supported = false;
      if (function_exists('random_bytes') &&
        version_compare(phpversion(), '7.1', '>=')) {
        $supported = true;
      }

      return $supported;
    }

    /**
     * Get the generator priority.
     *
     * @return integer Returns an integer indicating the priority of the
     *     generator. Lower numbers represent lower priorities.
     */
    public static function getPriority()
    {
        return GeneratorInterface::PRIORITY_HIGH;
    }

}
