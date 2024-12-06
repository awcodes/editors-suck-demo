<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('favicon.svg') }}">
        <title>Editor.js experiments</title>

        <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>

        <script src="{{ asset('editorjs/simple-image/index.js') }}"></script>
        <script src="{{ asset('editorjs/marker/index.js') }}"></script>

        <link href="{{ asset('editorjs/simple-image/index.css') }}" rel="stylesheet"/>

        @vite(['resources/css/app/app.css'])
    </head>
    <body>
        <div id="editorjs"></div>

        <button id="save-button">Save</button>
        <pre id="output"></pre>

        <script>
            const editor = new EditorJS({
                autofocus: true,
                tools: {
                    image: {
                        class: SimpleImage,
                        inlineToolbar: true,
                        config: {
                            placeholder: 'Paste image URL'
                        }
                    },
                    marker: {
                        class: MarkerTool
                    }
                },
                data: {
                    "time": 1729279177763,
                    "blocks": [
                        {
                            "id": "T6LXR72Ol9",
                            "type": "image",
                            "data": {
                                "url": "https://cdn.pixabay.com/photo/2017/09/01/21/53/blue-2705642_1280.jpg",
                                "caption": "That's a lot of blue.",
                                "withBorder": false,
                                "withBackground": true,
                                "stretched": false
                            }
                        },
                        {
                            "id": "KbyAlSXIhi",
                            "type": "paragraph",
                            "data": {
                                "text": "Lorem laborum eiusmod fugiat amet id reprehenderit nisi reprehenderit magna consequat in. In nulla in ullamco aute officia ex cillum dolore officia minim velit pariatur. Enim labore occaecat velit laboris enim sunt. Esse enim sunt ex nulla fugiat. Fugiat excepteur incididunt ex minim duis reprehenderit do consectetur voluptate veniam laboris quis."
                            }
                        }
                    ],
                    "version": "2.30.6"
                }
            });

            const saveButton = document.getElementById('save-button')
            const output = document.getElementById('output')

            saveButton.addEventListener('click', () => {
                editor.save().then(savedData => {
                    output.innerHTML = JSON.stringify(savedData, null, 4)
                })
            })
        </script>
    </body>
</html>
