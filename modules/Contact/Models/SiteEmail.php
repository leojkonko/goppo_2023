<?php

namespace Ellite\Contact\Models;

use App\Ellite\ElliteModel;
use Orchid\Filters\Filterable;

class SiteEmail extends ElliteModel
{
    use Filterable;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'site_emails';

    /**
     * Name of columns to which http filter can be applied
     *
     * @var array
     */
    protected $allowedFilters = [
        'form_name',
        'form_slug',
        'entity_name',
        'entity_id',
        'created_at',
        'name',
        'email',
        'phone',
        'whatsapp',
        'subject',
        'message',
    ];

    public function getLogName()
    {
        return $this->id;
    }
    
    public static function getEntityNameSingular()
    {
        return 'mensagem do site';
    }

    public static function getEntityNamePlural()
    {
        return 'mensagens do site';
    }

    public static function getArticle()
    {
        return 'a';
    }
}
