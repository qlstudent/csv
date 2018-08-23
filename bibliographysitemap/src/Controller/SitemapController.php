<?php

namespace Drupal\bibliographysitemap\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class SitemapController.
 */
class SitemapController extends ControllerBase
{

    /**
     * Showsitemapindex.
     *
     * @return string
     *   Return Hello string.
     */
    public function showSiteMapIndex()
    {
        $module_path = drupal_get_path('module', 'bibliographysitemap');
        $param = \Drupal::request()->query->all();
        if (isset($param) && count($param) > 0 && array_key_exists("page", $param)) {
            $file = $module_path . '/payload/' . 'bibliographysitemap' . $param["page"] . '.xml';
            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->headers->set('Content-Type', 'xml');
            $response->setContent(file_get_contents($file));
            return $response;
        } else {
            $file_list = file_scan_directory($module_path . '/payload/', '/.*\.xml$/');
            $siteMapIndex = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');
            for ($i = 0; $i < count($file_list); $i++) {
                $siteMapIndexElement = $siteMapIndex->addChild('sitemap');
                $siteMapIndexElement->addChild('loc', \Drupal::request()->getSchemeAndHttpHost() . "/bibliographysitemap.xml?page=" . $i);
                $siteMapIndexElement->addChild('lastmod', date('Y-m-d', time()));
            }
            $dom = new \DOMDocument();
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($siteMapIndex->asXML());
            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->headers->set('Content-Type', 'xml');
            $response->setContent($dom->saveXML());
            return $response;
        }
    }
}
