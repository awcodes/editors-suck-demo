<?php

namespace App\Typist\Editors;

use Awcodes\Typist\Actions\Bold;
use Awcodes\Typist\Actions\BulletList;
use Awcodes\Typist\Actions\HeadingThree;
use Awcodes\Typist\Actions\HeadingTwo;
use Awcodes\Typist\Actions\Italic;
use Awcodes\Typist\Actions\Link;
use Awcodes\Typist\Actions\OrderedList;
use Awcodes\Typist\Actions\Strike;
use Awcodes\Typist\TypistEditor;

class MinimalEditor extends TypistEditor
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
