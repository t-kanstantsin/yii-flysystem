<?php
/**
 * @link https://github.com/creocoder/yii2-flysystem
 * @copyright Copyright (c) 2015 Alexander Kochetov
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace tkanstantsin\yii\flysystem;

use League\Flysystem\Sftp\SftpAdapter;
use Yii;

/**
 * SftpFilesystem
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 */
class SftpFilesystem extends Filesystem
{
    /**
     * @var string
     */
    public $host;
    /**
     * @var string
     */
    public $port;
    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $password;
    /**
     * @var integer
     */
    public $timeout;
    /**
     * @var string
     */
    public $root;
    /**
     * @var string
     */
    public $privateKey;
    /**
     * @var integer
     */
    public $permPrivate;
    /**
     * @var integer
     */
    public $permPublic;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->host === null) {
            throw new \CException('The "host" property must be set.');
        }

        if ($this->username === null) {
            throw new \CException('The "username" property must be set.');
        }

        if ($this->password === null && $this->privateKey === null) {
            throw new \CException('Either "password" or "privateKey" property must be set.');
        }

        if ($this->root !== null) {
            $this->root = Yii::getPathOfAlias($this->root);
        }

        parent::init();
    }

    /**
     * @return SftpAdapter
     */
    protected function prepareAdapter()
    {
        $config = [];

        foreach ([
            'host',
            'port',
            'username',
            'password',
            'timeout',
            'root',
            'privateKey',
            'permPrivate',
            'permPublic',
        ] as $name) {
            if ($this->$name !== null) {
                $config[$name] = $this->$name;
            }
        }

        return new SftpAdapter($config);
    }
}