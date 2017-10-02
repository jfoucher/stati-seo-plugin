<?php

namespace Stati\Plugin\Seo;

use Stati\Event\SiteEvent;
use Stati\Event\SettingTemplateVarsEvent;
use Stati\Event\WillParseTemplateEvent;
use Stati\Plugin\Plugin;
use Stati\Site\Site;
use Stati\Site\SiteEvents;
use Stati\Liquid\TemplateEvents;
use Stati\Plugin\Seo\Liquid\Tag\SeoData;

class Seo extends Plugin
{
    protected $name = 'seo';

    public static function getSubscribedEvents()
    {
        return array(
            TemplateEvents::WILL_PARSE_TEMPLATE => 'onWillParseTemplate',
        );
    }

    public function onWillParseTemplate(WillParseTemplateEvent $event)
    {
        $template = $event->getTemplate();
        $template->registerTag('seo', SeoData::class);
    }



    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
