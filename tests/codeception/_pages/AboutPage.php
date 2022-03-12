<?php

namespace tests\codeception\_pages;

use yii\codeception\BasePage;

/**
 * Represents about paper
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class AboutPage extends BasePage
{
    public $route = 'site/about';
}
