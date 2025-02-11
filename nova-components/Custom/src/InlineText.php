<?php

namespace Nova\Custom;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class InlineText extends Text
{
    public $component = 'inline-text-field';

    protected function resolveAttribute($resource, $attribute)
    {
        $this->withMeta(['resourceId' => $resource->getKey()]);
        return parent::resolveAttribute($resource, $attribute);
    }

    public function resolve($resource, $attribute = null)
    {
        parent::resolve($resource, $attribute);

        /** @var NovaRequest */
        $novaRequest = app()->make(NovaRequest::class);
        if ($novaRequest->isFormRequest()) $this->component = 'text-field';
    }

    public function maxWidth(int|null $maxWidthPx = null)
    {
        return $this->withMeta(['maxWidth' => $maxWidthPx]);
    }
}
