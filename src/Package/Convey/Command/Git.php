<?php

namespace Pickle\Package\Convey\Command;

use Composer\Config;
use Pickle\Package;
use Composer\Downloader\GitDownloader;
use Pickle\Package\Convey\Command\Command;
use Pickle\Package\Convey\Command\Type;

class Git extends AbstractCommand implements Command
{
    protected function prepare()
    {
        if (Type::determineGit($this->path, $matches) < 1) {
            throw new \Exception("Not valid git URI");
        }

        $this->name = $matches['package'];
        $this->version = isset($matches['reference']) ? $matches['reference'] : 'master';
        $this->prettyVersion = $this->version;
        $this->url = preg_replace('/#.*$/', '', $this->path);
    }

    protected function fetch($target)
    {
        $package = new Package($this->name, $this->version, $this->prettyVersion);

        $package->setSourceType('git');
        $package->setSourceUrl($this->url);
        $package->setSourceReference($this->version);
        $package->setRootDir($target);

        $downloader = new GitDownloader($this->io, new Config());
        if (null !== $downloader) {
            $downloader->download($package, $target);
        }
    }

    public function execute($target, $no_convert)
    {
        $this->fetch($target);

        return parent::execute($target, $no_convert);
    }

    public function getType()
    {
        return Type::GIT;
    }
}
