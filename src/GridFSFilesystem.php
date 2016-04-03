<?php
/**
 * @link https://github.com/creocoder/yii2-flysystem
 * @copyright Copyright (c) 2015 Alexander Kochetov
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace tkanstantsin\yii\flysystem;

use League\Flysystem\GridFS\GridFSAdapter;
use MongoClient;

/**
 * GridFSFilesystem
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 */
class GridFSFilesystem extends Filesystem
{
    /**
     * @var string
     */
    public $server;
    /**
     * @var string
     */
    public $database;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->server === null) {
            throw new \CException('The "server" property must be set.');
        }

        if ($this->database === null) {
            throw new \CException('The "database" property must be set.');
        }

        parent::init();
    }

    /**
     * @return GridFSAdapter
     */
    protected function prepareAdapter()
    {
        return new GridFSAdapter((new MongoClient($this->server))->selectDB($this->database)->getGridFS());
    }
}
