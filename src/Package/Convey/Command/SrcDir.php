<?php

namespace Pickle\Package\Convey\Command;

use Composer\Config;
use Pickle\Package;
use Pickle\Package\Convey\Command\Command;
use Pickle\Package\Convey\Command\Type;

class SrcDir extends AbstractCommand implements Command
{
    protected function prepare()
    {
        $this->url = $this->path;
    }

    public function execute($target, $no_convert)
    {
        if (!$this->extConfigIsIn($target) && $this->extConfigIsIn($this->path)) {
            $target = realpath($this->path);
        }

        return parent::execute($target, $no_convert);
    }

    public function getType()
    {
        return Type::SRC_DIR;
    }
}
