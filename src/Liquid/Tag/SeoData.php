<?php

namespace Stati\Plugin\Seo\Liquid\Tag;

use Liquid\AbstractTag;
use Liquid\Context;

class SeoData extends AbstractTag
{
    public function render(Context $context)
    {
        return 'seo';
    }
}