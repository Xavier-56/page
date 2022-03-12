<?php

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that home paper works');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('My Company');
$I->seeLink('About');
$I->click('About');
$I->see('This is the About paper.');