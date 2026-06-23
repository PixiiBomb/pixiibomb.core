<?php

namespace PixiiBomb\Core\Controllers;

use PixiiBomb\Core\Data\Page;

class ChatbotController extends PageController
{
    public function index()
    {
        $page = new Page(self::me())
            ->setStylesheets(['blocks/chatbot/index']);
        return parent::view($page);
    }
}
