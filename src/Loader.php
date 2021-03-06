<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2001-2012, Facetime Media AB <http://www.facetimemedia.se>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Facetime Media AB nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *  
 */

/**
 * This class <tt>Loader</tt> has responsiblity for loading classes.
 *
 * @package    MyPackage
 * @author     Erkan Güler
 * @copyright  2001-2012 Facetime Media AB
 * @license    http://www.facetimemedia.se/sv/about  The License
 * @version    Release: 0.1.0
 * @link       http://www.facetimemedia.se
 * @since      Class available since Release 0.1.0
 */
class Loader {

    /**
     *  Loads the specified class.
     * 
     * @assert ('Person') == new Person()
     * @assert ('Car') == new Car()
     * @assert () throws InvalidArgumentException
     * @assert ('NoClass') throws UnexpectedValueException
     * @assert ('Car') == new Car()
     * 
     * @staticvar array $classRegistry
     * @param string $className
     * @return loaded class
     * @throws InvalidArgumentException
     * @throws UnexpectedValueException
     */
    public function load($className = NULL) {

        if ($className === NULL or $className === '') {
            throw new InvalidArgumentException('Missing argument');
        }

        static $classRegistry = array();

        if (isset($classRegistry[$className])) {
            return $classRegistry[$className];
        }

        $path = dirname(__DIR__) . "/fixture/classes/$className.php";

        if (is_readable($path)) {
            require_once($path);

            if (class_exists($className)) {
                $classRegistry[$className] = new $className;
                return $classRegistry[$className];
            }
        }
        throw new UnexpectedValueException('This class does not exist: ' . $className);
    }

}

?>
