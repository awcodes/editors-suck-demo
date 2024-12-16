<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $page->title }}</title>

        @vite(['resources/css/app/app.css'])

        @livewireStyles
    </head>
    <body class="antialiased bg-slate-50 text-slate-900 dark:bg-slate-900 dark:text-slate-50">
        <header class="py-3 bg-slate-100 dark:bg-slate-950">
            <div class="flex items-center justify-between gap-6 px-6">
                <a href="{{ route('page.show', $page) }}">Home</a>
                <x-dimmer::controls />
            </div>
        </header>
        <main
            @class([
                'py-12 prose dark:prose-invert max-w-5xl mx-auto' => ! $page->full_page,
            ])
        >
            {!! typist($page->content)->mergeTagsMap(['name' => 'Adam', 'email' => 'test@example.com', 'phone' => '(912) 867-5309'])->toHtml() !!}
        </main>

        @livewireScripts
    </body>
</html>
