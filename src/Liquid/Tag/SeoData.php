<?php

namespace Stati\Plugin\Seo\Liquid\Tag;

use Liquid\AbstractTag;
use Liquid\Context;
use Stati\Entity\Doc;
use Stati\Site\Site;

class SeoData extends AbstractTag
{
    public function render(Context $context)
    {
        $page = $context->get('page');
        $site = $context->get('site');
        /**
         * @var Doc $page
         * @var Site $site
         */

        $config = $site->getConfig();
        $siteTitle = isset($config['title']) ? strip_tags($config['title']) : '';
        $pageTitle = strip_tags($page->getTitle());
        $canonicalUrl = $site->url.$site->baseurl.$page->getUrl();
        $description = strip_tags($page->description ? $page->description : (isset($config['description']) ? $config['description'] : ''));


        $content = "<!-- Begin Stati SEO tag v0.1 -->\r\n";
        $content .= '<title>'.$pageTitle.' | '.$siteTitle.'</title>'."\r\n";
        $content .= "<meta property=\"og:title\" content=\"$pageTitle\">\r\n";
        if (isset($config['lang'])) {
            $content .= '<meta property="og:locale" content="' . $config['lang'] . '">'."\r\n";
        }

        $content .= "<meta name=\"description\" content=\"$description\">\r\n";
        $content .= "<meta name=\"og:description\" content=\"$description\">\r\n";
        $content .= "<link rel=\"canonical\" href=\"$canonicalUrl\">\r\n";
        $content .= "<meta property=\"og:url\" content=\"$canonicalUrl\">\r\n";
        $content .= "<meta property=\"og:site_name\" content=\"$siteTitle\">\r\n";

        if (isset($config['twitter']) && isset($config['twitter']['username'])) {
            $content .= '<meta name="twitter:card" content="summary">';
            $content .= '<meta name="twitter:site" content="@' . $config['twitter']['username'] . '">';
        }
        if (isset($config['google_site_verification'])) {
            $content .= '<meta name="google-site-verification" content="' . $config['google_site_verification'] . '">';
        }
        $content .= '<script type="application/ld+json">'."\r\n";
        $data = [
            'name' => $siteTitle,
            'description' => $description,
            'author' => $site->author,
            '@type' => "WebPage",
            'url' => $canonicalUrl,
            'image' => $page->image,
            'publisher' => [
                "@type" => "Organization",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => $site->logo,
                ]
            ],
            'headline' => $page->getTitle(),
            'dateModified' => $site->getTime(),
            'datePublished' => $site->getTime(),
            "@context" => "http://schema.org",
        ];
        $content .= json_encode($data)."\r\n";
        $content .= '</script>'."\r\n";

        $content .= '<!-- End Stati SEO tag -->'."\r\n";
        return $content;
    }
}