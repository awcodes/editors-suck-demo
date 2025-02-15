<?php

namespace App\Richie\Editors;

use Awcodes\Richie\Actions\Bold;
use Awcodes\Richie\Actions\BulletList;
use Awcodes\Richie\Actions\HeadingThree;
use Awcodes\Richie\Actions\HeadingTwo;
use Awcodes\Richie\Actions\Italic;
use Awcodes\Richie\Actions\Link;
use Awcodes\Richie\Actions\OrderedList;
use Awcodes\Richie\Actions\Strike;
use Awcodes\Richie\RichieEditor;

class MinimalEditor extends RichieEditor
{
    protected function setUp(): void
    {
        $this
            ->toolbar([
                Bold::make('Bold'),
                Italic::make('Italic'),
                Strike::make('Strike'),
                Link::make('Link'),
                BulletList::make('BulletList'),
                OrderedList::make('OrderedList'),
                HeadingTwo::make('HeadingTwo'),
                HeadingThree::make('HeadingThree'),
            ], merge: false)
            ->suggestions([], merge: false)
            ->mergeTags([])
            ->sidebar([]);

        parent::setUp();
    }
}
