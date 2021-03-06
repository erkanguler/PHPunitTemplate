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
 * Manage guestbok.
 *
 * @package    MyPackage
 * @author     Erkan Güler
 * @copyright  2001-2012 Facetime Media AB
 * @license    http://www.facetimemedia.se/sv/about  The License
 * @version    Release: 0.1.0
 * @link       http://www.facetimemedia.se
 * @since      Class available since Release 0.1.0
 */
class Guestbook {

    /**
     *  Contains a PDO object reference.
     * 
     * @var PDO 
     */
    private $pdo;

    /**
     * Constructor for Guestbook.
     * 
     * @param PDO $pdo
     */
    function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Adds guestbook entries into the table guestbook. 
     * 
     * @param int $id
     * @param string $content
     * @param string $user
     * @return boolean
     */
    function addEntry($id, $content, $user) {
        $query = "INSERT INTO guestbook VALUES ($id, '$content', '$user')";

        if (!$this->pdo->query($query)) {
            return false;
        }
        return true;
    }

}

?>
