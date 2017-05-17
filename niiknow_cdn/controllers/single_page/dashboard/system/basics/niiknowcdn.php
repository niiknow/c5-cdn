<?php
namespace Concrete\Package\NiiknowCdn\Controller\SinglePage\Dashboard\System\Basics;

defined('C5_EXECUTE') or die(_("Access Denied."));

use Package;
use \Concrete\Core\Page\Controller\DashboardPageController;

class NiiknowCdn extends DashboardPageController
{
    public function view()
    {
        $pkg = Package::getByHandle('niiknow_cdn');
        $this->set('CDN_ENABLED', $pkg->isEnabled());
        $this->set('CDN_OFFSITE_URL', $pkg->getOffsiteUrl());
        $this->set('CDN_INCLUDE_PATH', str_replace('|', ', ', $pkg->getIncludePath()));
        $this->set('CDN_EXCLUDE_SUBSTRINGS', str_replace('|', ', ', $pkg->getExcludeSubstrings()));
        $this->set('SITE_URL', $pkg->getSiteUrl());
    }

    public function success()
    {
        $this->set('success', t('Configuration updated'));
        $this->view();
    }

    public function saveSettings()
    {
        $pkg = Package::getByHandle('niiknow_cdn');
        $pkg->setEnabled($this->post('CDN_ENABLED'));
        $pkg->setOffsiteUrl($this->post('CDN_OFFSITE_URL'));
        $pkg->setIncludePath($this->post('CDN_INCLUDE_PATH'));
        $pkg->setExcludeSubstrings($this->post('CDN_EXCLUDE_SUBSTRINGS'));
        $this->redirect('/dashboard/system/basics/niiknowcdn/success');
    }
}
