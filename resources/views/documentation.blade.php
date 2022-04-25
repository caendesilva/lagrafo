<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Lagrafo') }} - {{ $document->title ?? 'Documentation'  }}</title>
</head>
<body id="lagrafo-app">
    <nav id="navigation-menu">
        <strong>
            <a href="{{ Lagrafo::route('index') }}">Lagrafo</a>
        </strong>

        <button id="toggle-nav">

        </button>
    </nav>
    <aside id="sidebar">
        <nav id="sidebar-navigation">
            <ul id="sidebar-navigation-menu">
                <li class="sidebar-navigation-item active" aria-current="page">
                    <a href="{{ Lagrafo::route('index') }}"></a>
                </li>
                <li class="sidebar-navigation-item">
                    <a href="{{ Lagrafo::route('index') }}"></a>
                </li>
                <li class="sidebar-navigation-item">
                    <a href="{{ Lagrafo::route('index') }}"></a>
                </li>
            </ul>
        </nav>
        <footer id="sidebar-footer">
            <p>
                <a href="{{ route('home') ?? '/' }}">Back to app</a>
            </p>
        </footer>
    </aside>
    <main id="content">
        <article class="prose">
            <header>
                <h1>{{ $document->title }}</h1>
            </header>
            <section>
                {!! $document->html !!}
            </section>
            <footer>
                <a href="">Edit this page</a>

                <a href=""><< Previous</a>
                <a href="">Next >></a>
            </footer>
        </article>
    </main>
    <footer>
        <small>
            <a href="https://github.com/caendesilva/lagrafo">Lagrafo</a>
        </small>
    </footer>
</body>
</html>
