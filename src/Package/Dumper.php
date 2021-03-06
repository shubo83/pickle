<?php
namespace Pickle\Package;

use Pickle\Package;

class Dumper
{
    public function dump(Package $package)
    {
        $data = [];

        $data['name'] = $package->getPrettyName();
        $data['version'] = $package->getPrettyVersion();
        $data['type'] = $package->getType();
        $data['stability'] = $package->getStability();

        if ($license = $package->getLicense()) {
            $data['license'] = $license;
        }

        if ($authors = $package->getAuthors()) {
            $data['authors'] = $authors;
        }

        if ($description = $package->getDescription()) {
            $data['description'] = $description;
        }

        if ($support = $package->getSupport()) {
            $data['support'] = $support;
        }

        if ($extra = $package->getExtra()) {
            $data['extra'] = $extra;
        }

        return $data;
    }
}
