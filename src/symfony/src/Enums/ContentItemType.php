<?php

namespace App\Enums;

enum ContentItemType: string
{
    case TYPE_ARTICLE = 'TYPE_ARTICLE';
    case TYPE_BLOG_POST = 'TYPE_BLOG_POST';
    case TYPE_PAGE = 'TYPE_PAGE';
    case TYPE_VIDEO = 'TYPE_VIDEO';
}